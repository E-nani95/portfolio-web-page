<?php
session_start();
include "DB.php";
include "func.php";

if($_SESSION['verify']=="ok"){
    header("Location: login.php");

// $conn=$conn_board;
$sql_board="SELECT * FROM board";
$result=mysqli_query($conn,$sql_board);
$table_name = "board";
// $domain = 'http://localhost/T4/index.php';
$list=10; //한페이지에 보일 글 갯수 

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

if(isset($_GET['choice'])){
    $choice = $_GET['choice'];
    $choice = block($choice);
    $choice = mysqli_real_escape_string($conn,$choice);
}else{
    $choice="ChoiceSearchR";
    $choice = block($choice);
    $choice = mysqli_real_escape_string($conn,$choice);
}

if(isset($_GET['search'])){
    $search=$_GET['search'];
    $search=block($search);
    $search=mysqli_real_escape_string($conn,$search);
}else{
    $search="ChoiceSearchR";
    $search=block($search);
    $search=mysqli_real_escape_string($conn,$search);
}
if(isset($_POST['sort'])){
    $sort= $_POST['sort'];
    $sort= block($sort);
    $sort= mysqli_real_escape_string($conn,$sort);
    if($sort=="1"){
        $sortCol = "title";
        $sortVal = "ASC";
    }elseif($sort == "2"){
        $sortCol = "title";
        $sortVal = "DESC";
    }elseif($sort == "3"){
        $sortCol = "content";
        $sortVal = "ASC";
    }elseif($sort == "4"){
        $sortCol = "content";
        $sortVal = "DESC";
    }elseif($sort == "5"){
        $sortCol = "author";
        $sortVal = "ASC";
    }elseif($sort == "6"){
        $sortCol = "author";
        $sortVal = "DESC";
    }elseif($sort == "7"){
        $sortCol = "date";
        $sortVal = "ASC";
    }elseif($sort == "8"){
        $sortCol = "date";
        $sortVal = "DESC";
    }elseif($sort == "9"){
        $sortCol = "hit";
        $sortVal = "ASC";
    }else{
        $sortCol = "hit";
        $sortVal = "DESC";
    }

}else{
    $sortCol = "idx";
    $sortVal = "ASC";
}

if(isset($_GET['page'])){
    $sql_paging=limit($page,$conn,$choice,$search,$list,$sortCol,$sortVal,$table_name);
    // print_r($sql_paging);
    $result_board= mysqli_query($conn,$sql_paging);
}else{
    //$limit=5; //페이지 클릭 안했을때  한페이지에 보일 글 갯수 
    if($choice == "ChoiceSearchR"){
        $sql_ss="SELECT * FROM board ORDER BY $sortCol $sortVal limit $page, $list"; // 페이지 클릭안했을때 초기값
        $result_board=mysqli_query($conn,$sql_ss);
    }else{
        $sql_ss="SELECT * FROM board WHERE $choice LIKE '%$search%' ORDER BY $sortCol $sortVal limit $page, $list";
        $result_board=mysqli_query($conn,$sql_ss);

    }


}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style_board.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <a class="refresh" href="index.php"><h1>Board</h1></a>
            <div class="buttons">
                <!-- <?php if($_SESSION['verify']=="admin"){ ?>
                <button onclick="location.href='qna.php'">Q&A</button>
                <?php } ?>  -->
                <button onclick="location.href='create.php'">Create</button>
                <button onclick="location.href='choice.php'">Back</button>
            </div>
        </div>
        <hr>
        <div class="search-form">
            <form action="" method="POST">
                <select name="sort">
                    <option value="1">Title-ASC</option>
                    <option value="2">Title-DESC</option>
                    <option value="3">Content-ASC</option>
                    <option value="4">Content-DESC</option>
                    <option value="5">Author-ASC</option>
                    <option value="6">Author-DESC</option>
                    <option value="7">Date-ASC</option>
                    <option value="8">Date-DESC</option>
                    <option value="9">Hit-ASC</option>
                    <option value="10">Hit-DESC</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <table>
            <tr>
                <th> </th>
                <th width="10%">Title</th>
                <th width="60%">Content</th>
                <th width="10%">Author</th>
                <th width="15%">Date</th>
                <th width="5%">Hit</th>
            </tr>
            <?php while($row_board = mysqli_fetch_assoc($result_board)) { ?>
                <tr onclick="location.href='detail.php?idx=<?= $row_board['idx'] ?>'">
                    <td><?=$i?></td>
                    <td><?= $row_board['title'] ?></td>
                    <td><?php echo substr($row_board['content'],0,10)."..."; ?></td>
                    <td><?= $row_board['author'] ?></td>
                    <td><?= $row_board['date'] ?></td>
                    <td><?= $row_board['hit'] ?></td>
                </tr>
                <?php $i +=1;?>
            <?php } ?>
        </table>
        <div class="search">
        <form action="index.php?page=1" method="GET" class="search-form">
            <select name="choice" style="text-align:center;">
                <option value="title">title</option>
                <option value="author">author</option>
                <option value="content">content</option>
            </select>
            <input type="text" name="search" class="search_text">
            <input type="hidden" name="page" value="1">
            <button type="submit">Search</button>
        </form>
        <?php

        ?>
        </div>
        <div class="paging">
            <?php paging($page, $conn, $list, $choice, $search, $sortCol, $sortVal,$table_name); ?>
        </div>
    </div>
</body>
</html>

<!-- <?php
echo $choice;
echo $search;

?> -->

<?php
}else{
    header("Location: login.php");
}
?>