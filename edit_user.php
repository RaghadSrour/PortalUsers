<?php
// Check if the user is logged in and has admin role
// session_start();
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != '1') {
//     header("Location: login.php");
//     exit();
// }

// Check if the user ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

// Get the user ID from the URL
$userID = $_GET['id'];

// Connect to the database
$db = new mysqli('localhost', 'root', '', 'project');
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

// Prepare the SQL statement with a placeholder
$sql = "SELECT * FROM users WHERE id = ? LIMIT 1";

// Prepare the statement
$stmt = $db->prepare($sql);
if (!$stmt) {
    die('Error preparing statement: ' . $db->error);
}

// Bind the parameter
$stmt->bind_param('i', $userID);

// Execute the statement
$result = $stmt->execute();
if (!$result) {
    die('Error executing statement: ' . $stmt->error);
}

// Get the result set
$resultSet = $stmt->get_result();

if ($resultSet->num_rows == 1) {
    $row = $resultSet->fetch_assoc();
    // Display the form to edit user data
    echo '<h1>Edit User</h1>';
    echo '<form method="POST" action="edit_user.php">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
    echo '<input type="text" name="username" placeholder="Username" value="' . $row['username'] . '" required><br>';
    echo '<input type="email" name="email" placeholder="Email" value="' . $row['email'] . '" required><br>';
    echo '<input type="submit" value="Update">';
    echo '</form>';
} else {
    echo 'User not found.';
}

// Close the statement and database connection
$stmt->close();
$db->close();
?>