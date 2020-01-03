<?php

define("DIR", dirname(__DIR__));
define("SITE", "Blog.com");
define("TITLE", "9-3 BloG");

const HOST = 'localhost';
const LOGIN = 'root';
const PASSWORD = '';
const DATABASE = '9-3_blog';

$select = "SELECT * FROM users WHERE id='{$_COOKIE['login']}'";
$select_res = mysqli_query(mysqli_connect(HOST, LOGIN, PASSWORD, DATABASE), $select);
$select_res = mysqli_fetch_array($select_res, MYSQLI_ASSOC);
define('PROFILE_INFO', $select_res);

const SEARCH_TAGS = ["/^\*{2}.*\*{2}$/"];
const REPLACE_TAGS = ["asd"];


