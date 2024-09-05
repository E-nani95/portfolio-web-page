<?php
$DB_Path="localhost";
// $DB_Path="192.168.242.128:1018";
$DB_ID="root";
// $DB_ID="admin";
$DB_PW="123456789a";
// $DB_PW="student1234";


// $conn_login=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_db");
// $conn_login=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_account");
// $conn_login=mysqli_connect("localhost","admin","student1234","test_account")

$conn=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test");
// $conn_board=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_board");

// $conn_reply=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_ri");
// $conn_reply=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_ripple");

// $conn_qna=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_qna");
// $conn_qna=mysqli_connect($DB_Path,$DB_ID,$DB_PW,"test_qna");
?>