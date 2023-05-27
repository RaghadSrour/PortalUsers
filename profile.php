<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the session
$userID = $_SESSION['user_id'];

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
    // Display the user profile data
    echo '<h1>User Profile</h1>';
    echo '<p>Username: ' . $row['username'] . '</p>';
    echo '<p>Email: ' . $row['email'] . '</p>';
    // Add more user data as needed

} else {
    echo "Failed to fetch user information.";
}

// Close the statement and database connection
$stmt->close();
$db->close();


// Include the header file
include 'header.php';

// Include the footer file
include 'footer.php';
?>
