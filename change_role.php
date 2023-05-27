<?php
// session_start();

// // Check if the user is not logged in
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// Establish database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Update the user's role to 1 in the database
    $updateSql = "UPDATE users SET role = 1 WHERE id = $userId";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        echo "User role updated successfully.";
    } else {
        echo "Error updating user role.";
    }
} else {
    echo "User ID not provided.";
}

// Close the database connection
mysqli_close($conn);

?>
