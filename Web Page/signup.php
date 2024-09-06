<?php
session_start();
include "DB.php";
include "func.php";
if(isset($_SESSION['test'])){
    if($_SESSION['test']=="good"){
        $check=$_SESSION['check'];
        if(!empty($check)){
        $check=block($check);
        $check=mysqli_real_escape_string($conn,$check);
        unset($_SESSION['check']);
        unset($_SESSION['test']);
        $i="test";  
        }else{
            $i="test1";
            unset($_SESSION['check']);
            unset($_SESSION['test']);
        }
    }else{
        $i="test2";
        unset($_SESSION['check']);
        unset($_SESSION['test']);
    }
}else{
    $i="test3";
    unset($_SESSION['check']);
    unset($_SESSION['test']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_signup.css">
</head>
<body>
    <div class="form-container">
        <h1>Sign Up</h1>
        <hr>
        <form action="" method="POST">
            <div class="input">
                <input type="text" name="id" id="check" placeholder="ID를 입력하세요">
                <input type="text" name="email" placeholder="E-Mail을 입력하세요">
                <input type="text" name="name" placeholder="이름을 입력하세요">
                <input type="text" name="address" id="address" placeholder="주소를 입력하세요">
                <input type="password" name="password" placeholder="비밀번호를 입력하세요">
                <input type="password" name="repassword" placeholder="비밀번호 확인">
            </div>
            <button type="submit" formaction="signup_p.php">Sign Up</button>
            <button type="submit" formaction="login.php">Back</button>
        </form>
    </div>
</body>
</html>



<script>
    // 아이디 중복 새창
    let check = document.getElementById('check');
    check.addEventListener("click",()=>{
        // alert(1);
        // console.log(event.target.value);
        // let target = event.target.value;
        let url_check="idcheck.php";
        let windowName="_blank";
        let frame_check="width=400 height=400"
       
        window.open(url_check,windowName,frame_check);
    })
</script>

<!-- <script>
    // 아이디 중복 새창
    let check = document.getElementById('check');
    check.addEventListener("change",(event)=>{
        // alert(1);
        // console.log(event.target.value);
        // let target = event.target.value;
        let url_check="idcheck.php?check="+event.target.value;
        let windowName="_blank";
        let frame_check="width=400 height=400"
       
        window.open(url_check,windowName,frame_check);
    })
</script> -->


<!-- <script>
    // 아이디 중복 창안염
    let check = document.getElementById('check');
    check.addEventListener("change",(event)=>{
        // alert(1);
        // console.log(event.target.value);
        let target = event.target.value;  //<- 필드에 입력
        location.href="idcheck.php?check="+target;
        // let url_check="idcheck.php";
        // let windowName="_blank";
        // let frame_check="width=400 height=400"
       
        // window.open(url_check,windowName,frame_check);
    })
</script> -->

<script>

    // 주소
    let address = document.getElementById('address');
    address.addEventListener("click",() => {
        let url='address.php';
        let feature='width=900, height=400';
        let dow = '_blank';
        window.open(url,dow,feature);
        // alert(1);
    });
</script>