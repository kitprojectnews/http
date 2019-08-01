<?php
    include 'dbconn.php';

    //삭제가 들어왔을 시
    //$del=$_GET["del"];
    //if($del){
    //$sql="delete from signature where sig_id='".$del."' ;";
    //$conn->query($sql);
    //}
    $allGroup;
    $group=$_GET["group"];
    if($group !=""){
        $sql="select gname from sig_group where gid=".$group.";";
        $chkresult = $conn->query($sql);
        $chk_group = $chkresult->fetch_assoc()["gname"];

        $sql="select * from signature where sig_gid=".$group.";";
    }
    else{
    $sql="select * from signature;";
    }
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
<script>
        function runner(id){
            var run=document.getElementById("run"+id);
            if(run.checked ==true){
                ifTarget.location.href="run.php?sig_id="+id+"&chk=true";
            }else{
                ifTarget.location.href="run.php?sig_id="+id+"&chk=false";
            }
        }
</script>
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
		    <option <?php if($chk_group ==$grow["gname"]) {?> selected <?php } ?> ><?=$grow["gname"]?></option>
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
	<div>
    	<label class="switch"> <?php $num = $row['sig_id']; ?>
        <input type="checkbox" id="run<?=$num?>" onclick="runner('<?=$num?>')"
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
        <td colspan=15 align=center>
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
        location.href="rlist.php";
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
                ?>
                location.href="rlist.php?group="+<?=$ngrow["gid"]?>;
                }
        <?php
            }
        ?>
    }
 }
</script>
<iframe id="ifTarget" name="ifTarget" style="width:0px; height:0px; display:none"></iframe>