<?php
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
            $sql="delete from sig_ip_variables where v_name='".$ipdel."' ;";
            $conn->query($sql);
        }
	}
?>
<meta http-equiv="refresh" content="0,ipvar.php">
