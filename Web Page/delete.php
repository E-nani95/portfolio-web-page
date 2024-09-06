<?php
session_start();
include "func.php";
include "DB.php";
// print($_POST['idx']);


// if(empty($_POST['password'])){
//     echo"<script>
//     alert(\"EmptyPassWord\");
//     history.back(1);
//     </script>";
// }

// if(!isset($_POST['password'])){
//     echo "<script> 
//     alert(\"ProcesssPWError\"); 
//     history.back(1); 
//     </script>";
// }
$idx=$_POST['idx'];
$idx=mysqli_real_escape_string($conn,$idx);
$sql_check="SELECT * FROM board WHERE idx='$idx'";
$result=mysqli_query($conn,$sql_check);
$row=mysqli_fetch_array($result);
echo $_SESSION['name'];
if($_SESSION['name'] == $row['author']  || $_SESSION['verify'] == "admin"){

$idx=$_POST['idx'];
$password=$_POST['password'];
$password=block($password);
$idx=block($idx);
$password=mysqli_real_escape_string($conn,$password);
$idx=mysqli_real_escape_string($conn,$idx);
    
if($_SESSION['verify'] == "admin"){
    $pass="pass";
}else{
    if(empty($_POST['password'])){
        echo"<script>alert(\"Fill FW\"); history.back(1); </script>";
        exit();
    }
    if(!isset($_POST['password'])){
        echo"<script>alert(\"Fill E-Mail\"); history.back(1); </script>";
        exit();
    }
}
// $conn=$conn_board;



$sql_check="SELECT * FROM board WHERE idx='$idx'";
$result=mysqli_query($conn,$sql_check);
$row=mysqli_fetch_assoc($result);

if($password == $row['pwd'] || isset($pass)){
    $sql_delete="DELETE FROM board WHERE idx='$idx'";
    $result_delete=mysqli_query($conn,$sql_delete);
    if($result_delete){
        header("Location: index.php");
        exit();
    }else{
        echo "<script>alert(\"Fail DELETE\"); history.back(1);</script>";
        exit();      
    }

}else{
        echo "<script>alert(\"Incorrect PassWord\"); history.back(1);</script>";
        exit();  
    }

}else{
    echo"<script>alert(\"GET BACK\"); history.back(1); </script>";
    exit();
}    
?>