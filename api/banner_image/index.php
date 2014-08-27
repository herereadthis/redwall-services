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

// Table Creation
$sql = "CREATE TABLE IF NOT EXISTS `banner_image` (
    `pk`            int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `unique_id`     char(30) NOT NULL UNIQUE,
    `url`           varchar(127) NOT NULL UNIQUE,
    `thumbnail`     VARCHAR( 127 ) NOT NULL UNIQUE,
    `width`         smallint(6) NOT NULL,
    `height`        smallint(6) NOT NULL,
    `title`         char(63) NOT NULL,
    `description`   varchar(255) NOT NULL,
    `hits`          int(11) NOT NULL DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
$create_table = $db->prepare($sql);
$create_table->execute();


$query_sort = $_GET["sort"];





if ($query_sort === "hits") {
    $lowest_hits = $db->prepare("SELECT * FROM `banner_image`
    ORDER BY `hits` ASC;");
    $lowest_hits->execute();
    $lowest_hits_results=$lowest_hits->fetchAll(PDO::FETCH_ASSOC);
    $first_result = $lowest_hits_results[0];
    $unique_id = $first_result['unique_id'];
    $hits = $first_result['hits'];
    $hit_count = $hits + 1;

    // $ljson=json_encode($lowest_hits_results);

    // take the item of the top of the array and add one to the hit count
    $add_hit = $db->prepare("UPDATE `banner_image`
            SET `hits` = :hits WHERE `unique_id` = :unique_id;"); 
    $add_hit->execute(array(
        'hits' => $hit_count,
        'unique_id' => $unique_id)
    );

    $hits_json = json_encode($lowest_hits_results);
    echo $hits_json;
}
else {
    // prepare PDO
    // return the object with lowest hits as first result
    $get_objects=$db->prepare("SELECT * FROM `banner_image`;");
    // $get_objects=$db->prepare("SELECT * FROM `banner_image` ORDER BY `hits` ASC;");
    // execute
    $get_objects->execute();
    // fetch results as array
    $json_results=$get_objects->fetchAll(PDO::FETCH_ASSOC);
    // get objects from array and return as JSON
    $json=json_encode($json_results);
    echo $json;
}


// $first_result = $json_results[0];
// $unique_id = $first_result['unique_id'];
// $hits = (int)$first_result['hits'];
// $hit_count = $hits + 1;

// echo $json;

// grab row where hits are lowest
/*
$lowest_hits = $db->prepare("SELECT * FROM `banner_image`
    WHERE `hits` = (SELECT MIN(`hits`) FROM `banner_image`)");
$lowest_hits->execute();

$lowest_hits_results=$lowest_hits->fetchAll(PDO::FETCH_ASSOC);
$first_result = $lowest_hits_results[0];
$unique_id = $first_result['unique_id'];
$hits = $first_result['hits'];
$hit_count = $hits + 1;
*/
// $lowest_hits = $db->prepare("SELECT * FROM `banner_image`
//     ORDER BY `hits` ASC;");
// $lowest_hits->execute();
// $lowest_hits_results=$lowest_hits->fetchAll(PDO::FETCH_ASSOC);
// $first_result = $lowest_hits_results[0];
// $unique_id = $first_result['unique_id'];
// $hits = $first_result['hits'];
// $hit_count = $hits + 1;

// // $ljson=json_encode($lowest_hits_results);

// // take the item of the top of the array and add one to the hit count
// $add_hit = $db->prepare("UPDATE `banner_image`
//         SET `hits` = :hits WHERE `unique_id` = :unique_id;"); 
// $add_hit->execute(array(
//     'hits' => $hit_count,
//     'unique_id' => $unique_id)
// );

// echo $json;


?>