<?php
    session_start();
    ob_start();
    require_once("header.php");

    
    if (isset($_SESSION['id'])){
        echo '<a href="logout.php">로그아웃</a>';
        } else{
        echo '<a href="login.html">로그인</a>
        <a href="register.html">
            회원가입
        </a>';
        }
?>