function updateCharts(xml) {
    var parser = new DOMParser();
    var xmlDoc = parser.parseFromString(xml.responseText,"text/xml");
    
    sysChart.data.datasets[0].data[0] = xmlDoc.getElementsByTagName("cpu")[0].childNodes[0].nodeValue;
    sysChart.data.datasets[0].data[1] = xmlDoc.getElementsByTagName("memory")[0].childNodes[0].nodeValue;
    sysChart.data.datasets[0].data[2] = xmlDoc.getElementsByTagName("disk")[0].childNodes[0].nodeValue;
    sysChart.update();

    var date_log = xmlDoc.getElementsByTagName("day_amount");
    for (var index = 0; index < date_log.length; index++) {
        logChart.data.datasets[0].data[index]=date_log[index].childNodes[0].nodeValue;
        logChart.data.labels[index] = date_log[index].getAttribute('date') ;
    }
    logChart.update();

    var time_log = xmlDoc.getElementsByTagName("time_amount");
    for (var index = 0; index < time_log.length; index++) {
        logChart2.data.datasets[0].data[index]=time_log[index].childNodes[0].nodeValue;
        logChart2.data.labels[index] = time_log[index].getAttribute('time') ;
    }
    logChart2.update();
}