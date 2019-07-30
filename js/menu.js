var current_menu="root_menu";
function animation(selected_menu) {
    document.getElementById("root_menu").style.display = "none";
    switch (selected_menu.name) {
        case "object":
            var e = document.getElementById("object_menu");
            e.style.display = "block";
            e.className = "slidein";
            current_menu="object_menu";
            document.getElementById("next").innerHTML='->오브젝트';
            break;
        case "log":
            var e = document.getElementById("log_menu");
            e.style.display = "block";
            e.className = "slidein";
            current_menu="log_menu";
            document.getElementById("next").innerHTML='->로그';
            break;
    }
}

function stage_animation(selected_menu) {
    switch (selected_menu.name) {
        case "All":
            if(current_menu=="root_menu")
                break;
            document.getElementById(current_menu).style.display = "none";
            var e = document.getElementById("root_menu");
            e.style.display = "block";
            e.className = "slidein";
            current_menu="root_menu";
            document.getElementById("next").innerHTML="";
            break;
    }
}