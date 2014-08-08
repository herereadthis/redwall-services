<?php
header('Content-Type: application/json');

// see access_keys.txt for sample
require("../../dbaccess.php");
require("../../includes/get_hostname.php");

try {
  # MySQL with PDO_MYSQL
  $db = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8", $db_username, $db_password);
}
catch(PDOException $e) {
    echo "<p>PDO ERROR: ".$e->getMessage()."</p>";
}



// $query_table = $_GET["table"];


$get_table = $db->prepare("SELECT * FROM `example`");
$get_table->execute();
$json_results=$get_table->fetchAll(PDO::FETCH_ASSOC);
$json=json_encode($json_results);
echo $json;

// echo "[";
// $i = 0;
// foreach($db->query('SELECT * FROM example') as $row) {
//     $i++;
//     echo "{\"id\":".$row['id'].",";
//     echo "\"name\":\"".$row['name']."\",";
//     echo "\"age\":".$row['age']."}";
//     if ($number_of_rows > $i) {
//         echo ",";
//     }
// }
// echo "]";

?>

