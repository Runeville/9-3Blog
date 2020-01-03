<?php
require_once './assets/vars.php';
require_once './functions/functions.php';

?>

<header>
    <div class="container">
        <div class="header_inner">
            <div><a class="logo" href="index.php"><?= TITLE ?></a></div>
            <div class="nav">
                <a class="nav-item" href="users.php">Users</a>
                <a class="nav-item" href="profile.php">Profile</a>
                <a class="nav-item" href="?auth=exit">Log out</a>
            </div>
            <div class="burger" onclick="useMenu()"></div>
        </div>
    </div>
</header>
<div class="container">
    <div class="toggle-menu">
        <a href="users.php">Users</a>
        <a href="profile.php">Profile</a>
        <a href="?auth=exit">Log out</a>
    </div>
</div>
<script src="../assets/javascript/main.js"></script>
