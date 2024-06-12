<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   
    $conn = new mysqli("localhost", "root", "", "lab777");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "INSERT INTO users (matric, name, accessLevel, password) VALUES ('$matric', '$name', '$accessLevel', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
}
?>

