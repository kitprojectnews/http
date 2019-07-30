<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>

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
		
 		var url = "addport.php";
		window.open(
			"addport.php", 
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
	"addport.php", 
	"_blank",
	"width="+w+",height="+h+",top="+TopPosition+",left="+LeftPosition+", scrollbars=no, toolbar=no, location=no, resizable=no, status=no, menubar=no");
	}
</script>

<table border=1 align=center>
	<tr><th colspan=4 align=center>Port tables</tr>
	<tr><th>Value Name<th>Values<th>Edit<th>Description</tr>
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
	    <div style="float:left;">
    <form method=post action=delport.php style="display:inline;">
        <input type="hidden" name="portdel" value=<?=$row2["v_name"]?>>
        <input type=submit value="삭제">
    </form>
	    </div>
	    <div style="float:right;">
    <form method=post id="editid" name="edit" action=addport.php style="display:inline;">
        <input type="hidden" name="vname">
	<input type="button" value="EDIT" onclick="popup_edit('<?=$row2["v_name"]?>')">
    </form>
	    </div>
    </td>
    <td> M E M O</td>
    </tr>
	<?php 
			}
		}
	?>
</table>
<div align="center">
<input type="button" value="ADD" onclick="popup_open()" style="width:200; height:30;">
</div>
