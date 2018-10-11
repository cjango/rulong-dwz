<div class="pageContent">
    <form method="post" action="{{ url()->current() }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="58">
            <div class="unit">
                <label>原始密码：</label>
                <input type="password" name="oldpass" value="" class="required" />
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>新的密码：</label>
                <input type="password" name="newpass" value="" class="required" />
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>重复密码：</label>
                <input type="password" name="repass" value="" class="required" />
            </div>
        </div>
        @csrf
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">立即修改</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
