<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-KR">
<head>
</head>
<body>
<?php
$user = $_POST["user"];
$pass = $_POST["pass"];

$hostName='localhost';
$dbuserName='msr';
$passWord='Qwer!234';
$dbName='test';
echo 1;
// Create connection
$conn = mysqli_connect($hostName, $dbuserName, $passWord, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
echo 2;
$sql = 'SELECT * FROM account';
$result = $conn->query($sql);
echo 3;
if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        echo "id: " . $row["u_id"]. " - pw: " . $row["u_pw"]. "<br>";
    }
} 
else 
{
    echo "0 results";
}
echo 4;
?>

</body>
</html>