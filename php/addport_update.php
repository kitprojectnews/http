<?php
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
    echo " <script>alert('비활성화된 사용자입니다. '); history.back(); </script>";
}

if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
{
   echo " <script>alert('접근권한이 없습니다. '); history.back(); </script>";
}

    include "dbconn.php";
    //port업데이트
	$portname=$_POST["portname"];
	$port1=$_POST["port1"];
	$port2=$_POST["port2"];
	$desc= $_POST["desc"];

	if(strchr($portname, ' '))
	{
	?><script>
		alert("변수 이름에 공백을 넣을 수 없습니다");
		history.back();
	</script><?php	
	}
	else if($port1=="")
	{
		?><script>
		alert("Port의 값을 입력해주세요!");
		history.back();
		</script><?php
	}
	else if(((int)$port1 > (int)$port2) && $port2!="" )
	{
		?><script>
		alert("오른쪽의 port 값이 더 커야합니다!");
		history.back();
		</script><?php
	}else{
		if($port2){
			$port=$port1.":".$port2;
		}
		else{
			$port=$port1;
		}
	
		if($portname && $port){
			//소켓 연동
    		$address = "localhost";                                             
    		$sport = 5252;
    		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    		$result = socket_connect($socket, $address, $sport);
    		$i = "OP_UPDATE name=$".$portname." value=".$port;  
    		socket_write($socket, $i, strlen($i)); 
    		socket_close($socket);
			$sql="update sig_port_variables SET v_value='".$port."',v_description='".$desc."' where v_name='$".$portname."' ;";
			$conn->query($sql);
			
		}
	}
?>
<script type="text/javascript">
window.opener.location.reload();
window.close();
</script>
