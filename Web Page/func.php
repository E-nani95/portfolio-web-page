<?php
// SQL INJECTION BLOCK
function block($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}



function checkI(){
    $_SESSION['?']="test";
}
function checkR(){
    unset($_SESSION['?']);
}

/// paging sql화
function paging($page,$conn,$list,$choice,$search,$sortCol,$sortVal,$table_name){
    if($choice == "ChoiceSearchR"){
        $sql="SELECT * FROM $table_name ORDER BY $sortCol $sortVal";
    }else{
        $sql="SELECT * FROM $table_name WHERE $choice LIKE '%$search%' ORDER BY $sortCol $sortVal";
    }
    
    $result=mysqli_query($conn,$sql);
    $row =mysqli_num_rows($result);
    //$list;//한페이지에 나타날 페이지수
    $block_ct=5; //g한페이지에 나타날 블럭수

    $block_Num=ceil($page/$block_ct);//현재페이지
    $block_Start=(($block_Num-1)*$block_ct)+1;//블럭시작
    $block_End=$block_Start+$block_ct-1;//블럭 끝

    $total_page=ceil($row/$list); //생성된 총페이지
    if($total_page < $block_End){
        $block_End = $total_page;
    };  //만약 마지막 번호가 페이지 번호 보다 많다면 마지막 번호는 페이지수

    $total_block=ceil($total_page/$block_ct); //생성된 총 블럭
    $start_page=($page-1)*$list;//시작 게시물

    if($choice == "ChoiceSearchR"){
        $sql_paging="SELECT * FROM $table_name ORDER BY $sortCol $sortVal LIMIT $start_page, $list";
    }else{
        $sql_paging="SELECT * FROM $table_name WHERE $choice LIKE '%$search%' ORDER BY $sortCol $sortVal LIMIT $start_page, $list";
    }
    

    if($page <= 1){
        echo "<div style=\"display:flex; justify-content: space-between;\">";
        echo "<div style=\"width:150px;\"></div>";
        echo "<div><strong>처음</strong></div>";
    }else{
        echo "<div style=\"display:flex; justify-content: space-between;\">";
        echo "<div style=\"width:150px;\"></div>";
        echo "<div><a href='?choice=$choice&search=$search'>처음</a></div>";
    }
    if($page <= 1){
    }else{
        $pre=$page-1;
        echo "<div><a href=\"?choice=$choice&search=$search&page=$pre\">이전</a></div>";
    }
    for($i=$block_Start; $i <= $block_End; $i++){
        if($i == $page){
            echo"<div><strong>$i</strong></div>";
        }else{}
    }
    if($page >= $total_page){
        
    }else{
        $next = $page +1;
        echo "<div><a href='?choice=$choice&search=$search&page=$next'>다음</a></div>";

    }
    if($total_page <= $page){
        echo "<div><strong>끝</strong></div>";
        echo "<div style=\"width:150px;\"></div>";
        echo "</div>";
    }else{
        echo "<div><a href=\"?choice=$choice&search=$search&page=$total_page\">끝</a></div>";
        echo "<div style=\"width:150px;\"></div>";
        echo "</div>";
    }
    return $sql_paging;
    }

function limit($page,$conn,$choice,$search,$list,$sortCol,$sortVal, $table_name){
    if($choice == "ChoiceSearchR"){
        $sql="SELECT * FROM $table_name ORDER BY $sortCol $sortVal";
    }else{
        $sql="SELECT * FROM $table_name WHERE $choice LIKE '%$search%' ORDER BY $sortCol $sortVal";
    }
    $result=mysqli_query($conn,$sql);
    $row =mysqli_num_rows($result);
    
    //$list;//한페이지에 나타날 페이지수
    $block_ct=5; //g한페이지에 나타날 블럭수

    $block_Num=ceil($page/$block_ct);//현재페이지
    $block_Start=(($block_Num-1)*$block_ct)+1;//블럭시작
    $block_End=$block_Start+$block_ct-1;//블럭 끝

    $total_page=ceil($row/$list); //생성된 총페이지
    if($total_page < $block_End){
        $block_End = $total_page;
    };  //만약 마지막 번호가 페이지 번호 보다 많다면 마지막 번호는 페이지수

    $total_block=ceil($total_page/$block_ct); //생성된 총 블럭
    $start_page=($page-1)*$list;//시작 게시물

    if($choice == "ChoiceSearchR"){
        $sql_paging="SELECT * FROM $table_name ORDER BY $sortCol $sortVal limit $start_page, $list";
    }else{
        $sql_paging="SELECT * FROM $table_name WHERE $choice LIKE '%$search%' ORDER BY $sortCol $sortVal limit $start_page, $list";
    }
    return $sql_paging;
}

function CheckPassword($password) {
    // 최소 길이
    $minLength = 8;
    
    // 정규 표현식
    $hasUppercase = preg_match('/[A-Z]/', $password);
    $hasLowercase = preg_match('/[a-z]/', $password);
    $hasDigit = preg_match('/\d/', $password);
    $hasSpecialChar = preg_match('/[\W_]/', $password);
    //특정 특수문자
    //$hasSpecialChar = preg_match('/[!@#$%^&*()_+]/', $password);

    
    if (strlen($password) < $minLength) {
        echo "비밀번호는 최소 {$minLength}자 이상이어야 합니다.";
        $checkPassword="a";
        return $checkPassword;
    }
    
    if (!$hasUppercase) {
        echo "비밀번호는 대문자를 포함해야 합니다.";
        $checkPassword="b";
        return $checkPassword;
    }
    
    if (!$hasLowercase) {
        echo "비밀번호는 소문자를 포함해야 합니다.";
        $checkPassword="c";
        return $checkPassword;
    }
    
    if (!$hasDigit) {
        echo "비밀번호는 숫자를 포함해야 합니다.";
        $checkPassword="d";
        return $checkPassword;
    }
    
    if (!$hasSpecialChar) {
        echo "비밀번호는 특수 문자를 포함해야 합니다.";
        $checkPassword="e";
        return $checkPassword; 
    }
    echo "비밀번호가 유효합니다.";
    $checkPassword="True";
    return $checkPassword;
}

?>


