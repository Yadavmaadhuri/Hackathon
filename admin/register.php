<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hackathon Registration</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="../assets/images/hackathon.png"/>

</head>
<body>
<form id="teamForm" enctype="multipart/form-data">
    <h2>Team Registration</h2>
    <label>Team Name: <input type="text" id="teamName" name="team_name" required></label>
    <span id="teamNameError" class="error-inline"></span><br><br>
    <label>College Name: <input type="text" id="collegeName" name="college_name" required></label>
    <span id="collegeNameError" class="error-inline"></span>
    <button type="button" onclick="openForm()">Add Member</button>

    <table id="memberTable">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

    <br><br>
    <button type="submit" id="registerbtn" disabled>Register Team</button>
</form>

<div id="overlay" onclick="closeForm()"></div>
<div class="popup" id="memberForm">
    <button class="close-btn" onclick="closeForm()">×</button>
    <h3>Add Member <span id="memberCountLabel"></span></h3>
    <span id="memberGeneralError" class="error"></span>
    <input type="text" id="mName" placeholder="Name" required>
    <span id="mNameError" class="error"></span>
    <input type="email" id="mEmail" placeholder="Email" required>
    <span id="mEmailError" class="error"></span>
    <input type="text" id="mPhone" placeholder="Phone" required>
    <span id="mPhoneError" class="error"></span>
    <input type="file" id="mPhoto" required>
    <span id="mPhotoError" class="error"></span>
    <input type="file" id="mAdmit" required>
    <span id="mAdmitError" class="error"></span>

    <button type="button" onclick="submitMember()">Add Member</button>
</div>

