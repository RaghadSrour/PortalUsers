<?php
include 'header.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Membership Registration</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Membership Registration</h1>
    <form method="POST" action="register_process.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
    <?php
   
    include 'footer.php';
?>

</body>
</html>


