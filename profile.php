<?php
require_once 'functions/functions.php';
require_once 'assets/vars.php';
require_once 'functions/cookies.php';
require_once 'functions/profile-functions.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <?php style(); ?>
    <link rel="stylesheet" href="assets/css/profile.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<?php ob_link('header'); ?>

<h1 class="title main-title">Профиль</h1>
<div class="container">
    <div class="profile-inner">
        <div class="prof-item">
            <img class="prof-img" src="assets/images/macbook.jpg" alt="">
            <form action="" method="post" enctype="multipart/form-data">
                <input name="user_photo" type="file"> <br>
                <input type="submit" value="Submit">
            </form>
        </div><!--PROF ITEM-->
        <div class="prof_item">
            <form action="" method="get">
                Ваше имя: <input name="user_name" type="text" maxlength="15" value="<?= PROFILE_INFO['name'] ?>" autocomplete="off"> <br>
                Ваша фамилия: <input name="user_surname" maxlength="15" type="text" value="<?= PROFILE_INFO['surname'] ?>" autocomplete="off"> <br>
                Ваш никнейм: <input name="user_nickname" maxlength="10" type="text" value="<?= PROFILE_INFO['nickname'] ?>" autocomplete="off"> <br>
                <input type="submit" value="Сохранить">
            </form>
            <hr>
            <form action="" method="post">
                <input name="old_password" type="password" placeholder="Старый пароль"> <br>
                <input name="password" type="password" placeholder="Новый пароль"> <br>
                <input name="password2" type="password" placeholder="Повторите новый пароль" value=""> <br>
                <input name="submit" type="submit" value="Изменить">
            </form>
        </div><!--PROF ITEM-->
    </div><!--PROFILE INNER-->
</div><!--CONTAINER-->



</body>
</html>
