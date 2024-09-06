<?php
session_start();
include "func.php";
include "DB.php";
// if(empty($_POST['title'])){
//     echo"<script>alert(\"Fill ID \"); history.back(1); </script>";
//     exit();
// }
// if(empty($_POST['content'])){
//     echo"<script>alert(\"Fill Content \"); history.back(1); </script>";
//     exit();
// }
if(!isset($_POST['title']) && !isset($_POST['content'])){
    echo"<script>alert(\"Fill E-Mail\"); history.back(1); </script>";
    exit();
}


$idx=$_POST['idx'];
$title=$_POST['title'];
$content=$_POST['content'];
$password=$_POST['password'];
date_default_timezone_set('Asia/Seoul');
$date=date("Y-m-d");

$title=block($title);
$content=block($content);
$password=block($password);

// $conn=$conn_board;
$idx=mysqli_real_escape_string($conn,$idx);
$title=mysqli_real_escape_string($conn,$title);
$content=mysqli_real_escape_string($conn,$content);
$password=mysqli_real_escape_string($conn,$password);

$author= $_SESSION['name'];
$author=mysqli_real_escape_string($conn,$author);

$sql_check="SELECT * FROM board WHERE idx='$idx'";
$result=mysqli_query($conn,$sql_check);
$row=mysqli_fetch_array($result);
// var_dump($password);
// var_dump($row['pwd']);
// $tmpfile=$_FILES['b_file']['tmp_name'];
// $name=$_FILES['b_file']['name'];
// $folder="upload/".$name;
// var_dump($_FILES);


if($_SESSION['name'] == $row['author']  || $_SESSION['verify'] == "admin"){

    if($_SESSION['verify'] == "admin"){
       
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
    if($password == $row['pwd'] || $_SESSION['verify'] == "admin"){

        if (isset($_FILES['b_file']) && $_FILES['b_file']['error'] === UPLOAD_ERR_OK) {
            $filecontent = file_get_contents($_FILES['b_file']['tmp_name']);
            $filename = $_FILES['b_file']['name'];
            $mime = $_FILES['b_file']['type'];
        } else {
            $filecontent = NULL;
            $filename = NULL;
            $mime = NULL;
        }
        $n=NULL;
        
        // move_uploaded_file($tmpfile,$folder);
        $stmt = $conn->prepare("UPDATE board 
        SET title = ?, 
            content = ?, 
            date = ?, 
            author = ?, 
            pwd = ?, 
            filename = ?, 
            filecontent = ?, 
            mime = ? 
        WHERE idx = ?");

        $stmt->bind_param("ssssssbsi", $title, $content, $date, $author, $password, $filename, $n, $mime, $idx);
        if ($filecontent !== null) {
            $stmt->send_long_data(6, $filecontent);
        }
        $result_update = $stmt->execute();

        // $sql_update= "UPDATE board SET 
        // title = '$title',
        // content='$content',
        // date='$date',
        // author='$_SESSION[name]',
        // file='$name'
        // WHERE idx = '$idx'
        // ";


        // $result_update=mysqli_query($conn, $sql_update);
        if($result_update){
            header("Location: index.php");
            exit();
        }else{
            echo "<script>alert(\"Fail Update\"); history.back(1);</script>";
            exit();  
        }
    }else{
        echo "<script>alert(\"Incorrect PassWord\"); history.back(1);</script>";
        exit();  
    }

}else{
    echo "<script>alert(\"No Permission\"); history.back(1);</script>";
    exit();
}

?>