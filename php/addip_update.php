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

    include 'dbconn.php';
    //ip업데이트

    $ipname = $_POST["ipname"];
	$ip1 = $_POST["ip1"];
	$ip2 = $_POST["ip2"];
	$ip3 = $_POST["ip3"];
	$ip4 = $_POST["ip4"];
	$ipsm = $_POST["ipsm"];
	$desc=$_POST["desc"];

    if(strchr($ipname, ' '))
	{
	?><script>
		alert("변수 이름에 공백을 넣을 수 없습니다");
		history.back();
	</script><?php	
	}
	else if($ip1 == "" || $ip2 == "" || $ip3 == "" || $ip4 == "")
	{
?><script>
		alert("ip 값을 제대로 입력해주세요");
		history.back();
</script><?php
	}
	else{
		if($ipsm == "")
			$ip = $ip1.".".$ip2.".".$ip3.".".$ip4;
		else
        	$ip = $ip1.".".$ip2.".".$ip3.".".$ip4."/".$ipsm;
        
	
		if($ipname && $ip){
			//소켓 연동
    		$address = "localhost";                                             
    		$port = 5252;
    		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    		$result = socket_connect($socket, $address, $port);
    		$i = "OI_UPDATE name=$".$ipname." value=".$ip;  
    		socket_write($socket, $i, strlen($i)); 
			socket_close($socket);
			//sql
			$sql="update sig_ip_variables SET v_value='".$ip."',v_description='".$desc."' where v_name='$".$ipname."' ;";
			$conn->query($sql);
		}
	}
?>
<!--<meta http-equiv="refresh" content="0,ipvar.php">-->
<script type="text/javascript">
window.opener.location.reload();
window.close();
</script>
