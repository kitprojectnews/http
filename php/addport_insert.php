<?php 
    include "dbconn.php";
    //port추가
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
	}
	else {
	
		if($port2){
			$port=$port1.":".$port2;
		}
		else{
			$port=$port1;
		}

		if($portname&&$port){
			$sql="select v_name from sig_port_variables where v_name='$".$portname."' ;";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
		?>
		<script>
			alert("해당 port가 이미 있습니다.");
			history.back();
		</script>
		<?php
			}else{
			$sql="insert into sig_port_variables values('$".$portname."','".$port."','".$desc."');";
		    $result = $conn->query($sql);
		?>
			<script type="text/javascript">
			window.opener.location.reload();
			window.close();
			</script>
	

		<?php
			}
		}//port end
	}
?>
