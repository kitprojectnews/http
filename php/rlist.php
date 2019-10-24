<?php
    include 'ReSession.php';
    include "dbconn.php";
    session_start();
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
    $li=0;
?>

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
<?php
    if($_SESSION["r_update"]==1){
?>
<input type=button onclick='location.href="rmain.php"' value='룰 추가'>
<?php
    }
?>
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
        <?php
            if($_SESSION["r_update"]==1){
        ?>
	    <th width=30 onclick="sortTable(<?=$li++?>)">Use</th>
        <?php 
            }
        ?>
        <th width=150 onclick="sortTable(<?=$li++?>)">Rule name</th>
        <th width=50 onclick="sortTable(<?=$li++?>)">Serverity</th>
        <th width=30 onclick="sortTable(<?=$li++?>)">Sid</th>
        <th width=150 onclick="sortTable(<?=$li++?>)">Group Name</th>
        <th width=30 onclick="sortTable(<?=$li++?>)">Rev</th>
        <th width=80 onclick="sortTable(<?=$li++?>)">action</th>
        <th width=80 onclick="sortTable(<?=$li++?>)">protocol</th>
        <th width=100 onclick="sortTable(<?=$li++?>)">srcIP</th>
        <th width=100 onclick="sortTable(<?=$li++?>)">srcPort</th>
        <th width=70 onclick="sortTable(<?=$li++?>)">direction</th>
        <th width=100 onclick="sortTable(<?=$li++?>)">dstIP</th>
        <th width=100 onclick="sortTable(<?=$li++?>)">dstPort</th>
        <th width=220 onclick="sortTable(<?=$li++?>)">Rule Option</th>
        <?php
             if($_SESSION["r_update"]==1){
        ?>
        <th width=90>Edit</th>
        <?php 
            }
        ?>
        
    </thead>
    <tbody>
        <?php
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
        ?>
		<tr>
        <?php
            if($_SESSION["r_update"]==1){
        ?>
	    <td>
	    <div>
    	    <label class="switch"> <?php $num = $row['sig_id']; ?>
            <input type="checkbox" id="run<?=$num?>" onclick="runner('<?=$num?>')"
                <?php if($row['sig_run'] == true) { ?> checked <?php  } ?> >
            <span class="slider"></span>
      	    </label>
  	    </div>
	    </td>
        <?php
            }
        ?>
        <td><?php echo htmlentities($row["sig_msg"]) ?>
        <td align=center>
            <?php 
                switch($row["severity"]){
                    case 1:
                        echo '<img src="../images/icons/circle-gray.png" >';
                        break;
                    case 2:
                        echo '<img src="../images/icons/circle-yellow.png" >';
                        break;
                    case 3:
                        echo '<img src="../images/icons/circle-orange.png" >';
                        break;
                    case 4:
                        echo '<img src="../images/icons/circle-dorange.png" >';
                        break;
                    case 5:
                        echo '<img src="../images/icons/circle-red.png" >';
                        break;
                }
            ?>
        </td>
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
        <td><?php echo htmlentities($row["sig_rule_option"]) ?></td>
        <?php
             if($_SESSION["r_update"]==1){
        ?>
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
        <?php 
            }
        ?>
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
