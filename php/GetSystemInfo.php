<?php
    function get_server_memory_usage(){

        $exec_free = explode("\n", trim(shell_exec('free')));
        $get_mem = preg_split("/[\s]+/", $exec_free[1]);
        $mem = round($get_mem[2]/$get_mem[1]*100, 2);
        return $mem;
    }
    function get_server_cpu_usage(){
        $exec_loads = sys_getloadavg();
        $exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
        $cpu = round($exec_loads[0]/($exec_cores+1)*100, 2);
        return $cpu;
    }  
    function get_server_up_time(){
        $exec_uptime = preg_split("/[\s]+/", trim(shell_exec('uptime')));
        $uptime = $exec_uptime[2];
        return $uptime;
    }
?>