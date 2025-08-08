<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HDC Hackathon Registration</title>
  <link rel="icon" href="../assets/images/hackathon.png" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --theme-color: #104594;
      --primary: #2a3b90;
      --primary-light: #3a4da8;
      --primary-dark: #1a2b70;
      --secondary: #f05d23;
      --secondary-light: #ff6b2b;
      --secondary-dark: #d04a1a;
      --accent: #6bd3e0;
      --accent-dark: #4bc5d4;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --light-gray: #e9ecef;
      --success: #28a745;
      --warning: #ffc107;
      --danger: #dc3545;
      --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
      --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
      --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.12);
      --shadow-heavy: 0 15px 40px rgba(0, 0, 0, 0.15);

    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #EEF1FF;
      color: var(--dark);
      line-height: 1.7;
      overflow-x: hidden;
    }


    /* body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f7f9;
    }

    .navbar {
      background-color: var(--theme-color);
    }

    .navbar-brand,
    .navbar .nav-link {
      color: #fff !important;
      font-weight: 600;
    } */

    /* header section */
    /* Enhanced Header */
    .main-header {
      /* margin-top: -30px; */
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-light);
      position: fixed;
      width: 100%;
      z-index: 1000;
      transition: var(--transition);
      display: block;
    }

    .main-header.scrolled {
      background: rgba(255, 255, 255, 0.98);
      box-shadow: var(--shadow-medium);
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
      transition: var(--transition);
    }

    .main-header.scrolled .header-content {
      padding: 15px 0;
    }

    .logo {
      font-size: 1.8rem;
      font-weight: 800;
      color: var(--primary);
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: var(--transition);
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .logo span {
      color: var(--secondary);
    }

    .logo::before {
      content: '⚡';
      margin-right: 8px;
      font-size: 1.5rem;
    }

    .nav-links {
      display: flex;
      gap: 35px;
      align-items: center;
    }

    .nav-links a {
      color: var(--dark);
      text-decoration: none;
      font-weight: 500;
      font-size: 1rem;
      transition: var(--transition);
      position: relative;
      padding: 8px 0;
    }

    .nav-links a:hover {
      color: var(--primary);
      transform: translateY(-2px);
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 3px;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      transition: var(--transition);
      transform: translateX(-50%);
      border-radius: 2px;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .btn-outline {
      border: 2px solid var(--primary);
      color: var(--primary);
      background: transparent;
      padding: 10px 25px;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .btn-outline::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: var(--primary);
      transition: var(--transition);
      z-index: -1;
    }

    .btn-outline:hover::before {
      left: 0;
    }

    .btn-outline:hover {
      color: white;
      transform: translateY(-2px);
      box-shadow: var(--shadow-light);
    }

    /* Mobile Menu */
    .mobile-menu-toggle {
      display: none;
      flex-direction: column;
      cursor: pointer;
      padding: 5px;
    }

    .mobile-menu-toggle span {
      width: 25px;
      height: 3px;
      background: var(--primary);
      margin: 3px 0;
      transition: var(--transition);
    }

    .mobile-menu-toggle.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    }

    .mobile-menu-toggle.active span:nth-child(2) {
      opacity: 0;
    }

    .mobile-menu-toggle.active span:nth-child(3) {
      transform: rotate(-45deg) translate(7px, -6px);
    }

    .mobile-menu {
      position: fixed;
      top: 0;
      right: -100%;
      width: 300px;
      height: 100vh;
      background: white;
      box-shadow: var(--shadow-heavy);
      transition: var(--transition);
      padding: 100px 30px 30px;
      z-index: 999;
    }

    .mobile-menu.active {
      right: 0;
    }

    .mobile-menu a {
      display: block;
      padding: 15px 0;
      color: var(--dark);
      text-decoration: none;
      font-weight: 500;
      border-bottom: 1px solid var(--light-gray);
      transition: var(--transition);
    }

    .mobile-menu a:hover {
      color: var(--primary);
      padding-left: 10px;
    }

    /* Form section */
    .form-section {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #00000020;
      margin-top: 30px;
    }

    /* footer {
      background-color: var(--theme-color);
      color: #fff;
      text-align: center;
      padding: 15px 0;
      margin-top: 60px;
    } */
    .section-title {
      text-align: center;
      margin-bottom: 80px;
      position: relative;
    }

    .section-title h2 {
      font-size: 3rem;
      color: var(--primary);
      margin-bottom: 20px;
      font-weight: 800;
      position: relative;
    }

    .section-title p {
      color: var(--gray);
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
    }

    .section-title::after {
      content: '';
      display: block;
      width: 100px;
      height: 5px;
      background: linear-gradient(90deg, var(--secondary), var(--accent));
      margin: 30px auto 0;
      border-radius: 3px;
    }


    .modal-header {
      background-color: var(--theme-color);
      color: white;
    }

    .btn-theme {
      background-color: var(--theme-color);
      color: white;
    }

    .btn-theme:hover {
      color: #0d3a7c;
      background-color: white;
      border: 1px solid #0d3a7c;
    }

    .error {
      color: red;
      font-size: 0.875em;
    }

    .preview {
      max-width: 100%;
      max-height: 100px;
      margin-top: 5px;
    }

    /* css of loader */
    /* Loader styles */
    #loaderOverlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 0, 0, 0.6);
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .loader-container {
      text-align: center;
    }

    /* css for footer */
    /* Enhanced Footer */
    footer {
      background: linear-gradient(135deg, var(--dark) 0%, #1a1d23 100%);
      color: white;
      padding: 80px 0 40px;
      position: relative;
      overflow: hidden;
    }

    footer::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiPjxkZWZzPjxwYXR0ZXJuIGlkPSJwYXR0ZXJuIiB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHBhdHRlcm5Vbml0cz0idXNlclNwYWNlT25Vc2UiIHBhdHRlcm5UcmFuc2Zvcm09InJvdGF0ZSg0NSkiPjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAyKSIvPjwvcGF0dGVybj48L2RlZnM+PHJlY3Qgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0idXJsKCNwYXR0ZXJuKSIvPjwvc3ZnPg==');
      opacity: 0.5;
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 50px;
      margin-bottom: 60px;
      position: relative;
      z-index: 2;
    }

    .footer-logo {
      text-decoration: none;
      font-size: 1.8rem;
      font-weight: 800;
      color: white;
      margin-bottom: 25px;
      display: inline-block;
      transition: var(--transition);
    }

    .footer-logo:hover {
      transform: scale(1.05);
    }

    .footer-logo span {
      color: var(--accent);
    }

    .footer-logo::before {
      content: '⚡';
      margin-right: 10px;
      font-size: 1.8rem;
      text-decoration: none;
    }

    .footer-about p {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1rem;
      line-height: 1.8;
      margin-bottom: 25px;
    }

    .social-links {
      display: flex;
      gap: 15px;
    }

    .social-link {
      width: 45px;
      height: 45px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-decoration: none;
      transition: var(--transition);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .social-link:hover {
      background: var(--accent);
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(107, 211, 224, 0.4);
    }

    .footer-links h3 {
      color: white;
      font-size: 1.3rem;
      margin-bottom: 25px;
      font-weight: 700;
      position: relative;
    }

    .footer-links h3::after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 30px;
      height: 3px;
      background: var(--accent);
      border-radius: 2px;
    }

    .footer-links ul {
      list-style-type: none;
      padding: 0;
    }

    .footer-links li {
      margin-bottom: 12px;
    }

    .footer-links a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: var(--transition);
      font-size: 1rem;
      display: inline-block;
    }

    .footer-links a:hover {
      color: var(--accent);
      padding-left: 8px;
    }

    .footer-bottom {
      text-align: center;
      padding-top: 40px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: rgba(255, 255, 255, 0.6);
      font-size: 1rem;
      position: relative;
      z-index: 2;
    }

    /* Scroll to Top Button */
    .scroll-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      cursor: pointer;
      transition: var(--transition);
      opacity: 0;
      visibility: hidden;
      z-index: 1000;
    }

    .scroll-top.visible {
      opacity: 1;
      visibility: visible;
    }

    .scroll-top:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(42, 59, 144, 0.4);
    }

    /* Animations */
    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in-up {
      animation: fadeInUp 0.8s ease-out;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
      .nav-links {
        display: none;
      }

      .mobile-menu-toggle {
        display: flex;
      }

      .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 50px;
      }

      .hero-image {
        order: -1;
        max-width: 600px;
        margin: 0 auto;
      }

      .hero-title {
        font-size: 3rem;
      }

      .hero-stats {
        justify-content: center;
      }

      .remember-list {
        grid-template-columns: 1fr;
      }

      .countdown {
        gap: 20px;
      }
    }

    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
      }

      .section-title h2 {
        font-size: 2.2rem;
      }

      .feature-card {
        padding: 40px 30px;
      }

      .hero-stats {
        flex-direction: column;
        align-items: center;
      }

      .countdown {
        flex-wrap: wrap;
        gap: 15px;
      }

      .countdown-item {
        min-width: 80px;
        padding: 20px 15px;
      }
    }

    @media (max-width: 576px) {
      .hero {
        padding-top: 100px;
      }

      .hero-title {
        font-size: 2rem;
      }

      .section {
        padding: 80px 0;
      }

      .container {
        padding: 0 15px;
      }

      .btn-primary {
        padding: 12px 30px;
        font-size: 1rem;
      }

      .cta-title {
        font-size: 2.2rem;
      }
    }

    @media (min-width: 1200px) {
      .custom-modal-width {
        max-width: 1000px;
        /* Adjust as needed */
      }
    }

    .modal-body {
      overflow-x: hidden;
    }
  </style>
