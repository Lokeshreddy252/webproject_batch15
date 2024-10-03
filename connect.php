<?php
error_reporting(0); // Add this line to suppress error reporting

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['$name'];
    $email = $_POST['$email'];
    $number = $_POST['$number'];
    $password = $_POST['$password'];
    $confirm_password = $_POST['$confirm_password'];

    // Validation and other code here

    $conn = new mysqli('localhost', 'root', '', 'webproject');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO registration (name, email, number, password, confirm_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $number, $password, $confirm_password);

        if ($stmt->execute()) {
            echo "Registration successfully completed";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>