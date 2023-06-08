<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/php/database.php";
    $sql = sprintf("SELECT * FROM user
            WHERE username = '%s'",
        $mysqli->real_escape_string($_POST["username"])
    );
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST["password"], $user["password"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];  
            
            header("Location: index.php");
            exit();
        }
    }

    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Login form</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://classless.de/classless.css">
    </head>

    <body>
        <h2>Login</h2>

        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>

        <form method="post">
           <label for="username"></label>
           <input type="text" name="username" id="username"
           value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">

           <label for="password">Password</label>
           <input type="password" name="password" id="password">
           <button>Log in</button>
        </form>
    </body>

</html>