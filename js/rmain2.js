//TODO
//ANY사용시 값을 입력하라고 나옴
/*
		== Rule Info ==
		"rule_name"
		"rule_number"
		"rule_group_number"

		== Rule Header ==
		radio "action"
		radio "protocol"
		"src_ip1" "src_ip2" "src_ip3" "src_ip4" "src_ip1" "src_sm" 또는 "srcip_v"
		radio "src_ip_opt"
		"src_port1" "src_port2" 또는 "srcport_v"
		radio "src_port_opt"
		radio "direction"
		"dest_ip1" "dest_ip2" "dest_ip3" "dest_ip4" "dest_sm" 또는 "dstip_v"
		radio "dest_ip_opt"
		"dest_port1" "dest_port2" 또는 "dstport_v"
		radio "dest_port_opt"
*/
function openGroup(){
	window.name = "rmain";
	openWin = window.open("group.php","groupForm","width=300,height=300, scrollbars=no");
}
function radioReturn(name)
{// 변수는 아직 안함
    var ck = document.getElementsByName(name);
    var typ = "";

    for(var i = 0; i < ck.length; i++)
	{
		if(ck[i].checked == true)
		{
            typ = ck[i].value;
		}
    }
    return typ;
}
function makeString()
{
    var str = "";
    var space = " ";
	var dot = ".";
	var id;
	
	id = document.getElementById("action");
	str += id.options[id.selectedIndex].value;
	str += space;
	id = document.getElementById("protocol");
	str += id.options[id.selectedIndex].value;
	str += space;

	
	// Source IP
	id = document.getElementById("srcip_v");
	
	if(document.getElementById("s1c").checked == true)
	{
		if(document.getElementById("s1not").checked == true)
			str += "!";
		str += document.getElementById("src_ip1").value;
        	str += dot;
        	str += document.getElementById("src_ip2").value;
        	str += dot;
        	str += document.getElementById("src_ip3").value;
        	str += dot;
        	str += document.getElementById("src_ip4").value;

        	if(document.getElementById("src_sm").value != "")
        	{
        	    str += "/";
        	    str += document.getElementById("src_sm").value;
		}
		str += space;
	}
	else
	{
		if(id.options[id.selectedIndex].value == "any")
			str += "any ";
		else
		{
			if(document.getElementById("s1not").checked == true)
				str += "!";
			str += "$";
			id = document.getElementById("srcip_v");
			str += id.options[id.selectedIndex].value;
			str += space;
		}
	}
	
	// Source Port
	id = document.getElementById("srcport_v");
	
	if((document.getElementById("s2c").checked != true) && (id.options[id.selectedIndex].value == "any"))
	{
		str += "any ";
	}
	else
	{
		if(document.getElementById("s2not").checked == true)
			str += "!";
		
		if(document.getElementById("s2c").checked == false)
		{
			str += "$";
			id = document.getElementById("srcport_v");
			str += id.options[id.selectedIndex].value;
			str += space;
		}
		else
		{
			str += document.getElementById("src_port1").value;
        	if(document.getElementById("src_port2").value != "")
        	{   
        	    str += ":";
				str += document.getElementById("src_port2").value;
			}
			str += space;
		}
	}
	
	// Direction
	id = document.getElementById("direction");
	str += id.options[id.selectedIndex].value;
	str += space;

	// Destination IP
	id = document.getElementById("dstip_v");
	if((document.getElementById("d1c").checked != true) && (id.options[id.selectedIndex].value == "any"))
	{
		str += "any ";
	}
	else
	{
		if(document.getElementById("d1not").checked == true)
			str += "!";
		
		if(document.getElementById("d1c").checked == false)
		{
			str += "$";
			id = document.getElementById("dstip_v");
			str += id.options[id.selectedIndex].value;
			str += space;
		}
		else
		{
			str += document.getElementById("dest_ip1").value;
        	str += dot;
        	str += document.getElementById("dest_ip2").value;
        	str += dot;
        	str += document.getElementById("dest_ip3").value;
        	str += dot;
        	str += document.getElementById("dest_ip4").value;

        	if(document.getElementById("dest_sm").value != "")
        	{
        	    str += "/";
        	    str += document.getElementById("dest_sm").value;
			}
			str += space;
		}
	}


	// Destination Port
	id = document.getElementById("dstport_v");
	if((document.getElementById("d2c").checked != true) && (id.options[id.selectedIndex].value == "any"))
	{
		str += "any ";
	}
	else
	{
		if(document.getElementById("d2not").checked == true)
			str += "!";
		
		if(document.getElementById("d2c").checked == false)
		{
			str += "$";
			id = document.getElementById("dstport_v");
			str += id.options[id.selectedIndex].value;
			str += space;
		}
		else
		{
			str += document.getElementById("dest_port1").value;
        	if(document.getElementById("dest_port2").value != "")
        	{   
        	    str += ":";
				str += document.getElementById("dest_port2").value;
			}
			str += space;
		}
	}

	return str;





   // str += radioReturn("action");
   // str += space;
   // str += radioReturn("protocol");
   // str += space;
   // if(document.getElementsByName("src_ip_opt")[2].checked != true)
   // {// NOT or NONE
   //     if(document.getElementsByName("src_ip_opt")[1].checked == true)
   //     {
   //         str += "!";
   //     }
   //     str += document.getElementById("src_ip1").value;
   //     str += dot;
   //     str += document.getElementById("src_ip2").value;
   //     str += dot;
   //     str += document.getElementById("src_ip3").value;
   //     str += dot;
   //     str += document.getElementById("src_ip4").value;
//
   //     if(document.getElementById("src_sm").value != "")
   //     {
   //         str += "/";
   //         str += document.getElementById("src_sm").value;
   //     }
   // }
   // else
   // {// ANY
   //     str += "any";
   // }
   // str += space;
   // if(document.getElementsByName("src_port_opt")[2].checked != true)
   // {
   //     if(document.getElementsByName("src_port_opt")[1].checked == true)
   //     {
   //         str += "!";
   //     }
//
   //     str += document.getElementById("src_port1").value;
   //     if(document.getElementById("src_port2").value != "")
   //     {   
   //         str += ":";
   //         str += document.getElementById("src_port2").value;
   //     }
   // }
   // else
   // {
   //     str += "any";
   // }
   // str += space;
//
   // if(document.getElementsByName("direction")[0].checked != true)
   // {
   //     str += "<->";
   // }
   // else
   // {
   //     str += "->";
   // }
   // str += space;
   // 
   // if(document.getElementsByName("dest_ip_opt")[2].checked != true)
   // {// NOT or NONE
   //     if(document.getElementsByName("dest_ip_opt")[1].checked == true)
   //     {
   //         str += "!";
   //     }
   //     str += document.getElementById("dest_ip1").value;
   //     str += dot;
   //     str += document.getElementById("dest_ip2").value;
   //     str += dot;
   //     str += document.getElementById("dest_ip3").value;
   //     str += dot;
   //     str += document.getElementById("dest_ip4").value;
//
   //     if(document.getElementById("dest_sm").value != "")
   //     {
   //         str += "/";
   //         str += document.getElementById("dest_sm").value;
   //     }
   // }
   // else
   // {// ANY
   //     str += "any";
   // }
   // str += space;
//
   // if(document.getElementsByName("dest_port_opt")[2].checked != true)
   // {
   //     if(document.getElementsByName("dest_port_opt")[1].checked == true)
   //     {
   //         str += "!";
   //     }
//
   //     str += document.getElementById("dest_port1").value;
   //     if(document.getElementById("dest_port2").value != "")
   //     {   
   //         str += ":";
   //         str += document.getElementById("dest_port2").value;
   //     }
   // }
   // else
   // {
   //     str += "any";
   // }
   // str += space;
   // 
   // return str;
}
/*
TODO
직접입력 / 변수입력
변수입력 선택 후 값 입력, 그 후에 직접입력 선택 후 올바른 값을 입력하면 alert 뜨는 문제점

*/
//옵션 정보
//https://m.blog.naver.com/PostView.nhn?blogId=koromoon&logNo=120177929267&proxyReferer=https%3A%2F%2Fwww.google.com%2F
//JS자료
//http://www.webmadang.net/javascript/javascript.do?boardid=8001

