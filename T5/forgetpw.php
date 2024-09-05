<?php
session_start();
include "DB.php";
?>

<link rel="stylesheet" href="style_signup.css">
<?php
    if(isset($_POST['email']) && isset($_POST['id'])){
    if(empty($_POST['email'])){
        echo "<script> let a = confirm(\"Empty E-Mail\"); if(a){location.href=\"forgetpw.php\";}else{location.href=\"forgetpw.php\";}  </script>";
        // echo"<script>alert(\"Fail Update\"); history.back(1); </script>";
        exit();
    }
    if(empty($_POST['id'])){
        echo "<script> let a = confirm(\"Empty ID\"); if(a){location.href=\"forgetpw.php\";}else{location.href=\"forgetpw.php\";}  </script>";
        // echo "<script>alert(\"Empty ID\")</script>";
        exit();
    }
    $email=$_POST['email'];
    $id=$_POST['id'];
    // $conn=$conn_login;
    $email=mysqli_real_escape_string($conn,$email);
    $id=mysqli_real_escape_string($conn,$id);
    $sql="SELECT * from users where email='$email' and id = '$id'";
    $result=mysqli_query($conn, $sql);
    if($row=mysqli_fetch_array($result)){?>
    <div class="form-container">
        <h1>NewPW</h1>
    <form action="repw.php" method="POST" >
        <div class="input">
        <input type="password" name="pw" placeholder="PASSWORD 입력">
        <input type="password" name="repw" placeholder="RE PASSWORD 입력">
        <input type="hidden" name ="idx" value="<?php echo $row['idx']; ?>">
        </div>
        <button type="submit">GO</button>
    </form>
    </div>
<?php
    }else{
        echo "<script> let a = confirm(\"Incorrect!!\"); if(a){location.href=\"forgetpw.php\";}else{location.href=\"forgetpw.php\";} </script>";
        // echo "<script>alert(\"Incorrect!!\"); history.back(1); </script>";
        exit();
    }
}else{

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    
    <div class="form-container">
        <h1>CheckPW</h1>
        <hr>
        <form action="" method="POST">
            <div class="input">
                <input type="text" name="id" placeholder="ID를 입력하세요">
                <input type="text" name="email" placeholder="E-Mail을 입력하세요">
            </div>
            <button type="submit" formaction="">Check</button>
            <button type="submit" formaction="login.php">Back</button>
        </form>
    </div>
</body>
</html>



<?php
}
?>