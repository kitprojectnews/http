<?php
include 'ReSession.php';
session_start();
include 'dbconn.php';
if(!$_SESSION['r_update'])//룰 추가 수정 삭제 가능 여부
{
   die('접근권한이 없습니다. ');
}

    //rmk_main으로 부터 넘어오는 변수
    //__Rname, __Rnum, __RGname, __full_header, __full_option
    $Rule_id=$_POST["__sid"];
    $Rule_name=$_POST["__Rname"];
    $Rule_GroupName=$_POST["__RGname"];
    $severity=$_POST["__severity"];
    $Rule_header=$_POST["__full_header"];
    $Rule_option=$_POST["__full_option"];
    $header = explode(' ', $Rule_header);
    /*
    0 : action
    1 : protocol
    2 : srcip
    3 : srcport
    4 : direction
    5 : dstip
    6 : dstport
    */ 


    //그룹명 그룹번호와 매칭
    $sql="select gid from sig_group where gname='".$Rule_GroupName."';";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        $Rule_GroupNum=$row["gid"];
    }else{
        $sql="insert into sig_group(gname) values('".$Rule_GroupName."');";
        $result = $conn->query($sql);
        $sql="select gid from sig_group where gname='".$Rule_GroupName."';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $Rule_GroupNum=$row["gid"];
    }
    //룰 번호 설정
    $sql="select * from signature where sig_id=".$Rule_id.";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $Rule_rev=(int)$row["sig_rev"]+1;
    if($Rule_GroupNum==$row["sig_gid"]){ //그룹이 그대로
        $Rule_num=$row["sig_sid"];
    }else{ //그룹 변경됨
        //룰 번호 불러오기(MAX)
        $sql="select MAX(sig_sid) from signature where sig_gid=".$Rule_GroupNum.";";
        $result = $conn->query($sql);
        if($row = $result->fetch_assoc()){
            $Rule_num=$row["MAX(sig_sid)"]+1;
        }else{
            $Rule_num=1;
        }
    }
    //소켓 연동
    $address = "localhost";                                             
    $port = 5252;
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); 
    $result = socket_connect($socket, $address, $port);
    $i = "R_UPDATE sig_id=".$Rule_id.", header=".$Rule_header.", option=".$Rule_option; 
    socket_write($socket, $i, strlen($i)); 
    socket_close($socket);
    
    //룰 삽입
    //$sql =$conn->prepare("INSERT INTO signature(sig_msg,sig_rev,sig_sid,sig_gid,sig_action,sig_protocol,sig_srcIP,sig_srcPort,sig_direction,sig_dstIP,sig_dstPort,sig_rule_option) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql =$conn->prepare("update signature SET sig_msg=?, sig_rev=?, sig_sid=?, sig_gid=?, sig_action=?, sig_protocol=?, sig_srcIP=?, sig_srcPort=?, sig_direction=?, sig_dstIP=?, sig_dstPort=?, sig_rule_option=?, severity=? where sig_id=?");    
    $sql->bind_param("siiissssssssii",$Rule_name,$Rule_rev,$Rule_num,$Rule_GroupNum,$header[0],$header[1],$header[2],$header[3],$header[4],$header[5],$header[6],$Rule_option,$severity,$Rule_id);
    $sql->execute();
    $sql->close();
    $conn->close();

    
    
?>
<meta http-equiv="refresh" content="0,rlist.php">
