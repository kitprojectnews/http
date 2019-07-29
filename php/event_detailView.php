<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/Observer_Login.css">
    <style>
        .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 33%;
        }

        .tablink:hover {
            background-color: #777;
        }

        /* Style the tab content */
        .tabcontent {
            color: black;
            display: none;
            padding: 25px;
            text-align: center;
        }
    </style>
</head>
<title>DetailViewer</title>
<!----------------------------------------------------------------->
<?php
include 'dbconn.php';
$eid = $_GET["eid"];
$sig_id = $_GET["sig_id"];

$sql = 'SELECT * FROM data';
$result_hex = $conn->query($sql);
$result_asc = $conn->query($sql);
function hexfilter($payload)
{
    $payload_hex = bin2hex($payload);
    $payload_hex = strToUpper($payload_hex);
    for ($i = 0; $i < strlen($payload_hex); $i++) {
        if ($i == 0) {
            echo ($payload_hex[$i]);
            continue;
        }
        if ($i % 32 == 0) {
            echo ("<br>");
            echo ($payload_hex[$i]);
        } else if ($i % 16 == 0) {
            echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
            echo ($payload_hex[$i]);
        } else if ($i % 8 == 0) {
            echo ("&nbsp;&nbsp;&nbsp;");
            echo ($payload_hex[$i]);
        } else if ($i % 2 == 0) {
            echo ("&nbsp;");
            echo ($payload_hex[$i]);
        } else {
            echo ($payload_hex[$i]);
        }
    }
}
function asciifilter($payload)
{
    for ($i = 0; $i < strlen($payload); $i++) {
        if ($i == 0) {
            echo ($payload[$i]);
            continue;
        }
        if ($i % 16 == 0) {
            echo ("<br>");
            if (ord($payload[$i]) < 33 || ord($payload[$i]) > 127) {
                echo (". ");
                continue;
            }
            echo ($payload[$i]);
        } else if ($i % 8 == 0) {
            echo ("&nbsp;&nbsp;&nbsp;&nbsp;");
            if (ord($payload[$i]) < 33 || ord($payload[$i]) > 127) {
                echo (". ");
                continue;
            }
            echo ($payload[$i]);
        } else {
            if (ord($payload[$i]) < 33 || ord($payload[$i]) > 127) {
                echo (". ");
                continue;
            }
            echo ($payload[$i]);
        }
    }
}

$sql = 'SELECT * FROM signature';
$result_sigRule = $conn->query($sql);

?>
<!----------------------------------------------------------------->

<body>
    <button class="tablink" onclick="openView('RuleView', this, 'gray')" id="defaultOpen">RuleView</button>
    <button class="tablink" onclick="openView('Header', this, 'gray')">Header</button>
    <button class="tablink" onclick="openView('PacketView', this, 'gray')">PacketView</button>

    <div id="RuleView" class="tabcontent">
        <br/>
        <h1>RuleView</h1>
        <table border=1 width=90% align=center>
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

            <tr align=center>
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
                            echo ("<td>" . $row["sig_protocol"] . "</td>");
                            echo ("<td>" . $row["sig_srcIP"] . "</td>");
                            echo ("<td>" . $row["sig_srcPort"] . "</td>");
                            echo ("<td>" . $row["sig_direction"] . "</td>");
                            echo ("<td>" . $row["sig_dstIP"] . "</td>");
                            echo ("<td>" . $row["sig_dstPort"] . "</td>");
                            echo ("<td>" . $row["sig_rule_option"] . "</td>");
                            break;
                        }
                    }
                }
                ?>
            </tr>
        </table>
    </div>

    <div id="Header" class="tabcontent">
        <h1>Header</h1>
        <p>HELLO I'M Header</p>
    </div>

    <div id="PacketView" class="tabcontent">
        <table>
            <tr>
                <td>
                    <?php
                    if ($result_hex->num_rows > 0) {
                        while ($row = $result_hex->fetch_assoc()) {
                            if ($eid == $row["eid"]) {
                                hexfilter($row["data_payload"]);
                            }
                        }
                        $result_hex->close();
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($result_asc->num_rows > 0) {
                        while ($row = $result_asc->fetch_assoc()) {
                            if ($eid == $row["eid"]) {
                                asciifilter($row["data_payload"]);
                            }
                        }
                        $result_asc->close();
                    }
                    ?>
                </td>
            </tr>
        </table>
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