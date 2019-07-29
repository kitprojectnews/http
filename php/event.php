<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/Observer_event.css" />
</head>

<title></title>

<body>
    <form target="_blank">
        <table class="eventTable">
            <thead>
                <tr>
                    <th scope="cols">eid</th>
                    <th scope="cols">time</th>
                    <th scope="cols">sig_msg</th>
                    <th scope="cols">src_ip</th>
                    <th scope="cols">dst_ip</th>
                    <th scope="cols">protocol</th>
                    <th scope="cols">ETC</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'dbconn.php';
                $sql = 'SELECT * FROM event,signature,(SELECT src_ip, dst_ip, data.eid as eid FROM data,iphdr WHERE data.eid=iphdr.eid) AS tmp WHERE event.eid=tmp.eid;';

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo ("<tr>");
                        echo ("<th scope='row'>" . $row["eid"] . "</th>");
                        echo ("<td>" . $row["time"] . "</td>");
                        echo ("<td>" . $row['sig_msg'] . "</td>");
                        echo ("<td>" . long2ip($row["src_ip"]) . "</td>");
                        echo ("<td>" . long2ip($row["dst_ip"]) . "</td>");
                        echo ("<td>" . $row["sig_protocol"] . "</td>");
                        echo ("<td> <input type=button value=자세히 onClick='detail(" . $row["eid"] . "," . $row["sig_id"] . ")' /></td>");
                        echo ("</tr>");
                        //echo "eid:" . $row["eid"] . " sig_id:" . $row["sig_id"] . " src_ip:" . $row["src_ip"] . " src_port:" . $row["src_port"] . "<br>";
                    }
                } else {
                    echo "0 results";
                }
                $result->close();
                ?>
            </tbody>
        </table>
    </form>
</body>
<script launguage='JAVASCRIPT'>
    //sig_msg에 하이퍼링크 걸기, 패킷뷰에 탭넣어서 ipheader들 볼수있게 TODOTODO
    function detail(eid, sig_id) {
        window.open('event_detailView.php?eid=' + eid + '&sig_id=' + sig_id, 'detailViewer', 'width = 1000, height = 800, menubar = no, status = no, toolbar = no ');
    }

</script>

</html>