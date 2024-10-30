<?php
// login.php
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
    $password = $_POST["password"];

    // Query the "register" table to find the user
    $sql = "SELECT * FROM register WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the user's data
        // Check if the password matches
        if ($password === $row["password"]) {
            header("Location: Welcome.html");
            exit();
        } else {
            echo "Invalid password."; // Incorrect password
        }
    } else {
        echo "No user found with this username."; // Username not found
    }
}

$conn->close();
?>
