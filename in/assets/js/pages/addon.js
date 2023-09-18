function url_action(preurl, action_name, id, value) {
    preurl += 'in/actions/'
    switch (action_name) {
        case 'enable':
            url_enable(preurl, id)
            break;

        case 'disable':
            url_disable(preurl, id)
            break;

        case 'delete':
            url_delete(preurl, id)
            break;

        case 'change_validity':
            url_change_validity(preurl, id, value);
            break;
    }
}

function url_enable(preurl, id) {
    var data = { 'id': id };
    $.ajax({
        url: preurl + 'url_enable.php',
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            console.log(response);
            window.location.href = './';
        }
    });
}

function url_disable(preurl, id) {
    var data = { 'id': id };
    $.ajax({
        url: preurl + 'url_disable.php',
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            console.log(response);
            window.location.href = './';
        }
    });
}

function url_delete(preurl, id) {
    var data = { 'id': id };
    $.ajax({
        url: preurl + 'url_delete.php',
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            console.log(response);
            window.location.href = './';
        }
    });
}

function url_change_validity(preurl, id, value) {
    // alert(preurl)
    var data = { 'id': id, 'validity': value };
    $.ajax({
        url: preurl + 'url_change_validity.php',
        method: 'POST',
        data: data,
        success: function (result) {
            console.log(result);
            var response = JSON.parse(result);
            window.location.href = './';
        }
    });
}

function copy_short_url(short_url) {
    // Create a new textarea element
    var textArea = document.createElement("textarea");

    // Set the text content to the value you want to copy
    textArea.value = short_url;

    // Append the textarea element to the document
    document.body.appendChild(textArea);

    // Select the text inside the textarea
    textArea.select();

    // Copy the selected text to the clipboard
    document.execCommand('copy');

    // Remove the temporary textarea element
    document.body.removeChild(textArea);

    // Alert the copied URL
    alert("Copied Short URL: " + short_url);
}

function validate_signup() {
    var name = $('#name').val();
    var username = $('#username').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var password = $('#password').val();
    var cpassword = $('#cpassword').val();

    // if (isValidName(name) && isValidUsername(username) && isValidPhoneNumber(phone) && isValidPassword(password, cpassword) && isValidEmail(email)) {

    if(!isValidName(name))
        return false;
    if(!isValidEmail(email))
        return false;
    if(!isValidUsername(username))
        return false;
    if(!isValidPhoneNumber(phone))
        return false;
    if(!isValidPassword(password, cpassword))
        return false;

        return true;
}

function isValidUsername(usernameInput) {
    const username = usernameInput.trim();

    // Define the username validation rules
    const usernameRegex = /^[a-zA-Z0-9_]{3,16}$/;

    if (!usernameRegex.test(username)) {
        alert('Please enter valid username!');
        return false;
    } else {
        return true;
    }
}

function isValidName(fullNameInput) {
    const fullName = fullNameInput.trim();

    // Check if the name contains only letters and spaces
    const nameRegex = /^[A-Za-z\s]+$/;

    if (!nameRegex.test(fullName)) {
        alert('Please enter valid name!');
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}

function isValidPhoneNumber(phoneNumberInput) {
    const phoneNumber = phoneNumberInput.trim();

    // Check if the phone number matches the US format (XXX-XXX-XXXX)
    const phoneRegex = /^\d{3}\d{3}\d{4}$/;

    if (!phoneRegex.test(phoneNumber)) {
        alert('Please enter valid Phone No!');
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}

function isValidPassword(passwordInput, confirmPasswordInput) {

    const password = passwordInput;
    const confirmPassword = confirmPasswordInput;

    // Check if passwords match
    if (password !== confirmPassword) {
        alert('Passwords do not match!');
        return false; // Prevent form submission
    } else if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}

function isValidEmail(emailInput) {
    const email = emailInput.trim();

    // Check if the email matches a valid email format
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!emailRegex.test(email)) {
        alert('Please enter valid email!');
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}