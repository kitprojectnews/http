<?php
    include "dbconn.php";
    //port업데이트
	$portname=$_POST["portname"];
	$port1=$_POST["port1"];
	$port2=$_POST["port2"];

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
			$sql="update sig_port_variables SET v_value='".$port."' where v_name='$".$portname."' ;";
			$conn->query($sql);
		}
	}
?>
<meta http-equiv="refresh" content="0,portvar.php">