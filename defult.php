<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Observer_animaiton.css" />
    <link rel="stylesheet" type="text/css" href="css/Observer_div.css" />
    <link rel="stylesheet" type="text/css" href="css/Observer_tag.css" />
</head>
<body>
    <div id="div_root">
        <div id="div_head">
            <div id="div_banner">
                <h1>Observer</h1>
            </div>
        </div>
        <div id="div_body">
            <div id="div_menu">
                <div class="stage" id="stage_menu">
                <a href="php/home.php" onclick=stage_animation(this) name="All" target="frame">All</a>
                </div>
                <ul id="root_menu">
                    <li class="menu_item"><a href="#">사용자 관리</a></li>
                    <li class="menu_item"><a href="#">룰</a></li>
                    <li class="menu_item"><a href="#" onclick=animation(this) name="object">오브젝트</a></li>
                    <li class="menu_item"><a href="#" onclick=animation(this) name="log">로그</a></li>
                </ul>
                <ul id="object_menu" style ="display:none">
                    <li class="menu_item"><a href="#">ip</a></li>
                    <li class="menu_item"><a href="#">port</a></li>
                    <li class="menu_item"><a href="#">group</a></li>
                </ul>
                <ul id="log_menu" style ="display:none">
                    <li class="menu_item"><a href="php/syslog.php" target="frame">syslog</a></li>
                    <li class="menu_item"><a href="#">event</a></li>
                </ul>
            </div>
            <div id="div_content">
                <iframe name=frame width=100% height=100% src="php/home.php">

                </iframe>
            </div>
        </div>
    </div>
</body>
<script src="js/menu.js">
</script>
</html>