<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HDC Hackathon 2025</title>
  <link rel="icon" type="image/png" href="assets/images/hackathon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    :root {
      --theme-color: #104594;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
    }

    /* NAVBAR */
    .navbar {
      background-color: var(--theme-color);
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 600;
      font-size: 1.4rem;
    }

    .navbar .nav-link {
      color: #f0f0f0 !important;
      font-weight: 500;
    }

    /* HERO SECTION */
    .hero {
      /* background: linear-gradient(rgba(16, 69, 148, 0.9), rgba(16, 69, 148, 0.9)),
        url('https://images.unsplash.com/photo-1557800636-894a64c1696f') no-repeat center center; */
      background: url('assets/images/hero.jpeg') no-repeat center center;
      /* background: linear-gradient(rgb(214 216 219 / 90%), rgb(98 117 144 / 90%)), url('assets/images/hero-img.jpg') no-repeat center center; */
      background-size: cover;
      color: white;
      padding: 100px 20px;
      text-align: center;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .hero p {
      font-size: 1.2rem;
      margin-top: 10px;
      color: #ddd;
    }

    .btn-theme {
      background-color: #ffffff;
      color: var(--theme-color);
      border: 2px solid white;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-theme:hover {
      background-color: #e0e0e0;
      color: var(--theme-color);
    }

    /* FEATURES */
    .features {
      padding: 60px 20px;
    }

    .features h2 {
      font-weight: 600;
      color: var(--theme-color);
    }

    .feature-icon {
      font-size: 2.2rem;
      color: var(--theme-color);
      margin-bottom: 10px;
    }

    .feature-box {
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s;
    }

    .feature-box:hover {
      transform: translateY(-5px);
    }

    /* INFO SECTION */
    .info-section {
      background-color: #ffffff;
      padding: 50px 20px;
    }

    .info-section h4 {
      color: var(--theme-color);
      font-weight: 600;
    }

    ul.checklist {
      list-style: none;
      padding-left: 0;
    }

    ul.checklist li {
      margin-bottom: 10px;
    }

    ul.checklist li::before {
      content: "\f26b";
      font-family: "Bootstrap-icons";
      color: var(--theme-color);
      margin-right: 10px;
    }

    footer {
      background-color: var(--theme-color);
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: 50px;
    }
  </style>
</head>

<body>
  
  <?php
  session_start();
  if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['success_message']) . "');</script>";
    unset($_SESSION['success_message']);
  }
  ?>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">HDC Hackathon 2025</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <h1>Join the Future of Innovation</h1>
      <p>Collaborate. Create. Compete.</p>
      <a href="registration/register" class="btn btn-theme mt-4 px-4 py-2">Register Your Team</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features">
    <div class="container text-center">
      <h2 class="mb-5">Why Participate?</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="feature-box h-100">
            <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
            <h5>Team Management</h5>
            <p>Register your team of exactly 4 members and manage all details securely.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box h-100">
            <div class="feature-icon"><i class="bi bi-upload"></i></div>
            <h5>Validated File Uploads</h5>
            <p>Submit 12th admit cards and photos (max 200kB) with live previews and validations.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box h-100">
            <div class="feature-icon"><i class="bi bi-chat-square-dots"></i></div>
            <h5>Live Notifications</h5>
            <p>Get SMS confirmations and team approval status instantly via secure SMS gateway.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Info Section -->
  <section class="info-section">
    <div class="container">
      <div class="text-center mb-4">
        <h4>Things to Remember Before Registering</h4>
      </div>
      <ul class="checklist mx-auto" style="max-width: 800px;">
        <li>Each team must consist of exactly 4 members.</li>
        <li>Each member must upload a recent photo and 12th admit card (JPEG/PDF only).</li>
        <li>Uploads are validated — max file size: 200kB.</li>
        <li>Team leader can create an account to manage team status.</li>
        <li>Team ID will be generated upon successful submission.</li>
        <li>Admins will verify your files before approving your team.</li>
        <li>SMS notifications will be sent on registration and approval.</li>
      </ul>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <small>&copy; 2025 HDC Hackathon Committee. All rights reserved.</small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>