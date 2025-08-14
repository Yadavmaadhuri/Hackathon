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

  <link rel="stylesheet" href="../assets/css/register.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
              <p class="mb-sm-2" style="float: left;">Team Name</p>
              <input type="text" class="form-control" id="teamName" name="team_name" maxlength="100" required>
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
                  <label class="mb-1">+2 Symbol No.</label>
                  <input type="number" class="form-control mb-2" id="mSymbol" placeholder="+2 Symbol No." required>
                  <div id="mSymbolError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Name</label>
                  <input type="text" class="form-control mb-2" id="mName" maxlength="100" placeholder="Full Name"
                    required>
                  <div id="mNameError" class="error"></div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <label class="mb-1">Email</label>
                  <input type="email" class="form-control mb-2" id="mEmail" maxlength="255" placeholder="Email"
                    required>
                  <div id="mEmailError" class="error"></div>
                </div>

                <div class="col-6">
                  <label class="mb-1">Phone</label>
                  <input type="text" class="form-control mb-2" id="mPhone" placeholder="Phone" maxlength="10"
                    pattern="(98|97)\d{8}" required>
                  <div id="mPhoneError" class="error"></div>
                </div>
              </div>

              <label class="mb-1">College Name</label>
              <input type="text" class="form-control mb-2" id="mCollege" maxlength="100" placeholder="College Name"
                required>
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

      if (!namePattern.test(teamName)) {
        errorElement.textContent = "Only letters and spaces allowed.";
        errorElement.style.color = "red";
        return;
      }

      if (teamName.length === 0) {
        errorElement.textContent = "Only letters and spaces allowed.";
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

    // Backend duplicate check for symbol number
    document.getElementById("mSymbol").addEventListener("input", async function () {
      const symbol = this.value.trim();
      const errorElement = document.getElementById("mSymbolError");

      if (!symbolPattern.test(symbol)) {
        errorElement.textContent = "Must be 8 digits.";
        errorElement.style.color = "red";
        return;
      }

      try {
        let response = await fetch(`submit.php?symbol=${encodeURIComponent(symbol)}`);
        let data = await response.json();
        if (data.exists) {
          errorElement.textContent = "Symbol number already registered.";
          errorElement.style.color = "red";
        } else {
          errorElement.textContent = "";
          errorElement.style.color = "";
        }
      } catch (error) {
        console.error("Error checking symbol:", error);
      }
    });

    // Backend duplicate check for email
    document.getElementById("mEmail").addEventListener("input", async function () {
      const email = this.value.trim();
      const errorElement = document.getElementById("mEmailError");

      if (!emailPattern.test(email)) {
        errorElement.textContent = "Invalid email format.";
        errorElement.style.color = "red";
        return;
      }

      try {
        let response = await fetch(`submit.php?email=${encodeURIComponent(email)}`);
        let data = await response.json();
        if (data.exists) {
          errorElement.textContent = "Email already registered.";
          errorElement.style.color = "red";
        } else {
          errorElement.textContent = "";
          errorElement.style.color = "";
        }
      } catch (error) {
        console.error("Error checking email:", error);
      }
    });

    // Backend duplicate check for phone
    document.getElementById("mPhone").addEventListener("input", async function () {
      const phone = this.value.trim();
      const errorElement = document.getElementById("mPhoneError");

      if (!phonePattern.test(phone)) {
        errorElement.textContent = "Invalid phone format.";
        errorElement.style.color = "red";
        return;
      }

      try {
        let response = await fetch(`submit.php?phone=${encodeURIComponent(phone)}`);
        let data = await response.json();
        if (data.exists) {
          errorElement.textContent = "Phone number already registered.";
          errorElement.style.color = "red";
        } else {
          errorElement.textContent = "";
          errorElement.style.color = "";
        }
      } catch (error) {
        console.error("Error checking phone:", error);
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


    function normalizePhone(p) {
      if (p == null) return "";
      return String(p).replace(/\D/g, "");
    }

    // Add member to table
    function addMember() {
      if (memberCount >= 4) {
        Swal.fire("Limit reached", "A team can have a maximum of 4 members.", "info");
        return;
      }

      // Check if any validation errors exist
      const errorIds = [
        "mSymbolError",
        "mNameError",
        "mEmailError",
        "mPhoneError",
        "mCollegeError"
      ];
      const hasErrors = errorIds.some(id => {
        const errEl = document.getElementById(id);
        return errEl && errEl.textContent.trim() !== "";
      });

      if (hasErrors) {
        Swal.fire("Error", "Please fix all errors before adding the member.", "error");
        return;
      }

      const symbol = document.getElementById("mSymbol").value.trim();
      const name = document.getElementById("mName").value.trim();
      const email = document.getElementById("mEmail").value.trim();
      const phone = document.getElementById("mPhone").value.trim();
      const college = document.getElementById("mCollege").value.trim();
      const photoFile = document.getElementById("mPhoto").files[0];
      const admitFile = document.getElementById("mAdmit").files[0];

      // 🚫 Check for empty required fields
      if (!symbol || !name || !email || !phone || !college || !photoFile || !admitFile) {
        Swal.fire("Error", "All fields and files are required.", "error");
        return;
      }
      // 🔍 Check duplicates in table before adding
      const table = document.getElementById("memberTable");
      for (let i = 1; i < table.rows.length; i++) { // skip header
        // inside duplicate check loop:
        const existingSymbol = table.rows[i].cells[1].textContent.trim().toLowerCase(); // Symbol No.
        const existingEmail = table.rows[i].cells[3].textContent.trim().toLowerCase(); // Email
        const existingPhone = normalizePhone(table.rows[i].cells[4].textContent.trim()); // Phone


        if (symbol === existingSymbol) {
          Swal.fire("Duplicate Symbol", "A member with this symbol already exists.", "error");
          return;
        }
        if (email === existingEmail) {
          Swal.fire("Duplicate Email", "A member with this email already exists.", "error");
          return;
        }
        if (phone === existingPhone) {
          Swal.fire("Duplicate Phone", "A member with this phone already exists.", "error");
          return;
        }
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