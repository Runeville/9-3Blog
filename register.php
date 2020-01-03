<?php
require_once 'assets/vars.php';
require_once 'functions/functions.php';

$fields = array('user_name', 'user_surname', 'login', 'password', 'password2');
$required = true;
foreach($fields as $field){
    if(empty($_POST[$field])){
        $required = false;
        break;
    }
}
if($required == true and $_POST['password'] === $_POST['password2']){
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE) or die("Something's wrong");
    insert_reg($connect);
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
    <h1 class="title title-m">Регистрация</h1>
</div>

<div class="container">
    <form class="auth" action="" method="post">
        <input name="user_name" type="text" placeholder="Ваше имя" autocomplete="off"> <br>
        <input name="user_surname" type="text" placeholder="Ваша фамилия" autocomplete="off"> <br>
        <input maxlength="25" name="login" type="text" placeholder="Придумайте логин" autocomplete="off"> <br>
        <input name="password" type="password" placeholder="Пароль" > <br>
        <input name="password2" type="password" placeholder="Повторите пароль" > <br>
        <input type="submit" value="Зарегистрироваться">
    </form>
    <a href="authorisation.php">Уже есть аккаунт?</a>
</div>

</body>
</html>