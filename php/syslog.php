<html>
    <title>SYSLOG</title>
    <body>
        <form>
            <table border=1>
                <tr>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                <?php
                    echo ('<tr><td>');
                    $all = shell_exec('grep Observer /var/log/messages');
                    $line = str_replace(PHP_EOL, '</tr><tr><td>', $all);
                    $tmp1 = preg_replace("/localhost \[Observer\]\[[0-9]{3,6}\]: /", "", $line);
                    $tmp2 = preg_replace("/ \[/","<td>[",$tmp1);
                    $tmp3 = substr($tmp2,0,-8);
                    echo $tmp3;
                ?>
            </table>
        </form>
    </body>
</html>

