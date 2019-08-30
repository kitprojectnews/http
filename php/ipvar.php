<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>

<head>
	<meta charset="UTF-8">
</head>
<?php
	include 'dbconn.php';
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
 header('Location:../index.html');
}
?>

<script src="../js/rmain2.js"></script>
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
		<th colspan=4 align=center >IP tables</td>
	</tr>
	<tr>
		<th>Value Name</th>
		<th>Values</th>
		<?php
             if($_SESSION["r_update"]==1){
		?>
		<th>Edit</th>
		<?php
    		}
		?>
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
    	<?php
             if($_SESSION["r_update"]==1){
		?>
		<td>
			<div style="float:left;">
        	<form method=post action="delip.php" style="display:inline;">
				<input type="hidden" name="ipdel" value=<?=$row1["v_name"]?>>
        		<input type=submit value="삭제" >
			</form>
			</div>
			<div style="float:right;">
        	<form method=post id="editid" name="edit" action="addip.php" style="display:inline;">
        		<input type="hidden" name="vname">
				<input type="button" value="수정" onclick="popup_edit('<?=$row1["v_name"]?>')">
			</form>
			</div>
		</td>
		<?php
    		}
		?>
    	<td><?=$row1["v_description"]?></td>
    </tr>
	<?php 
			}
		}
	?>
</table>
<?php
    if($_SESSION["r_update"]==1){
?>
<div align="center">
<br>
<input type="button" value="ADD" onclick="popup_open()" style="width:200; height:30;">
</div>
<?php
    }
?>
