<?php
    include 'dbconn.php';

    //삭제가 들어왔을 시
    //$del=$_GET["del"];
    //if($del){
    //$sql="delete from signature where sig_id='".$del."' ;";
    //$conn->query($sql);
    //}

    $sql="select * from signature;";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<a href="rmain.php">룰 추가</a>
<table border=1 >
    <tr align="center">
        <th colspan=13>Rule List</th>
    </tr>
    <tr align="center">
        <td width=200 >Rule name
        <td width=100>Sid
        <td width=150>Group Name
        <td width=100>Rev
        <td>action
        <td>protocol
        <td>srcIP
        <td>srcPort
        <td>direction
        <td>dstIP
        <td>dstPort
        <td>Rule Option
        <td>Edit
    </tr>
        <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
        ?>
		<tr>
        <td><?php echo $row["sig_msg"] ?>
        <td><?php echo $row["sig_sid"] ?>
        <td>
        <?php
            //그룹명 변환
            $ssql="select gname from sig_group where gid=".$row["sig_gid"].";";
            $sgid = $conn->query($ssql);
            $grow = $sgid->fetch_assoc();
            echo $grow["gname"];
        ?>
        <td><?php echo $row["sig_rev"] ?>
        <td><?php echo $row["sig_action"] ?>
        <td><?php echo $row["sig_protocol"] ?>
        <td><?php echo $row["sig_srcIP"] ?>
        <td><?php echo $row["sig_srcPort"] ?>
        <td><?php echo $row["sig_direction"] ?>
        <td><?php echo $row["sig_dstIP"] ?>
        <td><?php echo $row["sig_dstPort"] ?>
        <td><?php echo $row["sig_rule_option"] ?></td>
        <td>
        <form method=post action="rmain_mody.php" >
        <input type="hidden" name="sid" value=<?=$row["sig_id"]?>>
        <input type="submit" value="수정">
        <!--<input type=button value="수정" onclick=location.href='rmain_mody.php?sid='>-->
        </form>
        <form method=post action="rlistd.php">
        <input type="hidden" name="del" value=<?=$row["sig_id"]?>>
        <input type="submit" value="삭제">
        <!--<input type=button value="삭제" onclick=location.href='rlist.php?del='></td>-->
        </form> 
		</tr>
        <?php
                }
            } else {
        ?>
        <td colspan=13 align=center>
        <?php
                echo "NO Rules";
            }
        ?>
        </td>
</table>
</body>
</html>
<?php
$sql->close();
$conn->close();
echo "db close<br>";
?>