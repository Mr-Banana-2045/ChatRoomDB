<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chatroom";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['username'])) {
    $currentUsername = $_SESSION['username'];
    $newName = $_GET['name'];
    
    $stmt = $conn->prepare("UPDATE user SET name = ? WHERE username = ?");
    $stmt->bind_param("ss", $newName, $currentUsername);

    if ($stmt->execute()) {
        header("Location: http://localhost/chatroom/chat.php");
    } else {
        echo "error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "User not logged in.";
}

$conn->close();
?>
