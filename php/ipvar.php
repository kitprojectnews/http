<?php
    include 'dbconn.php';
?>
<h2 align=center>IP Variable List</h2>
<a href="addip.php" align=center>ip변수 추가</a>
<table border=1 align=center>
	<tr><td colspan=3 align=center>IP tables</tr>
	<tr><td>Value Name<td>Values</tr>
	<?php 
		$sql1="select * from sig_ip_variables;";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			// output data of each row
			while($row1= $result1->fetch_assoc()) {
	?>
	<tr>
    <td><?=substr($row1["v_name"],1)?>
	<td><?=$row1["v_value"]?>
    <td>
        <form method=post action="delip.php">
		<input type="hidden" name="ipdel" value=<?=$row1["v_name"]?>>
        <input type=submit value="삭제" >
        </form>
        <form method=post action="addip.php">
        <input type="hidden" name="vname" value=<?=$row1["v_name"]?>>
	    <input type="submit" value="수정">
        </form>
    </td>
    </tr>
	<?php 
			}
		}
	?>
</table>