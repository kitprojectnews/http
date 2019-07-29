<?php
    include 'dbconn.php';
    $vname = $_POST["vname"];
    if($vname){
        $sql="select v_value from sig_port_variables where v_name='".$vname."';";
        $result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$port = explode(':', $row["v_value"]);
    }
?>

<script src="rmain2.js"></script>
<form method=post 
    <?php 
        if($vname == "")
        { ?> 
            action="addport_insert.php" <?php 
        } 
        else
        { ?>
            action="addport_update.php" <?php 
        } 
    ?>
>
<script src="rmain2.js"></script>
<form method=post 
    <?php 
        if($vname == "")
        { ?> 
            action="addport_insert.php" <?php 
        } 
        else
        { ?>
            action="addport_update.php" <?php 
        } 
    ?>
>
<table border=1>
<tr>
    <td>NAME</td>
    <td><input type="text" name="portname" <?php if($vname != "") { ?> readonly <?php } ?> value="<?=substr($vname, 1)?>" ></td>
    </tr>
    </tr>
    <td>VALUE</td>
    <td>
        <input type="text" size=3 id="var_value_port1" name="port1" 
		onkeydown="return onlyNumber(event)" 
		onkeyup="removeChar(event)" 
		onfocusout="removeChar(event)" 
		oninput="portRange(this)" 
		style="ime-mode:disabled" value=<?=$port[0]?>> ~ 
		<input type="text" size=3 id="var_value_port2" name="port2" 
		onkeydown="return onlyNumber(event)" 
		onkeyup="removeChar(event)" 
		onfocusout="removeChar(event)" 
		oninput="portRange(this)" 
		style="ime-mode:disabled" value=<?=$port[1]?>>
    </td>
</tr>
<tr>
</tr>
</table>
<?php if($vname != "") { ?>
        <input type="submit" value="수정하기" >  
        <?php } else { ?>
        <input type="submit" value="추가하기" >
        <?php } ?>

</form>
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
