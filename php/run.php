<?php
include 'dbconn.php';

$sid = $_GET["sig_id"];
$chk = $_GET["chk"];

//소켓 연동
$address = "localhost";                                             
$port = 5252;
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); 
$result = socket_connect($socket, $address, $port);
$i = "Sig_run sig_id=".$Rule_id.", ".$chk; 
socket_write($socket, $i, strlen($i)); 
socket_close($socket);

//sql
$rsql="update signature set sig_run=".$chk." where sig_id=".$sid;
$conn->query($rsql);
?>
<meta http-equiv="refresh" content="0,rlist.php">