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
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management Portal</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <div class="header">
        <h1>User Management Portal</h1>
        <nav>
            <ul>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>

    <h1>User List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        // Fetch users from the database
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['password'] . '</td>';
                echo '<td>' . $row['role'] . '</td>';
                echo '<td class="actions">';
                echo '<a href="edit_user.php?id=' . $row['id'] . '" title="Edit user">✎</a>';
                echo '<a href="delete_user.php?id=' . $row['id'] . '" title="Delete user">✖</a>';
                echo '<a href="change_role.php?id=' . $row['id'] . '" title="Change role">⇄</a>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">No users found</td></tr>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </table>
</body>
</html>


