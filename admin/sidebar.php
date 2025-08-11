<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="sidebar">
  <h2><i class="fa-solid fa-user-shield px-2"></i>Admin</h2>
  <a href="dashboard" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-gauge px-2"></i>Dashboard
  </a>
  <a href="teams" class="<?= $current_page == 'teams.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-users px-2"></i>Team List
  </a>
  <a href="member" class="<?= $current_page == 'member.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-user px-2"></i>Member List
  </a>
  <a href="setting" class="<?= $current_page == 'setting.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-gear px-2"></i>Settings
  </a>
  <a href="logout" id="logoutBtn" class="<?= $current_page == 'logout.php' ? 'active' : '' ?>">
    <i class="fa-solid fa-right-from-bracket px-2"></i>Logout
  </a>
</div>

<style>
.sidebar a.active {
  background-color: #20487eff; /* Bootstrap primary */
  color: white;
  font-weight: bold;
}
.sidebar a.active i {
  color: white;
}
</style>

<!-- Logout button -->
<!-- <button id="logoutBtn">Logout</button> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('logoutBtn').addEventListener('click', function (e) {
    e.preventDefault(); // stop default link/button behavior

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to log out?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, log me out',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to logout page that ends session
            window.location.href = "logout.php?confirmed=true";
        }
    });
});
</script>

