<?php
session_start();
if($_SESSION['verify']=="ok"){

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
            <h1>Create</h1>
            <h3>Title</h3>
            <input type="text" name="title">

            <input type="hidden" name="author" value="<?=$_SESSION['name']?>">

            <h3>Content</h3>
            <textarea name="content"></textarea>

            <h3>Password</h3>
            <input type="password" name="password">

            <div class="file-input-container">
                <input type="file" class="file-input" name="b_file">
                <label class="file-input-label" for="b_file">Choose File</label>
            </div>

            <div class="button-group">
                <button type="submit" formaction="create_p.php">Create</button>
                <button type="submit" formaction="index.php">Back</button>
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