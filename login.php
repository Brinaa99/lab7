<?php
$servername = "localhost";
$username = "Sabrina";
$password = "Sabrina1995";
$dbname = "Lab_7";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $_POST['matric'];
$password = $_POST['password'];

$sql = "SELECT password FROM users WHERE matric='$matric'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['matric'] = $matric;
        header("Location: display_users.php");
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found";
}

$conn->close();
?>
