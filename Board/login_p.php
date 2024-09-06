<?php
session_start();
include "DB.php";
include "func.php";

if(empty($_POST['id'])){
    echo "<script> 
    alert(\"EmptyId\"); 
    history.back(1); 
    </script>";
    exit();
}
if(empty($_POST['password'])){
    echo"<script>
    alert(\"EmptyPassWord\");
    history.back(1);
    </script>";
    exit();
}

if(!isset($_POST['id'])){
    echo "<script> 
    alert(\"ProcesssIdError\"); 
    history.back(1); 
    </script>";
    exit();
}
if(!isset($_POST['password'])){
    echo "<script> 
    alert(\"ProcesssPWError\"); 
    history.back(1); 
    </script>";
    exit();
}


$id=$_POST['id'];
$password=$_POST['password'];

$id=block($id);
$password=block($password);

// $conn=$conn_login;

$id=mysqli_escape_string($conn,$id);
$password=mysqli_escape_string($conn,$password);

$sql="SELECT * FROM users where id = '$id'";
$result=mysqli_query($conn,$sql);

if($row=mysqli_fetch_assoc($result)){
    // echo "good";
    $check=password_verify($password,$row['password']);
    if($check){
        // echo "test success";
        $_SESSION['id']=$row['id'];
        $_SESSION['idx']=$row['idx'];
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        if($row['id']=="admin"){
            $_SESSION['verify']="admin";
        }else{
            $_SESSION['verify']="ok";
        }
        header("location: choice.php");
    }else{
        // echo "Incorrect";
        echo "<script>
        alert(\"IncorrectPW\");
        history.back(1);
        </script>";
        exit();
    }
}else{
    echo "<script>
    alert(\"IncorrectID\");
    history.back(1);
    </script>";
    exit();   
}





// print($id);
// print($password);
?>