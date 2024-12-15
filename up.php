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
    public function authenticate($user, $password) {
        $stmt = $this->connection->prepare("SELECT password FROM user WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        if ($stmt->fetch()) {
            if (password_verify($password, $hashedPassword)) {
                return true;
            }
        }
        $stmt->close();
        return false;
    }
    public function getConnect() {
        return $this->connection;
    }
}

class Human {
    public $username;
    public function user($username) {
        $this->username = $username;
    }
}


class Passwords {
    public $password;
    public function pass($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $_SESSION['username'] = $_POST['username'];
    $connection = new Start();
    if ($_GET['action'] == 'login') {
        $user = $_POST['username'];
        $password = $_POST['password'];
        if ($connection->authenticate($user, $password)) {
            header("Location: http://localhost/chatroom/chat.php");
        } else {
            echo 'error';
        }
    }
    $connection->getConnect()->close();
}
?>