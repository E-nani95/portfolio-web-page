<?php
include "func.php";
include "DB.php";

$Empty='';
if(empty($_POST['title'])){
    echo "<script> alert(\"EmptyId\"); history.back(1); </script>";
    exit();
}else{
    $EmptyId="j";
    $Empty = $Empty.$EmptyId;
}
if(empty($_POST['password'])){
    echo "<script> alert(\"EmptyPassword\"); history.back(1); </script>";
    exit();
}else{
    $EmptyPW="o";
    $Empty = $Empty.$EmptyPW;
}
if(empty($_POST['content'])){
    echo "<script> alert(\"EmptyPassword\"); history.back(1); </script>";
    exit();
}else{
    $EmptyPW="y";
    $Empty = $Empty.$EmptyPW;
}

// echo $Empty;
if($Empty =="joy"){
    // echo "Success";


    // $conn= $conn_qna;

    $title =$_POST['title'];
    $content=$_POST['content'];
    $password=$_POST['password'];
    date_default_timezone_set('Asia/Seoul');
    $date=date("Y-m-d");
    

    $title=block($title);
    $password=block($password);
    $content=block($content);

    $title=mysqli_real_escape_string($conn,$title);
    $password=mysqli_real_escape_string($conn,$password);
    $content=mysqli_real_escape_string($conn,$content);

    // echo $title;
    // echo $content;
    // echo $author;
    // echo $password;
    // echo $date;
    $sql_insert="INSERT INTO qna (title, content, date, password) VALUES('$title', '$content', '$date', '$password')";
    $result_insert=mysqli_query($conn,$sql_insert);
    if($result_insert){
        header("Location: qna.php");
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