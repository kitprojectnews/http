<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>

<head>
	<meta charset="UTF-8">
</head>
<?php
    include 'dbconn.php';
?>

<script src="rmain2.js"></script>
<script>
	w = 500; // POPUP W
	h = 150; // POPUP H
	
	// MID
	LeftPosition=(screen.width-w)/2;
	TopPosition=(screen.height-h)/2;
	
	//팝업 호출
	function popup_edit(hid) {
		var myForm = document.getElementById('editid');
		
 		var url = "addip.php";
		window.open(
			"addip.php", 
			"popupView",
			"width="+w+",height="+h+",top="+TopPosition+",left="+LeftPosition+", scrollbars=no, toolbar=no, location=no, resizable=no, status=no, menubar=no");
		
		myForm.action = url; 
		myForm.method = "post";
		myForm.target = "popupView";
		myForm.vname.value = hid;
		myForm.submit();
	}
	function popup_open() { 
	window.open(
	"addip.php", 
	"_blank",
	"width="+w+",height="+h+",top="+TopPosition+",left="+LeftPosition+", scrollbars=no, toolbar=no, location=no, resizable=no, status=no, menubar=no");
	}
</script>

<table border=1 align=center>
	<tr>
		<th colspan=4 align=center>IP tables</td>
	</tr>
	<tr>
		<th>Value Name</th>
		<th>Values</th>
		<th>Edit</th>
		<th>Description</th>
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
        		<form method=post id="editid" name="edit" action="addip.php">
        			<input type="hidden" name="vname">
	    			<!--<input type="submit" value="수정">-->
				<input type="button" value="EDIT" onclick="popup_edit('<?=$row1["v_name"]?>')">
        		</form>
		</td>
    		<td> MEMO </td>
    	</tr>
	<?php 
			}
		}
	?>
</table>
<div align="center">
<input type="button" value="ADD" onclick="popup_open()";">
</div>
