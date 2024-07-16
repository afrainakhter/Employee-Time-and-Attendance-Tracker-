<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            background-color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap");

        :root {
            --primary-color: #816bf2;
            --primary-color-dark: #6e5ecb;
            --secondary-color: #1f3160;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --extra-light: #faf5ff;
            --max-width: 1200px;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .wrapper {
            background-color: #faf5ff;
            width: 100%;
            height: 100vh;
            padding: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 450px;
            background: rgb(225, 206, 236);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 5px 5px 10px #b6a9a9, -5px -5px 10px #ffffff;
        }

        .container img {
            width: 150px;
            height: 150px;
            display: block;
            margin: -50px auto 20px auto;
        }

        h2 {
            text-align: center;
            color: #8f8888;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            color: #6b7280;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #38475a;
            text-transform: capitalize;
            margin-bottom: 10px;
            font-size: 14px;
            display: block;
            font-weight: 500;
        }

        .form-group input {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            outline: none;
            font-family: sans-serif;
            background: transparent;
            font-size: 16px;
            border-radius: 25px;
            text-shadow: 1px 1px 0 #fff;
            box-shadow: inset 2px 2px 5px #babecc, inset -5px -5px 10px #fff;
        }

        .form-group input:focus {
            box-shadow: inset 1px 1px 2px #babecc, inset -1px -1px 2px #fff;
        }

        button {
            width: 100%;
            border: none;
            height: 45px;
            border-radius: 25px;
            background: rgb(82, 182, 221);
            color: white;
            font-size: 18px;
            cursor: pointer;
            box-shadow: -5px -5px 20px rgb(224, 217, 217), 5px 5px 20px #babecc;
            outline: none;
            margin-top: 10px;
        }

        button:active {
            box-shadow: inset 1px 1px 2px #babecc, inset -1px -1px 2px #fff;
        }

        .form-group a {
            display: block;
            text-align: center;
            color: #8f8888;
            font-size: 16px;
            text-decoration: none;
            margin-top: 15px;
        }

        /* Additional styles for responsiveness */

        @media (max-width: 750px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .container img {
                width: 120px;
                height: 120px;
                margin: -40px auto 15px auto;
            }

            h2 {
                font-size: 22px;
                margin-bottom: 15px;
            }

            p {
                font-size: 14px;
                margin-bottom: 15px;
            }

            button {
                font-size: 16px;
                height: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <img src="assets/img/tvlogo.png" alt="Logo">
            <h2>Password Reset</h2>
            <p>Create a new password for your account.</p>
            <form action="reset_password.php" method="post" class="reset-form">
                <div class="form-group">
                    <label for="newPassword">New Password</label>
                    <input type="password" id="newPassword" name="new_password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirm_password" required>
                </div>
                <button class="submit-btn" type="submit" name="reset_password">Reset Password</button>
                
                <a href="index.php">Back to login</a>
            </form>
        </div>
    </div>
</body>

</html>
