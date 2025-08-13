<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

include '../config/database.php';

// Helper function to sanitize inputs
function clean_input($data) {
    return trim(htmlspecialchars($data));
}

// Collect form data and sanitize
$data = [
    'app_name' => clean_input($_POST['app_name'] ?? ''),
    'app_logo' => clean_input($_POST['app_logo'] ?? ''),
    'favicon' => clean_input($_POST['favicon'] ?? ''),
    'contact_email' => clean_input($_POST['contact_email'] ?? ''),
    'contact_phone' => clean_input($_POST['contact_phone'] ?? ''),
    'contact_address' => clean_input($_POST['contact_address'] ?? ''),
    'sms_api_url' => clean_input($_POST['sms_api_url'] ?? ''),
    'sms_api_key' => clean_input($_POST['sms_api_key'] ?? ''),
    'sms_sender_id' => clean_input($_POST['sms_sender_id'] ?? ''),
    'mail_mailer' => clean_input($_POST['mail_mailer'] ?? ''),
    'mail_host' => clean_input($_POST['mail_host'] ?? ''),
    'mail_port' => (int) ($_POST['mail_port'] ?? 0),
    'mail_username' => clean_input($_POST['mail_username'] ?? ''),
    'mail_password' => clean_input($_POST['mail_password'] ?? ''),
    'mail_encryption' => clean_input($_POST['mail_encryption'] ?? ''),
    'mail_from_address' => clean_input($_POST['mail_from_address'] ?? ''),
    'mail_from_name' => clean_input($_POST['mail_from_name'] ?? ''),
    'facebook_url' => clean_input($_POST['facebook_url'] ?? ''),
    'twitter_url' => clean_input($_POST['twitter_url'] ?? ''),
    'linkedin_url' => clean_input($_POST['linkedin_url'] ?? ''),
    'instagram_url' => clean_input($_POST['instagram_url'] ?? ''),
    'maintenance_mode' => isset($_POST['maintenance_mode']) ? (int)$_POST['maintenance_mode'] : 0,
];

// Check if there is already a settings row
$result = mysqli_query($conn, "SELECT id FROM settings LIMIT 1");
if ($result && mysqli_num_rows($result) > 0) {
    // Update existing row
    $sql = "UPDATE settings SET
        app_name = ?, app_logo = ?, favicon = ?,
        contact_email = ?, contact_phone = ?, contact_address = ?,
        sms_api_url = ?, sms_api_key = ?, sms_sender_id = ?,
        mail_mailer = ?, mail_host = ?, mail_port = ?, mail_username = ?, mail_password = ?, mail_encryption = ?, mail_from_address = ?, mail_from_name = ?,
        facebook_url = ?, twitter_url = ?, linkedin_url = ?, instagram_url = ?,
        maintenance_mode = ?,
        updated_at = NOW()
        WHERE id = (SELECT id FROM settings LIMIT 1)
    ";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,
        "ssssssssssssssssssssssi",
        $data['app_name'], $data['app_logo'], $data['favicon'],
        $data['contact_email'], $data['contact_phone'], $data['contact_address'],
        $data['sms_api_url'], $data['sms_api_key'], $data['sms_sender_id'],
        $data['mail_mailer'], $data['mail_host'], $data['mail_port'], $data['mail_username'], $data['mail_password'], $data['mail_encryption'], $data['mail_from_address'], $data['mail_from_name'],
        $data['facebook_url'], $data['twitter_url'], $data['linkedin_url'], $data['instagram_url'],
        $data['maintenance_mode']
    );
    $exec = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
} else {
    // Insert new row
    $sql = "INSERT INTO settings (
        app_name, app_logo, favicon,
        contact_email, contact_phone, contact_address,
        sms_api_url, sms_api_key, sms_sender_id,
        mail_mailer, mail_host, mail_port, mail_username, mail_password, mail_encryption, mail_from_address, mail_from_name,
        facebook_url, twitter_url, linkedin_url, instagram_url,
        maintenance_mode, created_at, updated_at
    ) VALUES (
        ?, ?, ?,
        ?, ?, ?,
        ?, ?, ?,
        ?, ?, ?, ?, ?, ?, ?, ?,
        ?, ?, ?, ?,
        ?, NOW(), NOW()
    )";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt,
        "sssssssssssssssssssssi",
        $data['app_name'], $data['app_logo'], $data['favicon'],
        $data['contact_email'], $data['contact_phone'], $data['contact_address'],
        $data['sms_api_url'], $data['sms_api_key'], $data['sms_sender_id'],
        $data['mail_mailer'], $data['mail_host'], $data['mail_port'], $data['mail_username'], $data['mail_password'], $data['mail_encryption'], $data['mail_from_address'], $data['mail_from_name'],
        $data['facebook_url'], $data['twitter_url'], $data['linkedin_url'], $data['instagram_url'],
        $data['maintenance_mode']
    );
    $exec = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

if ($exec) {
    $_SESSION['success_message'] = "Settings saved successfully.";
} else {
    $_SESSION['error_message'] = "Error saving settings: " . mysqli_error($conn);
}

header("Location: settings.php");
exit();
