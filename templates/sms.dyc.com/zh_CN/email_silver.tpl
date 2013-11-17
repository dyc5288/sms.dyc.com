<{include file="header.tpl"}>
<form jstype="vali" onreturn="OnReturnCheck()" action="?ct=email&ac=silver" method="POST">
    <table class="form">
        <tr>
            <th>标题：</th>
            <td><label>白银价格报警</label> </td>
        </tr>
        <tr>
            <th>高：</th>
            <td><input type="text" name="form[hign]" class="text s" vali="notempty|num" errormsg="请输入预警提示最高价且应为数字" />&nbsp;元/公斤 <span class="text-hint normal">当白银价格大于当前值进行报警</span> </td>
        </tr>
        <tr>
            <th>低：</th>
            <td><input type="text" name="form[low]" class="text s" vali="notempty|num" errormsg="请输入预警提示最低价且应为数字" />&nbsp;元/公斤 <span class="text-hint normal">当白银价格小于当前值进行报警</span></td>
        </tr>
        <tr>
        <tr>
            <th>描述：</th>
            <td><textarea id="" name="form[remark]" vali="notempty"  errormsg="请输入内容" ></textarea></td>
        </tr>        
        <tr>
            <th>状态：</th>
            <td>
                <input type="checkbox" name="form[startup]" id="startup" value="1"/>
                <label for="startup">启动</label>
            </td>
        </tr>
        <tr>
            <th></th>
            <td><button type="submit">确定</button></td>
        </tr>
    </table>
</form>
<script>
    function OnReturnCheck(){
        if ($(".text-hint error").length > 0) {
            return false;
        }
        return true;
    }
    <{if !empty($return.message)}>
        alert('<{$return.message}>');
    <{/if}>
</script>
<{include file="footer.tpl"}>