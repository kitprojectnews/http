<?php
    include 'dbconn.php';
?>

<script src="rmain2.js"></script>

<h2 align=center>LIST</h2>
<input type="button" value="ADD" onclick="window.open('addip.php', '_blank', 'width=800px,height=200px,toolbars=no,scrollbars=no'); return false;">
<table border=1 align=center>
	<tr><td colspan=3 align=center>Port tables</tr>
	<tr><td>Value Name<td>Values<td>Edit<td>Description</tr>
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
    <td> M E M O</td>
    </tr>
	<?php 
			}
		}
	?>
</table>
