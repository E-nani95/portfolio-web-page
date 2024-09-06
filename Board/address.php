<?php
include "DB.php";
include "func.php";
// echo "good"
$list=10;
$choice="COL6";
$sortCol = "COL1";
$sortVal = "ASC";
$table_name="address";
if(isset($_GET['search'])){
    $search=$_GET['search'];
    $search=block($search);
    $search=mysqli_real_escape_string($conn,$search);
}else{
    $search="ChoiceSearchR";
    $search=block($search);
    $search=mysqli_real_escape_string($conn,$search);
}
if(isset($_GET['page'])){
    $page=$_GET['page'];
    $page=block($page);
    $page=mysqli_real_escape_string($conn,$page);
    if($_GET['page']>1){
        $i = ($page-1)*$list+1;
    }else{
        $i=1;
    }
}else{
    $page=1;
    $page=block($page);
    $page=mysqli_real_escape_string($conn,$page);
    $i=1;
}
if(isset($_GET['page'])){
    $sql_paging=limit($page,$conn,$choice,$search,$list,$sortCol,$sortVal,$table_name);
    // print_r($sql_paging);
    $result_board= mysqli_query($conn,$sql_paging);
}else{
    //$limit=5; //페이지 클릭 안했을때  한페이지에 보일 글 갯수 
    if($choice == "ChoiceSearchR"){
        $sql_ss="SELECT * FROM address ORDER BY $sortCol $sortVal limit $page, $list"; // 페이지 클릭안했을때 초기값
        $result_board=mysqli_query($conn,$sql_ss);
    }else{
        $sql_ss="SELECT * FROM address WHERE $choice LIKE '%$search%' ORDER BY $sortCol $sortVal limit $page, $list";
        $result_board=mysqli_query($conn,$sql_ss);

    }


}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin: 20px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 50%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }
        input{
            width: 400px;
            height: 30px;
        }
        button{
            height: 30px;
        }
    </style>
    </head>
    <body>
    <h2>주소를 입력해주세요</h2>
    <form action="" method="GET">
        <input type="text" name="search" placeholder="시/군/구만 입력 ex) 군위군">
        <button type="submit">입력</button>
    </form>
    <?php if(isset($_GET['search'])){ ?>
    <table>
        <tr>
            <th></th>
            <th>우편번호</th>
            <th>시도</th>
            <th>시군구</th>
            <th>읍면동</th>
            <th>리명</th>
        </tr>
        <?php while($row=mysqli_fetch_array($result_board)){ ?>
            <tr onclick="address('<?= $row['COL1'] ?>','<?= $row['COL2'] ?>','<?= $row['COL4'] ?>','<?= $row['COL6'] ?>','<?= $row['COL8'] ?>')">
                <td style="width:10%"><?=$i?></td>
                <td><?=$row['COL1']?></td>
                <td><?=$row['COL2']?></td>
                <td><?=$row['COL4']?></td>
                <td><?=$row['COL6']?></td>
                <td><?=$row['COL8']?></td>
            </tr>
        <?php $i= $i+1; ?>  
    <?php }?>
    </table>
    <?php paging($page, $conn, $list, $choice, $search, $sortCol, $sortVal, $table_name); ?>
    <?php } ?>
    </body>
</html>


<script>
    function address(a, d, d, r, e){
        let add = `${a} ${d} ${d} ${r} ${e}`;
        window.opener.document.getElementById('address').value=add;
        window.close();
    }
</script>
