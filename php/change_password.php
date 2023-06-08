<?php

session_start();

$mysqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM user
WHERE id = '%s'",
    $mysqli->real_escape_string($_SESSION["user_id"])
);
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

if (!password_verify($_POST["current_password"], $user["password"])) {
    die("Previous password is not correct");
}

elseif (strlen($_POST["new_password"]) < 8) {
    die("Password should be 8 or more characters");
}

elseif ($_POST["new_password"] !== $_POST["confirm_password"]) {
    die("Passwords should match");
}

$password_hash = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
$sql = "UPDATE user
        SET password = ?
        WHERE id = ?";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("si", $password_hash, $_SESSION['user_id']);
if ($stmt->execute()) {
    print_r("Password was changed successfully");
} else {
    die($mysqli->error . " " . $mysqli->errno);
}

?>