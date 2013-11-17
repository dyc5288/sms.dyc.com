<{include file="header.tpl"}>
<div id="contents">
    <dl class="search-class">
        <dt>状态：</dt>
        <dd>
            <ul>
                <li class="focus"><a href="">全部</a></li>
                <li><a href="">未启动</a></li>
                <li><a href="">已启动</a></li>
                <li><a href="">已删除</a></li>
            </ul>
        </dd>
    </dl>
    <table class="table-sort">
        <tr>
            <th width="20"><input name="" type="checkbox" value="" rel="parent" /></th>
            <th>ID</th>
            <th>类型</th>
            <th>内容</th>
            <th>状态</th>
            <th>添加时间</th>
            <th>更改时间</th>
            <th>操作</th>
        </tr>
        <tr>
            <td><input name="" type="checkbox" value="" rel="child" /></td>
            <td><a href="">广东女初中生"插笔门"事件视频.flv</a></td>
            <td>192.168.1.128</td>
            <td>2010-01-26</td>
            <td><i class="result neglect">忽略</i></td>
            <td>5</td>
            <td>5</td>
            <td><a href="javascript:;" class="btn edit">编辑</a> <a href="ajaxreturn.html" class="btn delete" jsbotton="confirm" isajax="1">删除</a> <a href="javascript:;" class="btn download">下载</a></td>
        </tr>
    </table>
</div>

<div id="bottom">
    <form bind=".table-sort">
        <div class="fl">
            <input name="" type="checkbox" value="" rel="parent" />
            <label for="">全选</label>
            <button type="button" jstype="btn_post" isform="#js_test_box" posturl="">忽略</button>
            <button type="button" jstype="btn_post" >已处理</button>
            <button type="button" jstype="btn_post" isconfirm="1" onclick="alert(1);">删除</button>
            <button type="button" jstype="btn_post">等待审核</button>
            <button type="button" jstype="btn_post">审核通过</button>
            <button type="button" jstype="btn_post">禁止下载</button>
        </div>
    </form>
    <div class="pages"><a href="" class="disabled">&#8249;</a> <a href="" class="focus">1</a> <a href="">2</a> <a href="">3</a> <a href="">4</a> <a href="">5</a> <span>…</span> <a href="">114</a> <a href="">115</a> <a href="">&#8250;</a></div>
</div>
<{include file="footer.tpl"}>