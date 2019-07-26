<?php
    include 'dbconn.php';

    //삭제가 들어왔을 시
    $del=$_POST["del"];
    if($del){
    $sql="delete from signature where sig_id='".$del."' ;";
    $conn->query($sql);
    }
?>
<meta http-equiv="refresh" content="0,rlist.php">