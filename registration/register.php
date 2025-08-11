<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HDC Hackathon Registration</title>
  <link rel="icon" href="../assets/images/hackathon.png" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap"
    rel="stylesheet">
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

    .container {
      /* max-width: 1200px; */
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Enhanced Header */
    .main-header {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      box-shadow: var(--shadow-light);
      position: fixed;
      width: 100%;
      z-index: 1000;
      transition: var(--transition);
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

    /* .mobile-menu-toggle.active span:nth-child(1) {
      transform: rotate(45deg) translate(5px, 5px);
    } */

    /* .mobile-menu-toggle.active span:nth-child(2) {
      opacity: 0;
    } */

    /* .mobile-menu-toggle.active span:nth-child(3) {
      transform: rotate(-45deg) translate(7px, -6px);
    } */


    /* Mobile dropdown menu */
    .mobile-menu {
      position: absolute;
      /* anchor to header */
      top: 60px;
      /* adjust to match your header height */
      right: 10px;
      /* small gap from right edge */
      width: 200px;
      /* compact width */
      background: white;
      box-shadow: var(--shadow-heavy);
      border-radius: 8px;
      overflow: hidden;
      max-height: 0;
      /* start closed */
      opacity: 0;
      /* invisible when closed */
      transition: max-height 0.3s ease, opacity 0.3s ease;
      z-index: 999;
    }

    /* Open state */
    .mobile-menu.active {
      max-height: 300px;
      /* just enough for links */
      opacity: 1;
    }

    /* Menu links */
    .mobile-menu a {
      display: block;
      padding: 12px 15px;
      color: var(--dark);
      text-decoration: none;
      font-weight: 500;
      border-bottom: 1px solid var(--light-gray);
      background: white;
      transition: background 0.2s ease, color 0.2s ease;
    }

    .mobile-menu a:last-child {
      border-bottom: none;
      /* no border on last link */
    }

    .mobile-menu a:hover {
      color: var(--primary);
      background: var(--light-gray);
    }

    /* Form section */
    .form-section {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px #00000020;
      margin-top: 30px;
    }

    .section-title {
      text-align: center;
      margin-top: 20px;
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


    /* query */

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
      margin-bottom: 15px;
      text-align: left;
      padding-left: 0;
      margin-left: 0;
    }



    .preview {
      max-width: 100%;
      max-height: 100px;
      margin-top: 5px;
    }

    /* loader */
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

    /* footer */
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

    /* Responsive Styles (kept same as original intent) */
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
        font-size: 1.5rem;

      }

      .section-title p {
        font-size: 0.6rem;
      }

      #table-responsive {
        margin: 0px;
      }

      #memberTable th,
      #memberTable td {
        font-size: 0.5rem;


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


      .footer-content {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
      }

      /*  add member button */
      #openAddMemberBtn {
        font-size: 0.875rem;
        /* smaller text */
        padding: 0.25rem 0.5rem;
        /* less padding */
        margin: 0.25rem;
        width: 100%;
        display: block;
        /* tighter margin */
      }

      #openAddMemberBtn i {
        font-size: 0.9rem;
        /* shrink icon too */
      }

      /* register  */
      #registerbtn {
        font-size: 0.875rem;
        /* smaller text */
        padding: 0.25rem 0.5rem;
        /* less padding */
        margin: 0.25rem;
        width: 100%;
        display: block;
        /* tighter margin */
      }

      #registerbtn i {
        font-size: 0.9rem;
        /* shrink icon too */
      }

      #addToListBtn {
        font-size: 0.875rem;
        /* smaller text */
        padding: 0.25rem 0.5rem;
        /* less padding */
        margin: 0.25rem;
        /* tighter margin */
        width: 100%;
        /* full width */
        display: block;
      }

      #addToListBtn i {
        font-size: 0.9rem;
      }

      .footer-content {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
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
      }
    }

    .modal-body {
      overflow-x: hidden;
    }

    .image-upload-container {
      position: relative;
      display: inline-block;
      cursor: pointer;
      border: 2px dashed #ccc;
      border-radius: 10px;
      overflow: hidden;
      width: 150px;
      height: 150px;
      background-color: #f9f9f9;
      transition: border-color 0.3s;
    }

    .image-upload-container:hover {
      border-color: #092448;
    }

    .image-upload-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .remove-btn {
      position: absolute;
      top: 5px;
      right: 5px;
      background: #ff4444;
      border: none;
      color: white;
      font-size: 18px;
      padding: 0 6px;
      border-radius: 50%;
      cursor: pointer;
      display: none;
    }

    .remove-btn:hover {
      background: #cc0000;
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
            <a href="#register">Register</a>
            <a href="../index#contact">Contact</a>
          </nav>
          <!-- Hamburger Icon -->
          <div class="mobile-menu-toggle" id="mobileToggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
      <!-- Mobile Menu -->
      <div class="mobile-menu" id="mobileMenu">
        <a href="../index#home">Home</a>
        <a href="../index#features">Features</a>
        <a href="../index#guidelines">Guidelines</a>
        <a href="#register">Register</a>
        <a href="../index#contact">Contact</a>
      </div>
    </header>
  </div>

  <div style="min-height: 80px;">
    new line
  </div>

  <!-- Registration Form -->
  <div class="wrapper-form-table">
    <div class="container" style="margin-top:20px;">
      <div class="form-section section-title">
        <h2 class="text-center mb-4">Team Registration</h2>
        <form id="teamForm" novalidate>
          <div class="row mb-3">
            <div class="col-md-4">
              <p style="float: left;">Team Name</p>
              <input type="text" class="form-control" id="teamName" name="team_name"  maxlength="100" required>
              <div id="teamNameError" class="error"></div>
            </div>
            <div class="col-md-4 d-none">
              <label for="collegeName" class="form-label">College Name</label>
              <input type="text" class="form-control" id="collegeName" name="college_name" value="HDC">
              <div id="collegeNameError" class="error"></div>
            </div>
            <div class="col-md-8 d-flex align-items-end justify-content-end mt-2 mt-md-2" id="addMemberBtnDiv">
              <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#addMemberModal"
                id="openAddMemberBtn">
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
    <div class="modal fade" id="addMemberModal" tabindex="-1">
      <div class="modal-dialog modal-xl custom-modal-width">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body ">
            <!-- made this a proper form so reset() works -->
            <form id="memberForm" class="p-3" onsubmit="return false;">
              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Symbol Number</label>
                  <input type="number" class="form-control mb-2" id="mSymbol" placeholder="Symbol No." required>
                  <div id="mSymbolError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Name</label>
                  <input type="text" class="form-control mb-2" id="mName"  maxlength="100" placeholder="Full Name" required>
                  <div id="mNameError" class="error"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Email</label>
                  <input type="email" class="form-control mb-2" id="mEmail" maxlength="255" placeholder="Email" required>
                  <div id="mEmailError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Phone</label>
                  <input type="text" class="form-control mb-2" id="mPhone"  placeholder="Phone" required>
                  <div id="mPhoneError" class="error"></div>
                </div>
              </div>

              <label class="mb-1">College Name</label>
              <input type="text" class="form-control mb-2" id="mCollege" maxlength="100" placeholder="College Name" required>
              <div id="mCollegeError" class="error"></div>




              <div class="row">
                <!-- Photo Upload -->
                <div class="col-6 text-left">
                  <label class="file-label d-block mb-2">Photo Card (max 200KB)</label>
                  <div class="image-upload-container" onclick="document.getElementById('mPhoto').click()">
                    <img id="photoPreview" src="../assets/images/image_preview.png" alt="Upload Photo">
                    <button type="button" class="remove-btn" id="photoRemoveBtn"
                      onclick="removePhotoPreview(event)">&times;</button>
                  </div>
                  <input type="file" id="mPhoto" accept="image/*" required style="display: none;">
                </div>

                <!-- Admit Upload -->
                <div class="col-6 text-left">
                  <label class="file-label d-block mb-2">Admit Card (max 200KB)</label>
                  <div class="image-upload-container" onclick="document.getElementById('mAdmit').click()">
                    <img id="admitPreview" src="../assets/images/image_preview.png" alt="Upload Admit">
                    <button type="button" class="remove-btn" id="admitRemoveBtn"
                      onclick="removeAdmitPreview(event)">&times;</button>
                  </div>
                  <input type="file" id="mAdmit" accept="image/*" required style="display: none;">
                </div>
              </div>

              <div class="text-end mt-3">
                <button type="button" class="btn btn-outline" id="addToListBtn" onclick="addMember()">Add to
                  List</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Loader -->
    <div id="loaderOverlay" style="display: none;">
      <div class="loader-container">
        <div class="spinner-border text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <p class="text-light mt-2">Processing, please wait...</p>
      </div>
    </div>

  </div>

  <!-- Footer -->

  <!-- Footer -->
  <footer id="contact">
    <div class="container">
      <div class="footer-content">
        <div class="footer-about">
          <a href="#" class="footer-logo">HDC<span>Hackathon</span></a>
          <p>The premier hackathon event fostering innovation and collaboration among the brightest minds
            since 2015. Join us in shaping the future of technology.</p>
          <div class="social-links">
            <a href="https://www.facebook.com/share/19VNBxMkFK/" class="social-link"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/hdc.college?igsh=MWV2Z2xwN3czMGdzMg==" class="social-link"><i
                class="fab fa-instagram"></i></a>
            <a href="https://www.linkedin.com/company/himalayacollege/" class="social-link"><i
                class="fab fa-linkedin"></i></a>
            <!-- <a href="#" class="social-link"><i class="fab fa-github"></i></a> -->
            <!-- <a href="#" class="social-link"><i class="fab fa-twitter"></i></a> -->
          </div>
        </div>
        <div class="footer-links">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#features">Features</a></li>
            <li><a href="#guidelines">Guidelines</a></li>
            <li><a href="/registration/register">Register</a></li>
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



  <!-- Scripts -->
  <script>
    // --- Validation patterns & state
    let memberCount = 0;
    const collegePattern = /^[a-zA-Z\s'.-]+$/;
    const namePattern = /^[a-zA-Z\s]+$/;
    const symbolPattern = /^\d{8}$/;
    const phonePattern = /^(98|97)\d{8}$/;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const MAX_FILE_SIZE = 200 * 1024; // 200KB
    const defaultPreviewSrc = "../assets/images/image_preview.png";

    // --- Simple realtime validation messages
    document.getElementById("teamName").addEventListener("input", function () {
      document.getElementById("teamNameError").textContent = namePattern.test(this.value) ? "" : "Only letters and spaces allowed.";
    });
    document.getElementById("mCollege").addEventListener("input", function () {
      document.getElementById("mCollegeError").textContent = collegePattern.test(this.value) ? "" : "Invalid college name.";
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

    // Backend duplicate check for team name (keeps original logic)
    document.getElementById("teamName").addEventListener("input", async function () {
      const teamName = this.value.trim();
      const errorElement = document.getElementById("teamNameError");

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
          errorElement.textContent = "";
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

    // Preview functions with size check
    function previewPhoto(event) {
      const file = event.target.files ? event.target.files[0] : null;
      const preview = document.getElementById("photoPreview");
      const removeBtn = document.getElementById("photoRemoveBtn");

      if (!file) {
        preview.src = defaultPreviewSrc;
        removeBtn.style.display = "none";
        return;
      }

      if (!file.type.startsWith("image/")) {
        Swal.fire("Invalid file", "Please upload an image file.", "error");
        event.target.value = "";
        return;
      }

      if (file.size > MAX_FILE_SIZE) {
        Swal.fire("File Too Large", "Photo must be ≤ 200KB.", "warning");
        event.target.value = "";
        preview.src = defaultPreviewSrc;
        removeBtn.style.display = "none";
        return;
      }

      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        removeBtn.style.display = "block";
      };
      reader.readAsDataURL(file);
    }

    function removePhotoPreview(e) {
      e.stopPropagation(); // Prevent container click
      const input = document.getElementById("mPhoto");
      const preview = document.getElementById("photoPreview");
      const removeBtn = document.getElementById("photoRemoveBtn");

      input.value = "";
      preview.src = defaultPreviewSrc;
      removeBtn.style.display = "none";
    }

    function previewAdmit(event) {
      const file = event.target.files ? event.target.files[0] : null;
      const preview = document.getElementById("admitPreview");
      const removeBtn = document.getElementById("admitRemoveBtn");

      if (!file) {
        preview.src = defaultPreviewSrc;
        removeBtn.style.display = "none";
        return;
      }

      if (!file.type.startsWith("image/")) {
        Swal.fire("Invalid file", "Please upload an image file.", "error");
        event.target.value = "";
        return;
      }

      if (file.size > MAX_FILE_SIZE) {
        Swal.fire("File Too Large", "Admit card must be ≤ 200KB.", "warning");
        event.target.value = "";
        preview.src = defaultPreviewSrc;
        removeBtn.style.display = "none";
        return;
      }

      const reader = new FileReader();
      reader.onload = function (e) {
        preview.src = e.target.result;
        removeBtn.style.display = "block";
      };
      reader.readAsDataURL(file);
    }

    function removeAdmitPreview(e) {
      e.stopPropagation();
      const input = document.getElementById("mAdmit");
      const preview = document.getElementById("admitPreview");
      const removeBtn = document.getElementById("admitRemoveBtn");

      input.value = "";
      preview.src = defaultPreviewSrc;
      removeBtn.style.display = "none";
    }

    // Attach change listeners for the hidden file inputs
    document.getElementById("mPhoto").addEventListener("change", previewPhoto);
    document.getElementById("mAdmit").addEventListener("change", previewAdmit);

    // Utility to create FileList from a File
    function createFileList(file) {
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      return dataTransfer.files;
    }

    // Add member to table
    function addMember() {
      if (memberCount >= 4) {
        Swal.fire("Limit reached", "A team can have a maximum of 4 members.", "info");
        return;
      }

      const symbol = document.getElementById("mSymbol").value.trim();
      const name = document.getElementById("mName").value.trim();
      const email = document.getElementById("mEmail").value.trim();
      const phone = document.getElementById("mPhone").value.trim();
      const college = document.getElementById("mCollege").value.trim();
      const photoFile = document.getElementById("mPhoto").files[0];
      const admitFile = document.getElementById("mAdmit").files[0];

      if (!symbolPattern.test(symbol) || !namePattern.test(name) || !emailPattern.test(email) ||
        !phonePattern.test(phone) || !collegePattern.test(college) || !photoFile || !admitFile) {
        Swal.fire("Error", "Please correct all input fields.", "error");
        return;
      }

      if (photoFile.size > MAX_FILE_SIZE || admitFile.size > MAX_FILE_SIZE) {
        Swal.fire("File Too Large", "Each image must be ≤ 200KB.", "warning");
        return;
      }

      // read both files and then insert row
      const readerPhoto = new FileReader();
      const readerAdmit = new FileReader();

      readerPhoto.onload = function (e1) {
        readerAdmit.onload = function (e2) {
          memberCount++;

          const table = document.getElementById("memberTable").querySelector("tbody");
          const row = document.createElement("tr");

          // Use index starting at 0 for file names so they match later iteration
          const idx = memberCount - 1;

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
              <input type="file" name="photo_${idx}" style="display:none;" />
              <input type="file" name="admit_${idx}" style="display:none;" />
              <button class="btn btn-danger btn-sm" onclick="removeMember(this)">Remove</button>
            </td>
          `;

          table.appendChild(row);

          // assign file objects to the hidden inputs
          const photoInputHidden = row.querySelector(`input[name="photo_${idx}"]`);
          const admitInputHidden = row.querySelector(`input[name="admit_${idx}"]`);
          if (photoInputHidden) photoInputHidden.files = createFileList(photoFile);
          if (admitInputHidden) admitInputHidden.files = createFileList(admitFile);

          // reset the modal form (works because memberForm is a form)
          const memberFormEl = document.getElementById("memberForm");
          if (memberFormEl && typeof memberFormEl.reset === "function") {
            memberFormEl.reset();
          }

          // reset previews to default
          document.getElementById("photoPreview").src = defaultPreviewSrc;
          document.getElementById("photoRemoveBtn").style.display = "none";
          document.getElementById("admitPreview").src = defaultPreviewSrc;
          document.getElementById("admitRemoveBtn").style.display = "none";

          // hide the modal safely (use getOrCreateInstance)
          const modalEl = document.getElementById('addMemberModal');
          if (typeof bootstrap !== "undefined" && bootstrap.Modal) {
            bootstrap.Modal.getOrCreateInstance(modalEl).hide();
          } else {
            // fallback: try to trigger modal hide via dispatched event
            modalEl.classList.remove("show");
            modalEl.style.display = "none";
            document.body.classList.remove("modal-open");
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) backdrop.remove();
          }

          // toggle register button when we have 4 members
          document.getElementById("registerbtn").style.display = (memberCount === 4) ? "inline-block" : "none";

          checkMemberLimit();
        };
        readerAdmit.readAsDataURL(admitFile);
      };
      readerPhoto.readAsDataURL(photoFile);
    }



    // Remove a member row
    function removeMember(button) {
      const tr = button.closest("tr");
      if (!tr) return;
      tr.remove();
      memberCount--;
      const rows = document.querySelectorAll("#memberTable tbody tr");
      rows.forEach((row, i) => row.firstElementChild.textContent = i + 1);

      if (memberCount < 4) {
        document.getElementById("registerbtn").style.display = "none";
      }
      checkMemberLimit();
    }

    // teamForm file safety: ensure any file inputs (hidden) are <= 200KB (extra guard)
    document.getElementById("teamForm").addEventListener("change", function (e) {
      const target = e.target;
      if (target && target.type === "file" && target.files && target.files[0]) {
        if (target.files[0].size > MAX_FILE_SIZE) {
          Swal.fire("File Too Large", "Each image must be less than or equal to 200KB.", "warning");
          target.value = "";
        }
      }
    });

    // Submit team form
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
            checkMemberLimit();
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

    // for toggle
    //     document.getElementById('mobileToggle').addEventListener('click', function () {
    //   document.getElementById('mobileMenu').classList.toggle('active');
    // });

    const mobileToggle = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    // Toggle menu on button click
    mobileToggle.addEventListener('click', (e) => {
      e.stopPropagation(); // prevent closing when clicking toggle itself
      mobileToggle.classList.toggle('active');
      mobileMenu.classList.toggle('active');
    });

    // Close menu when clicking a menu link
    document.querySelectorAll('.mobile-menu a').forEach(link => {
      link.addEventListener('click', () => {
        mobileToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
      });
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        mobileToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
      }
    });
    document.querySelectorAll('.mobile-menu a').forEach(link => {
      link.addEventListener('click', () => {
        mobileToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
      });
    });

    document.addEventListener('click', (e) => {
      if (!mobileMenu.contains(e.target) && !mobileToggle.contains(e.target)) {
        mobileToggle.classList.remove('active');
        mobileMenu.classList.remove('active');
      }
    });




  </script>

  <!-- Bootstrap JS (keep at the end so bootstrap is available for modal operations) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>