async function request_Recovery(event, type) {
    event.preventDefault();

    if (type == 'requestCode') {
        let forgottenEmail = document.getElementById('email_forgot').value.trim();
        await code_request(forgottenEmail);
    } else if (type == "verifyCode") {
        let forgottenEmail = document.getElementById('email_forgot').value.trim();
        let code = document.getElementById('code').value.trim();
        await code_verify(forgottenEmail, code);
    } else if (type == "changePassword") {
        let newPass = document.getElementById('password_change').value.trim();
        let confirmPass = document.getElementById('password_again_change').value.trim();
        await change_password(newPass, confirmPass);
    }
}

async function code_request(email){
    let data = {
        'email': email
    }
    const json = await send_request(data, 'requestCode', '../server/control/requestCode.control.php');
    if (!json) {
        alert("Database did not return a valid response");
        return;
    }

    if ('success' in(json)) {
        alert(json['success']);
        flip();
    } else{
        alert(json['error']);
    }
}

async function code_verify(code){
    let data = {
        'code': code
    }

    const json = await send_request(data, 'verifyCode', '../server/control/verifyCode.control.php');
    if (!json) {
        alert("Database did not return a valid response");
        return;
    }

    if ('success' in(json)) {
        alert(json['success']);
        goTo('change-password');
    } else{
        alert(json['error']);
    }
}

async function change_password(newPass, confirmPass){
    let data = {
        'newPass': newPass,
        'confirmPass': confirmPass
    }

    const json = await send_request(data, 'changePassword', '../server/control/changePassword.control.php');
    if (!json) {
        alert("Database did not return a valid response");
        return;
    }

    if ('success' in(json)) {
        alert(json['success']);
    } else if ('error' in(json)){
        alert(json['error']);
    } else {
        alert('Handle error messages related to new password/confirm password');
    }
}