function validateForm() {
    // Retrieve the form inputs
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;


    // Regular expression patterns
    var fnamePattern = /^[a-zA-Z ]+$/; // Only alphabets and spaces allowed
    var lnamePattern = /^[a-zA-Z ]+$/; // Alphabets, numbers, spaces, and common address characters allowed
      // Exactly 10 digits allowed
     var passwordPattern = /^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,}$/;
      ; 

    // Validate Full Name
    if (!fnamePattern.test(fname)) {
        alert('Please enter a valid First Name');
        return false;
    }

    // Validate Address
    if (!lnamePattern.test(lname)) {
        alert('Please enter a valid Last Name');
        return false;
    }

    // Validate Contact Number
    if (!emailPattern.test(email)) {
        alert('Please enter a valid Email');
        return false;
    }

    //Validate Password
    if (!passwordPattern.test(password)) {
        alert('Password must contain at least 8 - 20 characters, including lowercase letters, uppercase letters, numbers, and special characters');
        return false;
    }

    // Confirm if Passwords Match
    if (userPass !== confirmPass) {
        alert('Passwords do not match');
        return false;
    }

    return true; // Allow form submission
}