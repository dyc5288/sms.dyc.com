<{include file="header.tpl"}>
<form jstype="vali" onreturn="OnReturnCheck()" action="?ct=email&silver">
    <table class="form">
        <tr>
            <th>标题：</th>
            <td><label>白银价格报警</label> </td>
        </tr>
        <tr>
            <th>高：</th>
            <td><input type="text" class="text s check" vali="notempty|num" errormsg="请输入预警提示最高价且应为数字" />&nbsp;元/公斤 <span class="text-hint normal">当白银价格大于当前值进行报警</span> </td>
        </tr>
        <tr>
            <th>低：</th>
            <td><input type="text" class="text s check" vali="notempty|num" errormsg="请输入预警提示最低价且应为数字" />&nbsp;元/公斤 <span class="text-hint normal">当白银价格小于当前值进行报警</span></td>
        </tr>
        <tr>
        <tr>
            <th>描述：</th>
            <td><textarea name="" id="" vali="notempty" class="check" errormsg="请输入内容" ></textarea></td>
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
</script>
<{include file="footer.tpl"}>