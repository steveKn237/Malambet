<?php

require_once("php/crud.php");

createBet(null, "fesfsef", 1, 2, 20, 1.40);

$submit = filter_input(INPUT_POST, "submit");

if (isset($submit)) {

    $uid = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "password");

    $result = createUser($uid, $pwd);
    echo $result;

    if (!is_bool($result))
        $fail = $result;
    else {
        echo "<form action='PageAcceuil.php' method='post' id='form'>";
        echo "<input type='text' id='Uid' name='username' value='$uid'>";
        echo "</form>";
    }
};

$submit = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_connexion.css">
    <title>Malambet</title>
</head>

<body>
    <div class="container">
        <h2>S'Inscrire</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" id="Uid" name="username" value="<?= isset($uid) ? $uid : "" ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="Pwd" name="password">
            </div>
            <input type="submit" name="submit">
        </form>
        <p><?= isset($fail) ? $fail : "" ?></p>
        <p>Si vous avez un compte <a href="connection.php">Connecter vous</a>.</p>
    </div>
</body>
<script>
    let form = document.getElementById('form')

    if (form != null)
        form.submit();
</script>

</html>