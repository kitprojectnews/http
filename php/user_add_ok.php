<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
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
$u_active = 1;
$u_update = 0;
$r_update = 0;
if (isset($_POST["u_id"])) {
    $u_id=$_POST["u_id"];
}
if (!isset($_POST["u_active"])) {
    $u_active=0;
}
if (isset($_POST["u_update"])) {
    $u_update=1;
}

if (isset($_POST["r_update"])) {
    $r_update=1;
}
if (isset($_POST["u_pw"])) {
    $u_pw = $_POST["u_pw"];
}

$hashpw = base64_encode(hash('sha256', $u_pw, true));
$sql = "INSERT INTO .account (u_id, u_pw, u_active, u_update, r_update) VALUES ('".$u_id."', '".$hashpw."', '".$u_active."', '".$u_update."', '".$r_update."')";

if ($conn->query($sql) === TRUE) 
{
    echo "ok<br>";
}
else 
{
    echo "Error updating record: " . $conn->error;
}
$conn->close();
echo "<script type='text/javascript'>

window.opener.location.reload();
window.close();
</script>"
?>
