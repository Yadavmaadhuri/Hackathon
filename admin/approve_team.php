<?php 
session_start(); 
include '../config/database.php';

if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}


$team_id = $_POST['team_id'] ?? '';
if ($team_id) {
    $stmt = $conn->prepare("UPDATE teams SET status = 'Approved' WHERE team_id = ?");
    $stmt->bind_param("s", $team_id);
    $stmt->execute();
}
header("Location: index.php");
