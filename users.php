<?php
require_once 'functions/functions.php';
require_once 'assets/vars.php';
require_once 'functions/cookies.php';

if(!empty($_POST)){
    update_status();
}


$connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
$select = mysqli_query($connect, "SELECT * FROM users");
$status = ['User', 'Redactor', 'Admin', 'Owner'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php style(); ?>
    <link rel="stylesheet" href="assets/css/users.css">
</head>
<body>
<?php ob_link('header'); ?>

<h1 class="title main-title">Пользователи</h1>

<div class="container">
    <div class="users_inner">
        <table>
            <tr>
                <td><span>Имя:</span></td>
                <td><span>Статус:</span></td>
                <?php if(PROFILE_INFO['status'] > 1): ?><td><span>Изменить статус:</span></td><?php endif; ?>
            </tr>
            <?php while($user = mysqli_fetch_array($select, MYSQLI_ASSOC)): ?>
            <tr>
                <td <?php if(PROFILE_INFO['id'] == $user['id']):?>
                        class="you"
                    <?php endif; ?> ><?= show_author($user); ?>

                </td>
                <td><?= $status[$user['status']]; ?></td>
                <?php if(PROFILE_INFO['status'] > 1 and PROFILE_INFO['id'] !== $user['id']): ?>
                <td>
                    <?php if($user['status'] != 3): ?>
                    <form action="" method="post">
                        <select name="status-<?= $user['id'] ?>">
                            <?php if(PROFILE_INFO['status'] > $user['status']): ?>
                            <option  value="0">User</option>
                            <option <?php if($user['status'] == 1) echo 'selected'?> value="1">Redactor</option>
                            <?php endif; ?>
                            <?php if(PROFILE_INFO['status'] > 2 or PROFILE_INFO['status'] == $user['status']): ?>
                            <option <?php if($user['status'] == 2) echo 'selected'?> value="2">Admin</option>
                            <?php endif; ?>
                        </select>
                        <input type="submit" value="Изменить">
                    </form>
                    <?php else: echo 'Cannot change owner status!'; endif;?>
                </td>
                <?php endif; ?>
            </tr>
            <?php endwhile; mysqli_close($connect); ?>
        </table>
    </div>
</div>

</body>
</html>