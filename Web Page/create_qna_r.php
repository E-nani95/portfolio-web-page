<?php
include "func.php";
include "DB.php";

// echo $_POST['idx'];
$Empty='';
if(empty($_POST['admin'])){
    echo "<script> alert(\"Empty\"); history.back(1); </script>";
    exit();
}else{
    $EmptyId="o";
    $Empty = $Empty.$EmptyId;
}


// echo $Empty;
if($Empty =="o"){
    // echo "Success";


    // $conn= $conn_qna;
    $idx=$_POST['idx'];
    $admin =$_POST['admin'];
    

    $admin=block($admin);
    $idx=block($idx);

    $idx=mysqli_real_escape_string($conn,$idx);
    $admin=mysqli_real_escape_string($conn,$admin);

    // echo $title;
    // echo $content;
    // echo $author;
    // echo $password;
    // echo $date;
    $sql_admin="UPDATE qna SET admin = '$admin' WHERE idx = '$idx'";

    $result_admin=mysqli_query($conn,$sql_admin);
    if($result_admin){
        header("Location: qna_detail.php?idx=$idx");
        exit();
    }else{
        echo "<script> alert(\"Fail Create\"); history.back(1); </script>";
        exit();
    }
}else{
    header("Location: signup.php?YouWentToTheWrongWay");
    exit();
}
?>