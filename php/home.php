<?php include 'GetSystemInfo.php';?>
<html>
    <head>
        <script src="../js/node_modules/chart.js/dist/Chart.js">
        </script>
        <link rel="stylesheet" type="text/css" href="../css/Observer_home.css" />
    </head>
    <body>
        <div id="home_div_root">
        <?php echo get_server_up_time();?>
            <div id="home_div_resource">
                <canvas id="myChart"></canvas>                
            </div>
        </div>
    </body>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ['CPU', 'Memory'],
                datasets: [{
                    label: '시스템 정보',
                    data: [<?php echo (double)get_server_cpu_usage();?>, <?php echo (double)get_server_memory_usage();?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
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
                }
            }
        });
    </script>
</html>