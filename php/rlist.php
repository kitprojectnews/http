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
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/tableaction.js"></script>
</head>
<body>
<a href="rmain.php">룰 추가</a>
<h2 align=center>Rule List</h2>
<table border="1" cellspacing="0" id="myTable">
    <tr align="center">
        <th width=200 onclick="sortTable(0)">Rule name</th>
        <th width=100 onclick="sortTable(1)">Sid</th>
        <th width=150 onclick="sortTable(2)">Group Name</th>
        <th width=100 onclick="sortTable(3)">Rev</th>
        <th onclick="sortTable(4)">action</th>
        <th onclick="sortTable(5)">protocol</th>
        <th onclick="sortTable(6)">srcIP</th>
        <th onclick="sortTable(7)">srcPort</th>
        <th onclick="sortTable(8)">direction</th>
        <th onclick="sortTable(9)">dstIP</th>
        <th onclick="sortTable(10)">dstPort</th>
        <th onclick="sortTable(11)">Rule Option</th>
        <th onclick="sortTable(12)">Edit</th>
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