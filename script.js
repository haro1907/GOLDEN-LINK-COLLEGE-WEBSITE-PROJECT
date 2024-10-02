// Validation for login form
function validateForm() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var errorMessage = document.getElementById("error-message");

    if (username === "" || password === "") {
        errorMessage.textContent = "Username and Password are required.";
        return false;
    }

    if (password.length < 6) {
        errorMessage.textContent = "Password must be at least 6 characters long.";
        return false;
    }

    return true;
}

// Validation for registration form
function validateRegistration() {
    var username = document.getElementById("reg-username").value;
    var password = document.getElementById("reg-password").value;
    var confirmPassword = document.getElementById("confirm-password").value;
    var errorMessage = document.getElementById("reg-error-message");

    if (username === "" || password === "" || confirmPassword === "") {
        errorMessage.textContent = "All fields are required.";
        return false;
    }

    if (password.length < 6) {
        errorMessage.textContent = "Password must be at least 6 characters long.";
        return false;
    }

    if (password !== confirmPassword) {
        errorMessage.textContent = "Passwords do not match.";
        return false;
    }

    return true;
}
