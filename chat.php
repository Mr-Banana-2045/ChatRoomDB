<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: http://localhost/chatroom");
}
?>
<html style="-webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;" oncontextmenu="return false;" onkeydown="if(!event.target.matches('input')&&!event.target.matches('textarea'))return!1" oncontextmenu="return!1" onselectstart="return!1" ondragstart="return!1">
<link rel="stylesheet" href="style.css">
<script src="jquery-3.6.0.min.js"></script>
<body style="background-color: #ffffff;
  font-family: 'Lucida Console', 'Courier New', monospace;
  background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
  background-size: 30px 30px;">
    <div class="chatname"><h1>Chatroom</h1><h3 style="color:white;">Welcome <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'unknown'; ?></h3>
    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" style="margin-right:40px; float:right; margin-top:-75px;" onclick="showUserInfomy(<?php $_SESSION['username']; ?>)">
                                    <path opacity="0.4" d="M2 12.8799V11.1199C2 10.0799 2.85 9.21994 3.9 9.21994C5.71 9.21994 6.45 7.93994 5.54 6.36994C5.02 5.46994 5.33 4.29994 6.24 3.77994L7.97 2.78994C8.76 2.31994 9.78 2.59994 10.25 3.38994L10.36 3.57994C11.26 5.14994 12.74 5.14994 13.65 3.57994L13.76 3.38994C14.23 2.59994 15.25 2.31994 16.04 2.78994L17.77 3.77994C18.68 4.29994 18.99 5.46994 18.47 6.36994C17.56 7.93994 18.3 9.21994 20.11 9.21994C21.15 9.21994 22.01 10.0699 22.01 11.1199V12.8799C22.01 13.9199 21.16 14.7799 20.11 14.7799C18.3 14.7799 17.56 16.0599 18.47 17.6299C18.99 18.5399 18.68 19.6999 17.77 20.2199L16.04 21.2099C15.25 21.6799 14.23 21.3999 13.76 20.6099L13.65 20.4199C12.75 18.8499 11.27 18.8499 10.36 20.4199L10.25 20.6099C9.78 21.3999 8.76 21.6799 7.97 21.2099L6.24 20.2199C5.33 19.6999 5.02 18.5299 5.54 17.6299C6.45 16.0599 5.71 14.7799 3.9 14.7799C2.85 14.7799 2 13.9199 2 12.8799Z" fill="#babcbe"/>
                                    <path d="M12 15.25C13.7949 15.25 15.25 13.7949 15.25 12C15.25 10.2051 13.7949 8.75 12 8.75C10.2051 8.75 8.75 10.2051 8.75 12C8.75 13.7949 10.2051 15.25 12 15.25Z" fill="#292D32"/></svg>
</div>
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
                        $name = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); 
        
                        if (!in_array($name, $displayedNames)) {
                            $messageClass = ($name === htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8')) ? 'user-name' : 'other-name';
                            if ($messageClass === 'other-name') {
                                echo '<div class="name ' . htmlspecialchars($messageClass, ENT_QUOTES, 'UTF-8') . '" style="margin-left: 0px;"><p style="margin-top:10px;">' . $name . '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" style="margin-right:10px; float:left;" id="info" onclick="showUserInfo(\'' . $name . '\')">
                                    <path opacity="0.4" d="M2 12.8799V11.1199C2 10.0799 2.85 9.21994 3.9 9.21994C5.71 9.21994 6.45 7.93994 5.54 6.36994C5.02 5.46994 5.33 4.29994 6.24 3.77994L7.97 2.78994C8.76 2.31994 9.78 2.59994 10.25 3.38994L10.36 3.57994C11.26 5.14994 12.74 5.14994 13.65 3.57994L13.76 3.38994C14.23 2.59994 15.25 2.31994 16.04 2.78994L17.77 3.77994C18.68 4.29994 18.99 5.46994 18.47 6.36994C17.56 7.93994 18.3 9.21994 20.11 9.21994C21.15 9.21994 22.01 10.0699 22.01 11.1199V12.8799C22.01 13.9199 21.16 14.7799 20.11 14.7799C18.3 14.7799 17.56 16.0599 18.47 17.6299C18.99 18.5399 18.68 19.6999 17.77 20.2199L16.04 21.2099C15.25 21.6799 14.23 21.3999 13.76 20.6099L13.65 20.4199C12.75 18.8499 11.27 18.8499 10.36 20.4199L10.25 20.6099C9.78 21.3999 8.76 21.6799 7.97 21.2099L6.24 20.2199C5.33 19.6999 5.02 18.5299 5.54 17.6299C6.45 16.0599 5.71 14.7799 3.9 14.7799C2.85 14.7799 2 13.9199 2 12.8799Z" fill="#babcbe"/>
                                    <path d="M12 15.25C13.7949 15.25 15.25 13.7949 15.25 12C15.25 10.2051 13.7949 8.75 12 8.75C10.2051 8.75 8.75 10.2051 8.75 12C8.75 13.7949 10.2051 15.25 12 15.25Z" fill="#292D32"/></svg></p></div>';
                            } else {
                                echo '<div class="name ' . htmlspecialchars($messageClass, ENT_QUOTES, 'UTF-8') . '"><p style="margin-top:10px;">' . $name . '</p></div>';
                            }
        
                            $displayedNames[] = $name;
                        }
                    }
                } else {
                    echo '<div>No Users</div>';
                }
                
                $connection->close();
        ?>
    </div>
    <div class="cou-msg" id="themsg">
    </div>
    </div>
    <dialog class="info" id="user-info">
    <button onclick="closeInfo()" style="float:left; margin-top:10px; margin-left:5px; background:black; border-radius:20px; border:none; padding:10px;"></button>
    <p>Info <span id="user-name"></span></p>
    <div id="user-image"></div>
    <p id="user-names"></p>
    <p id="user-profession"></p>
    <p id="user-number"></p>
