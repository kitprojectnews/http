<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/Observer_event.css" />
</head>
<script launguage='JAVASCRIPT'>
    function packetView(eid) {
        window.open('event_packetView.php?eid=' + eid, 'PacketViewer', 'width = 800, height = 600, menubar = no, status = no, toolbar = no');
    }
    //sig_msg에 하이퍼링크 걸기, 패킷뷰에 탭넣어서 ipheader들 볼수있게 TODOTODO
    function detail(eid, sig_id) {
        window.open('event_detailView.php?eid=' + eid + '&sig_id=' + sig_id, 'detailViewer', 'width = 1200, height = 800, menubar = no, status = no, toolbar = no ');
    }
</script>
<title></title>

<body>
    <form target="_blank">
        <table class="eventTable">
            <thead>
                <tr>
                    <th scope="cols">eid</th>
                    <th scope="cols">sig_id</th>
                    <th scope="cols">sig_msg</th>
                    <th scope="cols">src_ip</th>
                    <th scope="cols">src_port</th>
                    <th scope="cols">dst_ip</th>
                    <th scope="cols">dst_port</th>
                    <th scope="cols">ETC</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'dbconn.php';
                $sql = 'SELECT * FROM event,signature,(SELECT src_ip, dst_ip, data.eid as eid, src_port, dst_port FROM data,iphdr,tcphdr WHERE data.eid=iphdr.eid and data.eid=tcphdr.eid) AS tmp WHERE event.eid=tmp.eid';

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo ("<tr>");
                        echo ("<th scope='row'>" . $row["eid"] . "</th>");
                        echo ("<td>" . $row["sig_id"] . "</td>");
                        echo ("<td>" . $row["sig_msg"] . "</td>");
                        echo ("<td>" . long2ip($row["src_ip"]) . "</td>");
                        echo ("<td>" . $row["src_port"] . "</td>");
                        echo ("<td>" . long2ip($row["dst_ip"]) . "</td>");
                        echo ("<td>" . $row["dst_port"] . "</td>");
                        echo ("<td> <input type=button value=패킷뷰 onClick='packetView(" . $row["eid"] . ")'/>&nbsp;<input type=button value=자세히 onClick='detail(" . $row["eid"] . "," . $row["sig_id"] . ")' /></td>");
                        echo ("</tr>");
                        //echo "eid:" . $row["eid"] . " sig_id:" . $row["sig_id"] . " src_ip:" . $row["src_ip"] . " src_port:" . $row["src_port"] . "<br>";
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </tbody>
        </table>
    </form>
</body>

</html>