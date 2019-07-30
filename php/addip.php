<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>
<title>Variable</title>

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

<!--<h1>ADD IP Variable</h1>-->
<div align=center>
<table border=1>
<tr>
    <th align=center>NAME</th>
    <td>
        <input type="text" id="ipid" name="ipname" value="<?=substr($vname, 1)?>" <?php if($vname) { ?> readonly <?php } ?> >
    </td>
</tr>
<tr>
    <th align=center>VALUE</th>
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
</div>
