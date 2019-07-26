<?php
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
        $sql="delete from sig_port_variables where v_name='".$portdel."' ;";
        $conn->query($sql);
        }
    }
?> 
<meta http-equiv="refresh" content="0,portvar.php">