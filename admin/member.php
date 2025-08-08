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
// var_dump($_POST['member_id']); 
// exit;

?>
<style>
    .error {
        color: red;
        font-size: 0.875em;
    }
</style>
<div class="main">
    <h2>Hackathon Team & Member List</h2>

    <form method="GET">
        <input type="text" name="search" placeholder="Search"
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
                <th>Action</th>
                </tr>
        </thead>
        <?php
        $id = 0;
        // Build query with JOIN
        $query = "
    SELECT t.id AS team_id, t.name AS team_name, t.status,
    tm.id AS id, tm.college, tm.member_name, tm.email, tm.phone, tm.symbol_no, tm.photo, tm.admit_card, tm.added_at
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
                // $id++;
        

                // Inside while loop
                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                $rowJson = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');

                echo "<tr>
                <td>{$row['id']}</td>
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
                <td>
                    <button class='btn btn-link p-0 text-primary'
                            data-id='{$row['id']}'
                            onclick='openEditModal({$rowJson})'>
                        <i class='fas fa-edit'></i>
                    </button>
                </td>


            </tr>";

            }
        } else {
            echo "<tr><td colspan='11'>No members found.</td></tr>";
        }
        ?>
    </table>


    <!-- Edit Member Modal -->
    <!-- Modal HTML -->
    <div id="editModal"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.5); z-index:9999;">
        <div
            style="background:#fff; margin:5% auto; padding:20px; width:500px; height:90vh; overflow-y:auto; border-radius:10px; position:relative;">

            <span onclick="closeEditModal()"
                style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:20px;">&times;</span>
            <h3>Edit Member</h3>
            <form id="editForm" method="POST" action="member_edit.php" enctype="multipart/form-data" novalidate>
                <!-- <input type="hidden" name="team_id" id="editTeamId"> -->
                <input type="hidden" name="id" id="editMemberId">

                <input type="number" class="form-control mb-2" id="mSymbol" name="symbol_no" placeholder="Symbol No."
                    required>
                <div id="mSymbolError" class="error"></div>

                <input type="text" class="form-control mb-2" id="mName" name="member_name" placeholder="Full Name"
                    required>
                <div id="mNameError" class="error"></div>

                <input type="email" class="form-control mb-2" id="mEmail" name="email" placeholder="Email" required>
                <div id="mEmailError" class="error"></div>

                <input type="text" class="form-control mb-2" id="mPhone" name="phone" placeholder="Phone" required>
                <div id="mPhoneError" class="error"></div>

                <input type="text" class="form-control mb-2" id="mCollege" name="college" placeholder="College Name"
                    required>
                <div id="mCollegeError" class="error"></div>

                <label>Photo Card (max 200KB)</label>
                <input type="file" class="form-control mb-2" id="mPhoto" name="photo" accept="image/*">
                <img class="preview" id="photoPreview"
                    style="display:none; width:80px; height:80px; object-fit:cover;" />

                <label>Admit Card (max 200KB)</label>
                <input type="file" class="form-control mb-2" id="mAdmit" name="admit_card" accept="image/*">
                <img class="preview" id="admitPreview"
                    style="display:none; width:80px; height:80px; object-fit:cover;" />

                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
            </form>

        </div>
    </div>


</div> <!-- Closing tag of your main div -->



<script>
    const namePattern = /^[a-zA-Z\s]+$/;
    const symbolPattern = /^\d{8}$/;
    const phonePattern = /^(98|97)\d{8}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    document.getElementById("mName").addEventListener("input", function () {
        document.getElementById("mNameError").textContent = namePattern.test(this.value) ? "" : "Only letters and spaces allowed.";
    });
    document.getElementById("mSymbol").addEventListener("input", function () {
        document.getElementById("mSymbolError").textContent = symbolPattern.test(this.value) ? "" : "Must be 8 digits.";
    });
    document.getElementById("mPhone").addEventListener("input", function () {
        document.getElementById("mPhoneError").textContent = phonePattern.test(this.value) ? "" : "Invalid phone format.";
    });
    document.getElementById("mEmail").addEventListener("input", function () {
        document.getElementById("mEmailError").textContent = emailPattern.test(this.value) ? "" : "Invalid email format.";
    });
    document.getElementById("mCollege").addEventListener("input", function () {
        document.getElementById("mCollegeError").textContent = namePattern.test(this.value) ? "" : "Only letters and spaces allowed.";
    });

    document.getElementById("mPhoto").addEventListener("change", function () {
        previewImage(this, "photoPreview");
    });
    document.getElementById("mAdmit").addEventListener("change", function () {
        previewImage(this, "admitPreview");
    });



    function previewImage(input, previewId) {
        const file = input.files[0];
        const preview = document.getElementById(previewId);
        if (file) {
            if (file.size > 200 * 1024) {
                alert("File size should be less than 200KB");
                input.value = "";
                preview.style.display = "none";
            } else {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        }
    }

    document.getElementById("editForm").addEventListener("submit", function (e) {
        const nameValid = namePattern.test(mName.value);
        const symbolValid = symbolPattern.test(mSymbol.value);
        const phoneValid = phonePattern.test(mPhone.value);
        const emailValid = emailPattern.test(mEmail.value);
        const collegeValid = namePattern.test(mCollege.value);

        if (!nameValid || !symbolValid || !phoneValid || !emailValid || !collegeValid) {
            alert("Please fix validation errors before submitting.");
            e.preventDefault();
        }
    });

    // Show modal with pre-filled data
    function openEditModal(data) {
        document.getElementById('editModal').style.display = 'block';

        // document.getElementById('editTeamId').value = data.team_id;
        document.getElementById('editMemberId').value = data.id;

        document.getElementById('mSymbol').value = data.symbol_no;
        document.getElementById('mName').value = data.member_name;
        document.getElementById('mEmail').value = data.email;
        document.getElementById('mPhone').value = data.phone;
        document.getElementById('mCollege').value = data.college;

        document.getElementById('photoPreview').src = data.photo;
        document.getElementById('photoPreview').style.display = 'block';

        document.getElementById('admitPreview').src = data.admit_card;
        document.getElementById('admitPreview').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }



    // edit section validation end


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

</script>