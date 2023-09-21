const getDataFromInput = (arg) => {
    return $('#'+arg).val();
}


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

    if (!isValidName(name))
        return false;
    if (!isValidEmail(email))
        return false;
    if (!isValidUsername(username))
        return false;
    if (!isValidPhoneNumber(phone))
        return false;
    if (!isValidPassword(password, cpassword))
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

$('#full_url').click(async function () {
    const fromClipboard = await navigator.clipboard.readText();
    $('#full_url').val(fromClipboard);
});


function save_url(preurl) {

    var url = preurl + 'in/actions/shorten.php';

    var data = {
        'full_url': $('#full_url').val()
    }

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function (result) {
            // console.log(result);
            var response = JSON.parse(result);
            if (response.status == 1) {

                // console.log(response.short_code);

                // push it to localstorage
                var lsdata = localStorage.getItem('shortened_urls');

                var stringifiedLsdata;

                if (lsdata) {
                    var parsedLsdata = JSON.parse(lsdata);
                    parsedLsdata[response.short_code] = $('#full_url').val();
                    stringifiedLsdata = JSON.stringify(parsedLsdata);
                    console.log(stringifiedLsdata);
                } else {
                    var data = {};
                    data[response.short_code] = $('#full_url').val();
                    // console.log(data);
                    stringifiedLsdata = JSON.stringify(data);

                }

                var frontend_list = "<div class=\"alert alert-primary\">";
                frontend_list += "<h4 class=\"alert-heading\">Short Link Created</h4>";
                frontend_list += "<p>Full URL: <a target=\"_blank\" href=\"" + $('#full_url').val() + "\">" + $('#full_url').val() + "</a>";
                frontend_list += "<br/>Short URL: " + "<a target=\"_blank\" href=\"" + preurl + response.short_code + "\">" + preurl + response.short_code + "</a></p>";
                frontend_list += "</div>";
                $('#status-message').html(frontend_list);

                $('#full_url').val('');

            } else {
                var frontend_list = "<div class=\"alert alert-warning\">";
                frontend_list += "<h4 class=\"alert-heading\">Short Link Creation Failed</h4>";
                frontend_list += "<p>Unable to create short link!</p>";
                frontend_list += "</div>";
                $('#status-message').html(frontend_list);
            }
        }
    });

    return false;
};

function create_qr(preurl) {
    var full_url = $('#full_url').val();

    var frontend_list = "<div class=\"alert alert-primary\">";
    frontend_list += "<h4 class=\"alert-heading\">New QR Created</h4>";
    frontend_list += "<div class=\"row\">";
    frontend_list += "<div class=\"col-8\">";
    frontend_list += "Full URL: <a href=\"" + full_url + "\">" + full_url + "</a><br />";
    frontend_list += "<button class=\"btn btn-secondary mt-3\" onclick=\"download_qr()\">Download QR</button>";
    frontend_list += "</div>";
    frontend_list += "<div class=\"col-4\">";
    frontend_list += "<div id=\"qrcode\" style=\"height:200px;width:200px;\"></div>";
    frontend_list += "</div>";
    frontend_list += "</div>";
    $('#status-message').html(frontend_list);

    const qrCode = new QRCode(document.getElementById("qrcode"), {
        text: full_url, // Replace with your link
        width: 200,
        height: 200,
    });

    // html2canvas(document.getElementById("qrcode")).then((canvas) => {
    //     const qrCodeImage = canvas.toDataURL("image/png");
    //     const logo = document.getElementById("logo");

    //     const qrCodeWithLogo = new Image();
    //     qrCodeWithLogo.src = qrCodeImage;
    //     qrCodeWithLogo.onload = () => {
    //         const ctx = canvas.getContext("2d");
    //         ctx.drawImage(logo, 75, 75, 40, 40); // Adjust the positioning and size as needed
    //         document.getElementById("qrcode").innerHTML = '';
    //         document.getElementById("qrcode").appendChild(canvas);
    //         logo.remove();
    //     };

    //     // Prevent the default behavior of any parent element, such as a form submit
    //     if (event.preventDefault) {
    //         event.preventDefault();
    //     } else {
    //         event.returnValue = false; // For older browsers
    //     }
    // });

    var action_url = preurl + 'in/actions/qrsaver.php';

    var data = {
        'full_url': full_url
    }

    $.ajax({
        url: action_url,
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            if (response.status == 1) {
                console.log(response.message);
            } else {
                console.log(response.message);
            }
        }
    });


    return false;
}

