<?php
    include 'dbconn.php';

    //삭제가 들어왔을 시
    //$del=$_GET["del"];
    //if($del){
    //$sql="delete from signature where sig_id='".$del."' ;";
    //$conn->query($sql);
    //}
    $allGroup;
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
<td><select id="rule_group_name" onchange="group_change()"> <!--그룹명 combo_box-->
    <option value="all">전체</option>
	<?php 
		$gsql="select * from sig_group;";
		$gresult = $conn->query($gsql);
		if ($gresult->num_rows > 0) {
			// output data of each row
			while($grow = $gresult->fetch_assoc()) {
	?>
		    <option><?=$grow["gname"]?></option>
	<?php 
			}
		}
	?>
</select></td><br>

<table border="1" cellspacing="0" id="myTable">
    <thead align="center">
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
    </thead>
    <tbody>
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
    </tbody>
</table>
</body>
</html>
<script>
 function group_change(){
    var group=document.getElementById("rule_group_name");
    var show_by_group=group.options[group.selectedIndex].value;
    $(function() {$( '#myTable > tbody').empty();});
    if(show_by_group=='all'){
        <?php
            $nsql="select * from signature;";
            $nresult = $conn->query($nsql);
            if ($nresult->num_rows > 0) {
                // output data of each row
                while($nrow = $nresult->fetch_assoc()) {
                    $nssql="select gname from sig_group where gid=".$nrow["sig_gid"].";";
                    $nsgid = $conn->query($nssql);
                    $ngrow = $nsgid->fetch_assoc();
        ?>
        $(function() {$('#myTable > tbody:last').append('<tr><td><?=$nrow["sig_msg"]?><td><?=$nrow["sig_sid"]?><td><?=$ngrow["gname"];?><td><?=$nrow["sig_rev"] ?><td><?=$nrow["sig_action"] ?><td><?=$nrow["sig_protocol"]?><td><?=$nrow["sig_srcIP"]?><td><?=$nrow["sig_srcPort"]?><td><?=$nrow["sig_direction"]?><td><?=$nrow["sig_dstIP"] ?><td><?php echo $nrow["sig_dstPort"] ?><td><?=$nrow["sig_rule_option"]?></td><td><form method=post action="rmain_mody.php"><input type="hidden" name="sid" value=<?=$nrow["sig_id"]?>><input type="submit" value="수정"></form><form method=post action="rlistd.php"><input type="hidden" name="del" value=<?=$nrow["sig_id"]?>><input type="submit" value="삭제"></form></tr>');});
        <?php 
                }
            }
        ?> 
    }else{
        <?php
            $ggssql="select gname from sig_group;";
            $ggresult = $conn->query($ggssql);
            $l=0;
            while($gggrow = $ggresult->fetch_assoc()) {
                $allGroup[$l]=$gggrow["gname"];
                //echo "alert('".$allGroup[$l]."');";
                $l++;
            }
            for($i=0;$i<$l;$i++){
        ?>  
                var php_g=<?=json_encode($allGroup[$i])?>;
                //alert(show_by_group);
                //alert(php_g);
                if(show_by_group==php_g){
                <?php
                $nssql="select gid from sig_group where gname='".$allGroup[$i]."';";
                $nsgid = $conn->query($nssql);
                $ngrow = $nsgid->fetch_assoc();
                $asql="select * from signature where sig_gid=".$ngrow["gid"].";";
                $result = $conn->query($asql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($nrow = $result->fetch_assoc()) {
                ?>
                        $(function() {$('#myTable > tbody:last').append('<tr><td><?=$nrow["sig_msg"]?><td><?=$nrow["sig_sid"]?><td><?=$allGroup[$i];?><td><?=$nrow["sig_rev"] ?><td><?=$nrow["sig_action"] ?><td><?=$nrow["sig_protocol"]?><td><?=$nrow["sig_srcIP"]?><td><?=$nrow["sig_srcPort"]?><td><?=$nrow["sig_direction"]?><td><?=$nrow["sig_dstIP"] ?><td><?php echo $nrow["sig_dstPort"] ?><td><?=$nrow["sig_rule_option"]?></td><td><form method=post action="rmain_mody.php"><input type="hidden" name="sid" value=<?=$nrow["sig_id"]?>><input type="submit" value="수정"></form><form method=post action="rlistd.php"><input type="hidden" name="del" value=<?=$nrow["sig_id"]?>><input type="submit" value="삭제"></form></tr>');});
                <?php 
                    }
                }else{
                ?>
                    $(function() {$('#myTable > tbody:last').append('<tr><td colspan=14 align=center>No Rules</td></tr>');});
                <?php
                }
                ?> 
                }
        <?php
            }
        ?>
    }
 }
</script>