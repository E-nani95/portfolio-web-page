<?php
include "DB.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_signup.css">
</head>
<body>
    <div class="form-container">
        <h1>CheckID</h1>
        <hr>
        <form action="" method="POST">
            <div class="input">
                <input type="text" name="email" placeholder="E-Mail을 입력하세요">
            </div>
            <button type="submit" formaction="">Check</button>
            <button type="submit" formaction="forgetpw.php">forgetPW</button>
            <button type="submit" formaction="login.php">Back</button>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['email'])){
    if(empty($_POST['email'])){
        echo "<script>alert(\"Empty E-Mail\")</script>";
    }
    $email=$_POST['email'];
    // $conn=$conn_login;
    $email=mysqli_real_escape_string($conn,$email);
    $sql="SELECT * from users where email='$email'";
    $result=mysqli_query($conn, $sql);
    if($row=mysqli_fetch_array($result)){
        $a=$row['id'];
        echo "<script>alert(\"Your ID == $a\")</script>";
    }else{
        echo "<script>alert(\"Incorrect!!\")</script>";
    }
}


?>
