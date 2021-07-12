<html>
<head>
    <title>노래보기</title>
    <meta charset="utf-8" />
</head>
<body>
    <?php
    require_once('dbconnect.php');
    
    $dbc = mysqli_connect($host, $user, $pass, $dbname) or die('Error connecting to MySQL server.'); #데이터베이스 접속
    $query = "select * from song order by favorite desc";
    $result = mysqli_query($dbc, $query) or die('Error Querying database.');
    
    echo '<table border=1>';
    echo '<tr>';
    echo '<th>name</th><th>가수</th><th>번호</th><th>좋아하는 정도</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td><td>' . '(' . $row['singer'] . ')' . '</td><td>' . $row['number'] . '</td><td>' . ' ' . $row['favorite'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    mysqli_free_result($result);
    mysqli_close($dbc);
    ?>
</body>
</html>