function download_qr() {
    html2canvas(document.getElementById("qrcode")).then(function (canvas) {
        // Convert the canvas to a data URL
        const qrCodeImage = canvas.toDataURL("image/png");

        // Create a temporary anchor element for downloading
        const downloadLink = document.createElement("a");
        downloadLink.href = qrCodeImage;
        downloadLink.download = "qrcode.png"; // Specify the filename
        downloadLink.style.display = "none";

        // Append the anchor element to the document and trigger the download
        document.body.appendChild(downloadLink);
        downloadLink.click();

        // Clean up by removing the anchor element
        document.body.removeChild(downloadLink);
    });
}

function qr_action(preurl, action_name, id, value) {
    preurl += 'in/actions/'
    switch (action_name) {
        case 'enable':
            qr_enable(preurl, id)
            break;

        case 'disable':
            qr_disable(preurl, id)
            break;

        case 'delete':
            qr_delete(preurl, id)
            break;

        case 'change_validity':
            qr_change_validity(preurl, id, value);
            break;
    }
}

function qr_enable(preurl, id) {
    var data = { 'id': id };
    $.ajax({
        url: preurl + 'qr_enable.php',
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            console.log(response);
            window.location.href = './created-qrs';
        }
    });
}

function qr_disable(preurl, id) {
    var data = { 'id': id };
    $.ajax({
        url: preurl + 'qr_disable.php',
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            console.log(response);
            window.location.href = './created-qrs';
        }
    });
}

function qr_delete(preurl, id) {
    var data = { 'id': id };
    $.ajax({
        url: preurl + 'qr_delete.php',
        method: 'POST',
        data: data,
        success: function (result) {
            var response = JSON.parse(result);
            console.log(response);
            window.location.href = './created-qrs';
        }
    });
}

function qr_change_validity(preurl, id, value) {
    // alert(preurl)
    var data = { 'id': id, 'validity': value };
    $.ajax({
        url: preurl + 'qr_change_validity.php',
        method: 'POST',
        data: data,
        success: function (result) {
            console.log(result);
            var response = JSON.parse(result);
            window.location.href = './created-qrs';
        }
    });
}




// Document 
$(document).ready(function () {
    var new_url = localStorage.getItem('new_url');
    if (new_url) {
        $('#full_url').val(new_url);
        localStorage.removeItem('new_url');
    }

    // $('[id^="uit-a"]').click(function () {

    //     var id = this.id;
    //     id = id.replace("uit-a", "");

    //     var qr_wrapper = $('#qr-code-wrapper');

    //     var full_url = $('#full-url-a' + id).attr("href");;

    //     const qrCode = new QRCode(qr_wrapper, {
    //         text: full_url, // Replace with your link
    //         width: 200,
    //         height: 200,
    //     });
    // });

    // $('[id^="uit-a"]').click(function () {
    //     var id = this.id;
    //     id = id.replace("uit-a", "");
    //     console.log(id);
    //     $('[id^="hdb-a"]').css('display', 'none');
    //     $('#hdb-a' + id).css({
    //         display: 'flex',
    //         transition: '0.5s ease all'
    //     });

    //     var full_url = $('#full-url-a' + id).attr("href");;
    //     const qrCode = new QRCode($('#qrcode-a' + id), {
    //         text: full_url, // Replace with your link
    //         width: 200,
    //         height: 200,
    //     });

    // });

    // $(document).keydown(function (event) {
    //     if (event.key === "Escape") {
    //         $('[id^="hdb-a"]').hide();
    //     }
    // });

});

function generate_qrcode(full_url) {
    $('#qr-code-wrapper').empty();
    const qrCode = new QRCode(document.getElementById("qr-code-wrapper"), {
        text: full_url, // Replace with your link
        width: 200,
        height: 200,
    });
}

function download_qrcode() {
    html2canvas(document.getElementById("qr-code-wrapper")).then(function (canvas) {
        // Convert the canvas to a data URL
        const qrCodeImage = canvas.toDataURL("image/png");

        // Create a temporary anchor element for downloading
        const downloadLink = document.createElement("a");
        downloadLink.href = qrCodeImage;
        downloadLink.download = "qrcode.png"; // Specify the filename
        downloadLink.style.display = "none";

        // Append the anchor element to the document and trigger the download
        document.body.appendChild(downloadLink);
        downloadLink.click();

        // Clean up by removing the anchor element
        document.body.removeChild(downloadLink);
    });
}



function update_profile(preurl) {

    var url = preurl+'in/actions/update_profile.php';
    // console.log(url);

    var data = {
        id: getDataFromInput('id'),
        full_name: getDataFromInput('full_name'),
        phone: getDataFromInput('phone'),
        address: getDataFromInput('address'),
        city: getDataFromInput('city'),
        state: getDataFromInput('state'),
        pin: getDataFromInput('pin'),
    }

    $.ajax({
        url: url,
        method: 'POST',
        data: data,
        success: function (result) {
            alert(JSON.parse(result).message);
        }
    });

    return false;
}