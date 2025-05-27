// Gabimet ruhen globalisht
const profile_errors = {
  username: null,
  displayed_username: false,
  email: null,
  displayed_email: false,
};

async function change_data(event) {
  event.preventDefault(); // ndalon rifreskimin e faqes

  const email_div = document.getElementById("email");
  const username_div = document.getElementById("username");

  let changed_email = email_div.value.trim();
  let changed_username = username_div.value.trim();

  let count = check_info_errors(
    changed_email,
    email_div,
    changed_username,
    username_div
  );

  if (count !== 0) {
    display_profile_errors(email_div.parentElement, username_div.parentElement);
  } else {
    clear_profile_error(email_div.parentElement, username_div.parentElement);

    let data = {
      email: changed_email,
      username: changed_username,
    };

    const json = await send_request(
      data,
      "update_profile",
      "../server/control/updateProfil.control.php"
    );

    if ('success' in json) {
        create_notification('Data updated successfully!')
        goTo("/imperium/public/profile");
    } else {
        profile_server_errors(json, email_div.parentElement, username_div.parentElement);
    }
  }
}

function check_info_errors(email, email_div, username, username_div) {
  let count = 0;
  if (!email) {
    profile_errors.email = "Email can't be empty!";
    count++;
  } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
    profile_errors.email = "Invalid email!";
    count++;
  } else {
    profile_errors.email = null;
    clear_profile_error(email_div.parentElement, username_div.parentElement);
  }

  if (!username) {
    profile_errors.username = "Username can't be empty!";
    count++;
  } else {
    profile_errors.username = null;
    clear_profile_error(username_div.parentElement, username_div.parentElement);
  }

  return count;
}

function display_profile_errors(email_div, username_div) {
  if (profile_errors.email != null && !profile_errors.displayed_email) {
    create_error_message(profile_errors.email, email_div);
    profile_errors.displayed_email = true;
  }
  if (profile_errors.username != null && !profile_errors.displayed_username) {
    create_error_message(profile_errors.username, username_div);
    profile_errors.displayed_username = true;
  }
}

function clear_profile_error(email_div, username_div) {
  if (
    profile_errors.displayed_email &&
    email_div.nextElementSibling &&
    email_div.nextElementSibling.classList.contains("error")
  ) {
    email_div.nextElementSibling.remove();
    profile_errors.displayed_email = false;
  }
  if (
    profile_errors.displayed_username &&
    username_div.nextElementSibling &&
    username_div.nextElementSibling.classList.contains("error")
  ) {
    username_div.nextElementSibling.remove();
    profile_errors.displayed_username = false;
  }
}

function profile_server_errors(errors, email_div, username_div) {
  if ("email" in errors) {
    profile_errors.email = errors.email;
  }
  if ("username" in errors) {
    profile_errors.username = errors.username;
  }

  display_profile_errors(email_div, username_div);
}
function logout_user() {
  // You can replace this with a real API call or redirect
  fetch('../server/control/logout.control.php', {
    method: 'POST',
    credentials: 'include',
  })
    .then(response => response.json())
    .then(json => {
      if (json.success) {
        create_notification("Logged out successfully!");
        goTo("/imperium/public/login");
      } else {
        create_notification("Failed to log out.");
      }
    })
    .catch(error => {
      console.error("Logout error:", error);
      create_notification("An error occurred during logout.");
    });
}

function confirm_delete() {
  const confirmed = confirm("Are you sure you want to delete your account? This action cannot be undone.");
  if (confirmed) {
    delete_account();
  }
}

function delete_account() {
  fetch('../server/control/deleteAccount.control.php', {
    method: 'POST',
    credentials: 'include',
  })
    .then(response => response.json())
    .then(json => {
      if (json.success) {
        create_notification("Account deleted.");
        goTo("/imperium/public/register");
      } else {
        create_notification("Failed to delete account.");
      }
    })
    .catch(error => {
      console.error("Delete error:", error);
      create_notification("An error occurred while deleting the account.");
    });
}
function remove_saved_item(itemId) {
  if (!confirm("Remove this item from your saved items?")) return;

  fetch('../server/control/removeSavedItem.control.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ item_id: itemId }),
  })
    .then(res => res.json())
    .then(json => {
      if (json.success) {
        create_notification("Item removed from saved items.");
        // Optionally, remove from DOM
        document.querySelector(`.remove-saved[data-id="${itemId}"]`)?.closest(".item-card")?.remove();
      } else {
        create_notification("Failed to remove item.");
      }
    })
    .catch(err => {
      console.error("Remove saved item error:", err);
      create_notification("An error occurred.");
    });
}
