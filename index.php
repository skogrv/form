<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/php/database.php";
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
} 

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://classless.de/classless.css">
    </head>
        <body>
        <?php if (isset($user)): ?>
            <h2>Logged in user as <?= htmlspecialchars($user["username"]) ?>, cookies were set</h2>
            <p><a href="logout.php">Logout</a></p>
        <?php else: ?>
            <p><a href="login.php">Please log in or <a href="signup.html"> Sign up</a></p>
        <?php endif; ?>
    </body>

</html>