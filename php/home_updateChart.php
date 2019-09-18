<?php

include "home_GetSystemInfo.php";
include "home_log_amount.php";

$doc = new DomDocument('1.0', 'UTF-8');

$root = $doc->createElement('root');
$doc->appendChild($root);

$resource = $doc->createElement('resource');
$root->appendChild($resource);

$cpu = $doc->createElement('cpu', get_server_cpu_usage());
$memory = $doc->createElement('memory', get_server_memory_usage());
$disk = $doc->createElement('disk', get_server_disk_usage());
$resource->appendChild($cpu);
$resource->appendChild($memory);
$resource->appendChild($disk);

$data_date=DataPerDate();
date_default_timezone_set("Asia/Seoul");
for ($i=0; $i < 5; $i++) { 
    $j=4-$i;
    $dayset[$i]=date("Y-m-d", strtotime("-$j day"));
    if( !array_key_exists($dayset[$i], $data_date))
        $data_date[$dayset[$i]]=0;
}
$date_log = $doc->createElement('date_log');
$root->appendChild($date_log);

for ($i=0; $i <5; $i++) { 
    $day_data[$i] = $doc->createElement("day_amount", $data_date[$dayset[$i]]);
    $day_attr[$i]=$doc->createAttribute("date");
    $day_attr[$i]->value=date("m/d",strtotime($dayset[$i]));
    $day_data[$i] ->appendChild($day_attr[$i]);
    $date_log->appendChild($day_data[$i]);
}


$data_hour=DataPerHour();
for ($i=0; $i < 24; $i++) { 
    $j=23-$i;
    $hourset[$i]=date("Y-m-d G", strtotime("-$j hour"));
    if( !array_key_exists($hourset[$i], $data_hour))
        $data_hour[$hourset[$i]]=0;
}
$time_log = $doc->createElement('time_log');
$root->appendChild($time_log);

for ($i=0; $i <24; $i++) { 
    $time_data[$i] = $doc->createElement("time_amount", $data_hour[$hourset[$i]]);
    $time_attr[$i]=$doc->createAttribute("time");
    $time_attr[$i]->value=explode ( " ", $hourset[$i] )[1];
    $time_data[$i] ->appendChild($time_attr[$i]);
    $time_log->appendChild($time_data[$i]);
}

$xml = $doc->saveXML();
header('Content-type: text/xml');
echo $xml;
?>
