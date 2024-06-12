<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "lab777");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT password FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['matric'] = $matric;
            header("Location: display.php");
            exit();
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "Invalid credentials";
    }

    $conn->close();
}
?>
