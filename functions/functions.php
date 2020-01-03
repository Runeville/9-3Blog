<?php
require_once './assets/vars.php';

function debug($arr){
    echo '<pre>' . print_r($arr, 1) . '</pre>';
}

function ob_link($object){
    require_once 'objects/' . $object . '.php';
}

function style(){
    echo '
    <link rel="shortcut icon" type="image/gif" href="assets/images/icon/icon.jpg">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/opt.css">
    <link href="https://fonts.googleapis.com/css?family=Neucha|Roboto:400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
    <title>' . TITLE .'</title>
    ';
}

function insert_reg($connect){
    $select = "select * FROM users WHERE login='{$_POST['login']}'";
    $select_res = mysqli_query($connect, $select);
    $select_res = mysqli_fetch_array($select_res, MYSQLI_ASSOC);
    if($select_res == null){
        echo '<script>location="index.php"</script>';
        $password = md5($_POST['password']);
        $insert = "INSERT INTO users (name, surname, login, password) VALUES ('{$_POST['user_name']}', '{$_POST['user_surname']}', '{$_POST['login']}', '{$password}')";
        return $insert_res = mysqli_query($connect, $insert);

    } else {
        echo '<script>alert("Такой логин уже занят")</script>';
    }
};

function auth($connect){
    $password = md5($_POST['password']);
    $select = "SELECT * FROM users WHERE login='{$_POST['login']}' AND password='{$password}'";
    $select_res = mysqli_query($connect, $select);
    $select_res = mysqli_fetch_array($select_res, MYSQLI_ASSOC);
    if ($select_res !== null){
        if(!empty($_POST['remember'])) {
            setcookie('login', $select_res['id'], time() + 60 * 60 * 24 * 30);
        } else {
            setcookie('login', $select_res['id'], 0);
        }
        echo '<script>location="../index.php"</script>';
    } else {
        echo '<script>alert("Логин и/или пароль указаны неверно")</script>';
    }
}

function show_author($arr){
    if($arr['nickname'] !== null){
        return $arr['nickname'] . ' (' . $arr['name'] . ' ' . $arr['surname'] . ')';
    } else {
        return $arr['name'] . ' ' . $arr['surname'];
    }
}

function update_status(){
    header("Location: " . $_SERVER['PHP_SELF']);
    foreach ($_POST as $item => $value) {
        $arr = explode('-', $item);
        $connect = mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE);
        mysqli_query($connect, "UPDATE users SET status='{$value}' WHERE id='{$arr['1']}'");
        mysqli_close($connect);
    }
}