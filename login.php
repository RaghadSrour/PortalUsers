
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
    <form method="POST" action="users.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="registration.php">Register for Membership</a></p>
<!-- ////////////////////////////////////////////////////////////////// -->
<?php
session_start();



// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform input validation
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the database 
    $conn = mysqli_connect("localhost", "root", "", "project");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }



// Prepare the SQL query to retrieve the user's information
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $userRole = $row['role'];
    $_SESSION['user_id'] = $row['id'];

    if ($userRole == '1' || $userRole == '2') {
        // Redirect to the user page
        header("Location: users.php");
        exit();
    } else {
        // Invalid user role, display an error message or redirect to a default page
        $login_error = "Invalid user role";
    }
    
} 
// else {
//         // Invalid credentials, display an error message
//         $login_error = "Invalid username or password";
//     }



    mysqli_close($conn);
}
?>

    <?php
    if (isset($login_error)) {
        echo "<p>$login_error</p>";
    }

   
    include 'footer.php';

    ?>


</body>
</html>


