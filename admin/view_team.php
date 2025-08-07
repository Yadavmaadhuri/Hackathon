<?php
session_start();
include_once('header.php');
include_once('sidebar.php');
include_once('topbar.php');

include '../config/database.php';
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

$team_id = $_GET['team_id'] ?? null;
if (!$team_id) {
    echo "Invalid Team ID.";
    exit;
}

// Fetch team info
$teamQuery = $conn->query("SELECT * FROM teams WHERE id = $team_id");
$team = $teamQuery->fetch_assoc();

// Fetch members
$memberQuery = $conn->query("SELECT * FROM team_members WHERE team_id = $team_id");
?>


<div class="container-fluid my-5">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <!-- Page Title -->
        <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div> -->

        <!-- Team Details Card -->
        <div class="card shadow pb-2 mt-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Team Details</h4>
            </div>
            <div class="card-body">
                <h5>Team Name: <?= htmlspecialchars($team['name']) ?></h5>
                <p><strong>Description:</strong> <?= htmlspecialchars($team['description']) ?></p>
                <p><strong>Status:</strong>
                    <?php
                    $status = $team['status'];
                    if ($status == 0) {
                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                    } elseif ($status == 1) {
                        echo '<span class="badge bg-success">Approved</span>';
                    } elseif ($status == 2) {
                        echo '<span class="badge bg-danger">Rejected</span>';
                    } else {
                        echo '<span class="badge bg-secondary">Unknown</span>';
                    }
                    ?>
                </p>

                <?php if ($status == 0): ?>
                    <button class="btn btn-success me-2" onclick="confirmAction('approve', <?= $team_id ?>)">Approve</button>
                    <button class="btn btn-danger" onclick="confirmAction('reject', <?= $team_id ?>)">Reject</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Team Members Card -->
        <div class="card mt-4 shadow">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Team Members</h5>
            </div>
            <div class="card-body">
                <?php if ($memberQuery->num_rows > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>College</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($member = $memberQuery->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $member['id'] ?></td>
                                    <td><?= htmlspecialchars($member['college']) ?></td>
                                    <td><?= htmlspecialchars($member['member_name']) ?></td>
                                    <td><?= htmlspecialchars($member['phone']) ?></td>
                                    <td><?= htmlspecialchars($member['email']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-muted">No members found for this team.</p>
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


<script>
function confirmAction(action, teamId) {
    let actionText = action === 'approve' ? 'Approve' : 'Reject';
    let confirmBtnColor = action === 'approve' ? '#198754' : '#dc3545';

    Swal.fire({
        title: `Are you sure you want to ${actionText} this team?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: confirmBtnColor,
        confirmButtonText: `Yes, ${actionText}`,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `process_status.php?action=${action}&team_id=${teamId}`;
        }
    });
}
</script>

</body>
</html>
