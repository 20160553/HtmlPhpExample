<script>
    var cookie = decodeURIComponent(document.cookie);
    var cookie_ad = cookie.split(';');
    if (cookie_ad[1] == null) {
        alert("현재 로그아웃 상태입니다.");
        history.go(-1);
    }
</script>

<?php
    $pid = $_GET['id'];

    require_once('dbconnect.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to MySQL server.'); #데이터베이스 접속

    $uid = $_COOKIE['id'];

    $query = "select post_user from _posts where post_id =$pid and post_user='$uid';";
    $result = mysqli_query($dbc, $query) or die('Error Querying database.');
    $row = mysqli_fetch_array($result);
    if($row['post_user'] == $uid){
        mysqli_free_result($result);

        $query = "delete from _posts where post_id =$pid;";
        $result = mysqli_query($dbc, $query) or die('Error Querying database.');
    }
    else{
        echo '<script>alert("작성자가 아닙니다.");history.go(-1);</script>';
    }
    mysqli_free_result($result);
    mysqli_close($dbc);

    echo "<script>location.href = document.referrer;</script>;";
?>