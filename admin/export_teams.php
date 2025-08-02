<?php
include '../config/database.php';

// UTF-8 BOM to fix encoding issues in Excel
echo "\xEF\xBB\xBF";

// Set proper headers for Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Hackathon_Teams.xlsx");
header("Pragma: no-cache");
header("Expires: 0");

// Start table
echo "<table border='1' cellspacing='0' cellpadding='5'>";

// Title Row
echo "<tr style='background-color:#f2f2f2; font-weight:bold; font-size:16px; text-align:center;'>
        <td colspan='9'>Hackathon Team List (Teams with Exactly 4 Members)</td>
      </tr>";

// Table headers
echo "<tr style='background-color:#d9d9d9; font-weight:bold; text-align:center;'>
        <th>Team ID</th>
        <th>Team Name</th>
        <th>College</th>
        <th>Status</th>
        <th>Member Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Symbol No</th>
        <th>Documents</th>
      </tr>";

// Fetch all teams
$teamQuery = "SELECT * FROM teams WHERE is_deleted = 0";
$teamResult = $conn->query($teamQuery);

if ($teamResult && $teamResult->num_rows > 0) {
    while ($team = $teamResult->fetch_assoc()) {
        $team_id = $team['id'];

        // Fetch team members
        $memberQuery = "SELECT * FROM team_members WHERE team_id = $team_id";
        $memberResult = $conn->query($memberQuery);

        if ($memberResult && $memberResult->num_rows == 4) {
            $firstRow = true;
            while ($member = $memberResult->fetch_assoc()) {
                echo "<tr>";
                if ($firstRow) {
                    echo "<td rowspan='4'>" . $team['id'] . "</td>";
                    echo "<td rowspan='4'>" . htmlspecialchars($team['name']) . "</td>";
                    echo "<td rowspan='4'>" . htmlspecialchars($team['college']) . "</td>";

                    $statusText = 'Pending';
                    if ($team['status'] == 1) $statusText = 'Approved';
                    elseif ($team['status'] == 2) $statusText = 'Rejected';

                    echo "<td rowspan='4'>{$statusText}</td>";
                    $firstRow = false;
                }

                echo "<td>" . htmlspecialchars($member['member_name']) . "</td>";
                echo "<td>" . htmlspecialchars($member['email']) . "</td>";
                echo "<td>" . htmlspecialchars($member['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($member['symbol_no']) . "</td>";
                echo "<td>Photo: " . basename($member['photo']) . "<br>Admit: " . basename($member['admit_card']) . "</td>";
                echo "</tr>";
            }
        }
    }
} else {
    echo "<tr><td colspan='9'>No team data found.</td></tr>";
}

echo "</table>";
$conn->close();
exit;
?>
