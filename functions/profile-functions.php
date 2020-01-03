<?php
require_once './assets/vars.php';
$id = PROFILE_INFO['id'];

if(!empty($_GET['user_name']) and !empty($_GET['user_surname'])){
    header("Location: " . $_SERVER['PHP_SELF']);
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
    if(!empty($_GET['user_nickname'])){
        $update = "UPDATE users SET name='{$_GET['user_name']}', surname='{$_GET['user_surname']}', nickname='{$_GET['user_nickname']}' WHERE id='{$id}'";
    } else {
        $update = "UPDATE users SET name='{$_GET['user_name']}', surname='{$_GET['user_surname']}', nickname=null WHERE id='{$id}'";
    }
    $update_res = mysqli_query($connect, $update);
    mysqli_close($connect);
}

if(!empty($_POST['old_password']) and !empty($_POST['password']) and $_POST['password'] === $_POST['password2'] and md5($_POST['old_password']) == PROFILE_INFO['password']){
    header("Location: " . $_SERVER['PHP_SELF']);
    $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
    $password = md5($_POST['password']);
    $update = "UPDATE users SET password='{$password}' WHERE id='{$id}'";
    mysqli_query($connect, $update);
    mysqli_close($connect);
} elseif(isset($_POST['submit'])) {
    echo '<script>alert("Something\'s wrong")</script>';
    echo '<script>location="../profile.php"</script>';
}