</dialog>
<dialog class="info" id="user-infomy">
    <button onclick="closeInfomy()" style="float:left; margin-top:10px; margin-left:5px; background:black; border-radius:20px; border:none; padding:10px;"></button>
    <p>Info <span id="user-namemy"></span></p>
    <div id="user-imagemy"></div>
    <div style="display:none; margin-top:5px;" id="changes">
        <form id="change">
            <input type="text" name="name" placeholder="name" style="border:2px solid black; border-radius:10px 0px 0px 10px; padding:5px;">
            <input type="submit" value="save" class="inpname" style="border:2px solid black; border-radius:0px 10px 10px 0px; padding:5px; margin-left:-10px;">
        </form>
    </div>
    <p id="user-namesmy"></p>
    <p id="user-professionmy"></p>
    <p id="user-numbermy"></p>
    <p id="user-devicemy"></p>
</dialog>
<dialog id="msgs" style="background: #ffffffd8;
  padding: 10px;
  border-radius: 20px;
  width: 200px;
  height: 150px;
  text-align: center;">
<button onclick="closemsg()" style="float:left; margin-top:10px; margin-left:5px; background:black; border-radius:20px; border:none; padding:7px;"></button><h3>Change Message</h3>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="">
        <textarea name="msg" style="border:2px solid black; border-radius:10px; padding:5px; font-weight:900;"></textarea>
        <button type="submit" style="margin-top:10px; border:2px solid black; border-radius:10px; padding:10px; width:100px; font-weight:900;">Save</button>
    </form>
</dialog>
    </div>
    <div class="forms">
    <form id="forms">
    <div class="messageBox">
  <input required="" placeholder="Message..." type="text" name="msg" id="messageInput" pattern="^[a-zA-Z0-9 ]{1,100}$" title="The number of characters is more than 100, illegal characters"/>
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
            $('#forms').on('submit', function(event){
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
            $('#change').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: 'change.php',
                    type: 'GET',
                    data: $(this).serialize(),
                    success: function(data) {
                            window.location.href = "chat.php";
                    }
                });
            });
        });
        
        function checkForUpdates() {
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_data.php", true);
        xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById("themsg").innerHTML = this.responseText;
            const msgContainer = document.getElementById("themsg");
            msgContainer.scrollTop = msgContainer.scrollHeight;
        } else {
            console.error('Error fetching data: ' + this.status);
        }
    };
    xhr.onerror = function() {
        console.error('Request failed');
    };
    xhr.send();
}
setInterval(checkForUpdates, 1000);
        </script>
<script>
function closeInfo() {
    document.getElementById('user-info').style.display = 'none';
    document.getElementById('user-info').close();
    document.body.classList.remove("blur");
}
function closeInfomy() {
    document.getElementById('user-infomy').style.display = 'none';
    document.getElementById("changes").style.display = "none";
    document.getElementById("user-namesmy").style.display = "block";
    document.getElementById('user-infomy').close();
    document.body.classList.remove("blur");
}

function chmsg(messageId, currentMessage) {
    document.querySelector('input[name="id"]').value = messageId;
    document.querySelector('textarea[name="msg"]').value = currentMessage;
    document.getElementById('msgs').showModal();
}
function closemsg() {
    document.querySelector('input[name="id"]').value = '';
    document.querySelector('textarea[name="msg"]').value = '';
    document.getElementById('msgs').close();
}
function showUserInfo(name) {
    $.ajax({
        url: 'getUserInfo.php',
        type: 'GET',
        data: { username: name, name: name, row: name, profession: name },
        success: function(data) {
            var userInfo = JSON.parse(data);
            document.getElementById('user-name').innerText = userInfo.username;
            document.getElementById('user-image').innerHTML = '<img src="' + userInfo.img + '" class="images">';
            document.getElementById('user-names').innerText = "name : " + userInfo.name + ' | row : ' + userInfo.row;
            document.getElementById('user-profession').innerText = "profession : " + userInfo.profession;
            document.getElementById('user-number').innerText = "NumberOFMessage : " + userInfo.number;
            document.getElementById('user-info').style.display = 'block';
            document.getElementById('user-info').showModal();
            document.body.classList.add("blur");
        }
    });
}

function showUserInfomy(<?php $_SESSION['username']; ?>) {
    $.ajax({
        url: 'getUserInfomy.php',
        type: 'GET',
        data: { username: name, name: name, row: name, profession: name, device: name },
        success: function(data) {
            var userInfos = JSON.parse(data);
            document.getElementById('user-namemy').innerText = userInfos.username;
            document.getElementById('user-imagemy').innerHTML = '<img src="' + userInfos.img + '" class="images">';
            document.getElementById('user-namesmy').innerHTML = "name : " + userInfos.name + '<svg width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="margin-left:10px;" onclick="chname()"><path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="blue" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="blue" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg> | row : ' + userInfos.row;
            document.getElementById('user-professionmy').innerText = "profession : " + userInfos.profession;
            document.getElementById('user-numbermy').innerText = "NumberOFMessage : " + userInfos.number;
            document.getElementById('user-devicemy').innerText = "Device : " + userInfos.device;
            document.getElementById('user-infomy').style.display = 'block';
            document.getElementById('user-infomy').showModal();
            document.body.classList.add("blur");
        }
    });
}
function chname(){
    document.getElementById("changes").style.display = "block";
    document.getElementById("user-namesmy").style.display = "none";
}
</script>
</html>
