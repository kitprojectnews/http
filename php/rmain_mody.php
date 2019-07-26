<?php

include 'dbconn.php';

//수정이 들어왔을 시
	$sig_id=$_POST["sid"];
	
	if($sig_id != "")
	{
	//	$sql="select * from signature where sig_id=".$sig_id.";";
	//	$result = $conn->query($sql);
	//
	//	echo $result;
	//
	//	$row = $result->fetch_assoc();
	//	$sig_msg=$row["sig_msg"];
	//	$sig_gid=$row["sig_gid"];
	//	//받은 그룹명
	//	$gsql="select gname from sig_group where gid=".$sig_gid.";";
	//	$gresult = $conn->query($gsql);
	//	$grow = $gresult->fetch_assoc();
    //  $get_gname =$grow["gname"];
		

		$sql = "SELECT * FROM signature WHERE sig_id=".$sig_id.";";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		// sig_msg,sig_rev,sig_sid,sig_gid,sig_action,sig_protocol,sig_srcIP,sig_srcPort,sig_direction,sig_dstIP,sig_dstPort,sig_rule_option

		$sig_gid=$row["sig_gid"];

		//받은 그룹명
		$gsql="select gname from sig_group where gid=".$row["sig_gid"].";";
		$gresult = $conn->query($gsql);
		$grow = $gresult->fetch_assoc();
		$get_gname =$grow["gname"];
	}
	

	
