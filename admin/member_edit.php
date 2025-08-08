<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method not allowed";
    exit;
}

// $team_id = intval($_POST['team_id']);
$member_id = intval($_POST['id']);
$symbol_no = trim($_POST['symbol_no']);
$member_name = trim($_POST['member_name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$college = trim($_POST['college']);

if (!$member_id) {
    echo "<p style='color:red;'>Invalid member ID.</p>";
    exit;
}

$errors = [];
if (!preg_match('/^\d{8}$/', $symbol_no)) $errors[] = "Invalid Symbol No.";
if (!preg_match('/^[a-zA-Z\s]+$/', $member_name)) $errors[] = "Invalid Name.";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid Email.";
if (!preg_match('/^(97|98)\d{8}$/', $phone)) $errors[] = "Invalid Phone.";
if (!preg_match('/^[a-zA-Z\s]+$/', $college)) $errors[] = "Invalid College.";

if (!empty($errors)) {
    foreach ($errors as $err) {
        echo "<p style='color:red;'>$err</p>";
    }
    exit;
}

// Handle image uploads
$photo_path = '';
$admit_path = '';
$upload_dir = "../uploads/";

function handleImageUpload($field, $existingPath) {
    global $upload_dir;
    if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES[$field]['tmp_name'];
        $fileName = basename($_FILES[$field]['name']);
        $fileSize = $_FILES[$field]['size'];

        if ($fileSize > 200 * 1024) {
            echo "<p style='color:red;'>$field file is too large. Max 200KB allowed.</p>";
            exit;
        }

        $newName = uniqid() . '_' . $fileName;
        $destination = $upload_dir . $newName;

        if (move_uploaded_file($fileTmp, $destination)) {
            return $destination;
        } else {
            echo "<p style='color:red;'>Failed to upload $field.</p>";
            exit;
        }
    }
    return $existingPath;
}

// Fetch existing images
$existing = $conn->prepare("SELECT photo, admit_card FROM team_members WHERE id = ?");
$existing->bind_param("i", $member_id);
$existing->execute();
$result = $existing->get_result();

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $photo_path = handleImageUpload('photo', $data['photo']);
    $admit_path = handleImageUpload('admit_card', $data['admit_card']);
} else {
    echo "<p style='color:red;'>Member not found.</p>";
    exit;
}

// Perform update
$stmt = $conn->prepare("UPDATE team_members SET symbol_no = ?, member_name = ?, email = ?, phone = ?, college = ?, photo = ?, admit_card = ? WHERE id = ?");
$stmt->bind_param("sssssssi", $symbol_no, $member_name, $email, $phone, $college, $photo_path, $admit_path, $member_id);

if ($stmt->execute()) {
    echo "<script>alert('Member updated successfully.'); window.location.href='member.php';</script>";
} else {
    echo "<p style='color:red;'>Error updating member: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
