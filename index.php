<?php

session_start();

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Home</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://classless.de/classless.css">
    </head>
        <body>
        <?php if (isset($_SESSION["user_id"])): ?>
            <h2>Logged in user, coockies were set</h2>
        <?php else: ?>
            <p><a href="login.php">Please log in or <a href="signup.html"> Sign up</a></p>
        <?php endif; ?>
    </body>

</html>