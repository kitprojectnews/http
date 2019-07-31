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
<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>
<link href="../css/Observer_switch.css" rel="stylesheet" type='text/css'>
<html>
<head>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/colResizable-1.6.min.js"></script>
<script src="../js/tableaction.js"></script>
</head>
<body>

<h1 align=center>Rule List</h1>
<div style="margin-left:15px">
<input type=button onclick='location.href="rmain.php"' value='룰 추가'>
<select id="rule_group_name" onchange="group_change()"> <!--그룹명 combo_box-->
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
</select><br>
<table border="1" cellspacing="0" id="myTable">
    <thead align="center">
	    <th width=30>Use</th>
        <th width=150 onclick="sortTable(0)">Rule name</th>
        <th width=30 onclick="sortTable(1)">Sid</th>
        <th width=150 onclick="sortTable(2)">Group Name</th>
        <th width=30 onclick="sortTable(3)">Rev</th>
        <th width=80 onclick="sortTable(4)">action</th>
        <th width=80 onclick="sortTable(5)">protocol</th>
        <th width=100 onclick="sortTable(6)">srcIP</th>
        <th width=100 onclick="sortTable(7)">srcPort</th>
        <th width=70 onclick="sortTable(8)">direction</th>
        <th width=100 onclick="sortTable(9)">dstIP</th>
        <th width=100 onclick="sortTable(10)">dstPort</th>
        <th width=250 onclick="sortTable(11)">Rule Option</th>
        <th width=85  onclick="sortTable(12)">Edit</th>
    </thead>
    <tbody>
        <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
        ?>
		<tr>
	<td>
    <script>
        function runner(id){
            if(run.checked==true){
                ifTarget.location.href="run.php?sig_id="+id+"&chk=true";
            }else{
                ifTarget.location.href="run.php?sig_id="+id+"&chk=false";
            }
        }
    </script>
	<div>
    	<label class="switch"> <?php $num = $row['sig_id']; ?>
        <input type="checkbox" id="run<?=json_encode($row['sig_id'])?>" onclick="runner('<?=$num?>')" 
    <?php if($row['sig_run'] == true) { ?> checked <?php  } ?> >
        <span class="slider"></span>
      	</label>
  	</div>
	</td>
        <td><?php echo $row["sig_msg"] ?>
        <td align=center><?php echo $row["sig_sid"] ?>
        <td align=center>
        <?php
            //그룹명 변환
            $ssql="select gname from sig_group where gid=".$row["sig_gid"].";";
            $sgid = $conn->query($ssql);
            $grow = $sgid->fetch_assoc();
            echo $grow["gname"];
        ?>
        <td align=center><?php echo $row["sig_rev"] ?>
        <td align=center><?php echo $row["sig_action"] ?>
        <td align=center><?php echo $row["sig_protocol"] ?>
        <td align=center><?php if($row["sig_srcIP"][0]=='$'){ echo substr($row["sig_srcIP"],1);} else if($row["sig_srcIP"][1]=='$'){ echo "!".substr($row["sig_srcIP"],2);} else{ echo $row["sig_srcIP"];} ?>
        <td align=center><?php if($row["sig_srcPort"][0]=='$'){ echo substr($row["sig_srcPort"],1);} else if($row["sig_srcPort"][1]=='$'){ echo "!".substr($row["sig_srcPort"],2);} else{ echo $row["sig_srcPort"];}?>
        <td align=center><?php echo $row["sig_direction"] ?>
        <td align=center><?php if($row["sig_dstIP"][0]=='$'){ echo substr($row["sig_dstIP"],1);} else if($row["sig_dstIP"][1]=='$'){ echo "!".substr($row["sig_dstIP"],2);} else{ echo $row["sig_dstIP"];}?>
        <td align=center><?php if($row["sig_dstPort"][0]=='$'){ echo substr($row["sig_dstPort"],1);} else if($row["sig_dstPort"][1]=='$'){ echo "!".substr($row["sig_dstPort"],2);} else{ echo $row["sig_dstPort"];}?>
        <td><?php echo $row["sig_rule_option"] ?></td>
        <td>
        <div style="float:left;">
        <form method=post action="rmain_mody.php" style="display:inline;">
        <input type="hidden" name="sid" value=<?=$row["sig_id"]?>>
        <input type="submit" value="수정">
        <!--<input type=button value="수정" onclick=location.href='rmain_mody.php?sid='>-->
        </form>
        </div>
        <div style="float:right;">
        <form method=post action="rlistd.php" style="display:inline;">
        <input type="hidden" name="del" value=<?=$row["sig_id"]?>>
        <input type="submit" value="삭제">
        <!--<input type=button value="삭제" onclick=location.href='rlist.php?del='></td>-->
        </form> 
        </div>
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
</div>
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
        $(function() {$('#myTable > tbody:last').append('<tr><td><?=$nrow["sig_msg"]?><td><?=$nrow["sig_sid"]?><td><?=$ngrow["gname"];?><td><?=$nrow["sig_rev"] ?><td><?=$nrow["sig_action"] ?><td><?=$nrow["sig_protocol"]?><td><?=$nrow["sig_srcIP"]?><td><?=$nrow["sig_srcPort"]?><td><?=$nrow["sig_direction"]?><td><?=$nrow["sig_dstIP"] ?><td><?php echo $nrow["sig_dstPort"] ?><td><?=$nrow["sig_rule_option"]?></td><td><div style="float:left;"><form method=post action="rmain_mody.php" style="display:inline;"><input type="hidden" name="sid" value=<?=$nrow["sig_id"]?>><input type="submit" value="수정"></form></div><div style="float:right;"><form method=post action="rlistd.php" style="display:inline;"><input type="hidden" name="del" value=<?=$nrow["sig_id"]?>><input type="submit" value="삭제"></form></div></tr>');});
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
                        $(function() {$('#myTable > tbody:last').append('<tr><td><?=$nrow["sig_msg"]?><td><?=$nrow["sig_sid"]?><td><?=$ngrow["gname"];?><td><?=$nrow["sig_rev"] ?><td><?=$nrow["sig_action"] ?><td><?=$nrow["sig_protocol"]?><td><?=$nrow["sig_srcIP"]?><td><?=$nrow["sig_srcPort"]?><td><?=$nrow["sig_direction"]?><td><?=$nrow["sig_dstIP"] ?><td><?php echo $nrow["sig_dstPort"] ?><td><?=$nrow["sig_rule_option"]?></td><td><div style="float:left;"><form method=post action="rmain_mody.php" style="display:inline;"><input type="hidden" name="sid" value=<?=$nrow["sig_id"]?>><input type="submit" value="수정"></form></div><div style="float:right;"><form method=post action="rlistd.php" style="display:inline;"><input type="hidden" name="del" value=<?=$nrow["sig_id"]?>><input type="submit" value="삭제"></form></div></tr>');});
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
<iframe id="ifTarget" name="ifTarget" style="width:0px; height:0px; display:none"></iframe>