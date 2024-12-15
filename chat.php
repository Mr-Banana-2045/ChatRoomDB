<?php
session_start();
?>
<html>
<link rel="stylesheet" href="style.css">
<script src="jquery-3.6.0.min.js"></script>
<body style="  background-color: #ffffff; font-family: 'Lucida Console', 'Courier New', monospace;
  background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
  background-size: 30px 30px;">
    <div class="chatname"><h1>Chatroom</h1><h3 style="color:white;">Welcome <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'unknown'; ?></h3></div>
    <div class="container">
    <div class="cou-name">
        <h3 style="color:white;">Users</h3>
        <?php
                $host = 'localhost';
                $user = 'root';
                $pass = '';
                $datadb = 'chatroom';
                
                $connection = new mysqli($host, $user, $pass, $datadb);
                
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                
                $res = $connection->query("SELECT * FROM message");
                
                if ($res->num_rows > 0) {
                    $displayedNames = [];
            
                    while ($row = $res->fetch_assoc()) {
                        $name = htmlspecialchars($row['name']);
                        
                        if (!in_array($name, $displayedNames)) {
                            $messageClass = ($name === htmlspecialchars($_SESSION['username'])) ? 'user-name' : 'other-name';
                            echo '<div class="name ' . $messageClass . '">' . $name . '</div>';
                        
                            $displayedNames[] = $name;
                        }
                    }
                } else {
                    echo '<div>No Message</div>';
                }
                
                $connection->close();
        ?>
    </div>
    <div class="cou-msg">
        <?php
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $datadb = 'chatroom';
        
        $connection = new mysqli($host, $user, $pass, $datadb);
        
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        
        $res = $connection->query("SELECT * FROM message");
        
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $messageClass = (htmlspecialchars($row['name']) === htmlspecialchars($_SESSION['username'])) ? 'user-message' : 'other-message';
                if ($messageClass === 'user-message') {
                    echo '<div class="message ' . $messageClass . '">' . htmlspecialchars($row['msg']) . '<p style="font-size:10px;">' . htmlspecialchars(string: $row['time']) . '</p>' . '</div>';
                } else {
                    echo '<div class="message ' . $messageClass . '"><b style="font-weight:900; font-size:15px;">' . htmlspecialchars($row['name']) . '</b><br>' . htmlspecialchars($row['msg']) . '<p style="font-size:10px;">' . htmlspecialchars(string: $row['time']) . '</p>' . '</div>';
                }
            }
        } else {
            echo '<div>No Message</div>';
        }
        
        $connection->close();
        ?>
    </div>
    </div>
    <div class="forms">
    <form>
    <div class="messageBox">
  <input required="" placeholder="Message..." type="text" name="msg" id="messageInput" />
  <button id="sendButton" type="submit">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 690 690">
      <path
        fill="none"
        d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
      <path
        stroke-linejoin="round"
        stroke-linecap="round"
        stroke-width="33.67"
        stroke="#6c6c6c"
        d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
    </svg>
  </button>
</div>
    </form>
    </div>
</body>
<script>
        $(document).ready(function(){
            $('form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: 'chatback.php',
                    type: 'GET',
                    data: $(this).serialize(),
                    success: function(data) {
                            window.location.href = "chat.php";
                    }
                });
            });
        });
    </script>
</html>

