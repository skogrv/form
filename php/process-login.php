<?php

$is_invalid = false;

$mysqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM user
        WHERE username = '%s'",
    $mysqli->real_escape_string($_POST["username"])
);
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

if ($user) {
    if (password_verify($_POST["password"], $user["password"])) {
        die("Login is successfull");    
    }
}

$is_invalid = true;

?>