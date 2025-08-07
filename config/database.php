<?php
$servername = "localhost";
$username="u423560789_hackathon";
$password ="PassionChasers@321$$";
$dbname="u423560789_hackathon";

$conn = mysqli_connect($servername, $username, $password);
//  checking the connection
if ($conn == false) {
    die("ERROR:could not connect." . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    // echo"Database created sucessfully"
} else {
    die("ERROR: Could not create database. " . mysqli_error($conn));
}
// Connect to the newly created database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect to the database. " . mysqli_connect_error());
}


$sql = "CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)  UNIQUE NOT NULL,
    status TINYINT DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Rejected',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    is_deleted TINYINT DEFAULT 0
)";
if (mysqli_query($conn, $sql)) {
    // echo "Table 'admin' created successfully.";
} else {
    echo "Error creating 'teams' table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_id INT NOT NULL,
    member_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone BIGINT(10) UNIQUE NOT NULL,
    college VARCHAR(100) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    admit_card VARCHAR(255) NOT NULL,
    symbol_no BIGINT UNIQUE NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    removed_at TIMESTAMP NULL DEFAULT NULL,
    is_removed TINYINT DEFAULT 0,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table 'admin' created successfully.";
} else {
    echo "Error creating 'team_member' table: " . mysqli_error($conn);
}


// Create settings table
$sql = "CREATE TABLE IF NOT EXISTS settings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    app_name VARCHAR(255) NULL,
    app_logo VARCHAR(255) NULL,
    favicon VARCHAR(255) NULL,
    meta_title VARCHAR(255) NULL,  
    meta_description TEXT NULL,
    contact_email VARCHAR(255) NULL,
    contact_phone VARCHAR(50) NULL,
    contact_address VARCHAR(255) NULL,
    sms_api_url VARCHAR(255) NULL,
    sms_api_key VARCHAR(255) NULL,
    sms_sender_id VARCHAR(100) NULL,
    mail_mailer VARCHAR(50) NULL,
    mail_host VARCHAR(255) NULL,
    mail_port INT NULL,
    mail_username VARCHAR(255) NULL,
    mail_password VARCHAR(255) NULL,
    mail_encryption VARCHAR(50) NULL,
    mail_from_address VARCHAR(255) NULL,
    mail_from_name VARCHAR(255) NULL,
    facebook_url VARCHAR(255) NULL,
    twitter_url VARCHAR(255) NULL,
    linkedin_url VARCHAR(255) NULL,
    instagram_url VARCHAR(255) NULL,
    maintenance_mode TINYINT(1) DEFAULT 0,
    custom_script_head TEXT NULL,
    custom_script_body TEXT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
if (!mysqli_query($conn, $sql)) {
    echo "Error creating 'settings' table: " . mysqli_error($conn);
}
// Create admin table
$sql = "CREATE TABLE IF NOT EXISTS admin(
    id INT PRIMARY KEY NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL  
)";
if (mysqli_query($conn, $sql)) {
    // echo "Table 'admin' created successfully.";
} else {
    echo "Error creating 'admin' table: " . mysqli_error($conn);
}

// Hash the admin password securely
$hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);

// Prepare the SQL query to insert the default admin user if it doesn't exist
$sql = "INSERT IGNORE INTO admin (id, email, password) VALUES (1, 'admin@gmail.com', ?)";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind the hashed password to the statement
    mysqli_stmt_bind_param($stmt, "s", $hashedPassword);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // echo "Admin user inserted successfully.";
    } else {
        echo "Error executing statement: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($conn);
}

// Close the database connection
// mysqli_close($conn);

// $sql="DROP DATABASE u423560789_hackathon";
// if (mysqli_query($conn, $sql)) {
//     // echo "'reviews' table created successfully.<br>";
// } else {
//     echo "Error deleting table: " . mysqli_error($conn)."<br>";

// }



?>