<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="../css/Observer_tags.css">
<?php
include 'ReSession.php';
session_start();
if(!$_SESSION['u_update'])//유저 관리권한 여부
{
   die('접근권한이 없습니다. ');
}
?>
    <title>유저 관리 페이지 </title>
</head>
<body>
<h1 align=center>User Management</h1>
<p>
<div style="margin-left:15px">
<input type=button value="유저 추가" onclick="addhref()">
<form>
<table border="1" cellspacing="0" width=100%>

<tr><th width=100>관리번호</th><th>ID</th><th width=200>활성여부</th><th width=200>유저 관리권한</th><th width=200>룰 추가/수정/삭제</th><th>수정</th></tr>
<?php
include "dbconn.php";
$sql = "SELECT u_num, u_id, u_active, u_update, r_update FROM account ORDER BY u_num DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
    <tr>
        <th scope='row'><?=$row["u_num"]?></th>
        <td align=center ><?=$row["u_id"]?></td>
        <td align=center ><?php if($row["u_active"] == "1") {echo "TRUE";}else {echo "FALSE";} ?></td>
        <td align=center ><?php if($row["u_update"] == "1") {echo "TRUE";}else {echo "FALSE";} ?></td>
        <td align=center ><?php if($row["r_update"] == "1") {echo "TRUE";}else {echo "FALSE";} ?></td>
        <td width=110 align=center ><input type=button value="수정" onClick='userhref("<?=$row["u_num"]?>")'>
        <?php if($row["u_num"] != "1") { echo "<input type=button value=삭제 onClick='delhref(".$row["u_num"].")'>";}?> </td>
    </tr>
    
    <?php
        }
} else {
    echo "0 results<br>";
}
?>
</table>
</form>
</div>
</body>
<script launguage='JAVASCRIPT'>
    var popupX = (window.screen.width / 2) - (500 / 2);
    var popupY= (window.screen.height / 2) - (250 / 2);
    function addhref() {
        window.open('user_Add.php', 'userAdd', 'width = 400, height = 280, left ='+popupX+' , top ='+popupY+', menubar = no, status = no, toolbar = no, scrollbars = no, resizable = no, location = no');
    }
    function userhref(u_num) {
        window.open('user_Modi.php?u_num='+u_num, 'userModi', 'width = 400, height = 280, left ='+popupX+' , top ='+popupY+', menubar = no, status = no, toolbar = no, scrollbars = no, resizable = no, location = no');
    }
    function delhref(u_num) {
        a = confirm("관리번호 "+u_num+" 정말로 삭제하시겠습니까?");
        if(a)
        {
            window.open('user_Del.php?u_num='+u_num, 'userModi', 'width = 0, height = 0, menubar = no, status = no, toolbar = no, scrollbars = no, resizable = no, location = no');
        }
    }
    </script>
</html>
