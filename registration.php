<?php
include 'header.php';

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

// Create a connection to the database
$db = new PDO('mysql:host=localhost;dbname=project', 'root', '');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user information from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 2;

    // Hash the password
    $hashed_password = md5($password);

    // Prepare and execute the SQL query
    $stmt = $db->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $hashed_password, $email, $role]);

    // Check if the query was successful
    if ($stmt->rowCount() > 0) {
        // Get the user ID of the inserted record
        $user_id = $db->lastInsertId();

        // Store the user ID in the session
        session_start();
        $_SESSION['user_id'] = $user_id;

        // Redirect to the user page
        header("Location: users.php");
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

<!DOCTYPE html>
<html>
<head>
    <title>Membership Registration</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Membership Registration</h1>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>

<?php include 'footer.php'; ?>
</body>
</html>
