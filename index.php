<?php
// see access_keys.txt for sample
require("dbaccess.php");
require("includes/get_hostname.php");
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
<body data-google-analytics="UA-37798496-2">

<h1><a href="/">Redwall PHP Services</a></h1>

<ul>
    <li><strong>Server Name:</strong> <?php echo $_SERVER["SERVER_NAME"]; ?></li>
    <li><strong>HTTP_USER_AGENT:</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?></li>
    <li><strong>View Demo Page:</strong> <a href="/demo/">/demo/</a></li>
    <li><strong>Return example table as JSON:</strong> <a href="/api/?table=example">/api/?table=example</a></li>
</ul>

<?php

// echo "\t<li><strong>host_info:</strong> ".$mysqli->host_info ."</li>\n";




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


<?php


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
        echo "{\"id\":".$row['id'].",";
        echo "\"name\":\"".$row['name']."\",";
        echo "\"age\":".$row['age']."}";
        if ($number_of_rows > $i) {
            echo ",";
        }
    }
    echo "]";
    echo "\n</code>";

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
<script data-main="/build/js/main" src="/build/js/require.js"></script>
</body>
</html>

