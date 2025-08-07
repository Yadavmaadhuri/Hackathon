<?php
session_start();

// Check login session
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

include '../config/database.php';
include_once('header.php');
include_once('sidebar.php');
include_once('topbar.php');
?>

<div class="main">
    <h2>Hackathon Team & Member List</h2>

    <form method="GET">
        <input type="text" name="search" placeholder="Search team, member or college"
            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
        <select name="status">
            <option value="">All</option>
            <option value="0" <?php echo (isset($_GET['status']) && $_GET['status'] === '0') ? 'selected' : '' ?>>Pending
            </option>
            <option value="1" <?php echo (isset($_GET['status']) && $_GET['status'] === '1') ? 'selected' : '' ?>>Approved
            </option>
            <option value="2" <?php echo (isset($_GET['status']) && $_GET['status'] === '2') ? 'selected' : '' ?>>Rejected
            </option>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Export Button -->
    <button onclick="exportTableToExcel('teamTable', 'Hackathon_Members')" style="margin-top:10px; margin-bottom:10px;">
        Export to Excel
    </button>

    <table id="teamTable" border="1" cellpadding="8" cellspacing="0" class="table table-hover">
        <thead class="p-2">
            <t>
                <th>#</th>
                <th>Team Name</th>
                <th>Photo</th>
                <th>Member Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>College</th>
                <th>Symbol</th>
                <th>Admit Card</th>
                <th>Status</th>
                <th>Created at</th>
                </tr>
        </thead>
        <?php
        $id = 0;
        // Build query with JOIN
        $query = "
    SELECT t.id AS team_id, t.name AS team_name, t.status,
    tm.college, tm.member_name, tm.email, tm.phone, tm.symbol_no, tm.photo, tm.admit_card, tm.added_at
    FROM teams t
    LEFT JOIN team_members tm ON t.id = tm.team_id
    WHERE 1=1
";
        if (!empty($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $query .= " AND (
        t.name LIKE '%$search%' OR
        tm.college LIKE '%$search%' OR
        tm.member_name LIKE '%$search%' OR
        tm.email LIKE '%$search%' OR
        tm.phone LIKE '%$search%' OR
        tm.symbol_no LIKE '%$search%'
    )";
        }
        if (isset($_GET['status']) && $_GET['status'] !== '') {
            $status = (int) $_GET['status'];
            $query .= " AND t.status = $status";
        }
        $query .= " ORDER BY t.id DESC";


        $result = $conn->query($query);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $statusText = '';
                $status = $row['status'];

                if ($status == 0) {
                    $statusText = '<span class="badge bg-warning text-dark">Pending</span>';
                } elseif ($status == 1) {
                    $statusText = '<span class="badge bg-success">Approved</span>';
                } elseif ($status == 2) {
                    $statusText = '<span class="badge bg-danger">Rejected</span>';
                } else {
                    $statusText = '<span class="badge bg-secondary">Unknown</span>';
                }
                $id++;


                // Inside while loop
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                echo "<tr>
                <td>{$id}</td>
                <td>" . htmlspecialchars($row['team_name']) . "</td>
                <td><img src='" . htmlspecialchars($row['photo']) . "' class='rounded-circle' style='border:2px solid #817d7dff; width: 60px !important; height: 60px !important; object-fit: fill;' alt='" . htmlspecialchars($row['member_name']) . "'></td>
                <td>" . htmlspecialchars($row['member_name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['phone']) . "</td>
                <td>" . htmlspecialchars($row['college']) . "</td>
                <td>" . htmlspecialchars($row['symbol_no']) . "</td>
                <td><img src='" . htmlspecialchars($row['admit_card']) . "' width='70' height='70' class='border border-dark p-1'></td>
                <td>{$statusText}</td>
                <td>" . htmlspecialchars(date('Y-m-d', strtotime($row['added_at']))) . "</td>
                <td><button class='btn btn-sm btn-warning' onclick='openEditModal({$rowJson})'>Edit</button></td>
            </tr>";

            }
        } else {
            echo "<tr><td colspan='11'>No members found.</td></tr>";
        }
        ?>
    </table>

    <!-- Edit Member Modal -->
    <div id="editModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:9999;">
        <div
            style="background:#fff; margin:10% auto; padding:20px; width:500px; border-radius:10px; position:relative;">
            <span onclick="closeEditModal()"
                style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:20px;">&times;</span>
            <h3>Edit Member</h3>
            <form id="editForm" method="POST" action="member_edit.php">
                <input type="hidden" name="team_id" id="editTeamId">
                <input type="hidden" name="symbol_no_old" id="editOldSymbol">

                <label>Member Name:</label>
                <input type="text" name="member_name" id="editMemberName" required><br><br>

                <label>Email:</label>
                <input type="email" name="email" id="editEmail" required><br><br>

                <label>Phone:</label>
                <input type="text" name="phone" id="editPhone" required><br><br>

                <label>College:</label>
                <input type="text" name="college" id="editCollege" required><br><br>

                <label>Symbol No:</label>
                <input type="text" name="symbol_no" id="editSymbol" required><br><br>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div> <!-- Closing tag of your main div -->

</div>

<script>
    function exportTableToExcel(tableID, filename = '') {
        const table = document.getElementById(tableID);
        const rows = table.rows;
        let csv = [];

        for (let i = 0; i < rows.length; i++) {
            let row = [], cols = rows[i].querySelectorAll("td, th");
            for (let j = 0; j < cols.length; j++) {
                let cell = cols[j];
                let text = cell.innerText.trim();
                row.push('"' + text.replace(/"/g, '""') + '"');
            }
            csv.push(row.join(","));
        }

        const csvString = csv.join("\n");
        const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        if (navigator.msSaveBlob) {
            navigator.msSaveBlob(blob, filename + ".csv");
        } else {
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", filename + ".csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }



    //   for edit form
    function openEditModal(data) {
        document.getElementById('editModal').style.display = 'block';

        document.getElementById('editTeamId').value = data.team_id;
        document.getElementById('editOldSymbol').value = data.symbol_no;

        document.getElementById('editMemberName').value = data.member_name;
        document.getElementById('editEmail').value = data.email;
        document.getElementById('editPhone').value = data.phone;
        document.getElementById('editCollege').value = data.college;
        document.getElementById('editSymbol').value = data.symbol_no;
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }


</script>