</head>

<body>

  <div>
    <header class="main-header" id="header">
      <div class="container">
        <div class="header-content">
          <a href="../index.php" class="logo">HDC<span>Hackathon</span></a>
          <nav class="nav-links">
            <a href="../index">Home</a>
            <a href="../index#features">Features</a>
            <a href="../index#guidelines">Guidelines</a>
            <a href="registration/register">Register</a>
            <a href="../index#contact">Contact</a>

          </nav>
          <div class="mobile-menu-toggle" id="mobileToggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>

      <div class="mobile-menu" id="mobileMenu">
        <a href="../index#home">Home</a>
        <a href="../index#features">Features</a>
        <a href="../index#guidelines">Guidelines</a>
        <a href="registration/register">Register</a>
        <a href="../index#contact">Contact</a>
      </div>
    </header>
  </div>

  <div style="min-height: 70px;">
    new line
  </div>


  <!-- Registration Form -->
  <div class="wrapper-form-table m-5">
    <div class="container" style="margin-top:30px;">
      <div class="form-section section-title">
        <h2 class="text-center mb-4">Team Registration</h2>
        <form id="teamForm">
          <div class="row mb-3">
            <div class="col-md-4">
              <!-- <label for="teamName" class="form-label">Team Name</label> -->
              <p style="float: left;">Team Name</p>
              <input type="text" class="form-control" id="teamName" name="team_name" required>
              <div id="teamNameError" class="error"></div>
            </div>
            <div class="col-md-4 d-none">
              <label for="collegeName" class="form-label">College Name</label>
              <input type="text" class="form-control" id="collegeName" name="college_name" value="HDC">
              <div id="collegeNameError" class="error"></div>
            </div>
            <div class="col-md-8 d-flex align-items-end justify-content-end mt-2 mt-md-2" id="addMemberBtnDiv">
              <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                <i class="bi bi-person-plus-fill"></i> Add Member
              </button>
            </div>
          </div>

          <!-- Members Table -->
          <div class="table-responsive">
            <table class="table table-bordered" id="memberTable">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Symbol No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>College</th>
                  <th>Photo</th>
                  <th>Admit Card</th>
                  <th>Action</th>
                </tr>

              </thead>
              <tbody></tbody>
            </table>
          </div>

          <!-- Submit Button -->
          <div class="text-center">
            <button type="submit" class="btn btn-outline" id="registerbtn" style="display: none;">Register Team</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal for Adding Members -->
    <!-- <div class="modal fade" id="addMemberModal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="memberForm">
              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Symbol Number</label>
                  <input type="number" class="form-control mb-2" id="mSymbol" placeholder="Symbol No." required>
                  <div id="mSymbolError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Name</label>
                  <input type="text" class="form-control mb-2" id="mName" placeholder="Full Name" required>
                  <div id="mNameError" class="error"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Email</label>
                  <input type="email" class="form-control mb-2" id="mEmail" placeholder="Email" required>
                  <div id="mEmailError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Phone</label>
                  <input type="text" class="form-control mb-2" id="mPhone" placeholder="Phone" required>
                  <div id="mPhoneError" class="error"></div>
                </div>
              </div>

              <label class="mb-1">College Name</label>
              <input type="text" class="form-control mb-2" id="mCollege" placeholder="College Name" required>
              <div id="mCollegeError" class="error"></div>

              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Photo Card (max 200KB)</label>
                  <input type="file" class="form-control mb-2" id="mPhoto" accept="image/*" required
                    onchange="previewPhoto(event)">
                </div>

                <div class="col-6">
                  <div id="photoPreviewContainer" style="position: relative; display: none;">
                    <img class="preview" id="photoPreview"
                      style="width: 100%; height: auto; border: 1px solid #ccc; border-radius: 4px;" />
                    <button type="button" onclick="removePhotoPreview()"
                      style="position: absolute; top: 5px; right: 5px; background: #f00; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer;">&times;</button>
                  </div>
                </div>
              </div>

              
              <script>
                function previewPhoto(event) {
                  const file = event.target.files[0];
                  const preview = document.getElementById("photoPreview");
                  const container = document.getElementById("photoPreviewContainer");

                  if (file && file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                      preview.src = e.target.result;
                      container.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                  } else {
                    preview.src = "";
                    container.style.display = "none";
                  }
                }

                function removePhotoPreview() {
                  const input = document.getElementById("mPhoto");
                  const preview = document.getElementById("photoPreview");
                  const container = document.getElementById("photoPreviewContainer");

                  input.value = "";
                  preview.src = "";
                  container.style.display = "none";
                }
              </script>


              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Admit Card (max 200KB)</label>
                  <input type="file" class="form-control mb-2" id="mAdmit" accept="image/*" required
                    onchange="previewAdmit(event)">
                </div>

                <div class="col-6">
                  <div id="admitPreviewContainer" style="position: relative; display: none;">
                    <img class="preview" id="admitPreview"
                      style="width: 100%; height: auto; border: 1px solid #ccc; border-radius: 4px;" />
                    <button type="button" onclick="removeAdmitPreview()"
                      style="position: absolute; top: 5px; right: 5px; background: #f00; color: white; border: none; border-radius: 50%; width: 24px; height: 24px; cursor: pointer;">&times;</button>
                  </div>
                </div>
              </div>
              
              <script>
                function previewAdmit(event) {
                  const file = event.target.files[0];
                  const preview = document.getElementById("admitPreview");
                  const container = document.getElementById("admitPreviewContainer");

                  if (file && file.type.startsWith("image/")) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                      preview.src = e.target.result;
                      container.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                  } else {
                    preview.src = "";
                    container.style.display = "none";
                  }
                }

                function removeAdmitPreview() {
                  const input = document.getElementById("mAdmit");
                  const preview = document.getElementById("admitPreview");
                  const container = document.getElementById("admitPreviewContainer");

                  input.value = "";
                  preview.src = "";
                  container.style.display = "none";
                }
              </script>


              <div class="text-end">
                <button type="button" class="btn btn-outline" onclick="addMember()">Add to List</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Modal for Adding Members -->
    <!-- Modal for Adding Members -->
    <div class="modal fade" id="addMemberModal" tabindex="-1">
      <div class="modal-dialog modal-xl custom-modal-width">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="memberForm">
              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Symbol Number</label>
                  <input type="number" class="form-control mb-2" id="mSymbol" placeholder="Symbol No." required>
                  <div id="mSymbolError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Name</label>
                  <input type="text" class="form-control mb-2" id="mName" placeholder="Full Name" required>
                  <div id="mNameError" class="error"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Email</label>
                  <input type="email" class="form-control mb-2" id="mEmail" placeholder="Email" required>
                  <div id="mEmailError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Phone</label>
                  <input type="text" class="form-control mb-2" id="mPhone" placeholder="Phone" required>
                  <div id="mPhoneError" class="error"></div>
                </div>
              </div>

              <label class="mb-1">College Name</label>
              <input type="text" class="form-control mb-2" id="mCollege" placeholder="College Name" required>
              <div id="mCollegeError" class="error"></div>

              <div class="row">
                <!-- Photo Upload -->
                <div class="col-6">
                  <label class="file-label">Photo Card (max 200KB)</label>
                  <label class="custom-file-upload">
                    Browse Photo
                    <input type="file" id="mPhoto" accept="image/*" required onchange="previewPhoto(event)">
                  </label>
                  <div id="photoPreviewContainer" style="position: relative; display: none; margin-top: 10px;">
                    <img class="preview" id="photoPreview" />
                    <button type="button" class="remove-btn" onclick="removePhotoPreview()">&times;</button>
                  </div>
                </div>

                <!-- Admit Upload -->
                <div class="col-6">
                  <label class="file-label">Admit Card (max 200KB)</label>
                  <label class="custom-file-upload">
                    Browse Admit
                    <input type="file" id="mAdmit" accept="image/*" required onchange="previewAdmit(event)">
                  </label>
                  <div id="admitPreviewContainer" style="position: relative; display: none; margin-top: 10px;">
                    <img class="preview" id="admitPreview" />
                    <button type="button" class="remove-btn" onclick="removeAdmitPreview()">&times;</button>
                  </div>
                </div>
              </div>

              <div class="text-end mt-3">
                <button type="button" class="btn btn-outline" onclick="addMember()">Add to List</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- JS for Photo Preview -->
    <script>
      function previewPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("photoPreview");
        const container = document.getElementById("photoPreviewContainer");

        if (file && file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
            container.style.display = "block";
          };
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
          container.style.display = "none";
        }
      }

      function removePhotoPreview() {
        const input = document.getElementById("mPhoto");
        const preview = document.getElementById("photoPreview");
        const container = document.getElementById("photoPreviewContainer");

        input.value = "";
        preview.src = "";
        container.style.display = "none";
      }
    </script>

    <!-- JS for Admit Preview -->
    <script>
      function previewAdmit(event) {
        const file = event.target.files[0];
        const preview = document.getElementById("admitPreview");
        const container = document.getElementById("admitPreviewContainer");

        if (file && file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
            container.style.display = "block";
          };
          reader.readAsDataURL(file);
        } else {
          preview.src = "";
          container.style.display = "none";
        }
      }

      function removeAdmitPreview() {
        const input = document.getElementById("mAdmit");
        const preview = document.getElementById("admitPreview");
        const container = document.getElementById("admitPreviewContainer");

        input.value = "";
        preview.src = "";
        container.style.display = "none";
      }
    </script>
  </div>

  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <div class="footer-content">
        <div class="footer-about">
          <a href="#" class="footer-logo">HDC<span>Hackathon</span></a>
          <p>The premier hackathon event fostering innovation and collaboration among the brightest minds since 2015.
            Join us in shaping the future of technology.</p>
          <div class="social-links">
            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
            <a href="#" class="social-link"><i class="fab fa-discord"></i></a>
            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="footer-links">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="../index">Home</a></li>
            <li><a href="../index#features">Features</a></li>
            <li><a href="../index#guidelines">Guidelines</a></li>
            <li><a href="registration/register">Register</a></li>
          </ul>
        </div>
        <div class="footer-links">
          <h3>Resources</h3>
          <ul>
            <li><a href="#">Rules & Regulations</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Judging Criteria</a></li>
            <li><a href="#">Past Winners</a></li>
          </ul>
        </div>
        <div class="footer-links">
          <h3>Contact</h3>
          <ul>
            <li><a href="mailto:info@hdchack.com">Email Us</a></li>
            <li><a href="#">Sponsorship</a></li>
            <li><a href="#">Volunteer</a></li>
            <li><a href="#">Media Kit</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        © 2025 HDC Hackathon Committee. All rights reserved. | Privacy Policy | Terms of Service
      </div>
    </div>
  </footer>


  <!-- Loader -->
  <div id="loaderOverlay" style="display: none;">
    <div class="loader-container">
      <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <p class="text-light mt-2">Processing, please wait...</p>
    </div>
  </div>


  <!-- Script -->
  <script>
    //For all other Validations
    let memberCount = 0;

    const namePattern = /^[a-zA-Z\s]+$/;
    const symbolPattern = /^\d{8}$/;
    const phonePattern = /^(98|97)\d{8}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    document.getElementById("teamName").addEventListener("input", function () {
      document.getElementById("teamNameError").textContent = namePattern.test(this.value) ? "" : "Only letters and spaces allowed.";
    });
    document.getElementById("collegeName").addEventListener("input", function () {
      document.getElementById("collegeNameError").textContent = namePattern.test(this.value) ? "" : "Only letters and spaces allowed.";
    });
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


    // backend duplicacy check 
    // for team name
    document.getElementById("teamName").addEventListener("input", async function () {
      const teamName = this.value.trim();
      const errorElement = document.getElementById("teamNameError");

      // Reset message if input is empty
      if (teamName.length === 0) {
        errorElement.textContent = "";
        errorElement.style.color = "";
        return;
      }

      try {
        let response = await fetch(`submit.php?team_name=${encodeURIComponent(teamName)}`);
        let data = await response.json();

        if (data.exists) {
          errorElement.textContent = "Team name already exists.";
          errorElement.style.color = "red";
        } else {
          errorElement.textContent = ""; // No message if available
          errorElement.style.color = "";
        }
      } catch (error) {
        console.error("Error checking team name:", error);
      }
    });


    function checkMemberLimit() {
      const addBtn = document.querySelector("#addMemberBtnDiv button");
      addBtn.disabled = (memberCount >= 4); // disable at 4 members
    }

    function addMember() {
      if (memberCount >= 4) return;

      const symbol = document.getElementById("mSymbol").value.trim();
      const name = document.getElementById("mName").value.trim();
      const email = document.getElementById("mEmail").value.trim();
      const phone = document.getElementById("mPhone").value.trim();
      const college = document.getElementById("mCollege").value.trim();
      const photoFile = document.getElementById("mPhoto").files[0];
      const admitFile = document.getElementById("mAdmit").files[0];

      if (!symbolPattern.test(symbol) || !namePattern.test(name) || !emailPattern.test(email) ||
        !phonePattern.test(phone) || !namePattern.test(college) || !photoFile || !admitFile) {
        Swal.fire("Error", "Please correct all input fields.", "error");
        return;
      }

      if (photoFile.size > 200 * 1024 || admitFile.size > 200 * 1024) {
        Swal.fire("File Too Large", "Each image must be ≤ 200KB.", "warning");
        return;
      }

      const reader1 = new FileReader();
      const reader2 = new FileReader();

      reader1.onload = function (e1) {
        reader2.onload = function (e2) {
          memberCount++;

          const table = document.getElementById("memberTable").querySelector("tbody");
          const row = document.createElement("tr");
          row.innerHTML = `
        <td>${memberCount}</td>
        <td>${symbol}</td>
        <td>${name}</td>
        <td>${email}</td>
        <td>${phone}</td>
        <td>${college}</td>
        <td><img src="${e1.target.result}" class="preview" /></td>
        <td><img src="${e2.target.result}" class="preview" /></td>
        <td>
          <input type="file" name="photo_${memberCount - 1}" style="display:none;" />
          <input type="file" name="admit_${memberCount - 1}" style="display:none;" />
          <button class="btn btn-danger btn-sm" onclick="removeMember(this)">Remove</button>
        </td>
      `;

          table.appendChild(row);

          row.querySelector(`input[name="photo_${memberCount - 1}"]`).files = createFileList(photoFile);
          row.querySelector(`input[name="admit_${memberCount - 1}"]`).files = createFileList(admitFile);

          document.getElementById("memberForm").reset();
          document.getElementById("photoPreview").style.display = "none";
          document.getElementById("admitPreview").style.display = "none";

          bootstrap.Modal.getInstance(document.getElementById('addMemberModal')).hide();
          if (memberCount === 4) {
            document.getElementById("registerbtn").style.display = "inline-block";
          }
          checkMemberLimit();
        };
        reader2.readAsDataURL(admitFile);
      };
      reader1.readAsDataURL(photoFile);
    }

    // Create FileList object from single File
    function createFileList(file) {
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      return dataTransfer.files;
    }


    function removeMember(button) {
      button.closest("tr").remove();
      memberCount--;
      const rows = document.querySelectorAll("#memberTable tbody tr");
      rows.forEach((row, i) => row.firstElementChild.textContent = i + 1);
      if (memberCount < 4) {
        document.getElementById("registerbtn").style.display = "none";
      }

      checkMemberLimit(); // Add this line
    }


    document.getElementById("teamForm").addEventListener("change", function (e) {
      const file = e.target.files[0];
      if (file && file.size > 200 * 1024) {
        Swal.fire("File Too Large", "Each image must be less than or equal to 200KB.", "warning");
        e.target.value = "";
        return;
      }

      document.addEventListener("change", function (e) {
        if (e.target.matches(".photo-input, .admit-input")) {
          const file = e.target.files[0];
          const preview = e.target.nextElementSibling; // Gets the <img> right after the input

          if (file && preview && preview.classList.contains("preview")) {
            const reader = new FileReader();
            reader.onload = function (evt) {
              preview.src = evt.target.result;
              preview.style.display = "block";
            };
            reader.readAsDataURL(file);
          }
        }
      });

    });

    document.getElementById("teamForm").addEventListener("submit", function (e) {
      e.preventDefault();

      const rows = document.querySelectorAll("#memberTable tbody tr");
      if (rows.length !== 4) {
        Swal.fire("Error", "Exactly 4 members are required.", "error");
        return;
      }

      // Show the loader
      document.getElementById("loaderOverlay").style.display = "flex";

      const form = new FormData();
      form.append("team_name", document.getElementById("teamName").value.trim());
      form.append("college_name", document.getElementById("collegeName").value.trim());

      const members = [];

      rows.forEach((row, index) => {
        const cells = row.querySelectorAll("td");
        const symbol = cells[1].innerText;
        const name = cells[2].innerText;
        const email = cells[3].innerText;
        const phone = cells[4].innerText;
        const college = cells[5].innerText;

        members.push({ symbol, name, email, phone, college });

        const files = row.querySelectorAll("input[type='file']");
        form.append(`photo_${index}`, files[0].files[0]);
        form.append(`admit_${index}`, files[1].files[0]);
      });

      form.append("members", JSON.stringify(members));

      fetch("submit.php", {
        method: "POST",
        body: form,
      })
        .then(res => res.json())
        .then(data => {
          // Hide the loader
          document.getElementById("loaderOverlay").style.display = "none";

          if (data.success) {
            Swal.fire("Success", data.message, "success");
            document.getElementById("teamForm").reset();
            document.querySelector("#memberTable tbody").innerHTML = "";
            memberCount = 0;
            document.getElementById("registerbtn").style.display = "none";
          } else {
            Swal.fire("Error", data.error || "Something went wrong.", "error");
          }
        })
        .catch(() => {
          // Hide the loader even on error
          document.getElementById("loaderOverlay").style.display = "none";

          Swal.fire("Error", "Server error. Please check PHP backend.", "error");
        });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>