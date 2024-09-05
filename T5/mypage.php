<?php
session_start();
if($_SESSION['verify']=="ok"){

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_mypage.css">
</head>
<body class="mypageTable">
    <div class="form-container">
        <table>
            <form action="mypage_p.php" method="POST">
                <input type="hidden" name="check" value="check">
                <tr>
                    <td colspan="2"><h1>Mypage</h1></td>
                </tr>
                <tr>
                    <td> ID </td>
                    <td> <?=$_SESSION['id']?></td>
                </tr>
                <tr>
                    <td> NAME </td>
                    <td> <input type="text" name="name" class="click" value="<?=$_SESSION['name']?>"></td>
                </tr>
                <tr>
                    <td> E-Mail </td>
                    <td> <input type="text" name="email" class="click" value="<?=$_SESSION['email']?>"></td>
                </tr>
                <tr>
                    <td> Old PassWord </td>
                    <td> <input type="password" name="password" class="click" placeholder="Put your OLD PW down"></td>
                </tr>
                <tr>
                    <td> New PassWord </td>
                    <td> <input type="password" name="Npassword" class="click" placeholder="Put your NEW PW"></td>
                </tr>
                <tr>
                    <td colspan="2" height="40px"><button type="submit" class="click">Update</button></td>
                </tr>
            </form>
            <tr>
                <td colspan="2" height="40px"><button onclick="location.href='choice.php'" class="click">Back</button></td>
            </tr>
        </table>
    </div>
</body>
</html>

<?php
}else{
    header("Location: login.php");
}
?>