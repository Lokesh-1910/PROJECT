<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project"; // Your database name

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$registration_successful = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg_no = $_POST['reg_no'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    
    $technical_events = isset($_POST['technical_events']) ? implode(", ", $_POST['technical_events']) : "";
    $non_technical_events = isset($_POST['non_technical_events']) ? implode(", ", $_POST['non_technical_events']) : "";

    $sql = "INSERT INTO event (reg_no, name, department, year, email, contact_no, technical_events, non_technical_events) 
            VALUES ('$reg_no', '$name', '$department', '$year', '$email', '$contact_no', '$technical_events', '$non_technical_events')";

    if ($conn->query($sql) === TRUE) {
        $registration_successful = true;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        /* Styles for message container */
        body {
            font-family: Arial, sans-serif;
            background-image: url("BG.jpg"); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .message {
            font-size: 1.2em;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <?php if ($registration_successful): ?>
            <p class="message">Registration Successful!</p>
            <p>Thank you for registering the SPARK'S 2024. We look forward to seeing you at the event!</p>
        <?php else: ?>
            <p class="message">Registration failed. Please try again.</p>
        <?php endif; ?>
    </div>
</body>
</html>
