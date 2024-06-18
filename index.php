<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css?<?php echo time(); ?>">
</head>
<body class="login-body">
    <div class="login-form-container">
        <form action="/action_page.php" method="post">
            <label for="email"><b>Email</b></label>
            <input class="email-input" type="text" placeholder="Enter Email" name="email" required>
            <br><br>
            <label for="password"><b>Password</b></label>
            <input class="password-input" type="password" placeholder="Enter Password" name="password" required>
            <br><br>
            <button class="login-button" type="submit">Login</button>
        </form>
    </div>
</body>
</html>