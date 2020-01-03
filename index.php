<?php
require_once 'functions/functions.php';
require_once 'assets/vars.php';
require_once 'functions/cookies.php';

session_start();
//UPDATE POST
if($_GET['update'] != null and PROFILE_INFO['status'] > 0){
    $_SESSION['update'] = $_GET['update'];
    echo '<script>location="update_post.php"</script>';
}

//DELETE POST
if($_GET['del'] != null and PROFILE_INFO['status'] > 0){
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
    $delete = mysqli_query($connect, "DELETE FROM posts WHERE id='{$_GET['del']}'");
    mysqli_close($connect);
    echo '<script>location="index.php"</script>';
}

$connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
$select = "SELECT * FROM posts ORDER BY id DESC";
$select_res = mysqli_query($connect, $select);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php style(); ?>
</head>
<body>
<?php ob_link('header'); ?>
<div class="container">
    <?php if(PROFILE_INFO['status'] > 0): ?>
    <a class="btn btn--add" href="add_post.php">Добавить запись</a>
    <?php endif; ?>
    <?php while($post = mysqli_fetch_array($select_res, MYSQLI_ASSOC)): ?>
        <?php
            //GET AUTHOR
            $select_login = mysqli_query($connect,"SELECT * FROM users WHERE login='{$post['author']}'");
            $login_res = mysqli_fetch_array($select_login, MYSQLI_ASSOC);
            //GET DATE
            $date = substr($post['date'], 0, 10);
            $date = explode('-', $date);
            $date = $date[2] . '.' . $date[1] . '.' . $date['0'];

            $update_date = $post['update_date'];
            $update_date = explode('-', $update_date);
            $update_date = $update_date[2] . '.' . $update_date[1] . '.' . $update_date['0'];

        ?>

        <article class="article-first">
            <h2 class="title"><?= $post['title'] ?></h2>

            <div class="date">Дата: <span><?= $date ?></span></div>
            <?php if($post['update_date'] != null): ?>
                <div class="date update">Обновлено: <span><?= $update_date ?></span></div>
            <?php endif; ?>
            <?php $content = nl2br(htmlspecialchars($post['content'])) ?>
            <p><?= str_replace(SEARCH_TAGS, REPLACE_TAGS, $content) ?></p>

            <?php if($post['image']): ?>
                <div class="img">
                    <img class="img-item" src="assets/images/<?= $post['image'] ?>" alt="">
                </div>
            <?php endif; ?>

            <div class="author">Автор: <span <?php if(PROFILE_INFO['id'] == $login_res['id']): ?> class="you" <?php endif; ?>><?= show_author($login_res) ?></span></div>
                <!--DELETE BUTTON-->
            <?php if(PROFILE_INFO['status'] > 0): ?>
                <a class="btn btn--update" href="?update=<?= $post['id']; ?>">Обновить запись</a> <br>
                <a class="btn btn--delete" href="?del=<?= $post['id'] ?>">Удалить запись</a>
            <?php endif; ?>

            <hr>
        </article>
    <?php endwhile; mysqli_close($connect); ?>
</div>

</body>
</html>