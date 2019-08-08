function changedatefrom(){
    var from=document.getElementById('date_from');
    var to=document.getElementById('date_to');
    if(from.value>to.value)
        to.value=from.value;
}
function changedateto(){
    var from=document.getElementById('date_from');
    var to=document.getElementById('date_to');
    if(from.value>to.value)
        from.value=to.value;
}