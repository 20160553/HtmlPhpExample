<?php
    session_start();
    ob_start();
    require_once("header.php");
?>
<!doctype html>
<html lang="ko">

    <head>
        <meta charset="utf-8">
        <title>How to breed?</title>
        <link rel="stylesheet" href="main.css">
        <style>
            #kind {
                width: 160px;
                padding: 20px;
                margin-bottom: 20px;
                float: right;
                border: 1px solid #bcbcbc;
                background-color: white;
            }
            .table {
                border: 1px solid;
                padding: 5px;
                width: 100%;
                border-collapse: collapse;
            }
            td,
            th {
                border: 1px, solid #444444;
            }
        </style>
    </head>

    <body>
        <div id="jb-container">
            <div id="jb-header">
                <a href="main.php"><img src="/img/how to breed.PNG"/></a><br/>
            <?php
                if (isset($_SESSION['id'])){
                    echo '<a href="logout.php">로그아웃</a>';
                    } else{
                    echo '<a href="login.html">로그인</a>
                    <a href="register.html">
                        회원가입
                    </a>';
                    }
                ?>
            </div>
            <div id="jb-sidebar-left">
                <h2>분류</h2>
                <ul>
                    <a href="main.php?menu=포유류">
                        <li>포유류</li>
                    </a>
                    <a href="main.php?menu=조류">
                        <li>조류</li>
                    </a>
                    <a href="main.php?menu=어류">
                        <li>어류</li>
                    </a>
                    <a href="main.php?menu=파충류">
                        <li>파충류</li>
                    </a>
                    <a href="main.php?menu=양서류">
                        <li>양서류</li>
                    </a>
                </ul>
            </div>
            <div id="jb-content">
            <?php
                        $menu = $_GET;
                        if($menu == NULL)
                        {
                            echo "<h2>메인페이지</h2>
                            <p>
                                반려동물 및 애완동물에 대한 관심과 수요가 증가함에 따라서, 국내에
                                서 동물을 기르는 인구가 점차 증가하고 있다. 개와 고양이와 같이 친숙한 동물
                                외에도, 도마뱀, 개구리와 같은 파충류
                                부터, 사슴벌레, 사마귀와 같은 다양한 종류의 동물들이 애완동물로서 선택되고 있다. 동물을 건강하게 기르기
                                위해서는
                                해당 동물의 적정 온도나 먹이 등의 사육환경을 숙지하고 이를 신경 써야 하지만, 처음 기르는 사람에게 이러한 정보를 얻는 것은 쉽지
                                않은 일이다. 파충류에 대한 정보를 공유하는 카페나, 개와 관련된 정보를 공유하는 사이트 등, 기존에도 정보를 공유하는 사이
                                트가 존재하였지만,
                                특정 분야에 한정된 정보를 공유하는 문제가 존재하였다.<br/>
                                <br/>
                                - 작품에 대한 설명
                                <br/>
                                제안하는 작품은 기존에 분리되어 있던
                                , 각 분야의 동물에 대한 정보를 통합하여, 작품 내부에서 여러 동물들의 정보를 제공하는 통합 동물 사육
                                정보 공유커뮤니티이다. 여러 동물에 대한 정보를 통합하여 서비스하기 때문에, 비교적 간단하게 여러 동물의 정보를 획득할 수 있는 것이
                                장점이다.</p>";
                        }
                        else {
                            echo "<script>Show_title();</script>";
                            // require_once("show_posts.php");
                            header('Content-Type: text/html');
                        }
                    ?>
            </div>
            <div id="jb-sidebar-right">
                <form id="search" method="get" action="main.php">
                    <input id="search_text" name="search_text"/>
                    <input type="submit" id="search_btn" value="검색"/>
                </form>
                <div id="kind">
                    <button id="post" onclick="Certified_login();">글쓰기</button>
                </div>
            </div>
            <div id="jb-footer">
                <p>Copyright</p>
                pcs2686
            </div>
        </div>
    </body>
</html>