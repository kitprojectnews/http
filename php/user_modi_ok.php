<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
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
include "dbconn.php";
$u_num = $_POST["u_num"];
$u_active = 1;
$u_update = 0;
$r_update = 0;
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

if($u_pw!="")
{
    $hashpw = base64_encode(hash('sha256', $u_pw, true));
    $sql = "UPDATE account SET u_pw = '".$hashpw."', u_active = '".$u_active."', u_update = '".$u_update."', r_update = '".$r_update."' WHERE (u_num = '".$u_num."')";
    if ($conn->query($sql) === TRUE) 
    {
    }
    else {
    echo "Error updating record: " . $conn->error;
    }
}
else {
    $sql = "UPDATE account SET u_active = '".$u_active."', u_update = '".$u_update."', r_update = '".$r_update."' WHERE (u_num = '".$u_num."')";
    if ($conn->query($sql) === TRUE) 
    {
    } 
    else {
    echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
echo "<script type='text/javascript'>
window.opener.location.reload();
window.close();
</script>"
?>
