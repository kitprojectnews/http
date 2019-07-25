<?php
	include 'dbconn.php';
	
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
	else
	{
		if($ipsm == "")
			$ip = $ip1.".".$ip2.".".$ip3.".".$ip4;
		else
			$ip = $ip1.".".$ip2.".".$ip3.".".$ip4."/".$ipsm;

    	//ip추가
		//$ipn=$_POST["ipn"];
		//$ipv=$_POST["ipv"];
		if($ipname && $ip)
		{
			$sql="select v_name from sig_ip_variables where v_name='$".$ipname."' ;";
			$result = $conn->query($sql);
			if ($result->num_rows > 0)
			{ 			
			?><script>
				alert("해당 변수가 이미 있습니다.");
				history.back();
			</script><?php
			}
			else
			{
			$sql="insert into sig_ip_variables values('$".$ipname."','".$ip."');";
      $result = $conn->query($sql);
			?>
			<meta http-equiv="refresh" content="0,ipvar.php">
			<?php
			}
		}
	}//ip end

?>