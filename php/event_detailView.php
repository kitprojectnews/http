<html>
<title>detailViewer</title>

<head>

</head>
<?php
include 'dbconn.php';
$eid = $_GET["eid"];
$sig_id = $_GET["sig_id"];
$sql = 'SELECT * FROM event,signature,(SELECT src_ip, dst_ip, data.eid as eid, src_port, dst_port FROM data,iphdr,tcphdr WHERE data.eid=iphdr.eid and data.eid=tcphdr.eid) AS tmp WHERE event.eid=tmp.eid';

echo $eid;
echo "<br>";
echo $sig_id;
?>
<body>
    
</body>

</html>