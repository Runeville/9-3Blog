<?php
if($_GET['auth']){
    setcookie('login', '', time() - 3600);
    echo '<script>location="../authorisation.php"</script>';
}

if(empty($_COOKIE['login'])){
    echo '<script>location="authorisation.php"</script>';
}
