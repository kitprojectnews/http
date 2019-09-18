<?php
include 'ReSession.php';
session_start();
if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
{
   die('접근권한이 없습니다. ');
}
    include "dbconn.php";
    //ip삭제
	$ipdel=$_POST["ipdel"];
    if($ipdel){
        $sql="select * from signature where sig_srcIP='".$ipdel."' or sig_dstIP='".$ipdel."';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
?>
<script>
    alert("해당 ip변수를 사용하는 룰이 있어 변수를 삭제할 수 없습니다.");
</script>
<meta http-equiv="refresh" content="0,ipvar.php">
<?php
        }else{
            //소켓 연동
    		$address = "localhost";                                             
    		$port = 5252;
    		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    		$result = socket_connect($socket, $address, $port);
    		$i = "OI_DELETE name=".$ipdel;  
    		socket_write($socket, $i, strlen($i)); 
    		socket_close($socket);
            //sql
            $sql="delete from sig_ip_variables where v_name='".$ipdel."' ;";
            $conn->query($sql);
            
        }
	}
?>
<meta http-equiv="refresh" content="0,ipvar.php">
