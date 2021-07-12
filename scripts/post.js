function Certified_login() {
    var cookie = decodeURIComponent(document.cookie);
    var cookie_ad = cookie.split(';');
    if (cookie_ad[1] != null) {
        location.href = "_post.html?";
    } else {
        alert("현재 로그아웃 상태입니다.");
    }
}

function Show_title() {
    var url = location.href;
    var menu = (url.slice(url.indexOf('?') + 1, url.length)).split('=');

    if (menu[0] == "menu") {
        url = "show_titles.php?menu=";
    }
    else if (menu[0] == "search_text") {
        url = "search_post.php?search_text=";
    }
    url = url + menu[1];

    var _post = '<table class="table">\
    <thead>\
    <tr>\
    <th>#</th>\
    <th>메뉴</th>\
    <th>제목</th>\
    <th>시간</th>\
    <th>작성자</th>\
    </tr>\
    </thead>\
    <tbody>';

    $.getJSON(url, function (json) {
        $("#jp-content").remove();
        $.each(json._post, function () {

            var hr_link = "show_post.html?id=";
            hr_link = hr_link + this['post_id'];

            _post += '<tr><th class="post_id">' + this['post_id'] + '</th>';
            _post += '<th class="menu">' + this['post_menu'] + '</th>';
            _post += '<th class="title"><a href="' + hr_link + '">' + this['post_title'] + '</a></th>';
            _post += '<th class="time">' + this["time"] + '</th>';
            _post += '<th class="user">' + this["post_user"] + '</th>';;
            _post += '</tr>'
        });
        _post += '</tbody></table>';
        $("#jb-content").append(_post);
    });
}

function Show_post() {
    var url = location.href;
    var menu = (url.slice(url.indexOf('?') + 1, url.length)).split('=');
    url = "get_post.php?id=";
    url = url + menu[1];
    var _post = '';

    $.getJSON(url, function (json) {
        $("#plain_text").remove();
        $.each(json.show_post, function () {
            _post += '<div class="pid">게시글 번호 : ' + this['post_id'] + '</div><br />';
            _post += '<div class="pmenu">메뉴 : ' + this['post_menu'] + '</div>';
            _post += '<div class="ptitle">제목 : ' + this['post_title'] + '</div>';
            _post += '<div class="ptime">시간 : ' + this["time"] + '</div><br />이미지<br />';
            _post += '<img class="post_img" src="' + this["img_url"] + '" alt="User Image"/><br/>';
            _post += '<div class="pcontents">내용<br/>' + this["post_contents"] + '</div><br />';
            _post += '<div class="puser">글쓴이 :' + this["post_user"] + '</div>';
        });
        $("#jb-content").prepend(_post);

        var t_co = '<table class="t_comment">\
        <thead>\
        <tr>\
        <th>작성자</th>\
        <th>내용</th>\
        <th>시간</th>\
        </tr>\
        </thead>\
        <tbody>';

        $.each(json.comments, function () {
            t_co += '<tr><th class="c_user">' + this['co_user'] + '</th>';
            t_co += '<th class="c_contents">' + this['co_contents'] + '</th>';
            t_co += '<th class="c_time">' + this["time"] + '</th>';
            t_co += '</tr>'
        });
        t_co += '</tbody></table>';
        $("#comments").append(t_co);
    });
}


function Revise_post() {
    var url = location.href;
    var menu = (url.slice(url.indexOf('?') + 1, url.length)).split('=');
    url = "get_post.php?id=";
    url = url + menu[1];
    var _post = '';

    $.getJSON(url, function (json) {
        url = "revise_post.php?id=";
        url += menu[1];
        _post = '<form method="post" action="' + url + '">';
        $("#plain_text").remove();
        $.each(json.show_post, function () {
            _post += '<div class="pid">게시글 번호 : ' + this['post_id'] + '</div><br />';
            _post += '<div class="ptitle">제목<br/><input type="text" id="post_title" name="title" value="' + this['post_title'] + '"/><br /></div>';
            _post += '<div class="pmenu">분류<br/><select id="p_menu" name="menu">\
            <option>포유류</option>\
            <option>조류</option>\
            <option>어류</option>\
            <option>파충류</option>\
            <option>양서류</option>\
        </select><br /></div>';
            _post += '<div class="ptime">시간 : ' + this["time"] + '</div><br />이미지 변경은 불가합니다.<br />';
            _post += '<div class="pcontents">내용<br/><input type="text" id="post_contents" name="content" value="' + this["post_contents"] + '"/></div><br />';
            _post += '<input type="submit" id="post_register" value="등록">\
            </form>';

        });
        $("#jb-content").prepend(_post);
    });
}