<?php
    include 'dbconn.php';

    //rmk_main으로 부터 넘어오는 변수
    //__Rname, __Rnum, __RGname, __full_header, __full_option
    $Rule_name=$_POST["__Rname"];
    $Rule_GroupName=$_POST["__RGname"];
    $Rule_header=$_POST["__full_header"];
    $Rule_option=$_POST["__full_option"];
    $Rule_rev=1;
    $sig_run=true;
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

    //룰 번호 불러오기(MAX)
    $sql="select MAX(sig_sid) from signature where sig_gid=".$Rule_GroupNum.";";
    $result = $conn->query($sql);
    if($row = $result->fetch_assoc()){
        $Rule_num=$row["MAX(sig_sid)"]+1;
    }else{
        $Rule_num=1;
    }
    
    //룰 삽입
    $sql =$conn->prepare("INSERT INTO signature(sig_run,sig_msg,sig_rev,sig_sid,sig_gid,sig_action,sig_protocol,sig_srcIP,sig_srcPort,sig_direction,sig_dstIP,sig_dstPort,sig_rule_option) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param("isiiissssssss",$sig_run,$Rule_name,$Rule_rev,$Rule_num,$Rule_GroupNum,$header[0],$header[1],$header[2],$header[3],$header[4],$header[5],$header[6],$Rule_option);
    $sql->execute();
    $sql->close();

    $address = "127.0.0.11";                                                 // 접속할 IP //
    $port = 5252;                                                                         // 접속할 PORT //
 
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // TCP 통신용 소켓 생성 //
    if ($socket === false) {
        echo "socket_create() 실패! 이유: " . socket_strerror(socket_last_error()) . "\n";
        echo "<br>";
    } else {
        echo "socket 성공적으로 생성.\n";
        echo "<br>";
    }
    
    echo "다음 IP '$address' 와 Port '$port' 으로 접속중...";
    echo "<BR>";
    $result = socket_connect($socket, $address, $port);           // 소켓 연결 및 $result에 접속값 지정 //
    if ($result === false) {
    echo "socket_connect() 실패.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
    echo "<br>";
    } else {
    echo "다음 주소로 연결 성공 : $address.\n";
    echo "<br>";
    }
    $sql="select sig_id from signature where sig_sid=".$Rule_num." and sig_gid=".$Rule_GroupNum.";";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $sig_id=$row["sig_id"];
    $i = "INSERT sig_id=".$sig_id.", header=".$Rule_header.", option=".$Rule_option."\n";  //보내고자 하는 전문 //
    echo  "서버로 보내는 전문 : $i|종료|.\n";

    socket_write($socket, $i, strlen($i)); // 실제로 소켓으로 보내는 명령어 //
    echo "<br>";     
    $input = socket_read($socket, 1024) or die("Could not read from Socket\n");  // 소켓으로 부터 받은 REQUEST 정보를 $input에 지정 //
    echo "<br>";
 
    echo $input;  //REQUEST 정보 출력//
    socket_close($socket);
    $conn->close();
?>
<!--meta http-equiv="refresh" content="0,rlist.php"-->
