<?php
$submit = filter_input(INPUT_POST, "submit");

if(isset($submit))
{
    $uid = filter_input(INPUT_POST, "username");
    $pwd = filter_input(INPUT_POST, "password");
    

    
};
$uid = null
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
</body>
</html>