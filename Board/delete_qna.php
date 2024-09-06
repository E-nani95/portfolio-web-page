<?php
session_start();
include "func.php";
include "DB.php";
// print($_POST['idx']);



$idx=$_POST['idx'];
// $conn=$conn_qna;
$idx=block($idx);
$idx=mysqli_real_escape_string($conn,$idx);



$sql_delete="DELETE FROM qna WHERE idx='$idx'";
$result_delete=mysqli_query($conn,$sql_delete);
    if($result_delete){
        header("Location: qna.php");
        exit();
    }else{
        echo "<script>alert(\"Fail DELETE\"); history.back(1);</script>";
        exit();      
    }


?>