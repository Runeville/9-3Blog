<?php
require_once 'functions/functions.php';
require_once 'assets/vars.php';
require_once 'functions/cookies.php';

$author = PROFILE_INFO['login'];

if(!empty($_POST['post_title']) and !empty($_POST['post_content'])){
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
    if(!empty($_FILES['photo']['name'])){
        $insert = "INSERT INTO posts (title, content, author, image) VALUES ('{$_POST['post_title']}', '{$_POST['post_content']}', '{$author}', '{$_FILES['photo']['name']}')";
        move_uploaded_file($_FILES['photo']['tmp_name'], DIR . '/assets/images/' . $_FILES['photo']['name']);
    } else {
        $insert = "INSERT INTO posts (title, content, author, image) VALUES ('{$_POST['post_title']}', '{$_POST['post_content']}', '{$author}', null)";
    }
    $insert_res = mysqli_query($connect, $insert);
    mysqli_close($connect);
    echo '<script>location="index.php"</script>';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="assets/css/add_post.css">
    <?php style(); ?>
</head>
<body>
<?php ob_link('header'); ?>
<h1 class="title main-title">Добавить запись</h1>
<div class="container">
    <form class="add_form" action="" method="post" enctype="multipart/form-data">
        <input name="post_title" type="text" placeholder="Заголовок" autocomplete="off">
        <textarea name="post_content" id="" cols="30" rows="10" placeholder="Контент"></textarea> <br>
        <input name="photo" type="file">
        <input type="submit" value="Добавить">
    </form>
</div>

</body>
</html>