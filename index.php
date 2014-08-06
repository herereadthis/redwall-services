<?php


// see access_keys.txt for sample
require("dbaccess.php");


$db_internal = $db_internal;
$db_external = $db_external;
$db_database = $db_database;
$db_username = $db_username;
$db_password = $db_password;

if ($serverName === "localhost") {
    $db_hostname = $db_external;
}
else {
    $db_hostname = $db_internal;
}



try {
  # MySQL with PDO_MYSQL
  $db = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8", $db_username, $db_password);
}
catch(PDOException $e) {
    echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
}



$query_table = $_GET["table"];


if (!$query_table) {

?>
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


    echo "<ul>\n";
    $serverName = $_SERVER["SERVER_NAME"];
    echo "\t<li><strong>Server Name:</strong> ".$serverName."</li>\n";
    // echo "\t<li><strong>host_info:</strong> ".$mysqli->host_info ."</li>\n";
    echo "\t<li><strong>HTTP_USER_AGENT:</strong> ".$_SERVER['HTTP_USER_AGENT']."</li>\n";
    echo "</ul>\n";





    echo "<p><strong>Output as table:</strong></p>\n";
    echo "<table>\n";
    echo "\t<tr>\n";
    echo "\t\t<td><strong>id</strong></td>\n";
    echo "\t\t<td><strong>name</strong></td>\n";
    echo "\t\t<td><strong>age</strong></td>\n";
    echo "\t</tr>\n";
    foreach($db->query('SELECT * FROM example') as $row) {
        echo "\t<tr>\n";
        echo "\t\t<td>".$row['id']."</td>\n";
        echo "\t\t<td>".$row['name']."</td>\n";
        echo "\t\t<td>".$row['age']."</td>\n";
        echo "\t<tr>\n";
    }
    echo "</table>\n";





    $sql = "SELECT count(*) FROM `example`"; 
    $result = $db->prepare($sql); 
    $result->execute(); 
    $number_of_rows = $result->fetchColumn(); 

    echo "<p><strong>Output as JSON:</strong></p>\n";
    echo "<code>\n";
    echo "[";
    $i = 0;
    foreach($db->query('SELECT * FROM example') as $row) {
        $i++;
        echo "{\"id\":\"".$row['id']."\",";
        echo "\"name\":\"".$row['name']."\",";
        echo "\"age\":\"".$row['age']."\"}";
        if ($number_of_rows > $i) {
            echo ",";
        }
    }
    echo "]";
    echo "\n</code>";

?>

</body>
</html>
<?php
}
else if ($query_table === "example") {

    $sql = "SELECT count(*) FROM `example`"; 
    $result = $db->prepare($sql); 
    $result->execute(); 
    $number_of_rows = $result->fetchColumn(); 

    echo "[";
    $i = 0;
    foreach($db->query('SELECT * FROM example') as $row) {
        $i++;
        echo "{\"id\":\"".$row['id']."\",";
        echo "\"name\":\"".$row['name']."\",";
        echo "\"age\":\"".$row['age']."\"}";
        if ($number_of_rows > $i) {
            echo ",";
        }
    }
    echo "]";
}

/* creates a table
$mysqli->query("CREATE TABLE example(
    id INT NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY(id),
    name VARCHAR(30), 
    age INT)");  
echo "Table Created!";
*/






/*
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
*/

?>

