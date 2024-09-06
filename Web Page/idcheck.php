<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    
    </head>
    <body>
    <h2>ID 중복검사</h2>
    <form method="POST" action="">
        <input type="text" name="check" placeholder="ID입력">
        <button type="submit">확인</button>
    </form>
    
    </body>
</html>

<?php
if(isset($_POST['check'])){
    include "DB.php";
    include "func.php";
    $check = $_POST['check'];
    // echo $check;

    $check=block($check);
    $check=mysqli_real_escape_string($conn,$check);
    $sql="SELECT * From users WHERE id = '$check'";
    $result=mysqli_query($conn, $sql);
    $row=mysqli_num_rows($result);

    if($row==0){ 
        echo "사용가능한 ID입니다."; ?>
        <button type="button" onclick="check('<?=$check?>')">사용하기</button>
    <?php }else{
        echo "사용이 불가능한 ID입니다.\n";
        echo  "다시 입력해주세요";
        }

}
?>

<script>
    function check(check){
        window.opener.document.getElementById('check').value=check;
        window.close();
    }
</script>