// var
var _ip = new Array(0);
var	_ipname = new Array(0);
var _ipcnt = 0;
var _pt = new Array(0);
var _ptname = new Array(0);
var _ptcnt = 0;
// only number
//http://webskills.kr/archives/310
function onlyNumber(event){
		event = event || window.event;
		var keyID = (event.which) ? event.which : event.keyCode;
		if ( (keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 9 || keyID == 46 || keyID == 37 || keyID == 39 ) 
			return;
		else
			return false;
}// onlyNumber
function removeChar(event) {
	event = event || window.event;
	var keyID = (event.which) ? event.which : event.keyCode;
	if ( keyID == 8 || keyID == 9 || keyID == 46 || keyID == 37 || keyID == 39 ) 
		return;
	else
		event.target.value = event.target.value.replace(/[^0-9]/g, "");
}// removeChar
function ipRange(object)
{//http://dlrkdus0629dot.dothome.co.kr/wp/?p=223
	var num = parseInt(object.value);
	if(num < 0 || num > 255)
		object.value = object.value.slice(0, object.maxLength);
}// ipRange
function subnetmaskRange(object)
{
	var num = parseInt(object.value);
	if(num < 0 || num > 32)
		object.value = object.value.slice(0, object.maxLength);
}// subnetmaskRange
function portRange(object)
{
	var num = parseInt(object.value);
	if(num < 0 || num > 65535)
		object.value = object.value.slice(0, object.maxLength);
}// portRange
function uint32Range(object)
{
	var num = parseInt(object.value);
	if(num < 0 || num > 4294967295)
		object.value = object.value.slice(0, object.maxLength);
}// uint32Range
var sameipflag = false;



function AddOption()
{
	var option = document.getElementById("options");
	var option_name;
	if(option.options[option.selectedIndex].value == "content")
		option_name="content";
	else if(option.options[option.selectedIndex].value == "pcre")
		option_name="pcre";
	else if(option.options[option.selectedIndex].value == "dsize")
		option_name="dsize";
	else if(option.options[option.selectedIndex].value == "ttl")
		option_name="ttl";
	else if(option.options[option.selectedIndex].value == "tos")
		option_name="tos";
	else if(option.options[option.selectedIndex].value == "flagbits")
		option_name="flagbits";
	else if(option.options[option.selectedIndex].value == "sameip"){
		if(sameipflag){
			alert("sameip는 1개만 사용가능 합니다.");
			return 1;
		}
		else{			
			sameipflag=true;
		}
		option_name="sameip";
	}
	else if(option.options[option.selectedIndex].value == "flags")
		option_name="flags";
	else if(option.options[option.selectedIndex].value == "seq")
		option_name="seq";
	else if(option.options[option.selectedIndex].value == "ack")
		option_name="ack";
	else if(option.options[option.selectedIndex].value == "window")
		option_name="window";
	else if(option.options[option.selectedIndex].value == "itype")
		option_name="itype";
	else if(option.options[option.selectedIndex].value == "icode")
		option_name="icode";
	else if(option.options[option.selectedIndex].value == "detection_filter")
		option_name="detection_filter";
	else if(option.options[option.selectedIndex].value == "nation")
		option_name="nation";
	else if(option.options[option.selectedIndex].value == "ml")
		option_name="ml";
	else {
		return -1;
	}
	addoption(option_name);
}// AddOption()
var count=0;
var lcount=0;
var delete_cnt=0;
var coption=new Array(0);
var delete_num=new Array(0);

//넘어온 옵션 파싱
function lastoptions_parse(){
	var content_flag=false;
	var l_option=document.getElementById("hidden_loption").value;
	var p_semi = l_option.split("; ");
	for( i in p_semi){
		var p_col = p_semi[i].split(":");

		if(p_semi[i]=="sameip"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("sameip");
			sameipflag=true;
			lcount++;
			continue;
		}

		if(p_col[0]=="pcre"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("pcre");
			document.getElementById("pcre"+lcount).value =p_col[1];
			lcount++;
			continue;
		}else if(p_col[0]=="dsize"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("dsize");
			if(p_col[1][0]== '>'){
				document.getElementById("dsize>"+lcount).checked=true;
				document.getElementById("dsize_sin_"+lcount).value =p_col[1].substr(1);
			}else if(p_col[1][0]== '<'){
				document.getElementById("dsize<"+lcount).checked=true;
				document.getElementById("dsize_sin_"+lcount).value =p_col[1].substr(1);
			}else{
				var range = p_col[1].split("<>");
				if(range[1]){
					document.getElementById("dsize~"+lcount).checked=true;
					document.getElementById("dsize1"+lcount).style.display = "none";
					document.getElementById("dsize2"+lcount).style.display = "block";
					document.getElementById("dsize_dou1_"+lcount).value =range[1];
					document.getElementById("dsize_dou2_"+lcount).value =range[1];
				}else{
					document.getElementById("dsize="+lcount).checked=true;
					document.getElementById("dsize_sin_"+lcount).value =p_col[1];
				}
			}
			lcount++;
			continue;
		}else if(p_col[0]=="ttl"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("ttl");
			if(p_col[1][0]== '>' && p_col[1][1]== '='){
				document.getElementById("ttl>="+lcount).checked=true;
				document.getElementById("ttl_sin_"+lcount).value =p_col[1].substr(2);
				substr()
			}else if(p_col[1][0]== '<' && p_col[1][1]== '='){
				document.getElementById("ttl<="+lcount).checked=true;
				document.getElementById("ttl_sin_"+lcount).value =p_col[1].substr(2);
			}else if(p_col[1][0]== '>'){
				document.getElementById("ttl>"+lcount).checked=true;
				document.getElementById("ttl_sin_"+lcount).value =p_col[1].substr(1);
			}else if(p_col[1][0]== '<'){
				document.getElementById("ttl<"+lcount).checked=true;
				document.getElementById("ttl_sin_"+lcount).value =p_col[1].substr(1);
			}else{
				var range = p_col[1].split("<>");
				if(range[1]){
					document.getElementById("ttl~"+lcount).checked=true;
					document.getElementById("ttl1"+lcount).style.display = "none";
					document.getElementById("ttl2"+lcount).style.display = "block";
					document.getElementById("ttl_dou1_"+lcount).value =range[1];
					document.getElementById("ttl_dou2_"+lcount).value =range[1];
				}else{
					document.getElementById("ttl="+lcount).checked=true;
					document.getElementById("ttl_sin_"+lcount).value =p_col[1];
				}
			}
			lcount++;
			continue;
		}else if(p_col[0]=="tos"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("tos");
			if(p_col[1][0]== '!'){
				document.getElementById("tosNOT"+lcount).checked=true;
				document.getElementById("tos"+lcount).value =p_col[1].substr(1);
			}else{
				document.getElementById("tos"+lcount).value =p_col[1];
			}
			lcount++;
			continue;
		}else if(p_col[0]=="flagbits"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("flagbits");
			if(p_col[1][0]== '!'){
				document.getElementById("flagbitsNOT"+lcount).checked=true;
			}if(p_col[1].search('M')!=-1){
				document.getElementById("Mflag"+lcount).checked=true;
			}if(p_col[1].search('D')!=-1){
				document.getElementById("Dflag"+lcount).checked=true;
			}
			lcount++;
			continue;
		}else if(p_col[0]=="flags"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("flags");
			if(p_col[1][0]== '!'){
				document.getElementById("flagsNOT"+lcount).checked=true;
			}if(p_col[1].search('F')!=-1){
				document.getElementById("Fflag"+lcount).checked=true;
			}if(p_col[1].search('S')!=-1){
				document.getElementById("Sflag"+lcount).checked=true;
			}if(p_col[1].search('R')!=-1){
				document.getElementById("Rflag"+lcount).checked=true;
			}if(p_col[1].search('P')!=-1){
				document.getElementById("Pflag"+lcount).checked=true;
			}if(p_col[1].search('A')!=-1){
				document.getElementById("Aflag"+lcount).checked=true;
			}if(p_col[1].search('U')!=-1){
				document.getElementById("Uflag"+lcount).checked=true;
			}
			lcount++;
			continue;
		}else if(p_col[0]=="seq"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("seq");
			document.getElementById("seq"+lcount).value =p_col[1];
			lcount++;
			continue;
		}else if(p_col[0]=="ack"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("ack");
			document.getElementById("ack"+lcount).value =p_col[1];
			lcount++;
			continue;
		}else if(p_col[0]=="window"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("window");
			if(p_col[1][0]== '!'){
				document.getElementById("window"+lcount).checked=true;
				document.getElementById("window"+lcount).value =p_col[1].substr(1);
			}else{
				document.getElementById("window"+lcount).value =p_col[1];
			}
			lcount++;
			continue;
		}else if(p_col[0]=="itype"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("itype");
			if(p_col[1][0]== '>'){
				document.getElementById("itype>"+lcount).checked=true;
				document.getElementById("itype_sin_"+lcount).value =p_col[1].substr(1);
			}else if(p_col[1][0]== '<'){
				document.getElementById("itype<"+lcount).checked=true;
				document.getElementById("itype_sin_"+lcount).value =p_col[1].substr(1);
			}else{
				var range = p_col[1].split("<>");
				if(range[1]){
					document.getElementById("itype~"+lcount).checked=true;
					document.getElementById("itype1"+lcount).style.display = "none";
					document.getElementById("itype2"+lcount).style.display = "block";
					document.getElementById("itype_dou1_"+lcount).value =range[1];
					document.getElementById("itype_dou2_"+lcount).value =range[1];
				}else{
					document.getElementById("itype="+lcount).checked=true;
					document.getElementById("itype_sin_"+lcount).value =p_col[1];
				}
			}
			lcount++;
			continue;
		}else if(p_col[0]=="icode"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("icode");
			if(p_col[1][0]== '>'){
				document.getElementById("icode>"+lcount).checked=true;
				document.getElementById("icode_sin_"+lcount).value =p_col[1].substr(1);
			}else if(p_col[1][0]== '<'){
				document.getElementById("icode<"+lcount).checked=true;
				document.getElementById("icode_sin_"+lcount).value =p_col[1].substr(1);
			}else{
				var range = p_col[1].split("<>");
				if(range[1]){
					document.getElementById("icode~"+lcount).checked=true;
					document.getElementById("icode1"+lcount).style.display = "none";
					document.getElementById("icode2"+lcount).style.display = "block";
					document.getElementById("icode_dou1_"+lcount).value =range[1];
					document.getElementById("icode_dou2_"+lcount).value =range[1];
				}else{
					document.getElementById("icode="+lcount).checked=true;
					document.getElementById("icode_sin_"+lcount).value =p_col[1];
				}
			}
			lcount++;
			continue;
		}else if(p_col[0]=="detection_filter"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("detection_filter");
			var df = p_col[1].split(', ');
			for(var y=0;y<3;y++){
				var space=df[y].split(' ');
				dfopt=document.getElementById("df_opt"+lcount);
				for(var j=0; j<dfopt.options.length;j++){
					if(dfopt.options[j].value==space[1]){
						dfopt.options[j].selected=true;
						break;
					}
				}
				if(space[0]=="count"){
					document.getElementById("df_count"+lcount).value =space[1];
				}
				if(space[0]=="seconds"){
					document.getElementById("df_sec"+lcount).value =space[1];
				}
			}
			lcount++;
			continue;
		}else if(p_col[0]=="nation"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("nation");
			naopt=document.getElementById("na_opt"+lcount);
			for(var j=0; j<naopt.options.length;j++){
				if(naopt.options[j].value==p_col[1]){
					naopt.options[j].selected=true;
					break;
				}
			}
			lcount++;
			continue;
		}
		else if(p_col[0]=="ml"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("ml");
			mlopt=document.getElementById("ml_opt"+lcount);
			mlmod=document.getElementById("mlmod"+lcount);
			mlopti=document.getElementById("ml_opt_input"+lcount);
			var mlchk=true;
			for(var j=0; j<mlopt.options.length;j++){
				if(mlopt.options[j].value==p_col[1]){
					mlopt.options[j].selected=true;
					mlchk = false;
					break;
				}
			}
			if(mlchk==true){
				ml1="ml1"+lcount;
				ml2="ml2"+lcount;
				mlm="mlmod"+lcount;
				div_hidden(ml2,ml1);
				mlmod.checked=true;
				mlopti.value=p_col[1];				
			}
			lcount++;
			continue;
		}

		if(p_col[0]=="content"){
			if(content_flag){
				content_flag=false;
				lcount++;
			}
			addoption("content");
			content_flag=true;
			document.getElementById("content"+lcount).value =p_col[1].substr(1,p_col[1].length-2);
			continue;
		}else if(p_semi[i]=="nocase"){
			document.getElementById("nocase"+lcount).checked=true;
			continue;
		}else if(p_col[0]=="depth"){
			document.getElementById("depth"+lcount).value =p_col[1];
			continue;
		}else if(p_col[0]=="offset"){
			document.getElementById("offset"+lcount).value =p_col[1];
			continue;
		}else if(p_col[0]=="distance"){
			document.getElementById("distance"+lcount).value =p_col[1];
			continue;
		}else if(p_col[0]=="within"){
			document.getElementById("within"+lcount).value =p_col[1];
			continue;
		}else{//http_option 선택 
			htpopt=document.getElementById("httpopt"+lcount);
			for(var j=0; j<htpopt.options.length;j++){
				if(htpopt.options[j].value==p_semi[i]){
					htpopt.options[j].selected=true;
					break;
				}
			}
		}
	}

}//lastoptions

function addoption(opt){
	//var tr=document.createElement("table");
	var tr=document.createElement("div");
	var option=document.getElementById("addingoption");		
	var text="<table id=op"+count+" ><tr><td width=170>"+opt+"&nbsp;</td><td width=659><input type='button' value='삭제' onClick='removeoption("+count+")'>&nbsp;";
	if(opt=="content"){
		coption[count]="content";
		text+="<select id=httpopt"+count+"><option>선택</option><option>http_client_body</option><option>http_cookie</option><option>http_header</option>";
		text+="<option>http_method</option><option >http_uri</option><option>http_stat_code</option><option>http_stat_msg</option></select>";
		text+="<input type=checkbox id=nocase"+count+">nocase<br>";
		text+="depth:&nbsp;<input type=text id=depth"+count+" size=3 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='portRange(this)' style='ime-mode:disabled'>&nbsp;";
		text+="offset:&nbsp;<input type=text id=offset"+count+" size=3 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='portRange(this)' style='ime-mode:disabled'>&nbsp;";
		text+="distance:&nbsp;<input type=text id=distance"+count+" size=3 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='portRange(this)' style='ime-mode:disabled'>&nbsp;";
		text+="within:&nbsp;<input type=text id=within"+count+" size=3 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='portRange(this)' style='ime-mode:disabled'>&nbsp;<br>";
		text+="content:&nbsp;<input type=text id=content"+count+">&nbsp;";
	}
	else if(opt=="pcre"){
		coption[count]="pcre";
		text+="<input type=text id=pcre"+count+">";
	}
	else if(opt=="dsize"){
		coption[count]="dsize";
		//라디오버튼 추가
		//text+="<select id=dsizeopt"+count+" onchange=select_hidden('dsizeopt',"+count+",'dsize2_"+count+"')><option><</option><option>></option><option>~</option><option>=</option></select>&nbsp;";
		text+="<input type=radio id='dsize<"+count+"' name=dsizeRadio"+count+" value='<' onclick=div_hidden('dsize1"+count+"','dsize2"+count+"')><&nbsp;"
		text+="<input type=radio id='dsize>"+count+"' name=dsizeRadio"+count+" value='>' onclick=div_hidden('dsize1"+count+"','dsize2"+count+"')>>&nbsp;"
		text+="<input type=radio id='dsize="+count+"' name=dsizeRadio"+count+" value='=' onclick=div_hidden('dsize1"+count+"','dsize2"+count+"')>=&nbsp;"
		text+="<input type=radio id='dsize~"+count+"' name=dsizeRadio"+count+" value='~' onclick=div_hidden('dsize2"+count+"','dsize1"+count+"')>~&nbsp;"
		text+="<div id=dsize1"+count+"><input type=text id=dsize_sin_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'>&nbsp;</div>";
		text+="<div id=dsize2"+count+" style='display:none'><input type=text id=dsize_dou1_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'>&nbsp;";
		text+="<input type=text id=dsize_dou2_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'></div>";
	}
	else if(opt=="ttl"){
		coption[count]="ttl";
		text+="<input type=radio id='ttl<"+count+"' name=ttlRadio"+count+" value='<' onclick=div_hidden('ttl1"+count+"','ttl2"+count+"')><&nbsp;"
		text+="<input type=radio id='ttl>"+count+"' name=ttlRadio"+count+" value='>' onclick=div_hidden('ttl1"+count+"','ttl2"+count+"')>>&nbsp;"
		text+="<input type=radio id='ttl<="+count+"' name=ttlRadio"+count+" value='<=' onclick=div_hidden('ttl1"+count+"','ttl2"+count+"')><=&nbsp;"
		text+="<input type=radio id='ttl>="+count+"' name=ttlRadio"+count+" value='>=' onclick=div_hidden('ttl1"+count+"','ttl2"+count+"')>>=&nbsp;"
		text+="<input type=radio id='ttl="+count+"' name=ttlRadio"+count+" value='=' onclick=div_hidden('ttl1"+count+"','ttl2"+count+"')>=&nbsp;"
		text+="<input type=radio id='ttl~"+count+"' name=ttlRadio"+count+" value='~' onclick=div_hidden('ttl2"+count+"','ttl1"+count+"')>~&nbsp;"
		text+="<div id=ttl1"+count+"><input type=text id=ttl_sin_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>&nbsp;</div>";
		text+="<div id=ttl2"+count+" style='display:none'><input type=text id=ttl_dou1_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>&nbsp;";
		text+="<input type=text id=ttl_dou2_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'></div>";
		//text+="<select id=ttlopt"+count+"><option><</option><option><=</option><option>></option><option>>=</option><option>=</option><option>-</option></select>&nbsp;";
		//text+="<input type=text id=ttl"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'> " ;
	}
	else if(opt=="tos"){
		coption[count]="tos";
		text+="<input type=checkbox id=tosNOT"+count+">NOT&nbsp;";
		text+="<input type=text id=tos"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="flagbits"){
		coption[count]="flagbits";
		text+="<input type=checkbox id=flagbitsNOT"+count+">NOT&nbsp;<input type=checkbox id=Mflag"+count+">Mflag&nbsp;<input type=checkbox id=Dflag"+count+">Dflag&nbsp;";
	}
	else if(opt=="sameip"){
		coption[count]="sameip";
		text+="<input type=hidden id=sameip"+count+">";
	}
	else if(opt=="flags"){
		coption[count]="flags";
		text+="<input type=checkbox id=flagsNOT"+count+">NOT&nbsp;<input type=checkbox id=Fflag"+count+">Fflag&nbsp;<input type=checkbox id=Sflag"+count+">Sflag&nbsp;";
		text+="<input type=checkbox id=Rflag"+count+">Rflag&nbsp;<input type=checkbox id=Pflag"+count+">Pflag&nbsp;<input type=checkbox id=Aflag"+count+">Aflag&nbsp;";
		text+="<input type=checkbox id=Uflag"+count+">Uflag&nbsp;";
	}
	else if(opt=="seq"){
		coption[count]="seq";
		text+="<input type=text id=seq"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="ack"){
		coption[count]="ack";
		text+="<input type=text id=ack"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="window"){
		coption[count]="window";
		text+="<input type=checkbox id=windowNOT"+count+">NOT&nbsp;";
		text+="<input type=text id=window"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='portRange(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="itype"){
		coption[count]="itype";
		text+="<input type=radio id='itype<"+count+"' name=itypeRadio"+count+" value='<' onclick=div_hidden('itype1"+count+"','itype2"+count+"')>모듈선택&nbsp;"
		text+="<input type=radio id='itype>"+count+"' name=itypeRadio"+count+" value='>' onclick=div_hidden('itype1"+count+"','itype2"+count+"')>>&nbsp;"
		text+="<input type=radio id='itype="+count+"' name=itypeRadio"+count+" value='=' onclick=div_hidden('itype1"+count+"','itype2"+count+"')>=&nbsp;"
		text+="<input type=radio id='itype~"+count+"' name=itypeRadio"+count+" value='~' onclick=div_hidden('itype2"+count+"','itype1"+count+"')>~&nbsp;"
		text+="<div id=itype1"+count+"><input type=text id=itype_sin_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>&nbsp;</div>";
		text+="<div id=itype2"+count+" style='display:none'><input type=text id=itype_dou1_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>&nbsp;";
		text+="<input type=text id=itype_dou2_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'></div>";
		//text+="<select id=itypeopt"+count+"><option><</option><option>></option><option>-</option><option>=</option></select>&nbsp;";
		//text+="<input type=text id=itype"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="icode"){
		coption[count]="icode";
		text+="<input type=radio id='icode<"+count+"' name=icodeRadio"+count+" value='<' onclick=div_hidden('icode1"+count+"','icode2"+count+"')><&nbsp;"
		text+="<input type=radio id='icode>"+count+"' name=icodeRadio"+count+" value='>' onclick=div_hidden('icode1"+count+"','icode2"+count+"')>>&nbsp;"
		text+="<input type=radio id='icode="+count+"' name=icodeRadio"+count+" value='=' onclick=div_hidden('icode1"+count+"','icode2"+count+"')>=&nbsp;"
		text+="<input type=radio id='icode~"+count+"' name=icodeRadio"+count+" value='~' onclick=div_hidden('icode2"+count+"','icode1"+count+"')>~&nbsp;"
		text+="<div id=icode1"+count+"><input type=text id=icode_sin_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>&nbsp;</div>";
		text+="<div id=icode2"+count+" style='display:none'><input type=text id=icode_dou1_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>&nbsp;";
		text+="<input type=text id=icode_dou2_"+count+" size=11 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'></div>";
		//text+="<select id=icodeopt"+count+"><option><</option><option>></option><option>-</option><option>=</option></select>&nbsp;";
		//text+="<input type=text id=icode"+count+" onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='ipRange(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="detection_filter"){
		coption[count]="detection_filter";
		text+="<select id=df_opt"+count+"><option value='by_all'>all</option><option value='by_src'>source</option><option value='by_dst'>destination</option></select>&nbsp;";
		text+="count:&nbsp;<input type=text id=df_count"+count+" size=12 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'>&nbsp;";
		text+="seconds:&nbsp;<input type=text id=df_sec"+count+" size=12 onkeydown='return onlyNumber(event)' onkeyup='removeChar(event)' onfocusout='removeChar(event)' oninput='uint32Range(this)' style='ime-mode:disabled'>";
	}
	else if(opt=="nation"){
		coption[count]="nation";
		text+="<select id=na_opt"+count+">";
		text+="<option value=AD>안도라</option>";
		text+="<option value=AE>아랍에미리트</option>";
		text+="<option value=AF>아프가니스탄</option>";
		text+="<option value=AG>앤티가 바부다</option>";
		text+="<option value=AI>앵귈라</option>";
		text+="<option value=AL>알바니아</option>";
		text+="<option value=AM>아르메니아</option>";
		text+="<option value=AO>앙골라</option>";
		text+="<option value=AQ>남극</option>";
		text+="<option value=AR>아르헨티나</option>";
		text+="<option value=AS>아메리칸사모아</option>";
		text+="<option value=AT>오스트리아</option>";
		text+="<option value=AU>오스트레일라아</option>";
		text+="<option value=AW>아루바</option>";
		text+="<option value=AX>올란드 제도</option>";
		text+="<option value=AZ>아제르바이잔</option>";
		text+="<option value=BA>보스니아 헤르체고비나</option>";
		text+="<option value=BB>바베이도스</option>";
		text+="<option value=BD>방글라데시</option>";
		text+="<option value=BE>벨기에</option>";
		text+="<option value=BF>부르키나파소</option>";
		text+="<option value=BG>불가리아</option>";
		text+="<option value=BH>바레인</option>";
		text+="<option value=BI>부룬디</option>";
		text+="<option value=BJ>베냉</option>";
		text+="<option value=BL>생바르텔레미</option>";
		text+="<option value=BM>버뮤다</option>";
		text+="<option value=BN>브루나이</option>";
		text+="<option value=BO>볼리비아</option>";
		text+="<option value=BQ>보네르섬</option>";
		text+="<option value=BR>브라질</option>";
		text+="<option value=BS>바하마</option>";
		text+="<option value=BT>부탄</option>";
		text+="<option value=BV>부베섬</option>";
		text+="<option value=BW>보츠와나</option>";
		text+="<option value=BY>벨라루스</option>";
		text+="<option value=BZ>벨리즈</option>";
		text+="<option value=CA>케나다</option>";
		text+="<option value=CC>코코스 제도</option>";
		text+="<option value=CD>콩고 민주 공화국</option>";
		text+="<option value=CF>중앙아프리카 공화국</option>";
		text+="<option value=CG>콩고 공화국</option>";
		text+="<option value=CH>스위스</option>";
		text+="<option value=CI>코트디부아르</option>";
		text+="<option value=CK>쿡 제도</option>";
		text+="<option value=CL>칠레</option>";
		text+="<option value=CM>카메룬</option>";
		text+="<option value=CN>중국</option>";
		text+="<option value=CO>콜롬비아</option>";
		text+="<option value=CR>코스타리카</option>";
		text+="<option value=CU>쿠바</option>";
		text+="<option value=CV>카보베르데</option>";
		text+="<option value=CW>퀴라소</option>";
		text+="<option value=CX>크리스마스 섬</option>";
		text+="<option value=CY>키프로스</option>";
		text+="<option value=CZ>체코</option>";
		text+="<option value=DE>독일</option>";
		text+="<option value=DJ>지부티</option>";
		text+="<option value=DK>덴마크</option>";
		text+="<option value=DM>도미니카 연방</option>";
		text+="<option value=DO>도미니카 공화국</option>";
		text+="<option value=DZ>알제리</option>";
		text+="<option value=EC>에콰도르</option>";
		text+="<option value=EE>에스토니아</option>";
		text+="<option value=EG>이집트</option>";
		text+="<option value=EH>서사하라</option>";
		text+="<option value=ER>에리트레아</option>";
		text+="<option value=ES>스페인</option>";
		text+="<option value=ET>에티오피아</option>";
		text+="<option value=FI>필란드</option>";
		text+="<option value=FJ>피지</option>";
		text+="<option value=FK>포클랜드 제도</option>";
		text+="<option value=FM>미크로네시아 연방</option>";
		text+="<option value=FO>페로 제도</option>";
		text+="<option value=FR>프랑스</option>";
		text+="<option value=GA>가봉</option>";
		text+="<option value=GB>영국</option>";		
		text+="<option value=GD>그레나다</option>";
		text+="<option value=GE>조지아</option>";
		text+="<option value=GF>프랑스령 기아나</option>";
		text+="<option value=GG>건지섬</option>";
		text+="<option value=GH>가나</option>";
		text+="<option value=GI>지브롤터</option>";
		text+="<option value=GL>그린란드</option>";
		text+="<option value=GM>감비아</option>";
		text+="<option value=GN>기니</option>";
		text+="<option value=GP>과들루프</option>";
		text+="<option value=GQ>적도 기니</option>";
		text+="<option value=GR>그리스</option>";
		text+="<option value=GS>사우스조지아 사우스샌드위치 제도</option>";
		text+="<option value=GT>과테말라</option>";
		text+="<option value=GU>괌</option>";
		text+="<option value=GW>기니비사우</option>";
		text+="<option value=GY>가이아나</option>";
		text+="<option value=HK>홍콩</option>";
		text+="<option value=HM>허드 맥도널드 제도</option>";
		text+="<option value=HN>온두라스</option>";
		text+="<option value=HR>크로아티아</option>";
		text+="<option value=HT>아이티</option>";
		text+="<option value=HU>헝가리</option>";
		text+="<option value=ID>인도네시아</option>";
		text+="<option value=IE>아일랜드</option>";
		text+="<option value=IL>이스라엘</option>";
		text+="<option value=IM>맨섬</option>";
		text+="<option value=IN>인도</option>";
		text+="<option value=IO>영국령 인도양 지역</option>";
		text+="<option value=IQ>이라크</option>";
		text+="<option value=IR>이란</option>";
		text+="<option value=IS>아이슬란드</option>";
		text+="<option value=IT>이탈리아</option>";
		text+="<option value=JE>저지섬</option>";
		text+="<option value=JM>자메이카</option>";
		text+="<option value=JO>요르단</option>";
		text+="<option value=JP>일본</option>";
		text+="<option value=KE>케냐</option>";
		text+="<option value=KG>키르기스스탄</option>";
		text+="<option value=KH>캄보디아</option>";
		text+="<option value=KI>키리바시</option>";
		text+="<option value=KM>코모로</option>";
		text+="<option value=KN>세인트키츠 네비스</option>";
		text+="<option value=KP>북한</option>";
		text+="<option value=KR>대한민국</option>";
		text+="<option value=KW>쿠웨이트</option>";
		text+="<option value=KY>케이맨 제도</option>";
		text+="<option value=KZ>카자흐스탄</option>";
		text+="<option value=LA>라오스</option>";
		text+="<option value=LB>레바논</option>";
		text+="<option value=LC>세인트루시아</option>";
		text+="<option value=LI>리히텐슈타인</option>";
		text+="<option value=LK>스라랑카</option>";
		text+="<option value=LR>라이베리아</option>";
		text+="<option value=LS>레소토</option>";
		text+="<option value=LT>리투아니아</option>";
		text+="<option value=LU>룩셈부르크</option>";
		text+="<option value=LV>라트비아</option>";
		text+="<option value=LY>리비아</option>";
		text+="<option value=MA>모로코</option>";
		text+="<option value=MC>모나코</option>";
		text+="<option value=MD>몰도바</option>";
		text+="<option value=ME>몬테네그로</option>";
		text+="<option value=MF>생마르탱</option>";
		text+="<option value=MG>마다가스카르</option>";
		text+="<option value=MH>마셜 제도</option>";
		text+="<option value=MK>북마케노니아</option>";
		text+="<option value=ML>말리</option>";
		text+="<option value=MM>미얀마</option>";
		text+="<option value=MN>몽골</option>";
		text+="<option value=MO>마카오</option>";
		text+="<option value=MP>북마리아나 제도</option>";
		text+="<option value=MQ>마르티니크</option>";
		text+="<option value=MR>모리타니</option>";
		text+="<option value=MS>몬트세랫</option>";
		text+="<option value=MT>몰타</option>";
		text+="<option value=MU>모리셔스</option>";
		text+="<option value=MV>몰디브</option>";
		text+="<option value=MW>말라위</option>";
		text+="<option value=MX>멕시코</option>";
		text+="<option value=MY>말레이시아</option>";
		text+="<option value=MZ>모잠비크</option>";
		text+="<option value=NA>나미비아</option>";
		text+="<option value=NC>누벨칼레도니</option>";
		text+="<option value=NE>니제르</option>";
		text+="<option value=NF>노퍽 섬</option>";
		text+="<option value=NG>나이지리아</option>";
		text+="<option value=NI>나카라과</option>";
		text+="<option value=NL>네덜란드</option>";
		text+="<option value=NO>노르웨이</option>";
		text+="<option value=NP>네팔</option>";
		text+="<option value=NR>나우루</option>";
		text+="<option value=NU>니우에</option>";
		text+="<option value=NZ>뉴질랜드</option>";
		text+="<option value=OM>오만</option>";
		text+="<option value=PA>파나마</option>";
		text+="<option value=PE>페루</option>";
		text+="<option value=PF>프랑스령 폴리네시아</option>";
		text+="<option value=PG>파푸아뉴기니</option>";
		text+="<option value=PH>필리핀</option>";
		text+="<option value=PK>파키스탄</option>";
		text+="<option value=PL>폴란드</option>";
		text+="<option value=PM>생피에르 미클롱</option>";
		text+="<option value=PN>핏케언 제도</option>";
		text+="<option value=PR>푸에르토리코</option>";
		text+="<option value=PS>팔레스타인</option>";
		text+="<option value=PT>포르투갈</option>";
		text+="<option value=PW>팔라우</option>";
		text+="<option value=PY>파라과이</option>";
		text+="<option value=QA>카타르</option>";
		text+="<option value=RE>레위니옹</option>";
		text+="<option value=RO>루마니아</option>";
		text+="<option value=RS>세르비아</option>";
		text+="<option value=RU>러시아</option>";
		text+="<option value=RW>르완다</option>";
		text+="<option value=SA>사우디아라비아</option>";
		text+="<option value=SB>솔로몬 제도</option>";
		text+="<option value=SC>세이셸</option>";
		text+="<option value=SD>수단</option>";
		text+="<option value=SE>스웨덴</option>";
		text+="<option value=SG>싱가포르</option>";
		text+="<option value=SH>세인트헬레나</option>";
		text+="<option value=SI>슬로베니아</option>";
		text+="<option value=SJ>스발바르 얀마옌</option>";
		text+="<option value=SK>슬로바키아</option>";
		text+="<option value=SL>시에라리온</option>";
		text+="<option value=SM>산마리노</option>";
		text+="<option value=SN>세네갈</option>";
		text+="<option value=SO>소말리아</option>";
		text+="<option value=SR>수리남</option>";
		text+="<option value=SS>남수단</option>";
		text+="<option value=ST>상투메 프린시페</option>";
		text+="<option value=SV>엘살바도르</option>";
		text+="<option value=SX>신트마르턴</option>";
		text+="<option value=SY>시리아</option>";
		text+="<option value=SZ>에스와티니</option>";
		text+="<option value=TC>터크스 케이커스 제도</option>";
		text+="<option value=TD>차드</option>";
		text+="<option value=TF>프랑스령 남방 및 남극</option>";
		text+="<option value=TG>토고</option>";
		text+="<option value=TH>태국</option>";
		text+="<option value=TJ>타지키스탄</option>";
		text+="<option value=TK>토켈라우</option>";
		text+="<option value=TL>동티모르</option>";
		text+="<option value=TM>투르크메니스탄</option>";
		text+="<option value=TN>튀니지</option>";
		text+="<option value=TO>통가</option>";
		text+="<option value=TR>터키</option>";
		text+="<option value=TT>트리니다드 토바고</option>";
		text+="<option value=TV>투발루</option>";
		text+="<option value=TW>대만</option>";
		text+="<option value=TZ>탄자니아</option>";
		text+="<option value=UA>우크라이나</option>";
		text+="<option value=UG>우간다</option>";
		text+="<option value=UM>미국령 군소 제도</option>";
		text+="<option value=US>미국</option>";
		text+="<option value=UY>우루과이</option>";
		text+="<option value=UZ>우즈베키스탄</option>";
		text+="<option value=VA>바티칸 시국</option>";
		text+="<option value=VC>세인트빈센트 그레나딘</option>";
		text+="<option value=VE>베네수엘라</option>";
		text+="<option value=VG>영국령 버진아일랜드</option>";
		text+="<option value=VI>미국령 버진아일랜드</option>";
		text+="<option value=VN>베트남</option>";
		text+="<option value=VU>바누아투</option>";
		text+="<option value=WF>왈리스 퓌튀나</option>";
		text+="<option value=WS>사모아</option>";
		text+="<option value=YE>예멘</option>";
		text+="<option value=YT>마요트</option>";
		text+="<option value=ZA>남아프리카 공화국</option>";
		text+="<option value=ZM>잠비아</option>";
		text+="<option value=ZW>짐바브웨</option>";
		text+="</select>";
	}
	else if(opt=="ml"){
		coption[count]="ml";
		text+="<input type=checkbox id='mlmod"+count+"' name=mlmod"+count+" onclick=div_hidden_cbox('mlmod"+count+"','ml1"+count+"','ml2"+count+"')>모듈선택<br>";
		text+="<div id=ml1"+count+">";
		text+="<select id=ml_opt"+count+">";
		text+="<option value=sqli>SQL_injection</option>";
		text+="</select></div>";
		text+="<div id=ml2"+count+" style='display:none'>";
		text+="<input type=text size=15 id=ml_opt_input"+count+">";
		text+="</select></div>";
	}
	text+="</td></tr></table>";
	tr.innerHTML=text;
	option.appendChild(tr);
	count++;
}// addoption()

var fulloption;
function getoption()
{
	fulloption="";
	for(var i=0;i<count;i++)
	{
		if(check_deleted(i)) //삭제된것
		{
			continue;
		}
		if(coption[i] == "content")
		{
			var gcontent=document.getElementById("content"+i);
			if(gcontent.value ==""){
				alert("content에 값을 입력하십시오");
				return -1;
			}
			else{
				fulloption+="content:\""+gcontent.value+"\"; ";
			}
			var gdepth=document.getElementById("depth"+i);
			if(!(gdepth.value =="")){
				fulloption+="depth:"+gdepth.value+"; ";
			}
			var goffset=document.getElementById("offset"+i);
			if(!(goffset.value =="")){
				fulloption+="offset:"+goffset.value+"; ";
			}
			var gdistance=document.getElementById("distance"+i);
			if(!(gdistance.value =="")){
				fulloption+="distance:"+gdistance.value+"; ";
			}
			var gwithin=document.getElementById("within"+i);
			if(!(gwithin.value =="")){
				fulloption+="within:"+gwithin.value+"; ";
            }
            
            var ghttpopt=document.getElementById("httpopt"+i);
			if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_client_body")
				fulloption+="http_client_body; ";
			else if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_cookie")
				fulloption+="http_cookie; ";
			else if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_header")
				fulloption+="http_header; ";
			else if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_method")
				fulloption+="http_method; ";
			else if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_uri")
				fulloption+="http_uri; ";
			else if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_stat_code")
				fulloption+="http_stat_code; ";
			else if(ghttpopt.options[ghttpopt.selectedIndex].value == "http_stat_msg")
                fulloption+="http_stat_msg; ";
            
			var gnocase=document.getElementById("nocase"+i);
			if(gnocase.checked == true)
				fulloption+="nocase; "
		}//content
		else if(coption[i] == "pcre"){
			var gpcre=document.getElementById("pcre"+i);
			if(gpcre.value ==""){
				alert("pcre에 값을 입력하십시오");
				return -1;
			}
			else{
				fulloption+="pcre:"+gpcre.value+"; ";
			}
		}//pcre
		else if(coption[i] == "dsize"){
			var gdsize1=document.getElementById("dsize<"+i);
			var gdsize2=document.getElementById("dsize>"+i);
			var gdsize3=document.getElementById("dsize="+i);
			var gdsize4=document.getElementById("dsize~"+i);
			var gdsize_sin=document.getElementById("dsize_sin_"+i);
			var gdsize_dou1=document.getElementById("dsize_dou1_"+i);
			var gdsize_dou2=document.getElementById("dsize_dou2_"+i);
			fulloption+="dsize:";
			if(gdsize1.checked== true){
                fulloption+="<";
                if(gdsize_sin.value==""){
                    alert("dsize에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gdsize_sin.value;
			}
			else if(gdsize2.checked== true){
                fulloption+=">";
                if(gdsize_sin.value==""){
                    alert("dsize에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gdsize_sin.value;
			}
			else if(gdsize3.checked== true){
                if(gdsize_sin.value==""){
                    alert("dsize에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gdsize_sin.value;
			}
			else if(gdsize4.checked== true){
                if(gdsize_dou1.value=="" || gdsize_dou2.value==""){
                    alert("dsize에 값을 입력하십시오");
                    return -1;
                }
                else if(gdsize_dou1.value>gdsize_dou2.value){
                    alert("dsize범위를 제대로 입력하십시오.");
                    return -1;
                }
				fulloption+=gdsize_dou1.value+"<>"+gdsize_dou2.value;
			}
			else{
				alert("ttl dsize버튼을 체크하십시오");
				return -1;
			}
			fulloption+="; ";
		}//dsize
		else if(coption[i] == "ttl"){
			var gttl1=document.getElementById("ttl<"+i);
			var gttl2=document.getElementById("ttl>"+i);
			var gttl3=document.getElementById("ttl<="+i);
			var gttl4=document.getElementById("ttl>="+i);
			var gttl5=document.getElementById("ttl="+i);
			var gttl6=document.getElementById("ttl~"+i);
			var gttl_sin=document.getElementById("ttl_sin_"+i);
			var gttl_dou1=document.getElementById("ttl_dou1_"+i);
			var gttl_dou2=document.getElementById("ttl_dou2_"+i);
			fulloption+="ttl:";
			if(gttl1.checked== true){
				fulloption+="<";
				if(gttl_sin.value==""){
                    alert("ttl에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gttl_sin.value;
			}
			else if(gttl2.checked== true){
				fulloption+=">";
				if(gttl_sin.value==""){
                    alert("ttl에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gttl_sin.value;
			}
			else if(gttl3.checked== true){
				fulloption+="<=";
				if(gttl_sin.value==""){
                    alert("ttl에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gttl_sin.value;
			}
			else if(gttl4.checked== true){
				fulloption+=">=";
				if(gttl_sin.value==""){
                    alert("ttl에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gttl_sin.value;
			}
			else if(gttl5.checked== true){
				if(gttl_sin.value==""){
                    alert("ttl에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gttl_sin.value;
			}
			else if(gttl6.checked== true){
				if(gttl_dou1.value=="" || gttl_dou2.value==""){
                    alert("ttl에 값을 입력하십시오");
                    return -1;
                }
                else if(gttl_dou1.value>gttl_dou2.value){
                    alert("ttl범위를 제대로 입력하십시오.");
                    return -1;
                }
				fulloption+=gttl_dou1.value+"<>"+gttl_dou2.value;
			}
			else{
				alert("ttl radio버튼을 체크하십시오");
				return -1;
			}
			fulloption+="; ";
		}//ttl
		else if(coption[i] == "tos"){
			var gtosnot=document.getElementById("tosNOT"+i);
			var gtos=document.getElementById("tos"+i);
			fulloption+="tos:";
			if(gtosnot.checked==true){
				fulloption+="!";
			}
			if(gtos.value ==""){
				alert("tos에 값을 입력하십시오");
				return -1;
			}
			else{
				fulloption+=gtos.value+"; ";
			}
		}//tos
		else if(coption[i] == "flagbits"){
			var gtosNOT=document.getElementById("flagbitsNOT"+i);
			var gMflag=document.getElementById("Mflag"+i);
			var gDflag=document.getElementById("Dflag"+i);
			var chk=false;
			fulloption+="flagbits:";
			if(gtosNOT.checked==true){
				fulloption+="!";
			}
			if(gMflag.checked==true){
				fulloption+="M";
				chk=true;
			}
			if(gDflag.checked==true){
				fulloption+="D";
				chk=true;
			}
			if(!chk){
				alert("M이나 D에 체크를 해주세요");
				return -1;
			}
			fulloption+="; ";
		}//flagbits
		else if(coption[i] == "sameip"){
			fulloption+="sameip; "
		}//sameip			
		else if(coption[i] == "flags"){
			var gflagsNOT=document.getElementById("flagsNOT"+i);
			var gFflag=document.getElementById("Fflag"+i);
			var gSflag=document.getElementById("Sflag"+i);
			var gRflag=document.getElementById("Rflag"+i);
			var gPflag=document.getElementById("Pflag"+i);
			var gAflag=document.getElementById("Aflag"+i);
			var gUflag=document.getElementById("Uflag"+i);
			fulloption+="flags:";
			var chk=false;
			if(gflagsNOT.checked==true){
				fulloption+="!";
			}
			if(gFflag.checked==true){
				fulloption+="F";
				chk=true;
			}
			if(gSflag.checked==true){
				fulloption+="S";
				chk=true;
			}
			if(gRflag.checked==true){
				fulloption+="R";
				chk=true;
			}
			if(gPflag.checked==true){
				fulloption+="P";
				chk=true;
			}
			if(gAflag.checked==true){
				fulloption+="A";
				chk=true;
			}
			if(gUflag.checked==true){
				fulloption+="U";
				chk=true;
			}
			if(!chk){
				alert("!를 제외한 값을 체크하세요");
				return -1;
			}
			fulloption+="; ";
		}//flags
		else if(coption[i] == "seq"){
			var gseq=document.getElementById("seq"+i);
			if(gseq.value ==""){
				alert("seq에 값을 입력하십시오");
				return -1;
			}
			else{
				fulloption+="seq:"+gseq.value+"; ";
			}
		}//seq
		else if(coption[i] == "ack"){
			var gack=document.getElementById("ack"+i);
			if(gack.value ==""){
				alert("ack에 값을 입력하십시오");
				return -1;
			}
			else{
				fulloption+="ack:"+gack.value+"; ";
			}
		}//ack
		else if(coption[i] == "window"){
			var gwindownot=document.getElementById("windowNOT"+i);
			var gwindow=document.getElementById("window"+i);
			fulloption+="window:";
			if(gwindownot.checked==true){
				fulloption+="!";
			}
			if(gwindow.value ==""){
				alert("window에 값을 입력하십시오");
				return -1;
			}
			else{
				fulloption+=gwindow.value+"; ";
			}
		}//window
		else if(coption[i] == "itype"){
			var gitype1=document.getElementById("itype<"+i);
			var gitype2=document.getElementById("itype>"+i);
			var gitype3=document.getElementById("itype="+i);
			var gitype4=document.getElementById("itype~"+i);
			var gitype_sin=document.getElementById("itype_sin_"+i);
			var gitype_dou1=document.getElementById("itype_dou1_"+i);
			var gitype_dou2=document.getElementById("itype_dou2_"+i);
			fulloption+="itype:";
			if(gitype1.checked== true){
                fulloption+="<";
                if(gitype_sin.value==""){
                    alert("itype에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gitype_sin.value;
			}
			else if(gitype2.checked== true){
                fulloption+=">";
                if(gitype_sin.value==""){
                    alert("itype에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gitype_sin.value;
			}
			else if(gitype3.checked== true){
                if(gitype_sin.value==""){
                    alert("itype에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gitype_sin.value;
			}
			else if(gitype4.checked== true){
                if(gitype_dou1.value=="" || gitype_dou2.value==""){
                    alert("itype에 값을 입력하십시오");
                    return -1;
                }
                else if(gitype_dou1.value>gitype_dou2.value){
                    alert("itype범위를 제대로 입력하십시오.");
                    return -1;
                }
				fulloption+=gitype_dou1.value+"<>"+gitype_dou2.value;
			}
			else{
				alert("itype radio버튼을 체크하십시오");
				return -1;
			}
			fulloption+="; ";
		}//itype
		else if(coption[i] == "icode"){
			var gicode1=document.getElementById("icode<"+i);
			var gicode2=document.getElementById("icode>"+i);
			var gicode3=document.getElementById("icode="+i);
			var gicode4=document.getElementById("icode~"+i);
			var gicode_sin=document.getElementById("icode_sin_"+i);
			var gicode_dou1=document.getElementById("icode_dou1_"+i);
			var gicode_dou2=document.getElementById("icode_dou2_"+i);
			fulloption+="icode:";
			if(gicode1.checked== true){
                fulloption+="<";
                if(gicode_sin.value==""){
                    alert("icode에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gicode_sin.value;
			}
			else if(gicode2.checked== true){
                fulloption+=">";
                if(gicode_sin.value==""){
                    alert("icode에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gicode_sin.value;
			}
			else if(gicode3.checked== true){
                if(gicode_sin.value==""){
                    alert("icode에 값을 입력하십시오");
                    return -1;
				}
				fulloption+=gicode_sin.value;
			}
			else if(gicode4.checked== true){
                if(gicode_dou1.value=="" || gicode_dou2.value==""){
                    alert("icode에 값을 입력하십시오");
                    return -1;
                }
                else if(gicode_dou1.value>gicode_dou2.value){
                    alert("icode범위를 제대로 입력하십시오.");
                    return -1;
                }
				fulloption+=gicode_dou1.value+"<>"+gicode_dou2.value;
			}
			else{
				alert("icode radio버튼을 체크하십시오");
				return -1;
			}
			fulloption+="; ";
		}//icode
		else if(coption[i] == "detection_filter"){
				fulloption+="detection_filter:track ";
			var gdfopt=document.getElementById("df_opt"+i);
			if(gdfopt.options[gdfopt.selectedIndex].value == "by_all")
				fulloption+="by_all, ";
			else if(gdfopt.options[gdfopt.selectedIndex].value == "by_src")
				fulloption+="by_src, ";
			else if(gdfopt.options[gdfopt.selectedIndex].value == "by_dst")
				fulloption+="by_dst, ";
			
			var gdf_count=document.getElementById("df_count"+i);
			if(gdf_count.value==""){
                    alert("detection_filter의 count 값을 입력하십시오");
                    return -1;
			}else{
				fulloption+="count "+gdf_count.value+", ";
			}
			var gdf_sec=document.getElementById("df_sec"+i);
			if(gdf_sec.value==""){
                    alert("detection_filter의 seconds 값을 입력하십시오");
                    return -1;
			}else{
				fulloption+="seconds "+gdf_sec.value+"; ";
			}
        }//detection_filter
        else if(coption[i] == "nation"){
			fulloption+="nation:";
			var gnaopt=document.getElementById("na_opt"+i);
			fulloption+=gnaopt.options[gnaopt.selectedIndex].value;
			fulloption+="; ";
		}//nation
		else if(coption[i] == "ml"){
			fulloption+="ml:";
			var gmlopt=document.getElementById("ml_opt"+i);
			var gmlmod=document.getElementById("mlmod"+i);
			var gmlmodi=document.getElementById("ml_opt_input"+i);
			if(gmlmod.checked== true){
				if(gmlmodi.value ==""){
					alert("ml의 값을 입력하십시오");
					return -1;
				}
				fulloption+=gmlmodi.value;
			}else{
				fulloption+=gmlopt.options[gmlopt.selectedIndex].value;
			}
			fulloption+="; ";
		}
	}//for
	return fulloption;
}//getoption()
function removeoption(num)
{
	var id=document.getElementById("op"+num);
	while (id.hasChildNodes()) {
		id.removeChild(id.firstChild);
	}
	if(coption[num]=="sameip")
	{
		sameipflag=false;
	}
	delete_num[delete_cnt]=num;
	delete_cnt++;
}// removeoption()

function textCheck(id)
{
	var ck = document.getElementById(id);
	if(ck.value == "")
	{
		return 0;
	}
	else
	{
		return 1;
	}
}// textCheck()
function radioCheck(name)
{
	var ck = document.getElementsByName(name);
	var typ = null;
	for(var i = 0; i < ck.length; i++)
	{
		if(ck[i].checked == true)
		{
			typ = ck[i].value;
		}
	}
	if(typ == null)
	{
		return false;
	}
	else
	{
		return true;
	}
}// radioCheck(name)
function vipCheck(str)
{
	var rt = 0;
	if(_ipcnt != 0)
	{
		for(var i = 0; i < _ipcnt; i++)
		{
			if(_ipname[i] == str)
			{
				rt++;
			}
		}
	}
	
	if(rt == 0)
	{// 같은 이름이 없다
		return 0;
	}
	else
	{// 같은 이름이 있다
		return 1;
	}
}// vipCheck()
function vptCheck(str)
{
	var rt = 0;
	if(_ptcnt != 0)
	{
		for(var i = 0; i < _ptcnt; i++)
		{
			if(_ptname[i] == str)
			{
				rt++;
			}
		}
	}
	
	if(rt == 0)
	{// 같은 이름이 없다
		return 0;
	}
	else
	{// 같은 이름이 있다
		return 1;
	}
}// vptCheck()
function div_hidden_cbox(cid, id1, id2)
{
	var i1 = document.getElementById(id1);
	var i2 = document.getElementById(id2);
	if(document.getElementById(cid).checked == true)
	{
		i1.style.display = "none";
		i2.style.display = "block";
	}
	else
	{
		i1.style.display = "block";
		i2.style.display = "none";
	}
}// div_hidden_cbox
function div_hidden(firstid, secondid)
{
	var i1 = document.getElementById(firstid);
	var i2 = document.getElementById(secondid);
	
	i1.style.display = "block";
	i2.style.display = "none";
}// input()
function allCheck()
{
	var Rname=document.getElementById('__Rname');
	var RGname=document.getElementById('__RGname');
	var full_header=document.getElementById('__full_header');
	var full_option=document.getElementById('__full_option');
	var full_options;
	//serverity 설정
	var srv=document.getElementById('severity');
	document.getElementById('__severity').value=srv.options[srv.selectedIndex].value;
	//그룹명 전달
	var gname=document.getElementById("rule_group_name");
	RGname.value =gname.options[gname.selectedIndex].value;
	if(textCheck("rule_name") == 0)
	{
		alert("<!> 룰 이름을 입력해주세요");
		return 0;
	}
	else if((document.getElementById("s1c").checked != true) && (document.getElementById("srcip_v").value == "none"))
	{
		alert("<!> Source IP 변수를 선택해주세요");
	}
	else if((document.getElementById("s1c").checked == true) &&
			((textCheck("src_ip1") == 0) ||
			(textCheck("src_ip2") == 0) ||
			(textCheck("src_ip3") == 0) ||
			(textCheck("src_ip4") == 0)))
	{
		alert("<!> Source IP 입력을 제대로 해주세요");
		return 0;
	}
	else if((document.getElementById("s2c").checked != true) && (document.getElementById("srcport_v").value == "none"))
	{
		alert("<!> Source Port 변수를 선택해주세요");
	}
	else if((document.getElementById("s2c").checked == true) &&
			(textCheck("src_port1") == 0))
	{
		alert("<!> Source Port 값을 입력해주세요");
		return 0;
	}
	else if((document.getElementById("s2c").checked == true) &&
			(textCheck("src_port2") == 1) && 
			(parseInt(document.getElementById("src_port1").value) > parseInt(document.getElementById("src_port2").value)))
	{
		alert("<!> Source Port 앞의 값이 더 작아야합니다");	
		return 0;		
	}
	else if((document.getElementById("d1c").checked != true) && (document.getElementById("dstip_v").value == "none"))
	{
		alert("<!> Destination IP 변수를 선택해주세요");
	}
	else if((document.getElementById("d1c").checked == true) &&
			((textCheck("dest_ip1") == 0) ||
			(textCheck("dest_ip2") == 0) ||
			(textCheck("dest_ip3") == 0) ||
			(textCheck("dest_ip4") == 0)))
	{
		alert("<!> Destination IP 입력을 제대로 해주세요");
		return 0;
	}
	else if((document.getElementById("d2c").checked != true) && (document.getElementById("dstport_v").value == "none"))
	{
		alert("<!> Source IP 변수를 선택해주세요");
	}
	else if((document.getElementById("d2c").checked == true) &&
			(textCheck("dest_port1") == 0))
	{
		alert("<!> Destination Port 값을 입력해주세요");
		return 0;
	}
	else if((document.getElementById("d2c").checked == true) &&
			(textCheck("dest_port2") == 1) && 
			(parseInt(document.getElementById("dest_port1").value) > parseInt(document.getElementById("dest_port1").value)))
	{
		alert("<!> Source Port 앞의 값이 더 작아야합니다");	
		return 0;
	}
    else if((full_options = getoption()) == -1)
    {
		return 0;
    }
    else
    {
		Rname.value=document.getElementById("rule_name").value;
		full_header.value=makeString();
		full_option.value=full_options;
		document.tosubmit.submit();
    }
	//else if()
	/*
	== Rule Info ==
	"rule_name"
	"rule_number"
	"rule_group_number"
	== Rule Header ==
	radio "action"
	radio "protocol"
	"src_ip1" "src_ip2" "src_ip3" "src_ip4" "src_ip1" "src_sm" 또는 "srcip_v"
	radio "src_ip_opt"
	"src_port1" "src_port2" 또는 "srcport_v"
	radio "src_port_opt"
	radio "direction"
	"dest_ip1" "dest_ip2" "dest_ip3" "dest_ip4" "dest_sm" 또는 "dstip_v"
	radio "dest_ip_opt"
	"dest_port1" "dest_port2" 또는 "dstport_v"
	radio "dest_port_opt"
	*/
	
}

function check_deleted(num)
{
	for(var j=0;j<delete_cnt;j++)
	{
			if(delete_num[j]==num)
			{
				return true;
			}
    }
	return false;
}//check_deleted()
