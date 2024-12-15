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
public function save($human,$passwd) {
$stmt = $this->connection->prepare("INSERT INTO user (name,username,password) VALUES (?,?,?)");
$stmt->bind_param("sss", $human->name, $human->username,$passwd->password);
$stmt->execute();
$stmt->close();
}
public function getConnect() {
return $this->connection;
}
}
class Human {
public $name;
public $username;
public function user($name,$username) {
$this->name = $name;
$this->username = $username;
}
}
class passwd {
    public $password;
    public function pwd($password) {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}
if (isset($_GET['name']) && isset($_GET['username']) && isset($_GET['password'])) {
$_SESSION['username'] = $_GET['username'];
$connection = new Start();
$users = new Human();
$pass = new passwd();
$users->user($_GET['name'], $_GET['username']);
$pass->pwd($_GET['password']);
$connection->save($users,$pass);
header("Location: http://localhost/chatroom/chat.php");
$connection->getConnect()->close();
}

?>