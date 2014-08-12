<?php
header('Content-Type: application/json');

// see access_keys.txt for sample
require("../../dbaccess.php");
require("../../includes/get_hostname.php");

// try {
//   # MySQL with PDO_MYSQL
//   $db = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8", $db_username, $db_password);
// }
// catch(PDOException $e) {
//     echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
// }



$arr = array(
    "serverName" => $_SERVER["SERVER_NAME"],
    "httpUserAgent" => $_SERVER['HTTP_USER_AGENT'],
    "scriptUri" => $_SERVER["SCRIPT_URI"],
    "remoteAddress" => $_SERVER['REMOTE_ADDR'],
    "serverAddress" => $_SERVER['SERVER_ADDR']
);

echo json_encode($arr);



?>

