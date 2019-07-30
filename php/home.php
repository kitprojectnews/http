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
    $str   = @file_get_contents('/proc/uptime');
    $num   = floatval($str);
    $secs  = fmod($num, 60); $num = intdiv($num, 60);
    $secs=substr($secs,0,2);
    $mins  = $num % 60;      $num = intdiv($num, 60);
    $hours = $num % 24;      $num = intdiv($num, 24);
    $days  = $num;

?>
<html>
    <head>
        <script src="../js/node_modules/chart.js/dist/Chart.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../css/Observer_home.css" />
    </head>
    <body onload=printClock()>
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
<script>
    var days=<?=json_encode($days)?>;
    var hours=<?=json_encode($hours)?>;
    var mins=<?=json_encode($mins)?>;
    var secs=<?=json_encode($secs)?>;
function printClock() {
    var clock = document.getElementById("home_div_info");            // 출력할 장소 선택
    var currentDate = new Date();                                     // 현재시간
    var calendar = currentDate.getFullYear() + "-" + (currentDate.getMonth()+1) + "-" + currentDate.getDate() // 현재 날짜
    var amPm = 'AM'; // 초기값 AM
    var currentHours = addZeros(currentDate.getHours(),2); 
    var currentMinute = addZeros(currentDate.getMinutes() ,2);
    var currentSeconds =  addZeros(currentDate.getSeconds(),2);
    if(currentHours >= 12){ // 시간이 12보다 클 때 PM으로 세팅, 12를 빼줌
    	amPm = 'PM';
    	currentHours = addZeros(currentHours - 12,2);
    }
    secs++;
    if(secs>=60){
        secs=0;
        mins++;
    }if(mins>=60){
        mins=0;
        hours++;
    }if(hours>=24){
        hours=0;
        days++;
    }
    var uptime=days+"d "+hours+":"+mins+":"+secs;
    clock.innerHTML ="<span style='font-size:150px;'>"+currentHours+":"+currentMinute+":"+currentSeconds+"</span><span style='font-size:50px;'>"+ amPm+"</span><br><span style='font-size:30px;'>UP Time:"+uptime+"</span>"; //날짜를 출력해 줌
    
    setTimeout("printClock()",1000);         // 1초마다 printClock() 함수 호출
}

function addZeros(num, digit) { // 자릿수 맞춰주기
	  var zero = '';
	  num = num.toString();
	  if (num.length < digit) {
	    for (i = 0; i < digit - num.length; i++) {
	      zero += '0';
	    }
	  }
	  return zero + num;
}
</script>