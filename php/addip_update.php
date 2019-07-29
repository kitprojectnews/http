<?php
    include 'dbconn.php';
    //ip업데이트

    $ipname = $_POST["ipname"];
	$ip1 = $_POST["ip1"];
	$ip2 = $_POST["ip2"];
	$ip3 = $_POST["ip3"];
	$ip4 = $_POST["ip4"];
	$ipsm = $_POST["ipsm"];

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
			$sql="update sig_ip_variables SET v_value='".$ip."' where v_name='$".$ipname."' ;";
			$conn->query($sql);
		}
	}
?>
<!--<meta http-equiv="refresh" content="0,ipvar.php">-->
<script type="text/javascript">
window.opener.location.reload();
window.close();
</script>
