<?php
// submit.php

// Ensure your database.php path is correct for your project structure
include '../config/database.php';
var_dump($_POST);
// Set header to application/json for structured responses
header('Content-Type: application/json');

// Only allow POST requests (keeping this for basic request method safety)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit();
}

// Define the directory for uploads and ensure it exists
$uploadDir = '../uploads/';
if (!is_dir($uploadDir)) {
    // Attempt to create the directory with read/write/execute permissions for owner, group, and others
    if (!mkdir($uploadDir, 0777, true)) {
        http_response_code(500); // Internal Server Error
        echo json_encode(['status' => 'error', 'message' => 'Failed to create upload directory. Check server permissions.']);
        exit();
    }
}

// Basic input retrieval (no sanitization, no trim - as per "no validation" request)
$team_name = $_POST['team_name'] ?? '';
$college_name = $_POST['college_name'] ?? '';

// Get members data. Use null coalescing to safely get arrays.
$names = $_POST['member_name'] ?? [];
$emails = $_POST['email'] ?? [];
$phones = $_POST['phone'] ?? [];

// IMPORTANT: Accessing $_FILES for multiple files (photo[] and admit_card[])
// PHP structures these as arrays of arrays.
$photos_files = $_FILES['photo'] ?? ['error' => [UPLOAD_ERR_NO_FILE]];
$admits_files = $_FILES['admit_card'] ?? ['error' => [UPLOAD_ERR_NO_FILE]];

// --- REMOVED: Check for exactly 4 members is removed. Will process whatever is sent. ---
// This also means if count($names) is less than 4, the loop will run less times.
// If it's more, it will try to process more. This could lead to issues if the database
// structure expects exactly 4 members or if other arrays are not aligned.
// However, to fully remove "validation" as requested, this check is gone.

// Start transaction for atomicity
$conn->begin_transaction();
$uploaded_file_paths = []; // To store paths for potential cleanup on rollback

