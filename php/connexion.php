<?php
require_once("crud.php");

// createBet(null,"fesfsef", 1, 2, 20, 1.40);

$submit = filter_input(INPUT_POST, "submit");

if(isset($submit))
{

    $uid = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "password");

    $result = createUser($uid,$pwd);

    if(is_bool($result))
        echo "success";
    else{
        echo $result;
    }
};
$submit = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malambet</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">User Name</label>
        <input type="text" id="Uid" name="username">
        <label for="password">Password</label>
        <input type="password" id="Pwd" name="password">
        <input type="submit" name="submit">
    </form>
    <form action="" method="post">
        <label for=""></label>
    </form>
</body>
</html>