<?php
include "DB.php";
// include "func.php";
$i=$_GET['idx'];
// $i=block($i);
$i=mysqli_real_escape_string($conn,$i);
$conn=$conn;

$sql="SELECT filename, filecontent, mime FROM board WHERE idx = ? ";

$stmt=$conn->prepare($sql);

$stmt->bind_param('i', $i);
$stmt->execute();

$stmt->bind_result($filename,$filecontent,$mime);
$stmt->fetch();

header('Content-Type: ' . $mime);
header('Content-Disposition: inline; filename="' . $filename . '"');
echo $filecontent;


?>


