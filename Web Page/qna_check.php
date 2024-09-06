<?php
session_start();
include "DB.php";
include "func.php";
$idx=$_GET['idx'];
$idx=block($idx);
$idx=mysqli_real_escape_string($conn,$idx);
$sql="SELECT * FROM qna where idx = '$idx'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);?>
<script>
        function a(password, idx){
            let a= prompt("비밀번호를 입력하세요");
            if(a == password){
                <?php checkI();?>
                location.href='qna_detail.php?idx='+idx;
            }else{
                let b = alert('Incorrect!!');
                if(b){
                    location.href='qna.php';
                }else{
                    location.href='qna.php';
                }
            }
        }
</script>
<?php
if(isset($_SESSION['verify'])&&$_SESSION['verify']=="admin"){
    checkI();
    header("Location: qna_detail.php?idx=$idx");
}else{ ?>
        <script>
            a(<?= $row['password'] ?>,<?= $idx ?>);
        </script>
<?php }


?>