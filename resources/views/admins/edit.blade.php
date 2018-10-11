<div class="pageContent">
    <form method="post" action="{{ route('RuLong.admins.update', $admin) }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="60">
            <div class="unit">
                <label>用户名：</label>
                <input type="text" value="{{ $admin->username }}" readonly class="required"/>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>昵称：</label>
                <input type="text" name="nickname" value="{{ $admin->nickname }}"/>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>登录密码：</label>
                <input type="password" name="password" value="" placeholder="留空不修改"/>
            </div>
        </div>
        @csrf
        @method('PUT')
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
