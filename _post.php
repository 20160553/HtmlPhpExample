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

    if(!isset($_FILES['uimg']))
    {
        echo '<script type = "text/javascript">alert("이미지 업로드 에러 발생.");';
        echo 'history.go(-1);';
        echo '</script>';
    }

    require_once('dbconnect.php');
    $dbc = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to MySQL server.'); #데이터베이스 접속

    $title = $_POST['title'];
    $contents = $_POST['content'];
    $menu = $_POST['menu'];
    $uid = $_SESSION['id'];

    $imagepath = "./images/" . uniqid("img") . "." . pathinfo($_FILES['uimg']['name'], PATHINFO_EXTENSION );
        if(!move_uploaded_file($_FILES['uimg']['tmp_name'], $imagepath)){
            exit('<a href="javascript:history.go(-1)">이미지 에러가 발생했습니다.</a>');
        }

    $query = "insert into _posts values(null, '$title', '$menu', '$contents', '$imagepath', now(), '$uid');";
    $result = mysqli_query($dbc, $query) or die('Error Querying database.');
    
    error_reporting(E_ALL^ E_WARNING); 

    if($result != NULL)
    {
        mysqli_free_result($result);
        mysqli_close($dbc);
    }

    echo '<script type = "text/javascript">alert("게시물이 등록되었습니다.");';
    echo 'history.go(-2);';
    echo "location.href = document.referrer;";
    echo '</script>';
?>