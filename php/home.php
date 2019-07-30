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
        <meta name="viewport" content="target-densitydpi=device-dpi, user-scalable=0, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, width=device-width" />
    </head>
    <body>
        <div id="home_div_root">
            <?php //echo get_server_up_time();?>
            <div id="home_div_info">
                <div class="center">
                    <canvas id="info" class="chart"></canvas>
                </div>
            </div>
            <div id="home_div_resource">
                <div class="center">
                    <canvas id="sysinfo" class="chart"></canvas>                
                </div>
            </div>
            <div id="home_div_logcount">
                <div class="center">
                    <canvas id="log_amount" class="chart"></canvas>
                </div>
            </div>
            <div id="home_div_logcount_hour">
                <div class="center">
                    <canvas id="log_amount_hour" class="chart"></canvas>
                </div>
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
                labels: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
                datasets: [{ 
                    data: [86,114,106,106,107,111,133,221,783,13, 222, 444,121],
                    borderColor: "#3e95cd",
                    fill: false
                }
                ]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: '시간별 로그 발생량',
                    fontSize: 15,
                    position: 'bottom',
                    responsive:true,
                    maintainAspectRatio:false
                }
            }
        });
    </script>
</html>