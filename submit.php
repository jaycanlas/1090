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

$Article = $_POST['Article'];
$Description = $_POST['Description'];
$TranTime = $_POST['TranTime'];
$Amount = $_POST['Amount'];
$Quantity = $_POST['Quantity'];

$tsql = "INSERT INTO ARTICLE_DB (Article, Description, TranTime, Amount, Quantity) VALUES (?, ?, ?, ?, ?)";
$params = array($Article, $Description, $TranTime, $Amount, $Quantity);

$stmt = sqlsrv_query($conn, $tsql, $params);
if($stmt === false){
    echo 'Error';
}

header('Location: index.php');
exit;
?>