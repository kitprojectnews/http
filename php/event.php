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
                $hostName = 'localhost';
                $dbuserName = 'jwh';
                $passWord = 'Qwer!234';
                $dbName = 'test';
                // Create connection
                $conn = mysqli_connect($hostName, $dbuserName, $passWord, $dbName);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
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
                        echo ("<td> <button onClick='window.open(\"event_packetView.php\",\"PacketViewer\",\"width=10\",\"height=10\")'>패킷뷰</button>&nbsp;<button/>룰뷰</td>");
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