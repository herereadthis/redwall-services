<!DOCTYPE html>
<html lang="en" dir="ltr" xml:lang="en"
prefix="og: http://ogp.me/ns#
fb: http://ogp.me/ns/fb#
foaf: http://xmlns.com/foaf/0.1/
dc: http://purl.org/dc/terms/
v: http://rdf.data-vocabulary.org/#
owl: http://www.w3.org/2002/07/owl#" class="no-js no-touch">
<head>
    <meta charset="utf-8">
    <title property="dc:title">Redwall PHP</title>
    <meta name="robots" content="INDEX, FOLLOW" />
</head>
<body data-module="retromator" data-google-analytics="UA-37798496-1">

<h1>Redwall PHP Services</h1>

<?php

// see access_keys.txt for sample
require("dbaccess.php");


$foo = $foo;

echo $foo;

$db_internal = $db_internal;
$db_external = $db_external;
$db_database = $db_database;
$db_username = $db_username;
$db_password = $db_password;

// $db_internal = "localhost:3306";
// $db_internal = "localhost";

$serverName = $_SERVER["SERVER_NAME"];


if ($serverName === "localhost") {
	$db_hostname = $db_external;
}
else {
	$db_hostname = $db_internal;
}
echo $db_hostname.'!';


// $c = mysqli_connect($db_internal, $db_username, $db_password, $db_database);
$mysqli = new mysqli($db_internal, $db_username, $db_password, $db_database);


if ($mysqli->connect_errno) {
    echo "<p>Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error."</p>";
}
echo '<p>'.$mysqli->host_info .'</p>';
// $result = mysql_query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
// $row = mysql_fetch_assoc($result);
// echo htmlentities($row['_message']);


$helloWorld = 'Hello World!';
echo '<p>'.$helloWorld .'</p>';
echo '<p>'.$_SERVER['HTTP_USER_AGENT'].'</p>';


$array = array(
    "foo" => "bar",
    "sum" => "ting",
);
echo "<p>".$array["foo"]."</p>";
$varDump = print_r($array);

$array = array("foo", "bar", "hello", "world");
// append value
array_push($array, "woohoo");
echo "<p>".$array[0]."</p>";
$count = count($array);
echo "<p>Array size: ".$count."</p>";
$varDump = print_r($array);
echo "<p>".$varDump."</p>";
// remove a key-value pair at index 2
unset($array[2]);
$varDump = print_r($array);
echo "<p>".$varDump."</p>";

?>

</body>
</html>
