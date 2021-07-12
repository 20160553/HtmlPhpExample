<?php
    header('Content-Type: application/json;charset=UTF-8');
    require_once('dbconnect.php');

    $id = $_GET['id'];

    $dbc = mysqli_connect($host, $user, $pass, $dbname)
                    or die("Error Connecting to MySQL Server.");
    mysqli_query($dbc, 'set names utf8');

    $query = "select post_id, post_menu, post_title, post_contents, time, img_url, post_user from _posts where post_id='$id';";
    $result = mysqli_query($dbc, $query) or die("Error Querying database.");
    $json = array();
    
    while($row = mysqli_fetch_assoc($result)){
        $json['show_post'][]=$row;
    }
    mysqli_free_result($result);
    
    $query = "select _comments.post_id, _comments.co_id, _comments.co_contents, _comments.time, _comments.co_user from _posts inner join _comments where _posts.post_id = _comments.post_id and _posts.post_id = $id order by time desc;";
    $result = mysqli_query($dbc, $query) or die("Error Querying database.");
    while($row = mysqli_fetch_assoc($result)){
         $json['comments'][]=$row;
    }

    mysqli_free_result($result);
    mysqli_close($dbc);
    
    echo json_encode($json);
?>