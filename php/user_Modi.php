<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

<!-- <link rel="stylesheet" type="text/css" href="../css/Observer_Login.css"> -->
<link rel="stylesheet" type="text/css" href="../css/Observer_user_Manage.css">
<?php
session_start();
// if (!isset($_SESSION['user_num']))//세션 확인
// {
//     header('Location:../index.html');
// }
// if(!$_SESSION['u_active'])//활성 유저 여부 
// {
//     echo " <script>alert('비활성화된 사용자입니다. '); history.back(); </script>";
// }
// if(!$_SESSION['u_update'])//유저 관리권한 여부
// {
//     echo " <script>alert('접근권한이 없습니다. '); history.back(); </script>";
// }
?>
    <title>유저 수정 페이지 </title>
    </head>
<body>
<?php 
$u_num = $_GET["u_num"];
?>
<form action="user_modi_ok.php" method="POST">
<table width=100% align="center">
<?php
include "dbconn.php";

$sql = "SELECT u_num, u_id, u_active, u_update, r_update FROM account Where u_num ='".$u_num."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
        <tr><th colspan=2><h2>관리번호&nbsp;<?=$row["u_num"]?> </h2><input type="hidden" name="u_num" value="<?=$row["u_num"]?>"></tr>
        <tr><th>ID</th><td><?= $row["u_id"]?></td></tr>
        <tr><th>PW</th><td> <input name="u_pw" type='password' value=""></td></tr>
        <tr><th>활성여부</th><td><input name="u_active" type='checkbox' value="1" <?php if($row["u_active"] == "1") { ?> checked <?php } ?>></td></tr>
        <tr><th>관리권한</th><td><input name="u_update" type='checkbox' <?php if($row["u_update"] == "1") { ?> checked <?php } ?>></td></tr>
        <tr><th>룰 추가/수정/삭제</th><td><input name="r_update" type='checkbox' <?php if($row["r_update"] == "1") { ?> checked <?php } ?>></td></tr>
        <tr><td colspan="2"><input type="submit" value="수정">&nbsp;&nbsp;<button onClick="<script> self.close(); </script>">취소</button> </td></tr>
        <?php
        }
} else {
    echo "0 results<br>";
}
?>
</table>
</form>
</body>
</html>