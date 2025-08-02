<?php include '../config/database.php';

$team_id = $_POST['team_id'] ?? '';
if ($team_id) {
    $stmt = $conn->prepare("UPDATE teams SET status = 'Approved' WHERE team_id = ?");
    $stmt->bind_param("s", $team_id);
    $stmt->execute();
}
header("Location: index.php");
