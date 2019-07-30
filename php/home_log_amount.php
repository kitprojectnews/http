<?php
function DataPerDate()
{
    include "dbconn.php";
    $data_date=array();
    $sql = "SELECT DATE(`time`) AS `date`, count(`eid`) AS `amount` FROM test.event GROUP BY `date` having `date` > date_add(now(),interval -5 day)";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data_date[$row["date"]]= $row["amount"];
        }
    }
    return $data_date;
    $conn->close();
}
function DataPerHour()
{
    include "dbconn.php";
    $data_hour=array();
    $sql = "SELECT DATE(`time`) AS `date`, HOUR(`time`) AS `hour`, count(`eid`) AS `amount` FROM test.event where `time`>SUBDATE(NOW(), INTERVAL 23 HOUR) GROUP BY `date`, `hour`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data_hour[$row["date"]." ".$row["hour"]]= $row["amount"];
        }
    }
    return $data_hour;
    $conn->close();
}
?>