var xmlhttp = new XMLHttpRequest();

function validateUsername(usn) {
    let format = "^[a-zA-Z0-9_]+$";
    if(usn.value.match(format)) {
        return true;
    }
    return false;
}

function validateEmail(mail) {
    let format = "^[a-zA-Z0-9+_.-]+@[a-zA-Z.-]+(?:\.[a-zA-Z-]+)+$";
    if(mail.value.match(format)) {
        return true;
    }
    return false;
}

function checkUsername() {
    let usnField = document.getElementById('uname');
    let usn = encodeURIComponent(usnField.value);
    let err = document.getElementById('username-err');
    let qry = 'username=' + usn;
    let url = 'checkUnameField.php';
    let valid = validateUsername(usnField);
    
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(valid) {
                if(this.response === 'unique') {
                    usnField.style.border = '2px solid green';
                    err.innerHTML = '';
                }
                else {
                    usnField.style.border = '2px solid red';
                    err.innerHTML = 'Username not unique';
                }
            }
            else {
                usnField.style.border = '2px solid red';
            }
        }
    }
    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
    xmlhttp.send(qry);
}

function checkEmail() {
    let mailField = document.getElementById('email');
    let mail = encodeURIComponent(mailField.value);
    let err = document.getElementById('email-err');
    let qry = 'mail=' + mail;
    let url = 'checkEmailField.php';
    let valid = validateEmail(mailField);
    
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            if(valid) {
                if(this.response === 'unique') {
                    mailField.style.border = '2px solid green';
                    err.innerHTML = '';
                }
                else {
                    mailField.style.border = '2px solid red';
                    err.innerHTML = 'Email not unique';
                }
            }
            else {
                mailField.style.border = '2px solid red';
            }
        }
    }
    xmlhttp.open('POST', url, true);
    xmlhttp.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
    xmlhttp.send(qry);
}