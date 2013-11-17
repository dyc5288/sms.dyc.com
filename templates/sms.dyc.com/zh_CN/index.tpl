<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; " />
        <title>后台首页</title>
        <link href="<{s}>css/common.css<{/s}>" rel="stylesheet" type="text/css" />
        <link href="<{s}>css/index.css<{/s}>" rel="stylesheet" type="text/css" />
        <script src="<{s}>js/jquery.js<{/s}>" type="text/javascript"></script>
        <script src="<{s}>js/util.js<{/s}>" type="text/javascript" charset="gb2312"></script>
    </head>

    <body>
        <div id="top_data">
            <div id="logo"><a href=""><img src="static/images/logo.png" alt="115网络U盘" /></a></div>
            <div class="top-text"><span>欢迎您，</span><b>Admin</b> <a href="" class="logout">退出系统</a></div>
        </div>
        <div id="left_panel">
            <ul id="nav_class"></ul>
            <div class="switch-content"><a href="javascript:;" class="open" onclick="SidbarControl.ShowSec();">全部展开</a><a href="javascript:;" class="close" onclick="SidbarControl.HideSec();">全部收起</a></div>
            <ul id="nav_list"></ul>
        </div>
        <div id="main">
            <div id="top_menu">
                <div class="top_menu_box">
                    <div class="top_menu_contents" id="js_menu_contents"></div>
                </div>
                <a href="javascript:;" class="btn left disabled" id="js_tab_left_btn">向左</a><a href="javascript:;" class="btn right disabled" id="js_tab_right_btn">向右</a></div>
            <ul id="handle">
                <li class="back"><a href="javascript:;" onclick="TopMenuControl.Back();">后退(ctrl+b)</a></li>
                <li class="go"><a href="javascript:;" onclick="TopMenuControl.Forward();">前进(ctrl+n)</a></li>
                <li class="refresh"><a href="javascript:;" onclick="TopMenuControl.Refresh();">刷新(ctrl+q)</a></li>
                <li class="screen" id="js_screen_li"><a href="javascript:;" onclick="MainAPI.FullScreen();">全屏(ctrl+i)</a></li>
                <li class="undo" id="js_undo_li" style="display:none;"><a href="javascript:;" onclick="MainAPI.UndoScreen();">还原(ctrl+u)</a></li>
                <li class="close-all"><a href="javascript:;" onclick="TopMenuControl.Close();">关闭全部</a></li>
            </ul>
            <div id="main_frame"></div>
        </div>
        <script type="text/javascript">
            //数据
            var MenuData = {
                '1': {Text:"邮件"},
                '11': {Text:"定时功能",Parent:"1"},
                '111': {Text:"现货白银",Parent:"11",url:"?ct=email",Default:true},
            }
        </script>
        <script type="text/javascript" charset="gb2312" src="<{s}>js/main.js<{/s}>"></script>
    </body>
</html>
