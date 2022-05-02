<?php
    setcookie('login_nv', '', time()-10, '/');
    header('Location:'.$_SERVER['HTTP_REFERER']);
?>