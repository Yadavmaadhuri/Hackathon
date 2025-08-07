<?php
require '../vendor/autoload.php';
include '../config/database.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

// Set type manually since no query string is provided
$type = 'teams';

// Headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"{$type}_export.xlsx\"");

$writer = WriterEntityFactory::createXLSXWriter();
$writer->openToBrowser("{$type}_export.xlsx");

// Header row
$writer->addRow(WriterEntityFactory::createRowFromArray(['Team ID', 'Team Name', 'Status']));

// Fetch data
$result = $conn->query("SELECT id, name, status FROM teams");
while ($row = $result->fetch_assoc()) {
    $writer->addRow(WriterEntityFactory::createRowFromArray([
        $row['id'],
        $row['name'],
        $row['status']
    ]));
}

$writer->close();
exit;
