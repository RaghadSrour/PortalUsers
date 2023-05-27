<?php
// التحقق من تسجيل الدخول وصلاحيات المستخدم
// session_start();
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != '1') {
//     header("Location: login.php");
//     exit();
// }

// التحقق مما إذا كانت هناك معرف المستخدم المقدم في عنوان URL
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit();
}

// الحصول على معرف المستخدم من العنوان URL
$userID = $_GET['id'];

// الاتصال بقاعدة البيانات
$db = new mysqli('localhost', 'root', '', 'project');
if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm']) && $_POST['confirm'] == '1') {
        // إذا تم تأكيد الحذف، قم بحذف المستخدم
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $db->prepare($sql);
        if (!$stmt) {
            die('Error preparing statement: ' . $db->error);
        }
        $stmt->bind_param('i', $userID);
        $result = $stmt->execute();
        if (!$result) {
            die('Error executing statement: ' . $stmt->error);
        }
        if ($stmt->affected_rows > 0) {
            echo 'User deleted successfully.';
        } else {
            echo 'Failed to delete user.';
        }
        $stmt->close();
    } else {
        // إذا تم إلغاء الحذف، قم بإعادة التوجيه إلى صفحة القائمة
        header("Location: users.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <script>
        function confirmDelete() {
            var confirmed = confirm("Are you sure you want to delete this user?");
            if (confirmed) {
                // قم بإرسال النموذج لتأكيد الحذف
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</head>
<body>
    <h1>Delete User</h1>
    <p>Are you sure you want to delete this user?</p>
    <form id="deleteForm" method="POST" action="delete_user.php?id=<?php echo $userID; ?>">
        <input type="hidden" name="confirm" value="1">
        <button onclick="confirmDelete()">Delete</button>
        <button onclick="window.location.href='users.php'">Cancel</button>
    </form>
</body>
</html>
