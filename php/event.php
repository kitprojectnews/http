<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/Observer_event.css" />
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/colResizable-1.6.min.js"></script>
    <script src="../js/tableaction.js"></script>
</head>

<title></title>

<body>
    <form>
        <div id="root_div" target="_self" method="GET" action="event.php">
            <div id='select_div'>
                <div class='select_time' id='time'>
                    범위:&nbsp최근&nbsp
                    <input type='number' min='0' value='0' name="hour">시간
                    <input type='number' min='0' max='59' value='30' name="minute">분&nbsp&nbsp
                    새로고침 간격: 
                    <select>
                        <option>30초</option>
                        <option>1분</option>
                        <option>5분</option>
                    </select>
                    <input type="button" value='▮▮'>
                </div>
                <div class='select_date' style ="display:none" id='date'>
                    <input type="date" value='<?php echo date('Y-m-d');?>'>
                    ~
                    <input type="date" value='<?php echo date('Y-m-d');?>'>
                    <input type="button" value='조회'>
                </div>
                <div class='select_radio'>
                    <input type='radio' name='R' checked="checked" onClick='selectType(this);' value='time'>시간별 조회
                    <input type='radio' name='R' onClick='selectType(this);' value='date'>기간별 조회
                </div>
            </div>
            <div class='table_div'>
                <table class="eventTable">
                    <thead>
                        <tr>
                            <th scope="cols" width="60px">eid</th>
                            <th scope="cols" width="50px">serverity</th>
                            <th scope="cols" width="200px">time</th>
                            <th scope="cols" width="400px">sig_msg</th>
                            <th scope="cols" width="200px">src_ip</th>
                            <th scope="cols" width="80px">src_port</th>
                            <th scope="cols" width="200px">dst_ip</th>
                            <th scope="cols" width="80px">dst_port</th>
                            <th scope="cols" width="80px">protocol</th>
                            <th scope="cols" width="100px">payload_size</th>
                            <th scope="cols" width="50px">정탐률</th>
                            <th scope="cols">ETC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'dbconn.php';
                        if( array_key_exists("select_ago", $_GET))
                            $sql = 'SELECT * FROM event_view where  time>SUBDATE(NOW(), INTERVAL '.$_GET['select_ago'].' MINUTE) ORDER BY eid desc';
                        else if( array_key_exists("select_from", $_GET)&&array_key_exists("select_to", $_GET))
                            $sql = 'SELECT * FROM event_view where  time>='.$_GET['select_from'].'time<='.$_GET['select_to'].' ORDER BY eid desc';
                        else
                            $sql = 'SELECT * FROM event_view where  time>SUBDATE(NOW(), INTERVAL 60 MINUTE) ORDER BY eid desc';

                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo ("<tr>");
                                echo ("<th scope='row'>" . $row["eid"] . "</th>");
                                echo ("<td>" . $row["serverity"] . "</td>");
                                echo ("<td>" . $row["time"] . "</td>");
                                echo ("<td align='left'>" . $row['sig_msg'] . "</td>");
                                echo ("<td>" . long2ip($row["src_ip"]) . "</td>");
                                echo ("<td>" . $row['src_port'] . "</td>");
                                echo ("<td>" . long2ip($row["dst_ip"]) . "</td>");
                                echo ("<td>" . $row['dst_port'] . "</td>");
                                echo ("<td>" . $row["sig_protocol"] . "</td>");
                                echo ("<td>" . $row["payload_size"] . "</td>");
                                echo ("<td>" . $row["true_rate"] . "</td>");
                                echo ("<td> <input type=button value=자세히 onClick='detail(" . $row["eid"] . "," . $row["sig_id"] . ")' /></td>");
                                echo ("</tr>");
                                //echo "eid:" . $row["eid"] . " sig_id:" . $row["sig_id"] . " src_ip:" . $row["src_ip"] . " src_port:" . $row["src_port"] . "<br>";
                            }
                        }
                        $result->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</body>
<script launguage='JAVASCRIPT'>
    //sig_msg에 하이퍼링크 걸기, 패킷뷰에 탭넣어서 ipheader들 볼수있게 TODOTODO
    function detail(eid, sig_id) {
        var popupX = (window.screen.width / 2) - 500;
        var popupY= (window.screen.height / 2) - 400;
        window.open('event_detailView.php?eid=' + eid + '&sig_id=' + sig_id, 'detailViewer', 'width = 1000, height = 800, left ='+popupX+' , top ='+popupY+', menubar = no, status = no, toolbar = no ');
    }
    function selectType(radio){
        var time = document.getElementById("time");
        var date = document.getElementById("date");
        if(radio.value=="time")
        {
            time.style.display = "block";
            date.style.display = "none";
        }
        else
        {
            time.style.display = "none";
            date.style.display = "block";
        }
    }
    function selectDate(){

    }
    function selectTime(){

    }
</script>

</html>