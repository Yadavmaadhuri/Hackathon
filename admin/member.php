<?php
session_start();

// Debug session for troubleshooting (remove after confirming)
// var_dump($_SESSION);

include '../config/database.php';
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

include_once('header.php');
include_once('sidebar.php');
include_once('topbar.php');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';

$sql = "
    SELECT tm.id AS member_id,
           tm.photo,
           tm.admit_card,
           tm.member_name,
           tm.email,
           tm.phone,
           tm.symbol_no,
           t.name AS team_name,
           t.college,
           t.status,
           t.created_at
    FROM team_members tm
    INNER JOIN teams t ON tm.team_id = t.id
    WHERE 1
";

$params = [];
$types = "";

// Add search filter
if (!empty($search)) {
    $sql .= " AND (
        tm.member_name LIKE ? OR
        tm.email LIKE ? OR
        tm.phone LIKE ? OR
        tm.symbol_no LIKE ? OR
        t.name LIKE ? OR
        t.college LIKE ?
    )";
    $search_term = "%" . $search . "%";
    $params = array_fill(0, 6, $search_term);
    $types = str_repeat("s", 6);
}

// Add status filter
if ($status_filter !== '' && in_array($status_filter, ['0', '1', '2'])) {
    $sql .= " AND t.status = ?";
    $params[] = $status_filter;
    $types .= "i";
}

$sql .= " ORDER BY tm.id DESC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters if needed
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

function getStatusLabel($status)
{
    switch ($status) {
        case 1:
            return '<span class="badge bg-success">Approved</span>';
        case 2:
            return '<span class="badge bg-danger">Rejected</span>';
        default:
            return '<span class="badge bg-warning text-dark">Pending</span>';
    }
}
?>

<div class="main">
    <h2>Hackathon Member List</h2>

    <form method="GET">
        <input type="text" name="search" placeholder="Search team or college"
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
        <select name="status">
            <option value="">All</option>
            <option value="0" <?= (isset($_GET['status']) && $_GET['status'] === '0') ? 'selected' : '' ?>>Pending</option>
            <option value="1" <?= (isset($_GET['status']) && $_GET['status'] === '1') ? 'selected' : '' ?>>Approved
            </option>
            <option value="2" <?= (isset($_GET['status']) && $_GET['status'] === '2') ? 'selected' : '' ?>>Rejected
            </option>
        </select>

        <button type="submit">Filter</button>
    </form>
    <!-- Export Button -->
    <button onclick="exportTableToExcel('teamTable', 'Hackathon_Members')" class="btn btn-success mt-3">
        Export to Excel
    </button>

    <div class="container-fluid my-5">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Members Card -->
            <div class="card mt-4 shadow">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Member List</h5>
                </div>
                <div class="card-body">
                    <?php if ($result->num_rows > 0): ?>
                        <table class="table table-striped" id="teamTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-export="false">Photo</th>
                                    <th data-export="false">Admit Card</th>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Symbol No</th>
                                    <th>Team Name</th>
                                    <th>College</th>
                                    <th>Team Status</th>
                                    <th>Team created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td>
                                            <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" width="70"
                                                class="img-thumbnail">
                                        </td>
                                        <td>
                                            <img src="<?= htmlspecialchars($row['admit_card']) ?>" alt="admin card" width="70"
                                                class="img-thumbnail">
                                        </td>
                                        <td><?= htmlspecialchars($row['member_name']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td><?= htmlspecialchars($row['phone']) ?></td>
                                        <td><?= htmlspecialchars($row['symbol_no']) ?></td>
                                        <td><?= htmlspecialchars($row['team_name']) ?></td>
                                        <td><?= htmlspecialchars($row['college']) ?></td>
                                        <td><?= getStatusLabel($row['status']) ?></td>
                                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-muted mb-0">No members found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-5 mb-3 text-center text-muted">
                <hr>
                &copy; <?= date('Y') ?> Hackathon Admin Panel
            </footer>
        </main>
    </div>

    <!-- Export to Excel Script -->

    <script>
        function exportTableToExcel(tableID, filename = '') {
            const table = document.getElementById(tableID);
            let rows = table.rows;
            let csv = [];

            for (let i = 0; i < rows.length; i++) {
                let row = [], cols = rows[i].querySelectorAll("td, th");
                for (let j = 0; j < cols.length; j++) {
                    let col = cols[j];
                    // Skip if column marked as not for export
                    if (table.rows[0].cells[j].dataset.export === "false") continue;
                    row.push(`"${col.innerText.trim()}"`);
                }
                csv.push(row.join(","));
            }

            let csvString = csv.join("\n");
            let blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });

            // Download
            let link = document.createElement("a");
            if (navigator.msSaveBlob) { // For IE 10+
                navigator.msSaveBlob(blob, filename + ".csv");
            } else {
                let url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
                link.setAttribute("download", filename + ".csv");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    </script>


    </body>

    </html>