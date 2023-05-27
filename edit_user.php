<?php

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user information from the form
    $userID = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Prepare the SQL statement with placeholders
    $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";

    // Prepare the statement
    $stmt = $db->prepare($sql);
    if (!$stmt) {
        die('Error preparing statement: ' . $db->error);
    }

    // Bind the parameters
    $stmt->bind_param('ssi', $username, $email, $userID);

    // Execute the statement
    $result = $stmt->execute();
    if ($result) {
        // Redirect to the user list page
        header("Location: users.php");
        exit();
    } else {
        echo 'Error updating user.';
    }

    // Close the statement
    $stmt->close();
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
    echo '<form method="POST" action="">';
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
