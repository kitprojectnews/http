<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/Observer_syslog.css" />
    </head>
    <title>SYSLOG</title>
    <body>
        <form>
            <table class="syslogTable">
                <thead>
                    <tr>
                        <th scope="cols">Time</th>
                        <th scope="cols">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        echo ('<tr><th scope="row">');
                        $all = shell_exec('grep Observer /var/log/messages | sort -r');
                        $line = str_replace(PHP_EOL, '</td></tr><tr><th scope="row">', $all);
                        $tmp1 = preg_replace("/localhost \[Observer\]\[[0-9]{3,6}\]: /", "", $line);
                        $tmp2 = preg_replace("/ \[/","</th><td>[",$tmp1);
                        $tmp3 = substr($tmp2,0,-20);
                        echo $tmp3;
                    ?>
                </tbody>
            </table>
        </form>
    </body>
</html>

