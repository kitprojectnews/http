<?php
    include 'dbconn.php';
?>
<h2 align=center>Port Variable List</h2>
<a href="addport.php" align=center>Port 변수 추가</a>
<table border=1 align=center>
	<tr><td colspan=3 align=center>Port tables</tr>
	<tr><td>Value Name<td>Values</tr>
	<?php 
		$sql2="select * from sig_port_variables;";
		$result2 = $conn->query($sql2);
		if ($result2->num_rows > 0) {
			// output data of each row
			while($row2= $result2->fetch_assoc()) {
	?>
	<tr>
    <td><?=substr($row2["v_name"],1)?>
	<td><?=$row2["v_value"]?>
    <td>
    <form method=post action=delport.php>
        <input type="hidden" name="portdel" value=<?=$row2["v_name"]?>>
        <input type=submit value="삭제">
    </form>
    <form method=post action=addport.php>
        <input type="hidden" name="vname" value=<?=$row2["v_name"]?>>
	    <input type=submit value="수정">
    </form>
    </td>
    </tr>
	<?php 
			}
		}
	?>
</table>