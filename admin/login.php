
<?php
session_start();

$servername = "localhost";
$username = "u423560789_hackathon";
$password = "PassionChasers@321$$";
$dbname = "u423560789_hackathon";

// Connect to DB
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Login Logic
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['username'];
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password_input, $row['password'])) {
            // Login success
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_email'] = $row['email'];
            header("Location: dashboard");
            exit();
        } else {
            header("Location: login.php?error=Invalid password");
            exit();
        }
    } else {
        header("Location: login.php?error=Admin not found");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - Hackathon</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --theme-color: #104594;
    }

    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
    }

    .login-box {
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
      max-width: 400px;
      width: 100%;
    }

    .login-box h2 {
      margin-bottom: 30px;
      text-align: center;
      color: var(--theme-color);
      font-weight: 600;
    }

    .form-control {
      border-radius: 8px;
    }

    .btn-theme {
      background-color: var(--theme-color);
      color: white;
      font-weight: 600;
      border-radius: 8px;
    }

    .btn-theme:hover {
      background-color: #0b3d7c;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
      padding: 10px 15px;
      border: 1px solid #f5c6cb;
      border-radius: 5px;
      margin-bottom: 20px;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>

  <div class="login-wrapper">
    <div class="login-box">
      <h2>Admin Login</h2>
      <?php
      if (isset($_GET['error'])) {
          echo '<div class="error">'.htmlspecialchars($_GET['error']).'</div>';
      }
      ?>
      <form action="" method="POST">
        <div class="mb-3">
          <input type="email" name="username" class="form-control" placeholder="Email" required />
        </div>
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required />
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-theme">Login</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


