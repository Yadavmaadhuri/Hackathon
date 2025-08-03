<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['id'])) {
  header("Location: login");
  exit();
}

include_once('header.php');
include_once('sidebar.php');
include_once('topbar.php');

?>




<!-- Main Content -->
<!-- <div class="main">
    <h2>Hackathon Team List</h2>

    <form method="GET">
      <input type="text" name="search" placeholder="Search team or college" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
      <select name="status">
        <option value="">All</option>
        <option value="Pending" <?= (isset($_GET['status']) && $_GET['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
        <option value="Approved" <?= (isset($_GET['status']) && $_GET['status'] === 'Approved') ? 'selected' : '' ?>>Approved</option>
        <option value="Rejected" <?= (isset($_GET['status']) && $_GET['status'] === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
      </select>
      <button type="submit">Filter</button>
    </form>

    <table>
      <tr>
        <th>Team ID</th>
        <th>Team Name</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
      <?php
      $query = "SELECT * FROM teams";

      if (!empty($_GET['search'])) {
        $search = $conn->real_escape_string($_GET['search']);
        $query .= " AND (team_name LIKE '%$search%' OR team_id LIKE '%$search%')";
      }

      if (!empty($_GET['status'])) {
        $status = $conn->real_escape_string($_GET['status']);
        $query .= " AND status='$status'";
      }

      $result = $conn->query($query);
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>{$row['team_id']}</td>
                  <td>{$row['team_name']}</td>
                  <td>{$row['status']}</td>
                  <td class='action-link'>
                    <a href='view_team.php?team_id={$row['team_id']}'>View</a>
                  </td>
              </tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No teams found.</td></tr>";
      }
      ?>
    </table>
  </div> -->
<?php

// Get stats
$totalTeams = $conn->query("SELECT COUNT(*) as total FROM teams WHERE is_deleted = 0")->fetch_assoc()['total'];
$totalMembers = $conn->query("SELECT COUNT(*) as total FROM team_members")->fetch_assoc()['total'];
$totalApprovedTeams = $conn->query("SELECT COUNT(*) as total FROM teams WHERE is_deleted = 0 AND status=1")->fetch_assoc()['total'];
$totalRejectedTeams = $conn->query("SELECT COUNT(*) as total FROM teams WHERE is_deleted = 0 AND status=2")->fetch_assoc()['total'];


// Get recent teams and members
$recentTeams = $conn->query("SELECT * FROM teams ORDER BY created_at DESC LIMIT 5");
$recentMembers = $conn->query("SELECT * FROM team_members ORDER BY id DESC LIMIT 5");
$recentApprovedTeams = $conn->query("SELECT * FROM teams WHERE status = 1 ORDER BY created_at DESC LIMIT 5");
$recentRejectedTeams = $conn->query("SELECT * FROM teams WHERE status = 2 ORDER BY id DESC LIMIT 5");


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


<div class="container-fluid">
  <div class="row">


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <!-- Stats -->
      <div class="row mb-4">
        <div class="col-md-6 col-lg-3">
          <div class="card text-white bg-primary mb-3"> <!-- Blue -->
            <div class="card-body">
              <h5 class="card-title">Total Teams</h5>
              <p class="card-text fs-4"><?= $totalTeams ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card text-white bg-warning mb-3"> <!-- Light Blue -->
            <div class="card-body">
              <h5 class="card-title">Total Members</h5>
              <p class="card-text fs-4"><?= $totalMembers ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card text-white bg-success mb-3"> <!-- Green -->
            <div class="card-body">
              <h5 class="card-title">Approved Teams</h5>
              <p class="card-text fs-4"><?= $totalApprovedTeams ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card text-white bg-danger mb-3"> <!-- Red -->
            <div class="card-body">
              <h5 class="card-title">Rejected Teams</h5>
              <p class="card-text fs-4"><?= $totalRejectedTeams ?></p>
            </div>
          </div>
        </div>
      </div>


      <!-- Chart Filter -->
      <div class="mb-3">
        <label for="filter" class="form-label">Select Time Range</label>
        <select id="filter" class="form-select w-auto">
          <option value="daily">Daily</option>
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
        </select>
      </div>

      <!-- Chart -->
      <canvas id="teamChart" height="100"></canvas>

      <!-- Recent Entries -->
      <div class="row mt-5">
        <div class="col-md-6">
          <h4>Recent Teams</h4>
          <ul class="list-group">
            <?php while ($team = $recentTeams->fetch_assoc()): ?>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($team['name']) ?>
                <?= getStatusLabel($team['status']) ?>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>

        <div class="col-md-6">
          <h4>Recent Members</h4>
          <ul class="list-group">
            <?php while ($member = $recentMembers->fetch_assoc()): ?>
              <li class="list-group-item">
                <?= htmlspecialchars($member['member_name']) ?> <br>
                <!-- <small><?= htmlspecialchars($member['college']) ?></small> -->
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>

      <!-- Footer -->
      <footer class="mt-5 mb-3 text-center text-muted">
        <hr>
        &copy; <?= date('Y') ?> Hackathon Admin Panel
      </footer>
    </main>
  </div>
</div>

<script>
  const ctx = document.getElementById('teamChart').getContext('2d');
  let chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'New Teams',
        data: [],
        borderColor: 'rgba(75, 192, 192, 1)',
        tension: 0.1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });

  const filter = document.getElementById('filter');
  filter.addEventListener('change', () => updateChart(filter.value));

  function updateChart(range) {
    fetch(`fetch_chart_data.php?range=${range}`)
      .then(res => res.json())
      .then(data => {
        chart.data.labels = data.labels;
        chart.data.datasets[0].data = data.counts;
        chart.update();
      });
  }

  updateChart('daily');
</script>

<?php
// include_once('footer.php');
?>