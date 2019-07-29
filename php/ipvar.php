<?php
    include 'dbconn.php';
?>

<script src="rmain2.js"></script>
<a href="addip.php" align=center>ip변수 추가</a>

<h2 align=center>LIST</h2>
<input type="button" value="ADD" onclick="window.open('addip.php', '_blank', 'width=800px,height=200px,toolbars=no,scrollbars=no'); return false;">
<table border=1 align=center>
	<tr>
		<td colspan=4 align=center>IP tables</td>
	</tr>
	<tr>
		<td>Value Name</td>
		<td>Values</td>
		<td>Edit</td>
		<td>Description</td>
	</tr>   <?php 
		$sql1="select * from sig_ip_variables;";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			// output data of each row
			while($row1= $result1->fetch_assoc()) { ?>
	<tr>
		<td><?=substr($row1["v_name"],1)?></td>
		<td><?=$row1["v_value"]?></td>
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
    		<td> MEMO </td>
    	</tr>
	<?php 
			}
		}
	?>
</table>
