<{include file="header.tpl"}>
<div id="contents">
    <dl class="search-class">
        <dt>状态：</dt>
        <dd>
            <ul>
                <li class="focus"><a href="?ct=email">全部</a></li>
                <li><a href="?ct=email&state=0">未启动</a></li>
                <li><a href="?ct=email&state=1">已启动</a></li>
                <li><a href="?ct=email&state=2">已删除</a></li>
            </ul>
        </dd>
    </dl>
    <table class="table-sort">
        <tr>
            <th width="20"><input name="" type="checkbox" value="" rel="parent" /></th>
            <th>ID</th>
            <th>类型</th>
            <th>内容</th>
            <th>详细信息</th>
            <th>状态</th>
            <th>添加时间</th>
            <th>更改时间</th>
            <th>操作</th>
        </tr>
        <{if !empty($return.data)}>
            <{foreach from=$return.data item=clock}>
                <tr>
                    <td><input name="" type="checkbox" value="" rel="child" /></td>
                    <td><{$clock.cid}></td>
                    <td><{$clock.type_name}></td>
                    <td><{$clock.remark}></td>
                    <td>
                        <{if $clock.type_id == '1'}>
                            预警值高：<{$clock.data.hign}>，低：<{$clock.data.low}>
                        <{/if}>
                    </td>
                    <td>
                        <{if $clock.state == 0}>
                            <i class="result neglect">未启动</i>
                        <{elseif $clock.state == 1}>
                            <i class="result" style="color: red;">已启动</i>
                        <{elseif $clock.state == 2}>
                            <i class="result undone">已删除</i>
                        <{/if}>
                    </td>
                    <td><{$clock.ctime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
                    <td><{$clock.utime|date_format:"%Y-%m-%d %H:%M:%S"}></td>
                    <td>
                        <{if $clock.type_id == '1'}>
                            <{if $clock.state < 2}>
                                <a href="?ct=email&ac=silver&cid=<{$clock.cid}>" class="btn edit">编辑</a> 
                                <a href="?ct=email&ac=delete&cid=<{$clock.cid}>" class="btn delete" jsbotton="confirm" isajax="1">删除</a>
                            <{/if}>
                        <{/if}>
                    </td>
                </tr>
            <{/foreach}>
        <{else}>
            <tr><td colspan="9" style="text-align: center;">暂无</td></tr>
        <{/if}>
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
    <{$return.page}>
</div>
<script>
    $(function(){
        $(".delete").click(function(){
            var url = $(this).attr('href');
            Util.MsgBox.Confirm({
                text: "确定要删除该监控吗？",
                type: "warm",
                title:"提示",
                callback:function(r){
                    if (r) {
                        window.location.href = url;
                    }
                }
            });
            return false;
        });
    });
</script>
<{include file="footer.tpl"}>