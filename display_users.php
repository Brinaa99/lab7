<?php
session_start();
if (!isset($_SESSION['matric'])) {
    header("Location: login.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_7";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, matric, name, accessLevel FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["matric"] . "</td><td>" . $row["name"] . "</td><td>" . $row["accessLevel"] . "</td>
              <td>
              <a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | 
              <a href='delete_user.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
              </td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<a href="logout.php">Logout</a>
