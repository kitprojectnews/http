<?php 
    include 'home_GetSystemInfo.php';
    include 'dbconn.php';
    include 'home_log_amount.php';
    $data_date=DataPerDate();
    date_default_timezone_set("Asia/Seoul");
    for ($i=0; $i < 5; $i++) { 
        $days[$i]=date("Y-m-d", strtotime("-$i day"));
        if( !$data_date[$days[$i]])
            $data_date[$days[$i]]=0;
    }
    $data_hour=DataPerHour();
    for ($i=0; $i < 5; $i++) { 
        $hours[$i]=date("G", strtotime("-$i hour"));
        if( !$data_hour[$hours[$i]])
            $data_hour[$hours[$i]]=0;
    }
?>
<html>
    <head>
        <script src="../js/node_modules/chart.js/dist/Chart.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../css/Observer_home.css" />
    </head>
    <body>
        <div id="home_div_root">
            <?php //echo get_server_up_time();?>
            <div id="home_div_info">
                <canvas id="info"></canvas>
            </div>
            <div id="home_div_resource">
                <canvas id="sysinfo"></canvas>                
            </div>
            <div id="home_div_logcount">
                <canvas id="log_amount"></canvas>
            </div>
            <div id="home_div_logcount_hour">
                <canvas id="log_amount_hour"></canvas>
            </div>
        </div>
    </body>
    <script>
        var sysinfo = document.getElementById('sysinfo');
        var sysChart = new Chart(sysinfo, {
            type: 'horizontalBar',
            data: {
                labels: ['CPU', 'Memory', 'Disk'],
                datasets: [{
                    data: [<?php echo (double)get_server_cpu_usage();?>, <?php echo (double)get_server_memory_usage();?>, <?php echo (double)get_server_disk_usage();?>],
                    backgroundColor: [
                        'rgba(17, 125, 187, 0.2)',
                        'rgba(139, 18, 174, 0.2)',
                        'rgba(77, 166, 12, 0.2)'
                    ],
                    borderColor: [
                        'rgba(17, 125, 187, 1)',
                        'rgba(139, 18, 174, 1)',
                        'rgba(77, 166, 12, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 100
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: '시스템 정보',
                    fontSize: 15,
                    position: 'bottom'
                }
            }
        });
        
        var log_amount= document.getElementById('log_amount');
        var logChart = new Chart(log_amount, {
            type: 'bar',
            data: {
                labels:[
                    <?php 
                        echo "'".date("m/d",strtotime($days[4]))."'";
                        for ($i=3; $i >= 0; $i--) { 
                            echo ",";
                            echo "'".date("m/d",strtotime($days[$i]))."'";
                        }
                    ?>
                ],
                datasets: [{
                    data: [
                        <?php 
                            echo $data_date[$days[4]];
                            for ($i=3; $i >= 0; $i--) { 
                                echo ",";
                                echo $data_date[$days[$i]];
                            }
                        ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: '일별 로그 발생량',
                    fontSize: 15,
                    position: 'bottom'
                }
            }
        });
        var log_amount_hour= document.getElementById('log_amount_hour');
        var logChart = new Chart(log_amount_hour, {
            type: 'line',
            data: {
                datasets: [
                    {x: 10, y: 20}, 
                    {x: 15, y: 10}
                ]
            },
            options: {
                elements: {
                    line: {
                        tension: 0 // disables bezier curves
                     }
                }
            }
        });
    </script>
</html>