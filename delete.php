<?php
$serverName = "DESKTOP-R49M057\SQLEXPRESS";
$database = "mb52";
$uid = "";
$pass ="";

$connectionInfo = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass,
];

$conn = sqlsrv_connect($serverName, $connectionInfo);
if(!$conn)
    die(print_r(sqlsrv_errors(), true));

$id = $_POST['ID'];

$tsql = "DELETE FROM dbo.ARTICLE_DB WHERE ID = ?";
$params = array($id);

$stmt = sqlsrv_query($conn, $tsql, $params);
if($stmt === false){
    echo 'Error';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

header('Location: index.php');
exit;
?>