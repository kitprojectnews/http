<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="../css/Observer_user_Manage.css">
<link href="../css/Observer_tags.css" rel="stylesheet" type='text/css'>
<?php
session_start();

if(!$_SESSION['u_active'])//활성 유저 여부 
{
    echo " <script>alert('비활성화된 사용자입니다. '); history.back(); </script>";
}
if(!$_SESSION['u_update'])//유저 관리권한 여부
{
    echo " <script>alert('접근권한이 없습니다. '); history.back(); </script>";
}
?>
    <title>유저 추가 페이지 </title>
    </head>
<body>
<form action="user_add_ok.php" method="POST" name=frm1>
<table width=100% align="center">
<tr><th colspan=2><h2>유저 추가 </h2></th></tr>
<tr><th>ID</th><td><input name="u_id" type='text' value=""></td></tr>
<tr><th>PW</th><td> <input name="u_pw" type='password' value=""></td></tr>
<tr><th>활성여부</th><td><input name="u_active" type='checkbox'checked></td></tr>
<tr><th>관리권한</th><td><input name="u_update" type='checkbox'></td></tr>
<tr><th>룰 추가/수정/삭제</th><td><input name="r_update" type='checkbox'></td></tr>
<tr><td colspan="2"><input type="button" value="추가" onclick="ckfild()">&nbsp;&nbsp;
<input type="button" value="취소" onClick="window.close();"></td></tr>
</table>
</form>    
</body>
<script launguage='JAVASCRIPT'>
    function ckfild(){
        if (frm1.u_id.value=="") {
            alert ("ID 입력하시오");
        }
        else if (frm1.u_pw.value=="") {
            alert ("PW 입력하시오");
        }
        else
        {
            frm1.submit();
        }
    } 
</script>
</html>