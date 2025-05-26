// Gabimet ruhen globalisht
const profile_errors = {
    email: null,
    displayed_email: false
};

async function change_data(event) {
    event.preventDefault(); // ndalon rifreskimin e faqes

    const email_div = document.getElementById('email');
    const username_div = document.getElementById('username');

    let changed_email = email_div.value.trim();
    let changed_username = username_div.value.trim();

    if (!changed_email || !changed_username) {
        alert("Please fill in both email and username.");
        return;
    }

    let count = check_info_errors(changed_email, email_div);

    if (count !== 0) {
        display_errors(email_div);
    } else {
        clear_error(email_div);

        let data = {
            email: changed_email,
            username: changed_username
        };

        const json = await send_request(data, 'change', '../server/control/change_info.control.php');

        if ('success' in json) {
            alert('Info changed successfully');
        } else {
            profile_server_errors(json, email_div);
        }
    }
}

function check_info_errors(email, email_div) {
    let count = 0;

    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        profile_errors.email = 'Invalid email!';
        count++;
    } else {
        profile_errors.email = null;
        clear_error(email_div);
    }

    return count;
}

function display_errors(email_div) {
    if (profile_errors.email != null && !profile_errors.displayed_email) {
        create_error_message(profile_errors.email, email_div);
        profile_errors.displayed_email = true;
    }
}

function clear_error(email_div) {
    const next = email_div.nextElementSibling;
    if (profile_errors.displayed_email && next && next.classList.contains('error-message')) {
        next.remove();
        profile_errors.displayed_email = false;
    }
}

function profile_server_errors(errors, email_div) {
    if ('email' in errors) {
        profile_errors.email = errors.email;
    }
    display_errors(email_div);
}

// Funksion placeholder për krijimin e mesazhit të gabimit (mund të kesh një version më të mirë ti)
function create_error_message(message, input) {
    const error = document.createElement('div');
    error.className = 'error-message';
    error.style.color = 'red';
    error.style.fontSize = '0.85rem';
    error.style.marginTop = '0.25rem';
    error.textContent = message;
    input.parentNode.insertBefore(error, input.nextSibling);
}

async function send_request(data, request_type, url){
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Request-Type': request_type,
            },
            body: JSON.stringify(data),
        });
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        return json;
    } catch (error) {
        console.error(error.message);
    }
}
