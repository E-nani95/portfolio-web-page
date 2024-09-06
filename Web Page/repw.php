<?php
include "DB.php";
include "func.php";

// $conn=$conn_login;

$pw = $_POST['pw'];
$idx=$_POST['idx'];


$pw=block($pw);

$pw = mysqli_real_escape_string($conn,$pw);
$idx = mysqli_real_escape_string($conn,$idx);




$pw=password_hash($pw,PASSWORD_DEFAULT);

$sql="UPDATE users SET password = '$pw' WHERE idx = '$idx'";
$result=mysqli_query($conn,$sql);

if($result){
    header("Location: login.php");
    exit();
}else{
    echo "<script> let a = confirm(\"Empty ID\"); if(a){location.href=\"forgetpw.php\";}else{location.href=\"forgetpw.php\";}  </script>";
    exit();
}

?>