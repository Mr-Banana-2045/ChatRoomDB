<html style="-webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;" oncontextmenu="return false;" onkeydown="if(!event.target.matches('input')&&!event.target.matches('textarea'))return!1" oncontextmenu="return!1" onselectstart="return!1" ondragstart="return!1">
   <head>
   <link rel="stylesheet" href="style.css">
   </head>
<body style="
  background-color: #ffffff;
  background-image: radial-gradient(rgba(12, 12, 12, 0.171) 2px, transparent 0);
  background-size: 30px 30px; font-family: 'Comic Sans MS', cursive, sans-serif;
font-size: 15px;
letter-spacing: 0.6px;
word-spacing: 2px;
color: #000000;
font-weight: normal;
text-decoration: none;
font-style: normal;
font-variant: normal;
text-transform: none; ">
<div class="wrapper">
        <div class="card-switch">
            <label class="switch">
               <input type="checkbox" class="toggle">
               <span class="slider"></span>
               <span class="card-side"></span>
               <div class="flip-card__inner">
                  <div class="flip-card__front">
                     <div class="title">Log in</div>
                     <form class="flip-card__form" method="POST" action="up.php?action=login">
                     <input type="hidden" name="action" value="login">
                        <input class="flip-card__input" type="text" name="username" placeholder="username">
                        <input class="flip-card__input" type="password" name="password" placeholder="password">
                        <button class="flip-card__btn" type="submit">Let`s go!</button><a style="margin-top:-20px; color:blue; text-decoration:none;" href="reg.php">register account</a>
                     </form>
                  </div>
                  <div class="flip-card__back">
                     <div class="title">Sign up</div>
                     <form class="flip-card__form" method="POST" action="login.php" enctype="multipart/form-data">
                     <input class="flip-card__input" type="file" name="file" accept="image/*" required>
                        <input class="flip-card__input" type="text" name="name" placeholder="name">
                        <input class="flip-card__input" type="text" name="username" placeholder="username" pattern="(?=.*[a-z]).{5}" title="Only 5 small letters">
                        <input class="flip-card__input" type="password" name="password" placeholder="password">
                        <button class="flip-card__btn" type="submit">Confirm!</button>
                     </form>
                  </div>
               </div>
            </label>
        </div>   
   </div>
   </body>
</html>