<?php
require_once 'assets/vars.php';
require_once 'functions/functions.php';


if(!empty($_POST['login']) and !empty($_POST['password'])){
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE) or die('Problem with connection');
    auth($connect);
    mysqli_close($connect);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php style(); ?>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

<div class="container">
    <h1 class="title title-m">Авторизация</h1>
</div>

<div class="container">
    <form class="auth" action="" method="post">
        <input name="login" type="text" placeholder="Логин" autocomplete="off"> <br>
        <input name="password" type="password" placeholder="Пароль" > <br>
        Запомнить меня: <input name="remember" type="checkbox">
        <input type="submit" value="Submit">
    </form>
    <a href="register.php">Ещё нет аккаунта?</a>
</div>

</body>
</html>