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
$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (username, password)
        VALUES (?, ?)";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ss", $_POST["name"], $password_hash);

if ($stmt->execute()) {
    header("Location: ../home.html");
    exit;
} else {
    if ($mysqli->errno === 1062) {
        die("Username already exists");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

?>