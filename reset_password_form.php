<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
/* Include the styles from reset_password_style.css here */
@import url('https://fonts.googleapis.com/css?family=Rubik:400,500,700');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', 'sans-serif';
}

.wrapper {
    background-color: #272750;
    width: 100%;
    height: 100vh;
    padding: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    width: 500px;
    background-color: beige;
    padding: 30px;
    border-radius: 16px;
    background-color: rgb(0, 0, 0, 0.08) 0px 4px 12px;
}

.title-section {
    margin-bottom: 30px;
}

.title {
    color: #38475a;
    font-size: 25px;
    font-weight: 500;
    text-transform: capitalize;
    margin-bottom: 10px;
}

.para {
    color: #38475a;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.5;
    margin-bottom: 20px;
    text-transform: capitalize;
}

.form-group {
    position: relative;
    margin-bottom: 20px; /* Add space between form groups */
}

.form-group.label-title {
    color: #38475a;
    text-transform: capitalize;
    margin-bottom: 10px; /* Adjust the margin between label and input */
    font-size: 14px;
    display: block;
    font-weight: 500;
}

/* Ensure text boxes are on the same line */
.reset-form input {
    display: inline-block;
    width: calc(50% - 10px); /* Adjust width as needed */
    margin-right: 20px; /* Add margin between text boxes */
}

.submit-btn {
    width: 100%;
    background-color: #272750;
    border: 1px solid transparent;
    border-radius: 8px;
    font-size: 16px;
    color: aliceblue;
    padding: 13px 24px;
    font-weight: 500;
    text-align: center;
    text-transform: capitalize;
    cursor: pointer;
}

.submit-btn:hover {
    opacity: 0.95;
}

    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="title-section">
                <form action="reset_password.php" method="post" class="reset-form">
                    <h2 class="title">Password Reset</h2>
                    <p class="para">Create a new password for your account.</p>

                    <div class="form-group">
                        <label for="newPassword" class="label-title">New Password</label>
                        <input type="password" id="newPassword" name="new_password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirm_password" required>
                    </div>

                    <button class="submit-btn" type="submit" name="reset_password">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>