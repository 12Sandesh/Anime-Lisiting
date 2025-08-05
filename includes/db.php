<?php

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "24128443";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
mysqli_set_charset($conn, "utf8");

if(!$conn) {
    die("Connection to the database failed: ".mysqli_connect_error());
}

?>