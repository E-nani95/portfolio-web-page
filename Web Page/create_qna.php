<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_basic.css">
</head>
<body>
    <script>
        alert("자세한 문의는 111-111로 전화주세요!!");
    </script>
    <div class="form-container">
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $idx; ?>" name="idx">
            <h1>Create</h1>
            <h3>Title</h3>
            <input type="text" name="title">

            <h3>Content</h3>
            <textarea name="content"></textarea>

            <h3>Password</h3>
            <input type="password" name="password">

            <div class="button-group">
                <button type="submit" formaction="create_qna_p.php">Create</button>
                <button type="submit" formaction="qna.php">Back</button>
            </div>
        </form>
    </div>
</body>
</html>