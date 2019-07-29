<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/Observer_Login.css">
</head>
<title>PacketViewer</title>
<!----------------------------------------------------------------->
<?php
include 'dbconn.php';
$parameter = $_GET["eid"];
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
?>
<!----------------------------------------------------------------->

<body>
    <table>
        <tr>
            <td>
                <?php
                if ($result_hex->num_rows > 0) {
                    while ($row = $result_hex->fetch_assoc()) {
                        if ($parameter == $row["eid"]) {
                            hexfilter($row["data_payload"]);
                        }
                    }
                }
                ?>
            </td>
            <td>
                <?php

                if ($result_asc->num_rows > 0) {
                    while ($row = $result_asc->fetch_assoc()) {
                        if ($parameter == $row["eid"]) {
                            asciifilter($row["data_payload"]);
                        }
                    }
                }
                ?>
            </td>
        </tr>
    </table>

</body>

</html>