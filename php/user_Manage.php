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
    <title></title>
</head>
<body>
<form>
<table width=100%>
<tr><th>관리번호</th><td>ID</td><td>활성여부</td><td>유저 수정권한</td><td>룰 확인</td><td>룰 추가/수정/삭제</td><td>수정 및 삭제</td></tr>
<?php
include "./dbcdonn.php";
$sql = "SELECT u_num, u_id, u_active, u_update, r_sel, r_update FROM test.account ORDER BY DESC";
$result = $conn->query($sql);
echo "ok<br>";
if ($result->num_rows != 0) {
    while($row = $result->fetch_assoc()) 
    {
        echo ("<tr>");
        echo ("<th scope='row'>" . $row["u_num"] . "</th>");
        echo ("<td>" . $row["u_id"] . "</td>");
        echo ("<td>" . $row["u_active"] . "</td>");
        echo ("<td>" . $row["r_sel"]. "</td>");
        echo ("<td>" . $row["r_update"] . "</td>");
        echo ("<td> <button onClick='window.open(\"user_Modi.php\",\"user Modifiy\",\"width=10\",\"height=10\")'>수정</button>&nbsp;<button/>삭제</td>");
        echo ("</tr>");
        $row["u_num"];
        $row["u_id"];
        $row["u_active"];
        $row["u_update"];
        $row["r_sel"];
        $row["r_update"];
        $conn->close();
    }
}
else {
    $conn->close();
}
echo "ok<br>";
?>

</table>
</form>
</body>
</html>