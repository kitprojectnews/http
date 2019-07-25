<?php
include 'dbconn.php';
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
<body>
<h1 align="center">Rule Maker</h1>
<form name=rmk>
	<table style="width:50%" align="center" >
		<tr>
			<th colspan=2>Rule Info</th>
		</tr>
		<tr>
			<td style="width:40%">&nbsp;Rule Name</td>
			<td><input type="text" id="rule_name" value=<?=$sig_msg?>></td>
		</tr>
		<tr>
			<td>&nbsp;Rule Group Name</td>
			<td><select id="rule_group_name">
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
					<option value="alert">alert</option>
					<option value="log">log</option>
					<option value="pass">pass</option>
				</select>
			</td>
		</tr>

		<tr>
			<td style="width:25%" align=center>Protocol</td>
			<td>
				<select id="protocol" style="width:300px;height:20px;">
					<option value="tcp">tcp</option>
					<option value="udp">udp</option>
					<option value="icmp">icmp</option>
				</select>
			</td>
		</tr>

		<tr><!-- ######### SOURCE IP ########## -->
			<td style="width:25%" align=center>Source IP</td>
			<td>
				<input type="checkbox" id="s1c" onchange="div_hidden_cbox('s1c', 'srcip_div1', 'srcip_div2')">직접 입력하기
				<!-- Source IP Var -->
				<div id="srcip_div1">
				<select id="srcip_v" style="width:300px;height:20px;">
					<?php 
						 $ipsql="select * from sig_ip_variables;";
						 $ipresult = $conn->query($ipsql);
						 if ($ipresult->num_rows > 0) {
							// output data of each row
							while($iprow = $ipresult->fetch_assoc()) {
							?>
					<option><?=substr($iprow["v_name"],1)?></option>
					<?php 
							}
						}
					?>
				</select>
				</div>
				
				<!-- Source IP Direct Input -->
				<div id="srcip_div2" style="display:none">
				<input type="text" size=3 id="src_ip1" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" size=3 id="src_ip2" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" size=3 id="src_ip3" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" size=3 id="src_ip4" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> /
				<input type="text" size=3 id="src_sm" 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="subnetmaskRange(this)" 
				style="ime-mode:disabled">
				</div>

				<!-- Source IP Option-->
				<select id="src_ip_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not">NOT</option>
					<option value="any">ANY</option>
				</select>
			</td>
		</tr>

		<tr><!-- ######### SOURCE PORT ########## -->
			<td style="width:25%" align=center>Source Port</td>
			<td>
				<input type="checkbox" id="s2c" onchange="div_hidden_cbox('s2c', 'srcport_div1', 'srcport_div2')">직접 입력하기
				<!--
				<input type="radio" checked name="s2" onclick="div_hidden('srcport_div1', 'srcport_div2')">직접입력 |
				<input type="radio" name="s2"  onclick="div_hidden('srcport_div2', 'srcport_div1')">변수 -->
				<div id="srcport_div1">
					<!--<input type="text" id="srcport_v">-->
					<select id="srcport_v" style="width:300px;height:20px;">
						<?php 
							 $portsql="select * from sig_port_variables;";
							 $portresult = $conn->query($portsql);
							 if ($portresult->num_rows > 0) {
								// output data of each row
								while($portrow = $portresult->fetch_assoc()) {
						?>
									<option><?=substr($portrow["v_name"],1)?></option>
						<?php 
								}
							}
						?>
					</select>
				</div>

				<div id="srcport_div2" style="display:none">
				<input type="text" id="src_port1" size=5 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"> ~ 
				<input type="text" id="src_port2" size=5 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"></div>
				
				<select id="src_port_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not">NOT</option>
					<option value="any">ANY</option>
				</select>
			</td>
		</tr>

		<tr>
			<td style="width:25%" align=center>Direction</td>
			<td>
				<select id="direction" style="width:300px;height:20px;">
					<option value="->">-></option>
					<option value="<>"><></option>
				</select>
			</td>
		</tr>

		<tr>
			<td style="width:25%" align=center>Destination IP</td>
			<td><!-- ######### DESTINATION IP ########## -->
				<input type="checkbox" id="d1c" onchange="div_hidden_cbox('d1c', 'dstip_div1', 'dstip_div2')">직접 입력하기
				<!--
				<input type="radio" checked name="d1" onclick="div_hidden('dstip_div1', 'dstip_div2')">직접입력 |
				<input type="radio" name="d1"  onclick="div_hidden('dstip_div2', 'dstip_div1')">변수 -->
				<div id="dstip_div1">
					<select id="dstip_v" style="width:300px;height:20px;">
						<?php 
							 $ipsql="select * from sig_ip_variables;";
							 $ipresult = $conn->query($ipsql);
							 if ($ipresult->num_rows > 0) {
								// output data of each row
								while($iprow = $ipresult->fetch_assoc()) {
								?>
						<option><?=substr($iprow["v_name"],1)?></option>
						<?php 
								}
							}
						?>
					</select>
				</div>

				<div id="dstip_div2" style="display:none">
				<input type="text" id="dest_ip1" size=3
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" id="dest_ip2" size=3
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" id="dest_ip3" size=3
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> .
				<input type="text" id="dest_ip4" size=3
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="ipRange(this)" 
				style="ime-mode:disabled"> /
				<input type="text" id="dest_sm" size=3
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="subnetmaskRange(this)" 
				style="ime-mode:disabled"></div>
				
				<select id="dest_ip_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not">NOT</option>
					<option value="any">ANY</option>
				</select>
			</td>
		</tr>

		<tr>
			<td style="width:25%" align=center>Destination Port</td>
			<td><!-- ######### DESTINATION PORT ########## -->
				<input type="checkbox" id="d2c" onchange="div_hidden_cbox('d2c', 'dstport_div1', 'dstport_div2')">직접 입력하기

				<!--<input type="radio" checked name="d2" onclick="div_hidden('dstport_div1', 'dstport_div2')">직접입력 |
				<input type="radio" name="d2"  onclick="div_hidden('dstport_div2', 'dstport_div1')">변수 -->
				<div id="dstport_div1">
					<select id="dstport_v" style="width:300px;height:20px;">
						<?php 
							 $portsql="select * from sig_port_variables;";
							 $portresult = $conn->query($portsql);
							 if ($portresult->num_rows > 0) {
								// output data of each row
								while($portrow = $portresult->fetch_assoc()) {
						?>
									<option><?=substr($portrow["v_name"],1)?></option>
						<?php 
								}
							}
						?>
					</select>
				</div>
			
				<div id="dstport_div2" style="display:none">
				<input type="text" id="dest_port1" size=5 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"> ~ 
				<input type="text" id="dest_port2" size=5 
				onkeydown="return onlyNumber(event)" 
				onkeyup="removeChar(event)" 
				onfocusout="removeChar(event)" 
				oninput="portRange(this)" 
				style="ime-mode:disabled"></div>

				<select id="dest_port_opt" style="width:300px;height:20px;">
					<option value="none">NONE</option>
					<option value="not">NOT</option>
					<option value="any">ANY</option>
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
<div align="center">
<form id="tosubmit" name="tosubmit" action="RDBSubmit.php" method="POST">
	<input type="hidden" name="__Rname"  id="__Rname">
	<input type="hidden" name="__RGname" id="__RGname">
	<input type="hidden" name="__full_header" id="__full_header">
	<input type="hidden" name="__full_option" id="__full_option">
	<input type="button" onclick=allCheck() value="값 체크 및 전송" style="height: 50px; width: 650px">
</form>
</div>
</body>
</html>
