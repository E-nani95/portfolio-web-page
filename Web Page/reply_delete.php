<?php
session_start();
include "DB.php";
include "func.php";

// echo $_POST['reply_checkbox'];
// echo $_POST['reply_idx'];
$idx=$_POST['reply_idx'];
$idxRe= $_POST['reply_checkbox'];

$idx=block($idx);
$idxRe=block($idxRe);

$idx=mysqli_real_escape_string($conn,$idx);
$idxRe=mysqli_real_escape_string($conn,$idxRe);
$sql_check="SELECT * FROM ripple WHERE boardNum='$idx'";
$result=mysqli_query($conn,$sql_check);
$row=mysqli_fetch_array($result);

if($_SESSION['name'] == $row['name']  || $_SESSION['verify'] == "admin"){

    
    if($_SESSION['verify'] == "admin"){
        // $password=$row['pwd'];
    }else{
        if(empty($_POST['reply_idx'])){
            echo"<script>alert(\"Error\"); history.back(1); </script>";
            exit();
        }
        if(!isset($_POST['reply_idx'])){
            echo"<script>alert(\"Error\"); history.back(1); </script>";
            exit();
        }
        if(empty($_POST['reply_checkbox'])){
            echo"<script>alert(\"Error\"); history.back(1); </script>";
            exit();
        }
        if(!isset($_POST['reply_checkbox'])){
            echo"<script>alert(\"Error\"); history.back(1); </script>";
            exit();
        }
    }

// $conn=$conn_reply;
// $idx=$_POST['reply_idx'];
// $idxRe= $_POST['reply_checkbox'];

// $idx=block($idx);
// $idxRe=block($idxRe);

// $idx=mysqli_real_escape_string($conn,$idx);
// $idxRe=mysqli_real_escape_string($conn,$idxRe);

$sql="DELETE FROM ripple WHERE idxRe = '$idxRe'";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location: detail.php?idx=$idx");
    exit();
}

}else{
    header("Location: detail.php?idx=$idx");
    exit();
}
?>