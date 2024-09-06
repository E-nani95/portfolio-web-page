<?php
include "DB.php";
// include "func.php";
$i=$_GET['idx'];
// $i=block($i);
$i=mysqli_real_escape_string($conn,$i);
$sql="SELECT * FROM board WHERE idx =$i";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
if($row){
    $filename=$row['filename'];
    $filecontent=$row['filecontent'];
    $mime=$row['mime'];
    header("Content-Type: " . $mime);
    header("Content-Disposition: attachment; filename=\"$filename\"");
    echo $filecontent;
    exit();
    echo "<script>history.back(1);</script>";
}
?>