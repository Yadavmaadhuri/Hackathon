<?php
session_start();
include_once('header.php');
include_once('sidebar.php');
include_once('topbar.php');

if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}
?>

<!-- Main Content -->
<div class="main">
  <h2>Hackathon Team List</h2>

  <form method="GET">
    <input type="text" name="search" placeholder="Search team or college"
      value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
    <select name="status">
      <option value="">All</option>
      <option value="0" <?= (isset($_GET['status']) && $_GET['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
      <option value="1" <?= (isset($_GET['status']) && $_GET['status'] === 'Approved') ? 'selected' : '' ?>>Approved</option>
      <option value="2" <?= (isset($_GET['status']) && $_GET['status'] === 'Rejected') ? 'selected' : '' ?>>Rejected</option>
    </select>
    <button type="submit">Filter</button>
  </form>

  <!-- Export Button -->
  <button onclick="exportTableToExcel('teamTable', 'Hackathon_Teams')" style="margin-top:10px; margin-bottom:10px;">
    Export to Excel
  </button>

  <table id="teamTable">
    <tr>
      <th>Team ID</th>
      <th>Team Name</th>
      <th>College</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
    <?php
    $query = "SELECT * FROM teams WHERE 1=1";

    if (!empty($_GET['search'])) {
      $search = $conn->real_escape_string($_GET['search']);
      $query .= " AND (name LIKE '%$search%' OR college LIKE '%$search%')";
    }

    if (!empty($_GET['status'])) {
      $status = $conn->real_escape_string($_GET['status']);
      $query .= " AND status='$status'";
    }

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

        echo "<tr>
              <td>{$row['id']}</td>
              <td>" . htmlspecialchars($row['name']) . "</td>
              <td>" . htmlspecialchars($row['college']) . "</td>
              <td>{$statusText}</td>
              <td class='action-link'>
                  <a href='view_team.php?team_id={$row['id']}' class='btn btn-outline-primary '><img src='../assets/images/eye.sv5-g'></a>
              </td>
          </tr>";
      }
    } else {
      echo "<tr><td colspan='4'>No teams found.</td></tr>";
    }
    ?>
  </table>
</div>

<!-- Export to Excel Script -->
<script>
function exportTableToExcel(tableID, filename = '') {
  var downloadLink;
  var dataType = 'application/vnd.ms-excel';
  var tableSelect = document.getElementById(tableID);
  var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

  filename = filename ? filename + '.xls' : 'export_data.xls';

  // Create download link element
  downloadLink = document.createElement("a");

  document.body.appendChild(downloadLink);

  if (navigator.msSaveOrOpenBlob) {
    var blob = new Blob(['\ufeff', tableHTML], {
      type: dataType
    });
    navigator.msSaveOrOpenBlob(blob, filename);
  } else {
    // Create a link to the file
    downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

    // Setting the file name
    downloadLink.download = filename;

    // Triggering the function
    downloadLink.click();
  }
}
</script>

<?php
include_once('footer.php');
?>
