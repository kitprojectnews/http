<?php
include 'dbconn.php';

$sid = $_GET["sig_id"];
$chk = $_GET["chk"];


$rsql="update signature set sig_run=".$chk." where sig_id=".$sid.";";
$conn->query($rsql);
?>
<meta http-equiv="refresh" content="0,rlist.php">