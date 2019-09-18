<?php
include 'ReSession.php';
session_start();
if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
{
   die('접근권한이 없습니다. ');
}
    include "dbconn.php";
    //port삭제
	$portdel=$_POST["portdel"];
    if($portdel){
        $sql="select * from signature where sig_srcPort='".$portdel."' or sig_dstPort='".$portdel."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
?>
<script>
    alert("해당 port변수를 사용하는 룰이 있어 변수를 삭제할 수 없습니다.");
</script>
<meta http-equiv="refresh" content="0,portvar.php">
<?php
        }else{
            //소켓 연동
    		$address = "localhost";                                             
    		$port = 5252;
    		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    		$result = socket_connect($socket, $address, $port);
    		$i = "OP_DELETE name=".$portdel;  
    		socket_write($socket, $i, strlen($i)); 
    		socket_close($socket);
            //sql
            $sql="delete from sig_port_variables where v_name='".$portdel."' ;";
            $conn->query($sql);
        }
    }
?> 
<meta http-equiv="refresh" content="0,portvar.php">
