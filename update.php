<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lab777");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET name='$name', accessLevel='$accessLevel', password='$password' WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: display.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

$conn->close();
?>

<form action="update.php" method="POST">
    <input type="hidden" name="matric" value="<?php echo $row['matric']; ?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
    <br>
    <label for="accessLevel">Access Level:</label>
    <select name="accessLevel">
        <option value="admin" <?php if ($row['accessLevel'] == 'lecturer') echo 'selected'; ?>>lecturer</option>
        <option value="user" <?php if ($row['accessLevel'] == 'student') echo 'selected' ?>>student</option>
