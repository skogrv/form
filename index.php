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
            
            <h2>Change password</h2>
            <form action="php/change_password.php" method="post">
                <label for="current_password">Current password</label>
                <input type="password" id="current_password" name="current_password">
                <label for="new_password">New password</label>
                <input type="password" id="new_password" name="new_password">
                <label for="confirm_password">Confirm new password</label>
                <input type="password" id="confirm_password" name="confirm_password">
                <button>Change password</button>
            </form>
            
        <?php else: ?>
            <p><a href="login.php">Please log in or <a href="signup.html"> Sign up</a></p>
        <?php endif; ?>
    </body>

</html>