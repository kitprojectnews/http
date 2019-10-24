<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/Observer_tags.css" />
    <link rel="stylesheet" type="text/css" href="../css/Observer_eventdetail.css" />
</head>
<title>DetailViewer</title>
<!----------------------------------------------------------------->
<?php
include 'ReSession.php';
session_start();
include 'dbconn.php';
include 'event_packetview.php';
$eid = $_GET["eid"];
$sig_id = $_GET["sig_id"];

$sql = 'SELECT * FROM data where eid='.$eid;
$result_hex = $conn->query($sql);
$payload;
if ($result_hex->num_rows > 0)
{
    $row = $result_hex->fetch_assoc();
    $payload=$row["data_payload"];
}
$result_hex->close();
$sql = 'SELECT * FROM signature where sig_id='.$sig_id;
$result_sigRule = $conn->query($sql);
?>
<!----------------------------------------------------------------->

<body>
    <button class="tablink" onclick="openView('RuleView', this, 'gray')" id="defaultOpen">RuleView</button>
    <button class="tablink" onclick="openView('Header', this, 'gray')">Header</button>
    <button class="tablink" onclick="openView('TextView', this, 'gray')">TextView</button>
    <button class="tablink" onclick="openView('HexView', this, 'gray')">HexView</button>

    <div id="RuleView" class="tabcontent">
        <br />
        <h1>RuleView</h1>
        <table width=90% align='center'>
            <tr>
                <th>id</th>
                <th>msg</th>
                <th>rev</th>
                <th>sid</th>
                <th>gid</th>
                <th>action</th>
                <th>protocol</th>
                <th>srcIP</th>
                <th>srcPort</th>
                <th>direction</th>
                <th>dstIP</th>
                <th>dstPort</th>
                <th>rule_option</th>
            </tr>

            <tr align='center'>
                <?php
                if ($result_sigRule->num_rows > 0) {
                    while ($row = $result_sigRule->fetch_assoc()) {
                        if ($sig_id == $row["sig_id"]) {
                            echo ("<td>" . $row["sig_id"] . "</td>");
                            echo ("<td>" . $row["sig_msg"] . "</td>");
                            echo ("<td>" . $row["sig_rev"] . "</td>");
                            echo ("<td>" . $row["sig_sid"] . "</td>");
                            echo ("<td>" . $row["sig_gid"] . "</td>");
                            echo ("<td>" . $row["sig_action"] . "</td>");
                            $sig_protocol = $row["sig_protocol"];
                            echo ("<td>" . $row["sig_protocol"] . "</td>");
                            echo ("<td>" . $row["sig_srcIP"] . "</td>");
                            echo ("<td>" . $row["sig_srcPort"] . "</td>");
                            echo ("<td>" . $row["sig_direction"] . "</td>");
                            echo ("<td>" . $row["sig_dstIP"] . "</td>");
                            echo ("<td>" . $row["sig_dstPort"] . "</td>");
                            echo ("<td>" . $row["sig_rule_option"] . "</td>");
                            $result_sigRule->close();
                            break;
                        }
                    }
                }
                ?>
            </tr>
        </table>
    </div>

    <div id="Header" class="tabcontent">
        <br />
        <h1>HeaderView</h1>
        <br />

        <h2>IP Header</h2>
        <table width=70% align='center'>
            <tr>
                <th>src_ip</th>
                <th>dst_ip</th>
                <th>tos</th>
                <th>ttl</th>
                <th>more_frag</th>
                <th>dont_frag</th>
            </tr>
            <tr align='center'>
                <?php
                $sql = 'SELECT * FROM iphdr WHERE iphdr.eid=' . $eid;
                $result_iphdr = $conn->query($sql);
                if ($result_iphdr->num_rows > 0) {
                    while ($row = $result_iphdr->fetch_assoc()) {
                        if ($eid == $row["eid"]) {
                            echo ("<td>" . long2ip($row["src_ip"]) . "</td>");
                            echo ("<td>" . long2ip($row["dst_ip"]) . "</td>");
                            echo ("<td>" . $row["tos"] . "</td>");
                            echo ("<td>" . $row["ttl"] . "</td>");
                            echo ("<td>" . $row["more_frag"] . "</td>");
                            echo ("<td>" . $row["dont_frag"] . "</td>");
                            $result_iphdr->close();
                            break;
                        }
                    }
                }
                ?>
            </tr>
        </table>
        <br>
        <?php
        if ($sig_protocol == "tcp") {
            $sql = 'SELECT * FROM tcphdr WHERE tcphdr.eid=' . $eid;
            $result_tcphdr = $conn->query($sql);
            if ($result_tcphdr->num_rows > 0) {
                while ($row = $result_tcphdr->fetch_assoc()) {
                    if ($eid == $row["eid"]) {
                        echo ("<h2>TCP Header</h2>");
                        echo ("<table width=70% align='center'>");
                        echo ("<tr>");
                        echo ("<th>src_port</th>");
                        echo ("<th>dst_port</th>");
                        echo ("<th>seq_num</th>");
                        echo ("<th>ack_num</th>");
                        echo ("<th>urg</th>");
                        echo ("<th>ack</th>");
                        echo ("<th>psh</th>");
                        echo ("<th>rst</th>");
                        echo ("<th>syn</th>");
                        echo ("<th>fin</th>");
                        echo ("<th>win_size</th>");
                        echo ("</tr><tr align='center'>");

                        echo ("<td>" . $row["src_port"] . "</td>");
                        echo ("<td>" . $row["dst_port"] . "</td>");
                        echo ("<td>" . $row["seq_num"] . "</td>");
                        echo ("<td>" . $row["ack_num"] . "</td>");
                        echo ("<td>" . $row["urg"] . "</td>");
                        echo ("<td>" . $row["ack"] . "</td>");
                        echo ("<td>" . $row["psh"] . "</td>");
                        echo ("<td>" . $row["rst"] . "</td>");
                        echo ("<td>" . $row["syn"] . "</td>");
                        echo ("<td>" . $row["fin"] . "</td>");
                        echo ("<td>" . $row["win_size"] . " bytes</td></table>");
                        $result_tcphdr->close();
                        break;
                    }
                }
            }
        } else if ($sig_protocol == "udp") {
            $sql = 'SELECT * FROM udphdr WHERE udphdr.eid=' . $eid;
            $result_udphdr = $conn->query($sql);
            if ($result_udphdr->num_rows > 0) {
                while ($row = $result_udphdr->fetch_assoc()) {
                    if ($eid == $row["eid"]) {
                        echo ("<h2>UDP Header</h2>");
                        echo ("<table width=70% align='center'>");
                        echo ("<tr>");

                        echo ("<th>src_port</th>");
                        echo ("<th>dst_port</th>");

                        echo ("</tr><tr>");
                        echo ("<td>" . $row["src_port"] . "</td>");
                        echo ("<td>" . $row["dst_port"] . "</td></table>");
                        $result_udphdr->close();
                        break;
                    }
                }
            }
        } else if ($sig_protocol == "icmp") {
            $sql = 'SELECT * FROM icmphdr WHERE icmphdr.eid=' . $eid;
            $result_icmphdr = $conn->query($sql);
            if ($result_icmphdr->num_rows > 0) {
                while ($row = $result_icmphdr->fetch_assoc()) {
                    if ($eid == $row["eid"]) {
                        echo ("<h2>ICMP Header</h2>");
                        echo ("<table width=70% align='center'>");
                        echo ("<tr >");

                        echo ("<th>type</th>");
                        echo ("<th>code</th>");

                        echo ("</tr><tr>");
                        echo ("<td>" . $row["type"] . "</td>");
                        echo ("<td>" . $row["code"] . "</td></table>");
                        $result_icmphdr->close();
                        break;
                    }
                }
            }
        }
        ?>

    </div>

    <div id="TextView" class="tabcontent">
        <br />
        <h1>Packet Payload Text View</h1>
        <br/>
        <div id='div_textview'>
        <?php
            viewtext($payload);
        ?>
        </div>
    </div>

    <div id="HexView" class="tabcontent">
        <br />
        <h1>Packet Payload Hex View</h1>
        <br/>
        <div id='div_packetview'>
        <?php
            echo "<div id='div_hextable'>";
            hexfilter($payload);
            echo"</div>";
            echo "<div id='div_asciitable'>";
            asciifilter($payload);
            echo"</div>";
        ?>
        <script>
            function highlightBG(element, color) {
                var x = document.getElementsByClassName( element );
                for( var i = 0; i < x.length; i++ ) {
                    x[i].style.backgroundColor=color;
                    if(color=="white")
                        x[i].style.color="black";
                    else
                        x[i].style.color="white";
                }
            }
        </script>
        </div>
    </div>

</body>
<script>
    function openView(indexName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(indexName).style.display = "block";
        elmnt.style.backgroundColor = color;

    }
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

</html>
