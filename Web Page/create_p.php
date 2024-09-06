
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


    // $conn= $conn_board;

    $title =$_POST['title'];
    $content=$_POST['content'];
    $password=$_POST['password'];
    date_default_timezone_set('Asia/Seoul');
    $date=date("Y-m-d");
    $author=$_POST['author'];
    

    $title=block($title);
    $password=block($password);
    $author=block($author);
    $content=block($content);

    $title=mysqli_real_escape_string($conn,$title);
    $password=mysqli_real_escape_string($conn,$password);
    $author=mysqli_real_escape_string($conn,$author);
    $content=mysqli_real_escape_string($conn,$content);


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
    
    // echo $filecontent;
    // echo $mime;
    $stmt = $conn->prepare("INSERT INTO board (title, content, date, author, pwd, filename, filecontent, mime) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssbs", $title, $content, $date, $author, $password, $filename, $n, $mime);
    if ($filecontent !== null) {
        $stmt->send_long_data(6, $filecontent);
    }
    $result_insert = $stmt->execute();
    
    if($result_insert){
        header("Location: index.php");
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