<?php
include 'ReSession.php';
session_start();
function hexfilter($payload)
{
    $payload_hex = bin2hex($payload);
    $payload_hex = strToUpper($payload_hex);
    echo "<table align=center><tr>";
    if(strlen($payload_hex)>0)
        echo "<td class='td0' onMouseOver='highlightBG(\"td0\",\"rgb(119,119,119)\")' onMouseOut='highlightBG(\"td0\",\"white\")'>".$payload_hex[0];
    for ($i = 1; $i < strlen($payload_hex); $i++) {
        if($i%32==0)
            echo "</tr><tr>";
        else if($i%8==0)
            echo "<td></td>";

        if($i%2==0)
            echo "<td class='td".($i/2)."' onMouseOver='highlightBG(\"td".($i/2)."\",\"rgb(119,119,119)\")' onMouseOut='highlightBG(\"td".($i/2)."\",\"white\")'>".$payload_hex[$i];
        else
            echo $payload_hex[$i]."</td>";
    }
    echo "</tr></table>";
}
function asciifilter($payload)
{
    echo "<table align=center><tr>";
    for ($i = 0; $i < strlen($payload); $i++) 
    {
        if($i%16==0)
            echo "</tr><tr>";
        else if($i%4==0)
            echo "<td></td>";

        if (ord($payload[$i]) > 33 && ord($payload[$i]) < 127) 
            echo "<td class='td".$i."' onMouseOver='highlightBG(\"td".$i."\",\"rgb(119,119,119)\")' onMouseOut='highlightBG(\"td".$i."\",\"white\")'>".$payload[$i]."</td>";
        else 
            echo "<td class='td".$i."' onMouseOver='highlightBG(\"td".$i."\",\"rgb(119,119,119)\")' onMouseOut='highlightBG(\"td".$i."\",\"white\")'>.</td>";
    }
    echo "</tr></table>";
}
function viewtext($payload)
{
    echo "<pre align='left' style='font-size: 15px'><code>";
    echo htmlentities($payload);
    echo "</code></pre>";
}
?>
