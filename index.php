<?php
// Establish database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = mysqli_connect($host, $username, $password, $dbname);
//$db = new mysqli('localhost', 'root', '', 'project');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create users table if it doesn't exist
$sql = 'CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role INT NOT NULL
)';
mysqli_query($conn, $sql);
//$db->query($sql);

// Add the admin user
$username = 'admin';
$email = 'admin@example.com';
$password = md5('password123');
$role = '1';


$sql = "INSERT INTO users (username,password, email, role) VALUES ('$username', '$password', '$email', '$role')";
mysqli_query($conn, $sql);
//$stmt = $db->prepare($sql);


// Close the database connection
mysqli_close($conn);
?>

<?php
// Create a connection to the database
$db = new PDO('mysql:host=localhost;dbname=project', 'root', '');

// Get the user information from the form
// $username = $_POST['username'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $role = $_POST['role'];


// Hash the password
$hashed_password = md5($password);

// Create the User class
class User {
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;

    public function __construct($id, $username, $password, $email, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }
}

// Create the login page
$page = 'login.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    $page = 'users.php';
}


?>
