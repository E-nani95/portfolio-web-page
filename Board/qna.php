<?php
session_start();
include "DB.php";
// $conn=$conn_qna;
$sql="SELECT * FROM qna";
$result=mysqli_query($conn,$sql);
// $row_check=mysqli_fetch_array($result);
$i = 1;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_board.css">
</head>
<body>
    <script>
        function a(password, idx){
            let a= prompt("비밀번호를 입력하세요");
            if(a == password){
                location.href='qna_detail.php?idx='+idx;
            }else{
                alert('Incorrect!!');
            }
        }
    </script>
    <div class="container">
        <div class="header">
            <a href="qna.php" class="refresh"><h1>Q&A</h1></a>
            <div class="buttons">
                <?php if(isset($_SESSION['name']) && $_SESSION['verify']=="admin"){ ?>
                     <button onclick="location.href='choice.php'">Main</button>
                     <button onclick="location.href='create_qna.php'">Create</button>
                <?php }else{ ?> 
                    <button onclick="location.href='create_qna.php'">Create</button>
                    <button onclick="location.href='login.php'">Back</button>
                <?php } ?>
            </div>
        </div>
        <hr>
        <table>
            <tr>
                <th width="5%">Num</th>
                <th width="10%">Title</th>
                <th width="60%">Content</th>
                <th width="15%">Date</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <?php if(isset($_SESSION['name']) && $_SESSION['verify']=="admin"){ ?>
                        <tr onclick="location.href='qna_check.php?idx=<?= $row['idx'] ?>'">
                    <?php }else{?>
                        <!-- <tr onclick="a(<?= $row['password'] ?>, <?= $row['idx'] ?>);"> -->
                        <tr onclick="location.href='qna_check.php?idx=<?= $row['idx'] ?>'">
                    <?php }?>
                    <td><?= $i ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?php echo substr($row['content'],0,10)."..."; ?></td>
                    <td><?= $row['date'] ?></td>
                    <?php $i += 1; ?>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
