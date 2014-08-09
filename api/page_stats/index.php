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
$sql ="CREATE TABLE IF NOT EXISTS `page_stats`(
    `page_id`       int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `url_path`      varchar(63) NOT NULL,
    `title`         varchar(127) NOT NULL,
    `page_hits`     int(11) NOT NULL,
    UNIQUE (`url_path`)
    ) ENGINE=INNODB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
$create_table = $db->prepare($sql);
$create_table->execute();



$query_table = $_GET["url"];
$query_click = $_GET["addclick"];
$query_title = $_GET["title"];  
// echo "query_table(".$query_table."),\nquery_click(".$query_click."),\nquery_title(".$query_title.")";
// if a url is part of the query

if (isset($query_table)) {
    // echo "pass3";
    // check if the GET url is actually a URL
    $query_table = filter_var($query_table, FILTER_VALIDATE_URL);
    if (!empty($query_table)) {
        $http_user_agent = explode("http://herereadthis.com",$query_table);
        // echo "pass2";
        // echo "<p>HTTP user agent: ".$http_user_agent[1]."</p>";

        $statement=$db->prepare("SELECT * FROM `page_stats` WHERE `url_path` = :url_path");
        $statement->execute(array('url_path' => $http_user_agent[1]));

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        // entry does exist. 
        // up the hit count.
        if ($statement->rowCount() > 0) {
            if ($query_click === "true") {
                $page_hits = $row["page_hits"];
                $page_hits++;
                $up_page_hits = $db->prepare("UPDATE `page_stats` 
                    SET `page_hits` =  :page_hits 
                    WHERE  `url_path` = :url_path");
                $up_page_hits->execute(array('page_hits' => $page_hits,
                    'url_path' => $http_user_agent[1]));
            }
            // prepare PDO
            $get_url_row=$db->prepare("SELECT * FROM `page_stats` WHERE `url_path` = :url_path");
            // execute with url path
            $get_url_row->execute(array('url_path' => $http_user_agent[1]));
            // fetch results as array
            $json_results=$get_url_row->fetchAll(PDO::FETCH_ASSOC);
            // get object from array and return as JSON
            $json=json_encode($json_results[0]);
            echo $json;
        }
        // entry does not exist.
        // add into table.
        // confirm that call is true to set addclick and title
        else if ($query_click === "true" and isset($query_title)) {
            $new_url = $db->prepare('SELECT * FROM employees WHERE name = :name');
            $new_url = $db->prepare('INSERT IGNORE INTO `page_stats` 
                SET `url_path` = :url_path, 
                    `title` = :title,
                    `page_hits` = 1');
            $new_url->execute(array(
                'title' => $query_title,
                'url_path' => $http_user_agent[1])
            );
            header("Location: /api/page_stats/?addclick=true&url=http://herereadthis.com".
                $http_user_agent[1]);
        }
        // spit back JSON...
        // prepare PDO
        // $get_url_row=$db->prepare("SELECT * FROM `page_stats` WHERE `url_path` = :url_path");
        // execute with url path
        // $get_url_row->execute(array('url_path' => $http_user_agent[1]));
        // fetch results as array
        // $json_results=$get_url_row->fetchAll(PDO::FETCH_ASSOC);
        // get object from array and return as JSON
        // $json=json_encode($json_results[0]);
        // echo $json;
    }
}
else {
    $get_table = $db->prepare("SELECT * FROM `page_stats`");
    $get_table->execute();
    $json_results=$get_table->fetchAll(PDO::FETCH_ASSOC);
    $json=json_encode($json_results);
    echo $json;
}

?>