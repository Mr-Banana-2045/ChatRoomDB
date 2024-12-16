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

    public function save($human, $passwd, $image) {
        $stmt = $this->connection->prepare("INSERT INTO user (name, username, profession, password, img) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $human->name, $human->username, $human->profession, $passwd->password, $image->img);
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
    public $profession;
    public function user($name, $username, $profession) {
        $this->name = $name;
        $this->username = $username;
        $this->profession = $profession;
    }
}

class Image {
    public $img;
    public function images($img) {
        $this->img = $img;
    }
}

class passwd {
    public $password;
    public function pwd($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_FILES['file'])) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['file'] = $_FILES['file'];

        $connection = new Start();
        $users = new Human();
        $pass = new passwd();
        $photo = new Image();
        
        $file = $_FILES['file'];
        $targetDir = "photo/";
        $targetFile = $targetDir . basename($file["name"]);
        $uploadOk = 1;

        $check = getimagesize($file["tmp_name"]);
        if($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if(!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $users->user($_POST['name'], $_POST['username'], "member");
                $pass->pwd($_POST['password']);
                $photo->images($targetFile); 
                $connection->save($users, $pass, $photo);
                header("Location: http://localhost/chatroom/chat.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $connection->getConnect()->close();
    } else{
        echo "error";
    }
}
?>