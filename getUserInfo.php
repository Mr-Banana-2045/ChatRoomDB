<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$datadb = 'chatroom';

$connection = new mysqli($host, $user, $pass, $datadb);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET['username'])) {
    $username = htmlspecialchars($_GET['username']);
    $res = $connection->query("SELECT img FROM message WHERE name = '$username'");
    $ress = $connection->query("SELECT id,name,profession FROM user WHERE username = '$username'");

    $stmt = $connection->prepare("SELECT COUNT(*) AS message_count FROM message WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $rowCount = $result->fetch_assoc();
    $messageCount = $rowCount['message_count'];
    
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($ress->num_rows > 0) {
            $rows = $ress->fetch_assoc();
            echo json_encode([
                'username' => $username,
                'img' => htmlspecialchars($row['img']),
                'name' => htmlspecialchars($rows['name']),
                'row' => htmlspecialchars($rows['id']),
                'profession' => htmlspecialchars($rows['profession']),
                'number' => $messageCount
            ]);
        }
    }
}

$connection->close();
?>
