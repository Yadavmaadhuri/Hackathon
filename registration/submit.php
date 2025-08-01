<?php
include '../config/database.php'; 

//  Handle GET request: Check if team name exists
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['team_name'])) {
    $teamName = $_GET['team_name'] ?? '';    

    $stmt = $conn->prepare("SELECT COUNT(*) FROM teams WHERE team_name = ?");
    $stmt->bind_param("s", $teamName);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['exists' => $count > 0]);
    exit; // ⬅ Stop here so POST logic doesn’t run
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['team_name'], $_POST['college_name']) || empty($_POST['team_name']) || empty($_POST['college_name'])) {
        http_response_code(400);
        echo json_encode(["error" => "Team Name and College Name are required."]);
        exit;
    }

    $teamName = trim($_POST['team_name']);
    $collegeName = trim($_POST['college_name']);

    if (!preg_match("/^[a-zA-Z\s]+$/", $teamName) || !preg_match("/^[a-zA-Z\s]+$/", $collegeName)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid Team or College Name."]);
        exit;
    }

    $members = isset($_POST['members']) ? json_decode($_POST['members'], true) : [];
    if (!is_array($members) || count($members) !== 4) {
        http_response_code(400);
        echo json_encode(["error" => "Exactly 4 members are required."]);
        exit;
    }

    // Ensure upload directories exist
    @mkdir('../uploads/photos', 0777, true);
    @mkdir('../uploads/admit_cards', 0777, true);

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO teams (name, college) VALUES (?, ?)");
        $stmt->bind_param("ss", $teamName, $collegeName);
        $stmt->execute();
        $teamId = $stmt->insert_id;
        $stmt->close();

        $memberStmt = $conn->prepare("INSERT INTO team_members (team_id, member_name, email, phone, photo, admit_card, symbol_no) VALUES (?, ?, ?, ?, ?, ?, ?)");

        foreach ($members as $i => $member) {
            $photoKey = 'photo_' . $i;
            $admitKey = 'admit_' . $i;

            if (!isset($_FILES[$photoKey], $_FILES[$admitKey])) {
                throw new Exception("Missing file upload for member #" . ($i + 1));
            }

            $name = trim($member['name']);
            $email = trim($member['email']);
            $phone = trim($member['phone']);
            $symbol = trim($member['symbol']);

            if (!preg_match("/^[a-zA-Z\s]+$/", $name) ||
                !filter_var($email, FILTER_VALIDATE_EMAIL) ||
                !preg_match("/^(97|98)\d{8}$/", $phone) ||
                !preg_match("/^\d{12}$/", $symbol)) {
                throw new Exception("Invalid data for member #" . ($i + 1));
            }

            $photoTmp = $_FILES[$photoKey]['tmp_name'];
            $admitTmp = $_FILES[$admitKey]['tmp_name'];

            // File type and size validation
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            $photoMime = mime_content_type($photoTmp);
            $admitMime = mime_content_type($admitTmp);
            $maxSize = 2 * 1024 * 1024;

            if (!in_array($photoMime, $allowedMimeTypes) || !in_array($admitMime, $allowedMimeTypes)) {
                throw new Exception("Invalid file type for member #" . ($i + 1));
            }
            if ($_FILES[$photoKey]['size'] > $maxSize || $_FILES[$admitKey]['size'] > $maxSize) {
                throw new Exception("File size exceeds limit for member #" . ($i + 1));
            }

            $photoName = uniqid("photo_") . "_" . basename($_FILES[$photoKey]['name']);
            $admitName = uniqid("admit_") . "_" . basename($_FILES[$admitKey]['name']);

            $photoPath = '../uploads/photos/' . $photoName;
            $admitPath = '../uploads/admit_cards/' . $admitName;

            if (!move_uploaded_file($photoTmp, $photoPath) || !move_uploaded_file($admitTmp, $admitPath)) {
                throw new Exception("Failed to upload files for member #" . ($i + 1));
            }

            $memberStmt->bind_param("ississi", $teamId, $name, $email, $phone, $photoPath, $admitPath, $symbol);
            $memberStmt->execute();

            if ($memberStmt->errno === 1062) {
                throw new Exception("Duplicate Symbol No. detected: $symbol");
            }
        }

        $memberStmt->close();
        $conn->commit();

        echo json_encode(["success" => true, "message" => "Team registered successfully."]);

    } catch (Exception $e) {
        $conn->rollback();
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Invalid request method."]);
}
