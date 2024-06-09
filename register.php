
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $matric = $_POST['matric'];
        $password = $_POST['password'];

        
        $conn = new mysqli('localhost', 'root', '', 'Lab_7');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

     
        $sql = "SELECT password FROM users WHERE matric=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['matric'] = $matric;
            header("Location: display.php");
        } else {
            echo "<p style='color:red;'>Invalid matric number or password</p>";
        }

        $conn->close();
    }
    
