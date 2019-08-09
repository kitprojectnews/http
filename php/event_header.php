<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/Observer_eventHeader.css" />
    <script src="../js/DateControl.js"></script>
</head>
<body>
<div id='root_div'>
    <div id='head_div'>
        <div class='select_time' id='time'>
            <table align='right'><tr>
                <td>범위:&nbsp최근&nbsp</td>
                <td><input type='number' min='0' value='0' name="hour" id='time_hour'>시간</td>
                <td><input type='number' min='0' max='59' value='30' name="minute" id='time_minute'>분&nbsp&nbsp</td>
                <td>새로고침 간격: </td>
                <td>
                <select onChange='TimeChange(this);'>
                    <option value=10000>10초</option>
                    <option value=30000>30초</option>
                    <option value=60000>1분</option>
                    <option value=300000>5분</option>
                </select>
                </td>
                <td><input type="button" value='||' onClick='selectTimeStart();' id='OnOff'></td>
            </tr></table>
        </div>
        <div class='select_date' id='date' style ='display:none'>
            <table align='right'><tr>
                <td><input type="date" value='<?php echo date('Y-m-d');?>' id='date_from' onChange='changedatefrom();'></td>
                <td>~</td>
                <td><input type="date" value='<?php echo date('Y-m-d');?>' id='date_to' onChange='changedateto();'></td>
                <td><input type="button" value='조회' onClick='selectDate();'></td>
            </tr></table>
        </div>
        <div class='select_radio'>
            <table align='right'><tr>
                <td><input type='radio' name='R' checked='checked' onClick='selectType(this);' value='time'>시간별 조회</td>
                <td><input type='radio' name='R' onClick='selectType(this);' value='date'>기간별 조회</td>
            </tr></table>
        </div>
    </div>

    <div id='body_div'>
        <iframe frameborder="0" width=100% height=100% src='event.php' id='table'>
        </iframe>
    </div>
</div>
</body>
<script>
    var refreshTime=30000;
    function selectType(radio){
        var time = document.getElementById("time");
        var date = document.getElementById("date");
        if(radio.value=="time")
        {
            time.style.display = "block";
            date.style.display = "none";
        }
        else
        {
            time.style.display = "none";
            date.style.display = "block";
        }
    }
    function selectDate(){
        var OnOff=document.getElementById('OnOff');
        OnOff.value='►';
        isrefresh=false;
        clearInterval(interval);
        var frame=document.getElementById('table');
        var from=document.getElementById('date_from');
        var to=document.getElementById('date_to');
        frame.src="event.php?select_from="+from.value+"&select_to="+to.value;
        frame.location.reload();
    }
    function selectTime(){
        var frame=document.getElementById('table');
        var hour=document.getElementById('time_hour');
        var minute=document.getElementById('time_minute');
        var time=Number(hour.value)*60+Number(minute.value);
        frame.src="event.php?select_ago="+time;
        frame.location.reload();
    }
    function selectTimeStart(){
        if(isrefresh==true)
        {
            var OnOff=document.getElementById('OnOff');
            OnOff.value='►';
            isrefresh=false;
            clearInterval(interval);
        }
        else
        {
            var OnOff=document.getElementById('OnOff');
            OnOff.value='||';
            isrefresh=true;
            interval=setInterval(function(){selectTime();}, refreshTime);
            selectTime();
        }
    }
    function TimeChange(time){
        refreshTime = time.options[time.selectedIndex].value;
        clearInterval(interval);
        interval=setInterval(function(){selectTime();}, refreshTime);
        selectTime();
    }
    var isrefresh=true;
    var interval=setInterval(function(){selectTime();}, refreshTime);
</script>
</html>