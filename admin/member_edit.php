<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

include '../config/database.php';

// Get and sanitize input
$team_id = intval($_POST['team_id']);
$symbol_no_old = $conn->real_escape_string($_POST['symbol_no_old']);

$member_name = $conn->real_escape_string($_POST['member_name']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$college = $conn->real_escape_string($_POST['college']);
$symbol_no = $conn->real_escape_string($_POST['symbol_no']);

// Validate and update
$query = "UPDATE team_members 
          SET member_name='$member_name', email='$email', phone='$phone', college='$college', symbol_no='$symbol_no'
          WHERE team_id='$team_id' AND symbol_no='$symbol_no_old'";

if ($conn->query($query)) {
    $_SESSION['success'] = "Member updated successfully.";
} else {
    $_SESSION['error'] = "Update failed: " . $conn->error;
}

header("Location: member.php");
exit();
?>