?>
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<script src="rmain2.js"></script>
</head>
<body onload=lastoptions_parse()>
<input type=hidden id=hidden_loption value='<?=$row["sig_rule_option"]?>'>
<h1 align="center">Rule Maker</h1>
<form name=rmk>
	<table style="width:50%" align="center" >
		<tr>
			<th colspan=2>Rule Info</th>
		</tr>
		<tr>
			<td style="width:40%">&nbsp;Rule Name</td>
			<td><input type="text" id="rule_name" value=<?=$row["sig_msg"]?>></td>
		</tr>
		<tr>
			<td>&nbsp;Rule Group Name</td>
			<td><select id="rule_group_name">
			<?php
				if($get_gname !=""){
			?>
			<option><?=$get_gname?></option>
			<?php 
				}
			?>
			<?php 
				 $gsql="select * from sig_group;";
				 $gresult = $conn->query($gsql);
				 if ($gresult->num_rows > 0) {
					// output data of each row
					while($grow = $gresult->fetch_assoc()) {
						if($grow["gname"]==$get_gname)
							continue;
			?>
			<option><?=$grow["gname"]?></option>
			<?php 
					}
				}
			?>
			</select></td>
		</tr>
	</table>
	
	<hr align="center" style="width:50%">
	<table style="width:50%" align="center">
		<tr>
			<th colspan=2>Rule Header</th>
		</tr>
		<tr>
			<td style="width:25%" align=center>Action</td>
			<td>
				<select id="action" style="width:300px;height:20px;">
					<option value="alert" <?php if($row["sig_action"] == "alert"){?> selected <?php } ?>>alert</option>
					<option value="log" <?php if($row["sig_action"] == "log"){?> selected <?php } ?>>log</option>
					<option value="pass" <?php if($row["sig_action"] == "pass"){?> selected <?php } ?>>pass</option>
				</select>
			</td>
		</tr>

		<tr>
			<td style="width:25%" align=center>Protocol</td>
			<td>
				<select id="protocol" style="width:300px;height:20px;">
					<option value="tcp" <?php if($row["sig_protocol"] == "tcp"){?> selected <?php } ?>>tcp</option>
					<option value="udp" <?php if($row["sig_protocol"] == "udp"){?> selected <?php } ?>>udp</option>
					<option value="icmp" <?php if($row["sig_protocol"] == "icmp"){?> selected <?php } ?>>icmp</option>
				</select>
			</td>
		</tr>

		<tr><!-- ######### SOURCE IP ########## -->
		<?php
		$srchid = !(strchr($row["sig_srcIP"], '$')) && !($row["sig_srcIP"] == "any");

		if(!strchr($row["sig_srcIP"], '$'))
		{
			$siptk = explode('.', $row["sig_srcIP"]);
			if(strchr($row["sig_srcIP"], '!'))
			{
				$siptk[0] = substr($siptk[0], 1);
			}
			if(strchr($row["sig_srcIP"], '/'))
			{
				$siptk2 = explode('/', $siptk[3]);
				$siptk[3] = $siptk2[0];
			}
		}
		else
		{
			if(strchr($row["sig_srcIP"], '!'))
				$sivar = substr($row["sig_srcIP"], 2);
			else
				$sivar = substr($row["sig_srcIP"], 1);
		}
		?>
			<td style="width:25%" align=center>Source IP</td>
			<td>
				<input type="checkbox" id="s1c" onchange="div_hidden_cbox('s1c', 'srcip_div1', 'srcip_div2')" <?php if($srchid) { ?> checked <?php } ?>>직접 입력하기
				<!-- Source IP Var -->
				<div id="srcip_div1" <?php if($srchid) { ?> style="display:none" <?php } ?>>
				<select id="srcip_v" style="width:300px;height:20px;">
					<?php 
						 $ipsql="select * from sig_ip_variables;";
						 $ipresult = $conn->query($ipsql);
						 if ($ipresult->num_rows > 0) {
							// output data of each row
							while($iprow = $ipresult->fetch_assoc()) {
							?>
						<option <?php if($sivar == substr($iprow["v_name"],1)) { ?> selected <?php } ?>><?=substr($iprow["v_name"],1)?></option>
					<?php 
							}
						}
					?>
				</select>
				</div>
				<!-- Source IP Direct Input -->
				<div id="srcip_div2" <?php if($srchid) { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
				<input type="text" size=3 id="src_ip1" value="<?=$siptk[0]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" size=3 id="src_ip2"  value="<?=$siptk[1]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" size=3 id="src_ip3"  value="<?=$siptk[2]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" size=3 id="src_ip4"  value="<?=$siptk[3]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> /
				<input type="text" size=3 id="src_sm"  value="<?=$siptk2[1]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="subnetmaskRange(this)" 
				style="ime-mode:disabled">
				</div>

				<!-- Source IP Option-->
				<select id="src_ip_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not" <?php if(strchr($row["sig_srcIP"], '!')) { ?> selected <?php } ?>>NOT</option>
					<option value="any" <?php if($row["sig_srcIP"] == "any") { ?> selected <?php } ?>>ANY</option>
				</select>
			</td>
		</tr>
        <?php 
			// SOURCE PORT PHP 
			//$srchid = !(strchr($row["sig_srcIP"], '$')) && !($row["sig_srcIP"] == "any");
			$srcpthid = !(strchr($row["sig_srcPort"], '$')) && !($row["sig_srcPort"] == "any");

			if(!strchr($row["sig_srcPort"], '$'))
			{
				$spttk = explode(':', $row["sig_srcPort"]);
			}
			else
			{
				if(strchr($row["sig_srcPort"], '!'))
					$spvar = substr($row["sig_srcPort"], 2);
				else
					$spvar = substr($row["sig_srcPort"], 1);
			}
			if(strchr($row["sig_srcPort"], '!'))
			{
				$spttk[0] = substr($spttk[0], 1);
			}
			
		?>
		<tr><!-- ######### SOURCE PORT ########## -->
			<td style="width:25%" align=center>Source Port</td>
			<td>
				<input type="checkbox" id="s2c" onchange="div_hidden_cbox('s2c', 'srcport_div1', 'srcport_div2')" <?php if($srcpthid) { ?> checked <?php } ?>>직접 입력하기
				<!--
				<input type="radio" checked name="s2" onclick="div_hidden('srcport_div1', 'srcport_div2')">직접입력 |
				<input type="radio" name="s2"  onclick="div_hidden('srcport_div2', 'srcport_div1')">변수 -->
				<div id="srcport_div1" <?php if($srcpthid) { ?> style="display:none" <?php } ?>>
					<!--<input type="text" id="srcport_v">-->
					<select id="srcport_v" style="width:300px;height:20px;">
						<?php 
							 $portsql="select * from sig_port_variables;";
							 $portresult = $conn->query($portsql);
							 if ($portresult->num_rows > 0) {
								// output data of each row
								while($portrow = $portresult->fetch_assoc()) {
						?>
									<option <?php if( substr($portrow["v_name"],1) == $spvar) { ?> selected <?php } ?>><?=substr($portrow["v_name"],1)?></option>
						<?php 
								}
							}
						?>
					</select>
				</div>

				<div id="srcport_div2" <?php if($srcpthid) { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
				<input type="text" id="src_port1" size=5  value="<?=$spttk[0]?>" 
				onkeydown="return onlyNumber(event)"
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"> ~ 
				<input type="text" id="src_port2" size=5  value="<?=$spttk[1]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"></div>
				
				<select id="src_port_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not" <?php if(strchr($row["sig_srcPort"], '!')) { ?> selected <?php } ?> >NOT</option>
					<option value="any" <?php if($row["sig_srcPort"] == "any") { ?> selected <?php } ?>>ANY</option>
				</select>
			</td>
		</tr>

		<tr>
			<td style="width:25%" align=center>Direction</td>
			<td>
				<select id="direction" style="width:300px;height:20px;">
					<option value="->" <?php if($row["sig_direction"] == "->"){?> selected <?php } ?>>-></option>
					<option value="<>" <?php if($row["sig_direction"] == "<>"){?> selected <?php } ?>><></option>
				</select>
			</td>
		</tr>

		<tr>
		<?php
			$dsthid = !(strchr($row["sig_dstIP"], '$')) && !($row["sig_dstIP"] == "any");

			if(!strchr($row["sig_dstIP"], '$'))
			{
				$diptk = explode('.', $row["sig_dstIP"]);
				if(strchr($row["sig_dstIP"], '!'))
				{
					$diptk[0] = substr($diptk[0], 1);
				}
				if(strchr($row["sig_dstIP"], '/'))
				{
					$diptk2 = explode('/', $diptk[3]);
					$diptk[3] = $diptk2[0];
				}
			}
			else
			{
				if(strchr($row["sig_dstIP"], '!'))
					$divar = substr($row["sig_dstIP"], 2);
				else
					$divar = substr($row["sig_dstIP"], 1);
			}
		?>
			<td style="width:25%" align=center>Destination IP</td>
			<td><!-- ######### DESTINATION IP ########## -->
			
				<input type="checkbox" id="d1c" onchange="div_hidden_cbox('d1c', 'dstip_div1', 'dstip_div2')" <?php if($dsthid) { ?> checked <?php } ?>>직접 입력하기
				<!--
				<input type="radio" checked name="d1" onclick="div_hidden('dstip_div1', 'dstip_div2')">직접입력 |
				<input type="radio" name="d1"  onclick="div_hidden('dstip_div2', 'dstip_div1')">변수 -->
				<div id="dstip_div1" <?php if($dsthid) { ?> style="display:none" <?php } ?>>
					<select id="dstip_v" style="width:300px;height:20px;">
						<?php 
							 $ipsql="select * from sig_ip_variables;";
							 $ipresult = $conn->query($ipsql);
							 if ($ipresult->num_rows > 0) {
								// output data of each row
								while($iprow = $ipresult->fetch_assoc()) {
								?>
						<option <?php if($divar == substr($iprow["v_name"],1)) { ?> selected <?php } ?>><?=substr($iprow["v_name"],1)?></option>
						<?php 
								}
							}
						?>
					</select>
				</div>

				<div id="dstip_div2" <?php if($dsthid) { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
				<input type="text" id="dest_ip1" size=3  value="<?=$diptk[0]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" id="dest_ip2" size=3  value="<?=$diptk[1]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" id="dest_ip3" size=3  value="<?=$diptk[2]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" id="dest_ip4" size=3  value="<?=$diptk[3]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> /
				<input type="text" id="dest_sm" size=3  value="<?=$diptk2[1]?>" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="subnetmaskRange(this)" 
				style="ime-mode:disabled"></div>
				
				<select id="dest_ip_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not" <?php if(strchr($row["sig_dstIP"], '!')) { ?> selected <?php } ?> >NOT</option>
					<option value="any" <?php if($row["sig_dstIP"] == "any") { ?> selected <?php } ?>>ANY</option>
				</select>
			</td>
		</tr>

		<tr>
		<?php 
			// Destination PORT PHP 
			
			$dstpthid = !(strchr($row["sig_dstPort"], '$')) && !($row["sig_dstPort"] == "any");

			if(!strchr($row["sig_dstPort"], '$'))
			{
				$dpttk = explode(':', $row["sig_dstPort"]);
			}
			else
			{
				if(strchr($row["sig_dstPort"], '!'))
					$dpvar = substr($row["sig_dstPort"], 2);
				else
					$dpvar = substr($row["sig_dstPort"], 1);
			}
			if(strchr($row["sig_dstPort"], '!'))
			{
				$dpttk[0] = substr($dpttk[0], 1);
			}
		?>

			<td style="width:25%" align=center>Destination Port</td>
			<td><!-- ######### DESTINATION PORT ########## -->
				<input type="checkbox" id="d2c" onchange="div_hidden_cbox('d2c', 'dstport_div1', 'dstport_div2')" <?php if($dstpthid) { ?> checked <?php } ?>>직접 입력하기

				<!--<input type="radio" checked name="d2" onclick="div_hidden('dstport_div1', 'dstport_div2')">직접입력 |
				<input type="radio" name="d2"  onclick="div_hidden('dstport_div2', 'dstport_div1')">변수 -->
				<div id="dstport_div1" <?php if($dstpthid) { ?> style="display:none" <?php } ?>>
					<select id="dstport_v" style="width:300px;height:20px;">
						<?php 
							 $portsql="select * from sig_port_variables;";
							 $portresult = $conn->query($portsql);
							 if ($portresult->num_rows > 0) {
								// output data of each row
								while($portrow = $portresult->fetch_assoc()) {
						?>
									<option <?php if( substr($portrow["v_name"],1) == $dpvar) { ?> selected <?php } ?>><?=substr($portrow["v_name"],1)?></option>
						<?php 
								}
							}
						?>
					</select>
				</div>
			
				<div id="dstport_div2" <?php if($dstpthid) { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
				<input type="text" id="dest_port1" size=5   value="<?=$dpttk[0]?>"
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"> ~ 
				<input type="text" id="dest_port2" size=5   value="<?=$dpttk[1]?>"
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"></div>

				<select id="dest_port_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not" <?php if(strchr($row["sig_dstPort"], '!')) { ?> selected <?php } ?> >NOT</option>
					<option value="any"<?php if($row["sig_dstPort"] == "any") { ?> selected <?php } ?> >ANY</option>
				</select>
			</td>
		</tr>
	</table>
	<hr align="center" style="width:50%">
	<table style="width:50%" align="center" >
		<tr>
			<th colspan=2>Rule Option</th>
		</tr>
		<tr>
			<td colspan=2 align="center">
				<select id="options" name="options" >
					<option value=content>Content</option>
					<option value=pcre>PCRE</option>
					<option value=dsize>Data_Payload_Size</option>
					<option value=ttl>IP_TTL</option>
					<option value=tos>IP_TOS</option>
					<option value=flagbits>IP_Flagbits</option>
					<option value=sameip>SameIP</option>
					<option value=flags>TCP_Flags</option>
					<option value=seq>TCP_Seqnum</option>
					<option value=ack>TCP_Acknum</option>
					<option value=window>TCP_WindowSize</option>
					<option value=itype>ICMP_Type</option>
					<option value=icode>ICMP_Code</option>
					<option value=detection_filter>Detection_Filter</option>
					<option value=nation>Nation</option>
				</select>
				&nbsp;
				<input type="button" name="add_option_button" value="추가" onclick="AddOption()">
		</td>
		</tr>
		<tr><td colspan="2"><div id=addingoption ></div></td></tr>
	</table>
</form>
<br>
<div align="center">
<form id="tosubmit" name="tosubmit" action="RDBMODY.php" method="POST">
  <input type="hidden" name="__sid" id="__sid" value='<?=(int)$sig_id?>'>
	<input type="hidden" name="__Rname"  id="__Rname">
	<input type="hidden" name="__RGname" id="__RGname">
	<input type="hidden" name="__full_header" id="__full_header">
	<input type="hidden" name="__full_option" id="__full_option">
	<input type="button" onclick=allCheck() value="값 체크 및 전송" style="height: 50px; width: 650px">
</form>
</div>
</body>
</html>
