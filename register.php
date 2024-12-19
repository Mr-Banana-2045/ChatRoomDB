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

function deviceExists($conn, $device) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE device = ?");
    $stmt->bind_param("s", $device);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows > 0;
    $stmt->close();
    return $exists; 
}


if (isset($_POST['name'])&& isset($_POST['password'])) {
    $currentUsername = $_POST['name'];
    $newpass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $device = $_SERVER['HTTP_USER_AGENT'];

    $stmt = $conn->prepare("UPDATE user SET password = ? WHERE name = ? AND device = ?");
    $stmt->bind_param("sss", $newpass, $currentUsername, $device);
    if (deviceExists($conn ,$device)){
if ($stmt->execute()) {
            header("Location: http://localhost/chatroom/");
        } else {
            echo "error: " . $stmt->error;
        }
    } else {
        echo "This device is not authorized to change the password";
    }

    
    $stmt->close();
} else {
    echo "User not logged in or invalid data.";
}

$conn->close();
?>