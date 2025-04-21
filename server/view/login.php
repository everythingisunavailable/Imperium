<?php

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../global.css">
    <link rel="stylesheet" href="login_register.css">
</head>
<body>
    <div class="container">
         
        <div class="left">
            <img src="../assets/imperium.png" alt="Imperium">
        </div>
        
        <div class="right">
            <div class="form-container" id="form-container">
                <form action="#" method="post" id="login" onsubmit="save_data(event, "login")">
                    <h2>SIGN IN</h2>
                    <label for="email_login">Email</label>
                    <input type="text" name="email" placeholder="example@gmail.com" required id="email_login">
                    <label for="password_login">Password</label>
                    <input type="password" name="password" required id="password_login">
                    <div class="button-container">
                        <button>Sign In</button>
                    </div>

                    <div class="button-container">
                        <!--google button-->
                        <button type="button" class="gsi-material-button">
                            <div class="gsi-material-button-state"></div>
                            <div class="gsi-material-button-content-wrapper">
                                <div class="gsi-material-button-icon">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                    <path fill="none" d="M0 0h48v48H0z"></path>
                                </svg>
                                </div>
                                <span class="gsi-material-button-contents">Continue with Google</span>
                                <span style="display: none;">Continue with Google</span>
                            </div>
                            </button>
                        <!--end google button-->
                    </div>

                    <div class="link-container">
                        <a href="#">Forgot Password?</a>
                        <a href="#" onclick="flip()">Dont have an account?</a>
                    </div>
                </form>

                <form action="#" method="post" class="hide" id="register" onsubmit="save_data(event, "signup")">
                    <h2>Sign Up</h2>
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="John" required id="name">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" placeholder="Doe" required id="surname">
                    <label for="email_signup">Email</label>
                    <input type="text" name="email" placeholder="example@gmail.com" required id="email_signup">
                    <label for="password_signup">Password</label>
                    <input type="password" name="password" required id="password_signup">
                    <label for="password_again">Retype Password</label>
                    <input type="password" name="repeat-password" required id="password_again">
                    <div class="button-container">
                        <button>Sign Up</button>
                    </div>
                    <div class="link-container">
                        <a href="#" onclick="flip()" id="sign-in-link">Sign in instead</a>
                    </div>
                </form>

            </div>
        </div>

    </div>

    <script src="login_register.js"></script>

</body>
</html>';
