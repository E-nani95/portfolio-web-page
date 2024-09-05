<?php
session_start();
include "func.php";
include "DB.php";
if(empty($_POST['email'])){
    echo"<script>alert(\"Fill E-Mail\"); history.back(1); </script>";
    exit();
}
if(!isset($_POST['email'])){
    echo"<script>alert(\"Fill E-Mail\"); history.back(1); </script>";
    exit();
}
if(empty($_POST['password'])){
    echo"<script>alert(\"Fill Old PassWord\"); history.back(1); </script>";
    exit();
}
if(!isset($_POST['password'])){
    echo"<script>alert(\"Fill Old PassWord\"); history.back(1); </script>";
    exit();
}
if(!isset($_POST['check'])){
    echo"<script>alert(\"Wrong Path\"); history.back(1); </script>";
    exit();
}
if(empty($_POST['Npassword'])){
    echo"<script>alert(\"Fill New PassWord\"); history.back(1); </script>";
    exit();
}
if(!isset($_POST['Npassword'])){
    echo"<script>alert(\"Fill New PassWord\"); history.back(1); </script>";
    exit();
}
if(empty($_POST['name'])){
    echo"<script>alert(\"Fill Name\"); history.back(1); </script>";
    exit();
}
if(!isset($_POST['name'])){
    echo"<script>alert(\"Fill Name\"); history.back(1); </script>";
    exit();
}
// $conn = $conn_login;

$idx=$_SESSION['idx'];
$email=$_POST['email'];
$password=$_POST['password'];
$newpassword=$_POST['Npassword'];
$name=$_POST['name'];

$email=block($email);
$password=block($password);
$newpassword=block($newpassword);
$name=block($name);

$email=mysqli_real_escape_string($conn,$email);
$password=mysqli_real_escape_string($conn,$password);
$newpassword=mysqli_real_escape_string($conn,$newpassword);
$name=mysqli_real_escape_string($conn,$name);

$sql_check="SELECT * FROM users WHERE idx = '$idx'";
$result_check=mysqli_query($conn,$sql_check);
$row=mysqli_fetch_array($result_check);
$check=password_verify($password, $row['password']);

$sql_name_check="SELECT * FROM users WHERE name = '$name'";
$result_name_check=mysqli_query($conn,$sql_name_check);
$row_name_check=mysqli_num_rows($result_name_check);
// echo $row_name_check;
if($row_name_check === 0 OR $row_name_check['name'] == $name){
if($check){
    $newpassword=password_hash($newpassword,PASSWORD_DEFAULT);
    $sql="UPDATE users SET email = '$email', password = '$newpassword', name = '$name' WHERE idx = '$idx'";
    $result=mysqli_query($conn,$sql);
    
    if($result){
        $_SESSION['email']=$email;
        $_SESSION['name']=$name;
        header("Location: Logout.php");
        exit();
    }else{
        echo"<script>alert(\"Fail Update\"); history.back(1); </script>";
        exit();
    }
// print("CHECK");

}else{
    echo"<script>alert(\"Incorrect PW\"); history.back(1); </script>";
    exit();   
}
}else{
    echo"<script>alert(\"REwrite Name\"); history.back(1); </script>";
    exit();    
}
// print("bad");



?>