try {
    // --- REMOVED: Server-Side Uniqueness Check for Team Name ---
    // --- REMOVED: Server-Side Uniqueness Checks for Member Emails and Phones (Database-wide) ---
    // --- REMOVED: Check for duplicate emails/phones within the *current submission* ---
    // --- REMOVED: All individual field validations (empty, regex, filter_var) ---
    // --- REMOVED: If any validation errors accumulated, return them now block ---


    // --- Insert into `teams` table ---
    // Note: The database schema might still have UNIQUE constraints or NOT NULL.
    // If you send empty values or duplicates and the DB has these constraints,
    // the INSERT query will fail and trigger the catch block.
    $stmt_team = $conn->prepare("INSERT INTO teams (name, college) VALUES (?, ?)");
    if (!$stmt_team) {
        throw new Exception("Database prepare statement failed for team insert: " . $conn->error);
    }
    // No trim or validation on $team_name, $college_name
    $stmt_team->bind_param("ss", $team_name, $college_name);
    $stmt_team->execute();
    $team_id = $stmt_team->insert_id;
    $stmt_team->close();

    // --- Loop through each member to insert ---
    // Loop based on the count of received names.
    // If other arrays (emails, phones, files) have different counts, this will likely cause errors.
    for ($i = 0; $i < count($names); $i++) {
        $name = $names[$i] ?? ''; // Use null coalescing for safety if arrays are uneven
        $email = $emails[$i] ?? '';
        $phone = $phones[$i] ?? '';

        // Access specific file details for the current member
        // Added checks to prevent errors if file arrays are not complete for all members
        $current_photo = [
            'name' => $photos_files['name'][$i] ?? '',
            'type' => $photos_files['type'][$i] ?? '',
            'tmp_name' => $photos_files['tmp_name'][$i] ?? '',
            'error' => $photos_files['error'][$i] ?? UPLOAD_ERR_NO_FILE,
            'size' => $photos_files['size'][$i] ?? 0,
        ];
        $current_admit = [
            'name' => $admits_files['name'][$i] ?? '',
            'type' => $admits_files['type'][$i] ?? '',
            'tmp_name' => $admits_files['tmp_name'][$i] ?? '',
            'error' => $admits_files['error'][$i] ?? UPLOAD_ERR_NO_FILE,
            'size' => $admits_files['size'][$i] ?? 0,
        ];

        // --- REMOVED: Server-side File Validation (error codes, size, type) ---
        // Will attempt to move any file, regardless of type, size, or upload status.
        // This is extremely dangerous.
        if ($current_photo['error'] !== UPLOAD_ERR_OK && $current_photo['error'] !== UPLOAD_ERR_NO_FILE) {
             // If there's an actual upload error, we might still want to report it,
             // but not fail due to size/type as per "no validation".
             // For strict "no validation", you could even remove this.
             // Keeping a basic check for fatal upload issues, not *validation*.
             throw new Exception("Photo upload issue for member " . ($i + 1) . ". PHP upload error code: " . $current_photo['error']);
        }
        if ($current_admit['error'] !== UPLOAD_ERR_OK && $current_admit['error'] !== UPLOAD_ERR_NO_FILE) {
            throw new Exception("Admit card upload issue for member " . ($i + 1) . ". PHP upload error code: " . $current_admit['error']);
        }

        $photo_path = '';
        if ($current_photo['error'] === UPLOAD_ERR_OK) {
            // Generate unique filenames and move uploaded files
            $photo_extension = pathinfo($current_photo['name'], PATHINFO_EXTENSION);
            $photo_name = uniqid("photo_") . "." . $photo_extension; // Use original extension
            $photo_path = $uploadDir . $photo_name;
            if (!move_uploaded_file($current_photo['tmp_name'], $photo_path)) {
                throw new Exception("Photo upload failed for member " . ($i + 1) . ". Check server permissions for the 'uploads' folder.");
            }
            $uploaded_file_paths[] = $photo_path; // Add to list for potential cleanup
            $relative_photo_path = str_replace('../', '', $photo_path);
        } else {
            $relative_photo_path = ''; // No file uploaded
        }


        $admit_path = '';
        if ($current_admit['error'] === UPLOAD_ERR_OK) {
            $admit_extension = pathinfo($current_admit['name'], PATHINFO_EXTENSION);
            $admit_name = uniqid("admit_") . "." . $admit_extension; // Use original extension
            $admit_path = $uploadDir . $admit_name;
            if (!move_uploaded_file($current_admit['tmp_name'], $admit_path)) {
                throw new Exception("Admit card upload failed for member " . ($i + 1) . ". Check server permissions for the 'uploads' folder.");
            }
            $uploaded_file_paths[] = $admit_path; // Add to list for potential cleanup
            $relative_admit_path = str_replace('../', '', $admit_path);
        } else {
            $relative_admit_path = ''; // No file uploaded
        }


        // Insert member into DB
        $stmt_member = $conn->prepare("INSERT INTO team_members (team_id, member_name, email, phone, photo, admit_card) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt_member) {
            throw new Exception("Database prepare statement failed for member insert: " . $conn->error);
        }
        // No validation on $name, $email, $phone
        $stmt_member->bind_param("isssss", $team_id, $name, $email, $phone, $relative_photo_path, $relative_admit_path);
        $stmt_member->execute();
        $stmt_member->close();
    }

    // Commit transaction if everything passes
    $conn->commit();
    echo json_encode(['status' => 'success', 'message' => 'Team and members registered successfully! (Validation removed)']);

} catch (Exception $e) {
    // Rollback transaction on any error
    $conn->rollback();

    // Clean up uploaded files if a rollback occurs
    foreach ($uploaded_file_paths as $path) {
        if (file_exists($path)) {
            unlink($path); // Delete the partially uploaded file
        }
    }

    // Log the actual error for debugging
    error_log("Submission Error: " . $e->getMessage());

    http_response_code(400); // Set HTTP status to 400 Bad Request
    echo json_encode(['status' => 'error', 'message' => "An error occurred during submission: " . $e->getMessage()]);

} finally {
    // Close the database connection
    $conn->close();
}
?>