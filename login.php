<?php
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>로그인 결과</title>
        <meta charset="utf-8"/>
    </head>

    <body>
    <?php
        require_once('dbconnect.php');

        if (isset($_SESSION['id'])){
            echo '<script type = "text/javascript">alert("로그인 성공");';
            echo 'location.href="main.php";';
            echo '</script>';
        }

        if (empty($_POST['id']) || empty($_POST['pass'])) {
        echo '<script type = "text/javascript">alert("로그인 폼을 채워주세요.");';
        echo 'history.go(-1);';
        echo '</script>';
        }

        $dbc = mysqli_connect($host, $user, $pass, $dbname)
        or die("Error Connecting to MySQL Server.");

        $id = mysqli_real_escape_string($dbc, trim($_POST['id']));
        $pass = hash("sha256", $_POST['pass']);

        $query = "select id from user where id='$id' and pw='$pass';";
        $result = mysqli_query($dbc, $query) 
        or die ("Error Querying database.");

        if (mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            // $_SESSION['id'] = $row['id']; -> 에러 발생
            $userid = $row['id'];
            $_SESSION['id'] = $userid;

            setcookie('id', $userid, time() + (60*60*24));
            echo '<script type = "text/javascript">alert("로그인 성공");';
            echo 'location.href="main.php";';
            echo '</script>';
        }
        else{
            echo '<script type = "text/javascript">alert("로그인 실패");';
            echo 'location.href="main.php";';
            echo '</script>';
        }
        mysqli_free_result($result);       
    ?>
    </body>

</html>