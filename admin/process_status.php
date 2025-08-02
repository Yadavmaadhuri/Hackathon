<?php
// process_status.php
// include 'db_connect.php';
include '../config/database.php';


$action = $_GET['action'] ?? '';
$team_id = $_GET['team_id'] ?? '';

if (!in_array($action, ['approve', 'reject']) || !$team_id) {
    die('Invalid action.');
}

$status = ($action == 'approve') ? 1 : 2;

$update = $conn->query("UPDATE teams SET status = $status WHERE id = $team_id");

if ($update) {
    header("Location: teams");
    exit;
} else {
    echo "Failed to update status.";
}
