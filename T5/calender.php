<?php
session_start();
include "func.php";
if(!isset($_SESSION['verify'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_calender.css">
</head>
<body>

<?php
    date_default_timezone_set('Asia/Seoul');
    if(isset($_GET['month'])){
        $month=$_GET['month'];
        $month=block($month);
    }else{
        $month=date("m");
    }

    if(isset($_GET['year'])){
        $year=$_GET['year'];
        $year=block($year);
    }else{
        $year=date("Y");
    }

    if(isset($_GET['day'])){
        $day=$_GET['day'];
        $day=block($day);
    }else{
        $day=date("d");
        // $day='';
    }
?>
<a href="calender.php"><h1> Calender</h1></a>
<div class="choice">
    <form action="" method="GET">
        <select name="year" style="width: 80px;">
            <?php for($i=1950; $i <= 2500; $i++){?>
                <option value="<?=$i?>" <?php if($year == $i){ echo "selected";} ?>>
                    <?=$i?>
                </option>
            <?php } ?>
        </select>
        <select name="month" style="width: 50px;">
            <?php for($i=1; $i <= 12; $i++){?>
                <option value="<?=$i?>" <?php if($month == $i){ echo "selected";} ?>>
                    <?=$i?>
                </option>
            <?php } ?>
        </select>
        <select name="day" style="width: 50px;">
            <?php for($i=1; $i <= 31; $i++){?>
                <option value="<?=$i?>" <?php if($day == $i){ echo "selected";} ?>>
                    <?=$i?>
                </option>
            <?php } ?>
        </select>
        <button type="submit" formaction="calender.php" >Selected</button>
        <button type="submit" formaction="choice.php" >Back</button>
    </form>
</div>
<hr>
<?php
    date_default_timezone_set('Asia/Seoul');
    $thisMonth=$year."-".$month."-"."01";
    $startDay=strtotime($thisMonth);
    $blank=date("w",$startDay);
    $lastDay=date("t",$startDay);
    $today = date("Y-m-d");
    $Dday=$year."-".$month."-".$day;
    // echo $today;
?>
<?php for ($i = 1; $i <= $blank; $i++){ ?>
    <div class="item"></div>
<?php }?>

<?php for ($i = 1; $i <= $lastDay; $i++){ ?>
    <div class="item <?php if($year.'-'.$month.'-'.$i == $today) {echo 'today';}else if($year.'-'.$month.'-'.$i == $Dday){echo 'Dday';}; ?>"><?=$i?></div>
<?php }?>

</body>
</html>
