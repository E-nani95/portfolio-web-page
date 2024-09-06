<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style_login.css">
    </head>
    <body>
        <div class="parent">
        <div class = "logInbox">
        <h1>Login</h1>
        <form action="login_p.php" method="POST">
            <div class="input">
            <input type="text" id ="inputBox" name="id" placeholder="ID">
            <input type="password" id ="inputBox" name="password" placeholder="PASSWORD">
            </div>
            <div>
            <button type="submit" id ="button">Login</button>
            
        </form>
        <div id="etc">
            <a href='signup.php'>How about get your ID?</a>
            <a href='forget.php'>Would you forget your ID or PW?</a>
            <a href='qna.php'>Q&A</a>
    <!-- <button onclick="location.href='signup.php'">Sign Up</button> -->
        </div>
        </div>
        </div>
        </div>
    </body>
</html>