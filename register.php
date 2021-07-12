<?php
    #모든 사항 입력되었는지 확인
    if($_POST['id'] == null || $_POST['pw'] == null || $_POST['pwconf'] == null)
    {
        echo '<script type = "text/javascript">alert("모든 사항을 입력해주세요.");';
        echo 'history.go(-1);';
        echo '</script>';
        
    }
    else {
        #비밀번호 확인
    if(strcmp($_POST['pw'], $_POST['pwconf']))
    {
        echo '<script type = "text/javascript">alert("패스워드를 다시 한 번 확인해주세요");';
        echo 'history.go(-1);';
        echo '</script>';
    }
    else {
        require_once('dbconnect.php');
        $dbc = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to MySQL server.'); #데이터베이스 접속
    
        $id = trim($_POST['id']);
        $pw = hash("sha256", $_POST['pw']);
        
        #아이디 및 닉네임 중복 확인, 중복시 오류 메시지 출력 후, 이전 페이지로 돌아감
        $sql = "select * from user where id = '$id'";
        $result = mysqli_query($dbc, $sql) or die('Error Querying database.');
        if($result->num_rows != 0){
            mysqli_free_result($result);
            mysqli_close($dbc);
            echo '<script type = "text/javascript">alert("해당 아이디가 이미 존재합니다. 다른 아이디를 입력해주세요");';
            echo 'history.go(-1);';
            echo '</script>';
        }
        else
        {
            $query = "insert into user values('$id', '$pw');";
        $result = mysqli_query($dbc, $query) or die('Error Querying database.');
        
        mysqli_free_result($result);
        mysqli_close($dbc);   
        echo '<script type = "text/javascript">alert("회원가입에 성공하였습니다.");';
            echo 'location.href="main.php";';
            echo '</script>';
        }
        }
    }
?>