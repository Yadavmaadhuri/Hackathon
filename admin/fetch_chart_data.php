<?php
session_start();
header('Content-Type: application/json');

include '../config/database.php';
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

// Check DB connection
if (!$conn) {
    echo json_encode(['error' => 'Database connection failed.']);
    exit;
}

// Get time range
$range = $_GET['range'] ?? 'daily';

$labels = [];
$counts = [];

switch ($range) {
    case 'daily':
        $query = "
            SELECT DATE(created_at) as label, COUNT(*) as count
            FROM teams
            WHERE created_at >= CURDATE() - INTERVAL 6 DAY
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at)
        ";
        break;

    case 'weekly':
        $query = "
            SELECT YEARWEEK(created_at, 1) as label, COUNT(*) as count
            FROM teams
            WHERE created_at >= CURDATE() - INTERVAL 6 WEEK
            GROUP BY YEARWEEK(created_at, 1)
            ORDER BY YEARWEEK(created_at, 1)
        ";
        break;

    case 'monthly':
        $query = "
            SELECT DATE_FORMAT(created_at, '%Y-%m') as label, COUNT(*) as count
            FROM teams
            WHERE created_at >= CURDATE() - INTERVAL 6 MONTH
            GROUP BY DATE_FORMAT(created_at, '%Y-%m')
            ORDER BY DATE_FORMAT(created_at, '%Y-%m')
        ";
        break;

    case 'yearly':
        $query = "
            SELECT YEAR(created_at) as label, COUNT(*) as count
            FROM teams
            WHERE created_at >= CURDATE() - INTERVAL 4 YEAR
            GROUP BY YEAR(created_at)
            ORDER BY YEAR(created_at)
        ";
        break;

    default:
        echo json_encode(['error' => 'Invalid range']);
        exit;
}

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['label'];
        $counts[] = (int)$row['count'];
    }
}

echo json_encode([
    'labels' => $labels,
    'counts' => $counts
]);
