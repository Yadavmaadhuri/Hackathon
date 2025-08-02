<?php
$servername = "localhost";
$username="root";
$password ="";
$dbname="hackathon";
$conn = mysqli_connect($servername,$username,$password);
//  checking the connection
if($conn== false){
    die("ERROR:could not connect.".mysqli_connect_error());
}

$sql ="CREATE DATABASE IF NOT EXISTS $dbname";
if(mysqli_query($conn,$sql)){
    // echo"Database created sucessfully"
}else {
    die("ERROR: Could not create database. " . mysqli_error($conn));
}
// Connect to the newly created database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect to the database. " . mysqli_connect_error());
}


$sql ="CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    status TINYINT DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Rejected',
    college VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_deleted TINYINT DEFAULT 0
)";
if (mysqli_query($conn, $sql)) {
    // echo "Table 'admin' created successfully.";
} else {
    echo "Error creating 'teams' table: " . mysqli_error($conn);
}

$sql ="CREATE TABLE IF NOT EXISTS team_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_id INT NOT NULL,
    member_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone BIGINT(10) NOT NULL UNIQUE,
    photo VARCHAR(255) NOT NULL,
    admit_card VARCHAR(255) NOT NULL,
    -- symbol_no INT(20) UNIQUE NOT NULL,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    // echo "Table 'admin' created successfully.";
} else {
    echo "Error creating 'team_member' table: " . mysqli_error($conn);
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

// $sql="DROP DATABASE hackathon";
// if (mysqli_query($conn, $sql)) {
//     // echo "'reviews' table created successfully.<br>";
// } else {
//     echo "Error deleting table: " . mysqli_error($conn)."<br>";

// }

// ALTER TABLE team_members DROP COLUMN symb


?>