<?php
session_start();
$host = "localhost";
$user = "root";        // change if needed
$pass = "";            // your MySQL password
$dbname = "laundryhand"; // your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $accountType = $_POST["account_type"];

    $sql = "SELECT * FROM users WHERE email=? AND accountType=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $accountType);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            // Save user session
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["accountType"] = $row["accountType"];

            if ($row["accountType"] == "admin") {
                header("Location: admindashboard.php");
            } else {
                header("Location: customerdashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('No account found!'); window.location='login.html';</script>";
    }
}
$conn->close();
?>
