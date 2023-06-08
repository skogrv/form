<?php
if (empty($_POST["name"])) {
    die("Name is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password should be 8 or more characters");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords should match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
var_dump($password_hash);

print_r($_POST);
?>