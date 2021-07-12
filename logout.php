<?php
    session_start();
    ob_start();

    if (isset($_SESSION['id'])){
        unset($_SESSION['id']);
        setcookie('id', '', time() + (60*60*24));
        echo '<script type = "text/javascript">alert("로그아웃 성공");';
        echo 'location.href="main.php";';
        echo '</script>';
    }
?>