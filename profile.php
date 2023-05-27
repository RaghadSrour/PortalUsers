<?php

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the user data from the database
$user_data = mysqli_query($db, "SELECT * FROM users WHERE id = $_SESSION[user_id]");

// Check if the user data was retrieved successfully
if ($user_data) {
    $user = mysqli_fetch_assoc($user_data);
} else {
    echo "Error retrieving user data";
    exit;
}


// Close the statement and database connection
$stmt->close();
$db->close();


// Include the header file
include 'header.php';

// Include the footer file
include 'footer.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>Profile Page</h1>
    <p>Here is the data of the person who is currently logged in:</p>
    <ul>
        <li>Name: <?php echo $user['name']; ?></li>
        <li>Email: <?php echo $user['email']; ?></li>
        <li>Role: <?php echo $user['role']; ?></li>

    </ul>
</body>
</html>
