<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: http://localhost/chatroom");
}
$host = 'localhost';
$user = 'root';
$pass = '';
$datadb = 'chatroom';

$connection = new mysqli($host, $user, $pass, $datadb);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$stmt = $connection->prepare("SELECT message.*, user.img FROM message JOIN user ON user.img = message.img");
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $messageClass = (htmlspecialchars($row['name']) === htmlspecialchars($_SESSION['username'])) ? 'user-message' : 'other-message';
        if ($messageClass === 'user-message') {
            echo '<div class="message ' . $messageClass . '" style="padding-left:50px;">' . htmlspecialchars($row['msg']) . '<p style="font-size:10px;">' . htmlspecialchars($row['time']) . '</p><a onclick="chmsg(' . $row['id'] . ', \'' . htmlspecialchars($row['msg'], ENT_QUOTES, 'UTF-8') . '\')" style="margin-left:-40px; float:left; font-size:10px; margin-top:-25px; text-decoration:none; color:blue;">edit</a></div>';
        } else {
            echo '<div class="message"><img src="' . htmlspecialchars($row['img']) . '" class="img"><div class="' . $messageClass . '"><b style="font-weight:900; font-size:15px;">' . htmlspecialchars($row['name']) . '</b><br>' . htmlspecialchars($row['msg']) . '<p style="font-size:10px;">' . htmlspecialchars($row['time']) . '</p>' . '</div></div>';
        }        
    }
} else {
    echo '<div>No Message</div>';
}

$connection->close();
?>