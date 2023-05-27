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
    <form method="POST" action="users.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>


<?php
    // Establish database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        $role = 2;

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $password, $email, $role);
        $stmt->execute();

       // Check if the query was successful
if ($stmt->affected_rows > 0) {
    // Get the user ID of the inserted record
    $user_id = $stmt->insert_id;

    // Store the user ID in the session
    session_start();
    $_SESSION['user_id'] = $user_id;

    // Redirect to the user page
    header("Location: user_page.php");
    exit();
} else {
    echo "Error registering user.";
}

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>




