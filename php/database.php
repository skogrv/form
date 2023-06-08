<?php

$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "Igor228135!";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Error: ". $mysqli->connect_errno);
}

return $mysqli;

?>