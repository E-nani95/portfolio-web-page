
<?php
include "func.php";
include "DB.php";

$Empty='';
if(empty($_POST['reply_content'])){
    echo "<script> alert(\"Emptycontent\"); history.back(1); </script>";
    exit();
}else{
    $EmptyId="W";
    $Empty = $Empty.$EmptyId;
}


// echo $Empty;
if($Empty =="W"){
    // echo "Success";


    // $conn= $conn_reply;

    $content=$_POST['reply_content'];
    $name=$_POST['reply_name'];
    $idx=$_POST['reply_idx'];
    
    $name=block($name);
    $content=block($content);
    $idx=block($idx);

    $name=mysqli_escape_string($conn,$name);
    $content=mysqli_escape_string($conn,$content);
    $idx=mysqli_escape_string($conn,$idx);

    // echo $idx;
    // echo $content;
    // echo $name;

    $sql_insert="INSERT INTO ripple (name, content, boardNum) VALUES('$name', '$content', '$idx')";
    $result_insert=mysqli_query($conn,$sql_insert);
    if($result_insert){
        header("Location: detail.php?idx=$idx");
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