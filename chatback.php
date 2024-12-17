<?php
session_start();
class Start {
private $connection;
private $host = 'localhost';
private $user = 'root';
private $pass = '';
private $datadb = 'chatroom';
public function __construct() {
$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->datadb);
if ($this->connection->connect_error) {
die("Connection failed: " . $this->connection->connect_error);
}
}
public function save($human,$times) {
    $stmt = $this->connection->prepare("SELECT img FROM user WHERE username = ?");
    $stmt->bind_param("s", $human->name);
    $stmt->execute();
    $stmt->bind_result($img);
    $stmt->fetch();
    $stmt->close();

    $stmt = $this->connection->prepare("INSERT INTO message (name, msg, time, img) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $human->name, $human->msg, $times->time, $img);
    $stmt->execute();
    $stmt->close();
}
public function getConnect() {
return $this->connection;
}
}
class Human {
public $name;
public $msg;
public $img;
public function user($name,$msg) {
$this->name = $name;
$this->msg = $msg;
}
}
class Times {
    public $time;
    public function tim($time) {
        $this->time = $time;
    }
}
if (isset($_SESSION['username']) && isset($_GET['msg'])) {
    $connection = new Start();
    $users = new Human();
    $date = new Times();

    $users->user($_SESSION['username'], $_GET['msg']);
    $date->tim(date("H:i | Y-m-d"));
    $connection->save($users,$date);

    header("Location: http://localhost/chatroom/chat.php");
    $connection->getConnect()->close();
    }
?>