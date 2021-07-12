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
    $comment = $_POST['comment'];

    #모든 사항 입력되었는지 확인
    if($comment == null)
    {
        echo '<script type = "text/javascript">alert("댓글을 입력해주세요.");';
        echo 'history.go(-1);';
        echo '</script>';
    }

    require_once('dbconnect.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to MySQL server.'); #데이터베이스 접속

    $uid = $_COOKIE['id'];

    $query = "insert into _comments values('$pid', null, '$comment', now(), '$uid');";
    $result = mysqli_query($dbc, $query) or die('Error Querying database.');
    
    mysqli_free_result($result);
    mysqli_close($dbc);

    echo "<script>location.href = document.referrer;</script>;";
?>