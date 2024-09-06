<?php
session_start();
include "DB.php";
include "func.php";
if($_SESSION['verify']=="ok"||$_SESSION['verify']=="admin"){
    // header("Location: login.php");

if(isset($_GET['idx'])){
    $idx=$_GET['idx'];
}elseif(isset($_POST['idx'])){
    $idx=$_POST['idx'];
}else{
    header("Location: index.php");
}
// $conn=$conn_board;
$sql="SELECT * FROM board WHERE idx = '$idx'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$sql_hit="UPDATE board SET hit = $row[hit]+1 WHERE idx = '$idx' ";
$result_hit=mysqli_query($conn, $sql_hit);

if(isset($_GET['like'])){
    if($_GET['like'] == "1"){
        $sql_like="UPDATE board SET good = $row[good]+1 WHERE idx = '$idx' ";
        $result_like=mysqli_query($conn, $sql_like);
        $row['good']++; // 적용되면 지금 화면에서는 안나와서 하나 더해주는 거임
    }elseif($_GET['like'] == "0"){
        $sql_like="UPDATE board SET good = $row[good]-1 WHERE idx = '$idx' ";
        $result_like=mysqli_query($conn, $sql_like);
        $row['good']--;
    }

}

$sql_reply="SELECT * FROM ripple WHERE boardNum = '$idx'";
$result_reply=mysqli_query($conn,$sql_reply);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_detail.css">
</head>
<body>
    <script>
        function onlyOne(checkbox) {
            let checkboxes = document.getElementsByName('reply_checkbox');
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false; 
            });
        }
    </script>
    <!-- <script>
        function onlyOne(checkbox) {
            let checkboxes = document.getElementsByName('reply_checkbox');
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] !== checkbox) {
                    checkboxes[i].checked = false;
                }
            }
        }
    </script> -->
</script>
    <div class="form-container">
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $idx; ?>" name="idx">
            <?php if(!isset($_GET['like'])){?>
                <button type="button" onclick="location.href='detail.php?idx=<?= $idx ?>&like=1';">Like: <?= $row['good'] ?></button>
            <?php }elseif($_GET['like']==1){?>
                <button type="button" onclick="location.href='detail.php?idx=<?= $idx ?>&like=0';">Like: <?= $row['good'] ?></button>
            <?php }elseif($_GET['like']==0){?>
                <button type="button" onclick="location.href='detail.php?idx=<?= $idx ?>&like=1';">Like: <?= $row['good'] ?></button>
            <?php }else{ ?>
                <button type="button" onclick="location.href='detail.php?idx=<?= $idx ?>';">Like: <?= $row['good'] ?></button>
            <?php }?>
            <h1>Details</h1>
            <div class="one-side">
            <div class="button-group">
                <!-- <a href="upload/<?=$row['file']?>" download><?=$row['file']?></a> -->
                <button type="submit" formaction="modify.php" class="long-button">Update & Delete</button>
                <button type="submit" formaction="index.php">Back</button>
            </div>
            </div>
            <table>
                <tr>
                    <th>Title</th>
                    <td class="col3td" colspan="2"><?=$row['title']?></td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td class="col3td" colspan="2"><?=$row['author']?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td class="col3td" colspan="2"><?=$row['date']?></td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td class="col3td" colspan="2"><?=$row['content']?></td>
                </tr>
                <?php if(!empty($row['filename'])){ ?>
                <tr>
                    <th>View</th>
                    <td class="col3td" colspan="2"><a id="view" class="download-link"><?=$row['filename']?>(View)</a></td>
                </tr>
                <tr>
                    <th>Download</th>
                    <td class="col3td" colspan="2"><a href="download.php?idx=<?=$idx?>" class="download-link"><?=$row['filename']?>(Download)</a></td>
                </tr>
                <?php } ?>
            </table>
            <form action="" method="POST">
                <table>
                    <tr>
                        <th>Author</th>
                        <th>Content</th>
                        <th>
                            <a herf></a>
                            <button type="submit" formaction="">Modify</button>
                            <button type="submit" formaction="reply_delete.php">Delete</button>
                        </th>
                    </tr>
                    <?php while($row_reply=mysqli_fetch_assoc($result_reply)){ ?>
                        <tr>
                            <td><?=$row_reply['name']?></td>
                            <td <?php if(!empty($_POST['reply_checkbox'])){echo "colspan='2'";} ?>><?=$row_reply['content']?></td>
                            <?php if(empty($_POST['reply_checkbox'])){?>
                                <td><input type="checkbox" name="reply_checkbox" value="<?=$row_reply['idxRe']?>" onclick="onlyOne(this)"></td>
                            <?php }else{?>
                                <?php if($_POST['reply_checkbox'] == $row_reply['idxRe']){ ?>
                                    <tr>
                                    <td><input type="checkbox" name="reply_checkbox" checked value="<?=$row_reply['idxRe']?>" onclick="onlyOne(this)"></td>
                                    <input type="hidden" name="re_idx" value="<?php echo $row_reply['idxRe']; ?>">
                                    <td><input type="text" name="reply_modify" placeholder="Reply"></td>
                                    <td style="text-align:center;"><button formaction="reply_modify.php">modify</button></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                    <tr>
                        <input type="hidden" name="reply_name" value="<?=$_SESSION['name']?>">
                        <input type="hidden" name="reply_idx" value="<?=$idx?>">
                        <td colspan="2"><input type="text" class="reply" name="reply_content" placeholder="Content"></td>
                        <td class="comment-button"><button type="submit" formaction="reply_create.php">Comment</button></td>
                    </tr>
                </table>
            </form>
        </form>
    </div>
</body>
</html>



<script>
    // view 새창
    let check = document.getElementById('view');
    check.addEventListener("click",()=>{
        // alert(1);
        // console.log(event.target.value);
        // let target = event.target.value;
        let url_check="view.php?idx=<?= $idx ?>";
        let windowName="_blank";
        let frame_check="width=1000 height=600"
       
        window.open(url_check,windowName,frame_check);
    })
</script>



<?php
}else{
    header("Location: login.php");
}
?>

<!-- <?php

if(isset($_POST['reply_modify'])){
    $reply_modify=$_POST['reply_modify'];
    $reply_idxx=$_POST['reply_checkbox'];

    $reply_modify=block($reply_modify);
    $reply_idxx=block($reply_idxx);

    $reply_modify=mysqli_real_escape_string($conn_reply,$reply_modify);
    $reply_idxx=mysqli_real_escape_string($conn_reply,$reply_idxx);

    $reply_sql = "UPDATE ripple SET content = '$reply_modify' WHERE idxRe = '$reply_idxx'";
    $reply_result = mysqli_query($conn_reply, $reply_sql);

    if($reply_result){
        header("Location: detail.php?idx="+$idx);
        exit();
    }else{
        echo "<script> alert(\"Failed\")</script>";
    }
}

?> -->



