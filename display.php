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


$sql = "SELECT matric, name, accessLevel FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: papayawhip;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: teal;
        }
        th, td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Users List</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Actions</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["matric"] . "</td><td>" . $row["name"] . "</td><td>" . $row["accessLevel"] . "</td>";
            echo "<td><a href='update.php?matric=" . $row["matric"] . "'>Update</a> | ";
            echo "<a href='delete.php?matric=" . $row["matric"] . "'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
