<html>
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
                        <button class="flip-card__btn" type="submit">Let`s go!</button>
                     </form>
                  </div>
                  <div class="flip-card__back">
                     <div class="title">Sign up</div>
                     <form class="flip-card__form" method="GET" action="login.php">
                        <input class="flip-card__input" type="text" name="name" placeholder="name">
                        <input class="flip-card__input" type="text" name="username" placeholder="username">
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