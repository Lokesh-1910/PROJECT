<?php
// register.php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project"; // Your database name

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare SQL to insert user data
    $sql = "INSERT INTO register (username,email,password) VALUES ('$username','$email', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: success.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