<script>
    let memberCount = 0;
    const uploadedPhotos = [];
    const uploadedAdmits = [];
    // Changed to MAX_PHOTO_SIZE_BYTES as per clarification (<= 200KB)
    const MAX_PHOTO_SIZE_BYTES = 200 * 1024; // 200 KB in bytes

    // Function to clear inline errors for team and college name
    function clearTeamCollegeErrors() {
        document.getElementById("teamNameError").textContent = "";
        document.getElementById("collegeNameError").textContent = "";
    }

    // Function to show inline error for a specific input field (used for main form)
    function showInlineError(elementId, message) {
        const errorSpan = document.getElementById(elementId + "Error");
        if (errorSpan) {
            errorSpan.textContent = message;
        }
    }

    // Function to show error for a specific input field (used for popup)
    function showError(inputId, message) {
        const errorSpan = document.getElementById(inputId + "Error");
        if (errorSpan) {
            errorSpan.textContent = message;
        }
    }

    // Function to clear error for a specific input field (used for popup)
    function clearError(inputId) {
        const errorSpan = document.getElementById(inputId + "Error");
        if (errorSpan) {
            errorSpan.textContent = "";
        }
    }

    // Function to clear all errors within the member popup
    function clearMemberPopupErrors() {
        // Clear general member error
        document.getElementById("memberGeneralError").textContent = "";
        // Clear individual input errors
        ["mName", "mEmail", "mPhone", "mPhoto", "mAdmit"].forEach(id => {
            clearError(id);
        });
    }

    function openForm() {
        clearTeamCollegeErrors(); // Clear previous errors when opening form

        const teamName = document.getElementById("teamName").value.trim();
        const collegeName = document.getElementById("collegeName").value.trim();

        const teamValid = /^[A-Za-z0-9\s]+$/.test(teamName);
        const collegeValid = /^[A-Za-z\s]+$/.test(collegeName);

        let formValid = true;

        if (!teamName) {
            showInlineError("teamName", "Team Name is required.");
            formValid = false;
        } else if (!teamValid) {
            showInlineError("teamName", "Team Name should only contain letters, numbers, and spaces.");
            formValid = false;
        }

        if (!collegeName) {
            showInlineError("collegeName", "College Name is required.");
            formValid = false;
        } else if (!collegeValid) {
            showInlineError("collegeName", "College Name should only contain letters and spaces.");
            formValid = false;
        }

        if (!formValid) {
            // Don't open the member form if team/college details are invalid
            return;
        }

        if (memberCount >= 4) {
            Swal.fire({
                icon: 'info',
                title: 'Limit Reached',
                text: 'You can only add up to 4 members.'
            });
            return;
        }

        document.getElementById("overlay").style.display = "block";
        document.getElementById("memberForm").style.display = "block";
        document.getElementById("memberCountLabel").innerText = memberCount + 1;
        // Clear popup inputs and errors when opening
        ["mName", "mEmail", "mPhone", "mPhoto", "mAdmit"].forEach(id => {
            document.getElementById(id).value = '';
        });
        clearMemberPopupErrors(); // Clear all errors within the member popup
    }

    function closeForm() {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("memberForm").style.display = "none";

        ["mName", "mEmail", "mPhone", "mPhoto", "mAdmit"].forEach(id => {
            document.getElementById(id).value = '';
        });

        clearMemberPopupErrors(); // Clear all errors within the member popup
    }

    function isEmailUnique(email) {
        const tableRows = document.querySelectorAll("#memberTable tbody tr");
        let isUnique = true;
        tableRows.forEach(row => {
            if (row.cells[2].innerText.toLowerCase() === email.toLowerCase()) {
                isUnique = false;
            }
        });
        return isUnique;
    }

    // Function to check if a team name already exists (placeholder for server-side check)
    // In a real-world scenario, you'd make an AJAX call to your backend here.
    async function isTeamNameTaken(teamName) {
        // Simulate a server check. Replace with actual fetch to your backend.
        // For demonstration, let's say "DreamTeam" is already taken.
        const takenTeamNames = ["DreamTeam", "AlphaSquad", "CodeMasters"];
        return new Promise(resolve => {
            setTimeout(() => { // Simulate network delay
                resolve(takenTeamNames.includes(teamName));
            }, 300);
        });
    }

    // Function to check if a phone number is already taken (placeholder for server-side check)
    // In a real-world scenario, you'd make an AJAX call to your backend here.
    async function isPhoneNumberTaken(phone) {
        // Simulate a server check. Replace with actual fetch to your backend.
        // For demonstration, let's say "9812345678" is taken.
        const takenPhoneNumbers = ["9812345678", "9700011223"];
        return new Promise(resolve => {
            setTimeout(() => { // Simulate network delay
                resolve(takenPhoneNumbers.includes(phone));
            }, 300);
        });
    }

    async function submitMember() {
        const name = document.getElementById("mName").value.trim();
        const email = document.getElementById("mEmail").value.trim();
        const phone = document.getElementById("mPhone").value.trim();
        const photo = document.getElementById("mPhoto").files[0];
        const admit = document.getElementById("mAdmit").files[0];

        clearMemberPopupErrors(); // Clear all popup errors at the start of validation

        let valid = true;

        // Check if all fields are empty
        if (!name && !email && !phone && !photo && !admit) {
            showError("memberGeneralError", "Please enter all member details.");
            valid = false;
        }

        if (!name) {
            showError("mName", "Name is required.");
            valid = false;
        } else if (!/^[A-Za-z\s]+$/.test(name)) {
            showError("mName", "Name should contain only letters and spaces.");
            valid = false;
        }

        if (!email) {
            showError("mEmail", "Email is required.");
            valid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError("mEmail", "Enter a valid email address.");
            valid = false;
        } else if (!isEmailUnique(email)) { // Client-side check for uniqueness within added members
            showError("mEmail", "This email is already added for another member.");
            valid = false;
        }

        if (!phone) {
            showError("mPhone", "Phone number is required.");
            valid = false;
        } else if (!/^(97|98)\d{8}$/.test(phone)) {
            showError("mPhone", "Phone must be 10 digits and start with 97 or 98.");
            valid = false;
        } else if (await isPhoneNumberTaken(phone)) { // Server-side check for phone number uniqueness
            showError("mPhone", "This phone number is already registered.");
            valid = false;
        }

        if (!photo) {
            showError("mPhoto", "Please select a photo.");
            valid = false;
        } else if (!photo.type.startsWith("image/")) {
            showError("mPhoto", "Photo must be an image.");
            valid = false;
        } else if (photo.size > MAX_PHOTO_SIZE_BYTES) { // Changed to <=
            showError("mPhoto", `Photo must be ${MAX_PHOTO_SIZE_BYTES / 1024}KB or less.`);
            valid = false;
        }

        if (!admit) {
            showError("mAdmit", "Please select an admit card image.");
            valid = false;
        } else if (!admit.type.startsWith("image/")) {
            showError("mAdmit", "Admit card must be an image.");
            valid = false;
        } else if (admit.size > MAX_PHOTO_SIZE_BYTES) { // Changed to <=
            showError("mAdmit", `Admit card must be ${MAX_PHOTO_SIZE_BYTES / 1024}KB or less.`);
            valid = false;
        }

        if (!valid) return; // If any validation fails, stop here

        // If all validations pass, proceed to add member
        uploadedPhotos.push(photo);
        uploadedAdmits.push(admit);

        const table = document.querySelector("#memberTable tbody");
        const row = table.insertRow();
        row.innerHTML = `
            <td>${memberCount + 1}</td>
            <td>${name}</td>
            <td>${email}</td>
            <td>${phone}</td>
            <td><button type="button" onclick="removeMember(this)">Remove</button></td>
        `;

        memberCount++;
        closeForm();
        updateRegisterButton();
    }

    function removeMember(btn) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to remove this member?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const row = btn.closest("tr");
                const index = row.rowIndex - 1;
                row.remove();
                uploadedPhotos.splice(index, 1);
                uploadedAdmits.splice(index, 1);
                memberCount--;
                updateRegisterButton();

                // Re-index S.No column
                const rows = document.querySelectorAll("#memberTable tbody tr");
                rows.forEach((r, idx) => {
                    r.cells[0].innerText = idx + 1;
                });

                Swal.fire('Removed!', 'The member has been removed.', 'success');
            }
        });
    }

    function updateRegisterButton() {
        // Register button is enabled only if exactly 4 members are added
        document.getElementById("registerbtn").disabled = memberCount !== 4;
    }

    document.getElementById("teamForm").addEventListener("submit", async function (e) {
        e.preventDefault();

        // Re-run team/college validation on submit, just in case
        clearTeamCollegeErrors();
        const teamNameInput = document.getElementById("teamName");
        const collegeNameInput = document.getElementById("collegeName");
        const teamName = teamNameInput.value.trim();
        const collegeName = collegeNameInput.value.trim();

        const teamValid = /^[A-Za-z0-9\s]+$/.test(teamName);
        const collegeValid = /^[A-Za-z\s]+$/.test(collegeName);
        let submitFormValid = true;

        if (!teamName) {
            showInlineError("teamName", "Team Name is required.");
            submitFormValid = false;
        } else if (!teamValid) {
            showInlineError("teamName", "Team Name should only contain letters, numbers, and spaces.");
            submitFormValid = false;
        } else if (await isTeamNameTaken(teamName)) { // Server-side check for team name uniqueness
            showInlineError("teamName", "This team name is already taken.");
            submitFormValid = false;
        }

        if (!collegeName) {
            showInlineError("collegeName", "College Name is required.");
            submitFormValid = false;
        } else if (!collegeValid) {
            showInlineError("collegeName", "College Name should only contain letters and spaces.");
            submitFormValid = false;
        }

        if (!submitFormValid) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fix the errors in Team Name and College Name before submitting.'
            });
            return;
        }

        if (memberCount !== 4) {
            Swal.fire({
                icon: 'error',
                title: 'Registration Error',
                text: 'You must add exactly 4 members to register your team.'
            });
            return;
        }

        // Check for any currently displayed errors from the member popup or main form
        const allErrorSpans = document.querySelectorAll(".error, .error-inline");
        let hasVisibleErrors = false;
        for (const span of allErrorSpans) {
            if (span.textContent.trim() !== "") {
                hasVisibleErrors = true;
                break;
            }
        }

        if (hasVisibleErrors) {
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please correct all highlighted errors before submitting the form.'
            });
            return;
        }

        const formData = new FormData();
        formData.append("team_name", teamName);
        formData.append("college_name", collegeName);

        const rows = document.querySelectorAll("#memberTable tbody tr");
        rows.forEach((row, index) => {
            formData.append("member_name[]", row.cells[1].innerText);
            formData.append("email[]", row.cells[2].innerText);
            formData.append("phone[]", row.cells[3].innerText);
            formData.append("photo[]", uploadedPhotos[index]);
            formData.append("admit_card[]", uploadedAdmits[index]);
        });

        // Simulating a server-side submission (replace with your actual submit.php)
        try {
            const response = await fetch("submit.php", {
                method: "POST",
                body: formData
            });

            if (!response.ok) {
                const text = await response.text();
                throw new Error(text);
            }
            const responseText = await response.text();
            Swal.fire("Success", responseText, "success");
            // Optional: reset the form manually
            document.getElementById("teamForm").reset();
            document.querySelector("#memberTable tbody").innerHTML = '';
            uploadedPhotos.length = 0;
            uploadedAdmits.length = 0;
            memberCount = 0;
            updateRegisterButton();
        } catch (err) {
            console.error(err);
            Swal.fire("Error", "Error submitting form: " + err.message, "error");
        }
    });

    // Real-time validation listeners for member popup fields
    document.getElementById("mName").addEventListener("input", function () {
        const val = this.value.trim();
        if (!val) {
            showError("mName", "Name is required.");
        } else if (!/^[A-Za-z\s]+$/.test(val)) {
            showError("mName", "Name should contain only letters and spaces.");
        } else {
            clearError("mName");
        }
        document.getElementById("memberGeneralError").textContent = ""; // Clear general error
    });

    document.getElementById("mEmail").addEventListener("input", function () {
        const val = this.value.trim();
        if (!val) {
            showError("mEmail", "Email is required.");
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
            showError("mEmail", "Enter a valid email address.");
        } else if (!isEmailUnique(val)) {
            showError("mEmail", "This email is already added for another member.");
        } else {
            clearError("mEmail");
        }
        document.getElementById("memberGeneralError").textContent = ""; // Clear general error
    });

    document.getElementById("mPhone").addEventListener("input", async function () { // Added async
        const val = this.value.trim();
        if (!val) {
            showError("mPhone", "Phone number is required.");
        } else if (!/^(97|98)\d{8}$/.test(val)) {
            showError("mPhone", "Phone must be 10 digits and start with 97 or 98.");
        } else if (await isPhoneNumberTaken(val)) { // Call async function
            showError("mPhone", "This phone number is already registered.");
        } else {
            clearError("mPhone");
        }
        document.getElementById("memberGeneralError").textContent = ""; // Clear general error
    });

    document.getElementById("mPhoto").addEventListener("change", function () {
        const file = this.files[0];
        if (!file) {
            showError("mPhoto", "Please select a photo.");
        } else if (!file.type.startsWith("image/")) {
            showError("mPhoto", "Photo must be an image.");
        } else if (file.size > MAX_PHOTO_SIZE_BYTES) { // Changed to >
            showError("mPhoto", `Photo must be ${MAX_PHOTO_SIZE_BYTES / 1024}KB or less.`);
        } else {
            clearError("mPhoto");
        }
        document.getElementById("memberGeneralError").textContent = ""; // Clear general error
    });

    document.getElementById("mAdmit").addEventListener("change", function () {
        const file = this.files[0];
        if (!file) {
            showError("mAdmit", "Please select an admit card image.");
        } else if (!file.type.startsWith("image/")) {
            showError("mAdmit", "Admit card must be an image.");
        } else if (file.size > MAX_PHOTO_SIZE_BYTES) { // Changed to >
            showError("mAdmit", `Admit card must be ${MAX_PHOTO_SIZE_BYTES / 1024}KB or less.`);
        } else {
            clearError("mAdmit");
        }
        document.getElementById("memberGeneralError").textContent = ""; // Clear general error
    });

    // Initial update of register button state
    updateRegisterButton();

    // Real-time validation for team name and college name (already existing, kept for completeness)
    document.getElementById("teamName").addEventListener("input", async function() { // Added async
        const val = this.value.trim();
        if (!val) {
            showInlineError("teamName", "Team Name is required.");
        } else if (!/^[A-Za-z0-9\s]+$/.test(val)) {
            showInlineError("teamName", "Team Name should only contain letters, numbers, and spaces.");
        } else if (await isTeamNameTaken(val)) { // Call async function
            showInlineError("teamName", "This team name is already taken.");
        }
        else {
            showInlineError("teamName", ""); // Clear error
        }
    });

    document.getElementById("collegeName").addEventListener("input", function () {
        const val = this.value.trim();
        if (!val) {
            showInlineError("collegeName", "College Name is required.");
        } else if (!/^[A-Za-z\s]+$/.test(val)) {
            showInlineError("collegeName", "College Name should only contain letters and spaces.");
        } else {
            showInlineError("collegeName", ""); // Clear error
        }
    });
</script>
</body>
</html>