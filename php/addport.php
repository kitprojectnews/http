<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>
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
<div align=center>
<table border=1>
<tr>
    <th>NAME</th>
    <td><input type="text" name="portname" <?php if($vname != "") { ?> readonly <?php } ?> value="<?=substr($vname, 1)?>" ></td>
    </tr>
    </tr>
    <th>VALUE</th>
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
</div>
