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


if (isset($_GET['matric'])) {
    $matric = $conn->real_escape_string($_GET['matric']);
    
   
    $sql = "DELETE FROM users WHERE matric='$matric'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Matric is not set";
}


$conn->close();


header("Location: display.php");
exit();
?>
