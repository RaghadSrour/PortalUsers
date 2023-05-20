
<?php

include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="registration.php">Register for Membership</a></p>
    <?php
    if (isset($login_error)) {
        echo "<p>$login_error</p>";
    }

   
    include 'footer.php';

    ?>
</body>
</html>
