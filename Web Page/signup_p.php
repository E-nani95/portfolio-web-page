<?php
include "func.php";
include "DB.php";

$Empty='';
if(empty($_POST['id'])){
    echo "<script> alert(\"EmptyId\"); history.back(1); </script>";
    exit();
}else{
    $EmptyId="v";
    $Empty = $Empty.$EmptyId;
}
if(empty($_POST['password'])){
    echo "<script> alert(\"EmptyPassword\"); history.back(1); </script>";
    exit();
}else{
    $EmptyPW="e";
    $Empty = $Empty.$EmptyPW;
}

if(empty($_POST['repassword'])){
    echo "<script> alert(\"EmptyCheckPassword\"); history.back(1); </script>";
    exit();
}else{
    $EmptyRPW="n";
    $Empty = $Empty.$EmptyRPW;
}
if(empty($_POST['email'])){
    echo "<script> alert(\"EmptyEmail\"); history.back(1); </script>";
    exit();
}else{
    $EmptyEmail="t";
    $Empty = $Empty.$EmptyEmail;
}
if(empty($_POST['name'])){
    echo "<script> alert(\"EmptyName\"); history.back(1); </script>";
    exit();
}else{
    $EmptyName="i";
    $Empty = $Empty.$EmptyName;
}

// echo $Empty;
if($Empty =="venti"){
    // echo "Success";


    // $conn= $conn_login;

    $id =$_POST['id'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $email=$_POST['email'];
    $name=$_POST['name'];



    $id=block($id);
    $password=block($password);
    $repassword=block($repassword);
    $email=block($email);
    $name=block($name);

    $id=mysqli_real_escape_string($conn,$id);
    $password=mysqli_real_escape_string($conn,$password);
    $repassword=mysqli_real_escape_string($conn,$repassword);
    $email=mysqli_real_escape_string($conn,$email);
    $name=mysqli_real_escape_string($conn,$name);


    if($password==$repassword){
        $checkPassword=CheckPassword($password);
        if($checkPassword !="True"){
            echo "<script> alert(\"Weak Password\"); history.back(1); </script>";
            exit();
        }
        // echo "Good";
        $sql_ID_Check="SELECT * FROM users WHERE id = '$id'";
        $result_ID_Check=mysqli_query($conn,$sql_ID_Check);
        $row_ID_Check=mysqli_num_rows($result_ID_Check);
        // echo $row;

        if($row_ID_Check === 0){
            $sql_name_Check="SELECT * FROM users WHERE name = '$name'";
            $result_name_Check=mysqli_query($conn,$sql_name_Check);
            $row_name_Check=mysqli_num_rows($result_name_Check);
            if($row_name_Check === 0){
                $sql_Email_Check="SELECT * FROM users WHERE  email = '$email'";
                $result_Email_Check=mysqli_query($conn,$sql_Email_Check);
                $row_Email_Check=mysqli_num_rows($result_Email_Check);
                if($row_Email_Check === 0){
                    $password=password_hash($password,PASSWORD_DEFAULT);
                    // echo $password;
                    $sql_signup="INSERT INTO users (id, password, name, email) VALUES ('$id', '$password', '$name', '$email')";
                    $result_signup=mysqli_query($conn,$sql_signup);
                    if($result_signup){
                        header("Location: login.php");
                        exit();
                    }else{
                        echo "<script> alert(\"FailSignUp\"); history.back(1); </script>";
                        exit();
                    }
                }else{
                    echo "<script> alert(\"Email already exists!!\"); history.back(1); </script>";
                    exit();
                }
            }else{
                echo "<script> alert(\"name already exists!!\"); history.back(1); </script>";
                exit();
            }
        }else{
            echo "<script> alert(\"ID already exists!!\"); history.back(1); </script>";
            exit();
        }
    }else{
        echo "<script> alert(\"IncorrectPW\"); history.back(1); </script>";
        exit();
    }



    // echo $id."\n";
    // echo $password."\n";
    // echo $repassword."\n";
    // echo $email."\n";
    // echo $name;    
}else{
    header("Location: signup.php?YouWentToTheWrongWay");
}

?>