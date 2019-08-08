<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Observer_animaiton.css" />
    <link rel="stylesheet" type="text/css" href="css/Observer_div.css" />
    <?php
    session_start();
    if (!isset($_SESSION['u_num'])) 
    {
        header('Location:./index.html');
    }
    ?>
</head>
<body onload="showCustomer()">
    <div id="div_root">
        <div id="div_head">
            <div id="div_banner">
                Observer
            </div>
            <div id="div_eventalert">
            <iframe id="eventiframe" name="eventiframe" src="php/event_alert.php" width="100%" height="90%" frameborder="0"></iframe>
            </div>
            <div id="div_alertcheckbox">
            <form>
                <input type="button" id="clear" name="clear" value="clear" onClick="clearframe()">
            </form>
            </div>
            <div id="div_login">
                <table width=100% height=100%><tr><td>
                <div class="login_text">
                    <?php 
                        echo $_SESSION["u_id"]."님으로 로그인 되어있습니다.&nbsp&nbsp&nbsp";
                        echo "<a href='php/logout.php'>logout</a>&nbsp";
                    ?>
                </div>
                </td></tr></table>
            </div>
        </div>

        <div id="hr"><hr></div>
        
        <div id="div_body">
            <div id="div_menu">
                <div class="stage" id="stage_menu">
                <div style="float:left;"><a href="php/home.php" onclick=stage_animation(this) name="All" target="frame">All</a></div><div id="next" style="float:left;"></div>
                </div>
                <ul id="root_menu">
                    <?php 
                        if($_SESSION["u_update"]==1)
                            echo '<li class="menu_item"><a href="php/user_Manage.php" target="frame">사용자 관리</a></li>';
                    ?>
                    <li class="menu_item"><a href="php/rlist.php" target="frame">룰</a></li>
                    <li class="menu_item"><a href="#" onclick=animation(this) name="object">오브젝트</a></li>
                    <li class="menu_item"><a href="#" onclick=animation(this) name="log">로그</a></li>
                </ul>
                <ul id="object_menu" style ="display:none">
                    <li class="menu_item"><a href="php/ipvar.php" target="frame">ip</a></li>
                    <li class="menu_item"><a href="php/portvar.php" target="frame">port</a></li>
                    <li class="menu_item"><a href="php/group.php" target="frame">group</a></li>
                </ul>
                <ul id="log_menu" style ="display:none">
                    <li class="menu_item"><a href="php/syslog.php" target="frame">syslog</a></li>
                    <li class="menu_item"><a href="php/event_header.php" target="frame">event</a></li>
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
<script launguage='JAVASCRIPT'>
    function clearframe()
    {
                document.getElementById("eventiframe").contentDocument.location.reload(true);
    }
</script>
</html>
