<script>
    var cookie = decodeURIComponent(document.cookie);
    var cookie_ad = cookie.split(';');
    if (cookie_ad[1] == null) {
        alert("현재 로그아웃 상태입니다.");
        history.go(-1);
    }
</script>

<?php
    session_start();
    ob_start();

    #모든 사항 입력되었는지 확인
    if($_POST['title'] == null || $_POST['content'] == null || $_POST['menu'] == null)
    {
        echo '<script type = "text/javascript">alert("모든 사항을 입력해주세요.");';
        echo 'history.go(-1);';
        echo '</script>';
    }

    require_once('dbconnect.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to MySQL server.'); #데이터베이스 접속

    $title = $_POST['title'];
    $contents = $_POST['content'];
    $menu = $_POST['menu'];
    $uid = $_COOKIE['id'];    
    $pid = $_GET['id'];

    $query = "select post_user from _posts where post_id =$pid and post_user='$uid';";
    $result = mysqli_query($dbc, $query) or die('Error Querying database.');
    $row = mysqli_fetch_array($result);
    if($row['post_user'] == $uid){
        mysqli_free_result($result);

        $query = "UPDATE _posts SET post_title='$title', post_menu='$menu', post_contents='$contents' WHERE post_id='$pid'";
        $result = mysqli_query($dbc, $query) or die('Error Querying database.');

        echo "<script>alert('게시물이 수정되었습니다.');</script>";
    }
    else{
        echo '<script>alert("작성자가 아닙니다.");history.go(-1);</script>';
    }
    mysqli_free_result($result);
    mysqli_close($dbc);

    echo "<script>location.href = document.referrer;</script>;";
?>

