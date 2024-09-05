<?php
session_start();
include "DB.php";
include "func.php";
$idx = $_POST['idx'];
$idx=block($idx);
$idx=mysqli_real_escape_string($conn,$idx);
// $conn = $conn_board;
$sql = "SELECT * FROM board WHERE idx = '$idx'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if($_SESSION['verify']=="ok"){
    header("Location: login.php");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_basic.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $idx; ?>" name="idx">
            <h1>Update</h1>
            <h3>Title</h3>
            <input type="text" name="title" value="<?=$row['title']?>">

            <h3>Content</h3>
            <textarea name="content"><?=$row['content']?></textarea>

            <!-- <h3>Upload</h3>
            <input type="file" value="b_file" name="b_file"> -->

            <h3>Upload</h3>
            <div class="file-input-container">
                <input type="file" class="file-input" name="b_file" id="b_file">
                <!-- <input type="file" class="file-input" accept="image/png, image/jpeg" name="b_file" id="b_file"> -->
                <label class="file-input-label" for="b_file">Choose File</label>
            </div>

            <h3>Password</h3>
            <input type="password" name="password" placeholder="Put your password in here">
            

            <div class="button-group">
                <button type="submit" formaction="modify_p.php">Update</button>
                <button type="submit" formaction="delete.php">Delete</button>
                <button type="submit" formaction="detail.php">Back</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
}else{
    header("Location: login.php");
}
?>