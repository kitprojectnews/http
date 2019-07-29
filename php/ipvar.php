<?php
    include 'dbconn.php';
    
    $vname = $_POST["vname"];
    //ip수정
    if($vname){
        $sql="select v_value from sig_ip_variables where v_name='".$vname."';";
        $result = $conn->query($sql);
		$row = $result->fetch_assoc();
		$ip = explode('.', $row["v_value"]);
        $sm = explode('/', $ip[3]);
    }
?>

<script src="rmain2.js"></script>
<h2 align=center>IP Variable List</h2>
<form method=post 
    <?php 
        if($vname == "")
        { ?> 
            action="addip_insert.php" <?php 
        } 
        else
        { ?>
            action="addip_update.php" <?php 
        } 
    ?>
>
<table border=1 align=center>
<tr>
    <td align=center>NAME</td>
    <td>
        <input type="text" id="ipid" name="ipname" value="<?=substr($vname, 1)?>" <?php if($vname) { ?> readonly <?php } ?> >
    </td>
</tr>
<tr>
    <td align=center>VALUE</td>
    <td>
        <input type="text" size=3 id="var_value_ip1" name="ip1" 
        onkeydown="return onlyNumber(event)" 
        onkeyup="removeChar(event)" 
        onfocusout="removeChar(event)" 
        oninput="ipRange(this)" 
        style="ime-mode:disabled" value=<?=$ip[0]?> > . 
        <input type="text" size=3 id="var_value_ip2" name="ip2" 
        onkeydown="return onlyNumber(event)" 
        onkeyup="removeChar(event)" 
        onfocusout="removeChar(event)" 
        oninput="ipRange(this)" 
        style="ime-mode:disabled" value=<?=$ip[1]?>> . 
        <input type="text" size=3 id="var_value_ip3" name="ip3" 
        onkeydown="return onlyNumber(event)" 
        onkeyup="removeChar(event)" 
        onfocusout="removeChar(event)" 
        oninput="ipRange(this)" 
        style="ime-mode:disabled" value=<?=$ip[2]?>> . 
        <input type="text" size=3 id="var_value_ip4" name="ip4" 
        onkeydown="return onlyNumber(event)" 
        onkeyup="removeChar(event)" 
        onfocusout="removeChar(event)" 
        oninput="ipRange(this)" 
        style="ime-mode:disabled" value=<?=$sm[0]?>> / 
        <input type="text" size=3 id="var_value_sm" name="ipsm" 
        onkeydown="return onlyNumber(event)" 
        onkeyup="removeChar(event)" 
        onfocusout="removeChar(event)" 
        oninput="subnetmaskRange(this)" 
        style="ime-mode:disabled" value=<?=$sm[1]?>>
    </td>
</tr>
</table>    
    <?php if($vname != "") { ?>
        <input type="submit" value="수정하기" >
        <?php } else { ?>
        <input type="submit" value="추가하기" >
        <?php } ?>
</form>

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
