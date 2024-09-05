<?php
session_start();
include "DB.php";
include "func.php";
// echo "good";
$idx=$_POST['idx'];
$idx=block($idx);
$idx=mysqli_real_escape_string($conn,$idx);
$idxRe=$_POST['re_idx'];
$content=$_POST['reply_modify'];
// echo $idx."+";
// echo $idxRe."+";
echo $content;
// $conn=$conn_reply;
$sql_check="SELECT * FROM ripple WHERE idxRe='$idxRe' and boardNum='$idx'";
$result=mysqli_query($conn,$sql_check);
$row=mysqli_num_rows($result);
if($row > 0){
    if($row['name']==$_SESSION['name']){

    $content=mysqli_real_escape_string($conn,$content);
    $idxRe=mysqli_real_escape_string($conn_reply,$idxRe);

    $reply_sql = "UPDATE ripple SET content = '$content' WHERE idxRe = '$idxRe'";
    $reply_result = mysqli_query($conn, $reply_sql);

    if($reply_result){
        header("Location: ./detail.php?idx=$idx");
        exit();
    }else{
        echo "<script> alert(\"Failed\")</script>";
    }
    }else{
        echo "<script>alert(\"Error!!\"); history.back(1);</script>";
    }
}else{
    echo "<script>alert(\"Error!!\"); history.back(1);</script>";
}
?>