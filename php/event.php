<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/Observer_event.css" />
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/colResizable-1.6.min.js"></script>
    <script src="../js/tableaction.js"></script>
    <?php date_default_timezone_set("Asia/Seoul");?>
</head>

<title></title>

<body>
    <div id="root_div">
        <table class="eventTable">
            <thead>
                <tr>
                    <th scope="cols" width="60px">eid</th>
                    <th scope="cols" width="50px">severity</th>
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
                        $sql = 'SELECT * FROM event_view where  date(time)>="'.$_GET['select_from'].'"and date(time)<="'.$_GET['select_to'].'" ORDER BY eid desc';
                    else
                        $sql = 'SELECT * FROM event_view where  time>SUBDATE(NOW(), INTERVAL 60 MINUTE) ORDER BY eid desc';
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo ("<tr>");
                            echo ("<th scope='row'>" . $row["eid"] . "</th>");
                            echo ("<td>" . $row["severity"] . "</td>");
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
                        }
                    }
                    $result->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
<script launguage='JAVASCRIPT'>
    //sig_msg에 하이퍼링크 걸기, 패킷뷰에 탭넣어서 ipheader들 볼수있게 TODOTODO
    function detail(eid, sig_id) {
        var popupX = (window.screen.width / 2) - 500;
        var popupY= (window.screen.height / 2) - 400;
        window.open('event_detailView.php?eid=' + eid + '&sig_id=' + sig_id, 'detailViewer', 'width = 1000, height = 800, left ='+popupX+' , top ='+popupY+', menubar = no, status = no, toolbar = no ');
    }
</script>

</html>