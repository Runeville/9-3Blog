<?php
require_once 'functions/functions.php';
require_once 'assets/vars.php';
require_once 'functions/cookies.php';
session_start();

if($_SESSION['update'] == null){
    echo '<script>location="index.php"</script>';
}

$connect = mysqli_connect(HOST,LOGIN,PASSWORD,DATABASE);
$select = "SELECT * FROM posts WHERE id='{$_SESSION['update']}'";
$select_res = mysqli_query($connect, $select);
$fields = mysqli_fetch_array($select_res);
mysqli_close($connect);

if(!empty($_POST['post_title']) and !empty($_POST['post_content'])){
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
    $update_date = date('Y-m-d');
    if(!empty($_FILES['photo']['name'])){
        $update = "UPDATE posts SET title='{$_POST['post_title']}', content='{$_POST['post_content']}', image='{$_FILES['photo']['name']}', update_date='{$update_date}' WHERE id='{$_SESSION['update']}'";
        move_uploaded_file($_FILES['photo']['tmp_name'], DIR . '/assets/images/' . $_FILES['photo']['name']);
    } else {
        $update = "UPDATE posts SET title='{$_POST['post_title']}', content='{$_POST['post_content']}', update_date='{$update_date}' WHERE id='{$_SESSION['update']}'";
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    $insert_res = mysqli_query($connect, $update);
    mysqli_close($connect);
    unset($_SESSION['update']);
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
    <link rel="stylesheet" href="assets/css/add_post.css">
</head>
<body>
<?php ob_link('header'); ?>

<h1 class="title main-title">Обновить запись</h1>
<div class="container">
    <form class="add_form" action="" method="post" enctype="multipart/form-data">
        <input name="post_title" value="<?= $fields['title'] ?>" type="text" placeholder="Заголовок" autocomplete="off">
        <textarea name="post_content"  cols="30" rows="10" placeholder="Контент"><?= $fields['content'] ?></textarea> <br>
        <input name="photo" type="file">
        <input type="submit" value="Добавить">
    </form>
</div>

</body>
</html>