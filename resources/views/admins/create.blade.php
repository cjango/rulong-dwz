<div class="pageContent">
    <form method="post" action="{{ route('RuLong.admins.store') }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="60">
            <div class="unit">
                <label>用户名：</label>
                <input type="text" name="username" value="" class="required"/>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>昵称：</label>
                <input type="text" name="nickname" value="" class=""/>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>登录密码：</label>
                <input type="password" name="password" value="" class="required"/>
            </div>
        </div>
        @csrf
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
