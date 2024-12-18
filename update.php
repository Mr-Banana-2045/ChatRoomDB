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

if (isset($_SESSION['username']) && isset($_POST['id']) && isset($_POST['msg'])) {
    $currentUsername = $_SESSION['username'];
    $messageId = $_POST['id'];
    $newmsg = $_POST['msg'];

    $stmt = $conn->prepare("UPDATE message SET msg = ? WHERE id = ? AND name = ?");
    $stmt->bind_param("sis", $newmsg, $messageId, $currentUsername);

    if ($stmt->execute()) {
        header("Location: http://localhost/chatroom/chat.php");
    } else {
        echo "error: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "User not logged in or invalid data.";
}

$conn->close();
?>
