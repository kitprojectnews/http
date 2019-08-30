<?php
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
 header('Location:../index.html');
}
if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
{
   die('접근권한이 없습니다. ');
}
    include 'dbconn.php';

    //삭제가 들어왔을 시
    $del=$_POST["del"];
    
    if($del){
    //소켓 연동
    $address = "localhost";                                             
    $port = 5252;
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    $result = socket_connect($socket, $address, $port);
    $i = "R_DELETE sig_id=".$del;  
    socket_write($socket, $i, strlen($i)); 
    socket_close($socket);
    
    $sql="delete from signature where sig_id='".$del."' ;";
    $conn->query($sql);
    }
    $conn->close();
?>
<meta http-equiv="refresh" content="0,rlist.php">
