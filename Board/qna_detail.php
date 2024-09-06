<?php
session_start();
include "DB.php";
include "func.php";
if(isset($_GET['idx'])){
    $idx=$_GET['idx'];
    $idx=block($idx);
    $idx=mysqli_real_escape_string($conn,$idx);
}elseif(isset($_POST['idx'])){
    $idx=$_POST['idx'];
    $idx=block($idx);
    $idx=mysqli_real_escape_string($conn,$idx);
}else{
    header("Location: login.php");
}

if(isset($_SESSION['?'])){
    checkR();
}else{
    header("Location: Logout.php");
}
// $conn=$conn_qna;
$sql="SELECT * FROM qna WHERE idx = '$idx'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_detail.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $idx; ?>" name="idx">
            <h1>Q&A</h1>
            <div class="one-side">
            <div class="button-group">
                <?php if(isset($_SESSION['name']) && $_SESSION['verify']=="admin"){ ?>
                     <button type="submit" formaction="choice.php">Main</button>
                     <button type="submit" formaction="qna.php">Back</button>
                     <button type="submit" formaction="delete_qna.php" >Delete</button>
                <?php }else{ ?> 
                    <button type="submit" formaction="qna.php">Back</button>
                <?php } ?>
            </div>
            </div>
            <table>
                <tr>
                    <th>Title</th>
                    <td class="col3td" colspan="2"><?=$row['title']?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td class="col3td" colspan="2"><?=$row['date']?></td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td class="col3td" colspan="2"><?=$row['content']?></td>
                </tr>
            </table>
            <form action="" method="POST">
                <table>
                    <tr>
                        <th colspan="3" style="text-align:center">Admin_Answer</th>
                    </tr>
                    <tr>
                        <td  colspan="3" style="text-align:center"><?=$row['admin']?></td>
                    </tr>
                    <?php if(isset($_SESSION['name']) && $_SESSION['verify'] == "admin"){ ?>
                    <tr>
                        <input type="hidden" name="idx" value="<?=$idx?>">
                        <td style="width: 80%"><input  class="reply" type="text" name="admin" placeholder="Content"></td>
                        <td style="width: 20%"><button type="submit" formaction="create_qna_r.php">Comment</button></td>
                    </tr>
                    <?php }else{} ?>
                </table>
            </form>
        </form>
    </div>
</body>
</html>