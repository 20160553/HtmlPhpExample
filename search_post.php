<?php
    header('Content-Type: application/json;charset=UTF-8');
    require_once('dbconnect.php');

    $s_txt = $_GET['search_text'];

    $dbc = mysqli_connect($host, $user, $pass, $dbname)
                    or die("Error Connecting to MySQL Server.");
    mysqli_query($dbc, 'set names utf8');

    $query = "select post_id, post_menu, post_title, time, post_user from _posts where post_title LIKE '%$s_txt%' or post_user LIKE '%$s_txt%' order by time desc limit 0, 30;";
    $result = mysqli_query($dbc, $query) or die("Error Querying database.");
    $json = array();
    
    while($row = mysqli_fetch_assoc($result)){
        $json['_post'][]=$row;
    }
    mysqli_free_result($result);
    mysqli_close($dbc);

    echo json_encode($json);
?>