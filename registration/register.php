<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HDC Hackathon Registration</title>
  <link rel="icon" href="../assets/images/hackathon.png" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root {
      --theme-color: #104594;
    }

    body {
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
    }

    .form-section {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px #00000020;
      margin-top: 30px;
    }

    footer {
      background-color: var(--theme-color);
      color: #fff;
      text-align: center;
      padding: 15px 0;
      margin-top: 60px;
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
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">HDC Hackathon 2025</a>
    </div>
  </nav>

  <!-- Registration Form -->
  <div class="container">
    <div class="form-section">
      <h2 class="text-center mb-4">Team Registration</h2>
      <form id="teamForm">
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="teamName" class="form-label">Team Name</label>
            <input type="text" class="form-control" id="teamName" name="team_name" required>
            <div id="teamNameError" class="error"></div>
          </div>
          <div class="col-md-4">
            <label for="collegeName" class="form-label">College Name</label>
            <input type="text" class="form-control" id="collegeName" name="college_name" required>
            <div id="collegeNameError" class="error"></div>
          </div>
          <div class="col-md-4 d-flex align-items-end justify-content-end mt-2 mt-md-2" id="addMemberBtnDiv">
            <button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#addMemberModal">
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
                <th>Uploads & Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" class="btn btn-success" id="registerbtn" style="display: none;">Register Team</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal for Adding Members -->
  <div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="memberForm">
            <input type="number" class="form-control mb-2" id="mSymbol" placeholder="Symbol No." required>
            <div id="mSymbolError" class="error"></div>
            <input type="text" class="form-control mb-2" id="mName" placeholder="Full Name" required>
            <div id="mNameError" class="error"></div>
            <input type="email" class="form-control mb-2" id="mEmail" placeholder="Email" required>
            <div id="mEmailError" class="error"></div>
            <input type="text" class="form-control mb-2" id="mPhone" placeholder="Phone" required>
            <div id="mPhoneError" class="error"></div>
            <div class="text-end">
              <button type="button" class="btn btn-theme" onclick="addMember()">Add to List</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <small>&copy; 2025 HDC Hackathon Committee. All rights reserved.</small>
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
    document.getElementById("teamName").addEventListener("input", async function (params) {
      const teamName = this.value.trim();
      const errorElement = document.getElementById("teamNameError");


      // Don't send request if input is empty
      if (teamName.length === 0) {
        errorElement.textContent = "";
        errorElement.style.color = ""; // reset color 

        return;
      }

      try {
        let response = await fetch(`submit.php?team_Name=${encodeURIComponent(teamName)}`)
        let data = await response.json()
        if (data.exists) {
          errorElement.textContent = "Team name already exists.";
          errorElement.style.color = "red"; // red for error
        } else {
          errorElement.textContent = "Team name is available.";
          errorElement.style.color = "green"; // green for available
        }
      } catch (error) {
        console.error("Error checking team name:", error);
      }
    });




    // //to check the memeber limit
    // function checkMemberLimit() {
    //   const addBtnDiv = document.getElementById("addMemberBtnDiv");
    //   if (memberCount >= 4) {
    //     addBtnDiv.style.display = "none";
    //   } else {
    //     addBtnDiv.style.display = "flex";
    //   }
    // }

    function checkMemberLimit() {
      const addBtn = document.querySelector("#addMemberBtnDiv button");
      addBtn.disabled = (memberCount >= 4); // disable at 4 members
    }



    function addMember() {

      if (memberCount >= 4) {
        // Swal.fire("Limit Reached", "You can only add up to 4 members.", "warning");
        return;
      }
      const symbol = document.getElementById("mSymbol").value.trim();
      const name = document.getElementById("mName").value.trim();
      const email = document.getElementById("mEmail").value.trim();
      const phone = document.getElementById("mPhone").value.trim();

      if (!symbolPattern.test(symbol) || !namePattern.test(name) || !emailPattern.test(email) || !phonePattern.test(phone)) {
        Swal.fire("Error", "Please correct the input fields.", "error");
        return;
      }



      memberCount++;
      const table = document.getElementById("memberTable").querySelector("tbody");

      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${memberCount}</td>
        <td>${symbol}</td>
        <td>${name}</td>
        <td>${email}</td>
        <td>${phone}</td>
        <td>
          <label>Photo Card</label>
          <input type="file" name="photo_${memberCount - 1}" class="form-control mb-1 photo-input" required />
          <img class="preview photo-preview" style="display:none;" />
          <label>Admit Card</label>
          <input type="file" name="admit_${memberCount - 1}" class="form-control mb-1 admit-input" required />
          <img class="preview admit-preview" style="display:none;" />
          <button class="btn btn-danger btn-sm mt-1" onclick="removeMember(this)">Remove</button>
        </td>
      `;

      table.appendChild(row);

      document.getElementById("memberForm").reset();
      bootstrap.Modal.getInstance(document.getElementById('addMemberModal')).hide();

      if (memberCount === 4) {
        document.getElementById("registerbtn").style.display = "inline-block";

      }

      checkMemberLimit(); // Add this line
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

        members.push({ symbol, name, email, phone });

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