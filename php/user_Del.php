<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

<!-- <link rel="stylesheet" type="text/css" href="../css/Observer_Login.css"> -->
<link rel="stylesheet" type="text/css" href="../css/Observer_user_Manage.css">
<?php
session_start();
if(!$_SESSION['u_active'])//활성 유저 여부 
{
 header('Location:../index.html');
}
if(!$_SESSION['u_update'])//유저 관리권한 여부
{
   die('접근권한이 없습니다. ');
}
include "dbconn.php";
if (isset($_GET["u_num"])) {
    $u_num = $_GET["u_num"];
}
 echo "wow";
$sql = "DELETE FROM account WHERE u_num='".$u_num."'";
if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();
echo "<script type='text/javascript'>
window.opener.location.reload();
window.close();
</script>"
?>
