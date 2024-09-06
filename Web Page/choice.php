<?php
session_start();
if($_SESSION['verify']=="ok"||$_SESSION['verify']=="admin"){
    
// echo $_SESSION['verify'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style_choice.css">
    </head>
    <body >


    <div class="center">
    <h1>Welcome <?=$_SESSION['name']?>!!</h1>
        <div class="center2">
            <div>
                <button onclick="location.href='mypage.php'">Mypage</button>
            </div>
            <div>
                <button onclick="location.href='index.php'">Board</button>
            </div>

            <div>
                <?php if($_SESSION['verify']=="admin"){ ?>
                    <button onclick="location.href='qna.php'">Q&A</button>
                <?php } ?> 
            </div>
            <div>
                <button onclick="location.href='calender.php'">Calender</button>
            </div>
            <div>
                <button onclick="location.href='logout.php'">Logout</button>
            </div>
        </div>
    </div>
    </body>
</html>


<?php
}else{
    header("Location: login.php");
}
?>
                