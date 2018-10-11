<div class="pageContent">
    <form method="get" action="{{ route('Admin.test.index') }}" class="pageForm" onsubmit="return navTabSearch(this);">
        <div class="pageFormContent" layoutH="58">
            <div class="unit">
                <label>用户名称：</label>
                <input type="text" name="username" value="{{ Request::input('username') }}"/>
            </div>
        </div>
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">开始检索</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="reset">清空重输</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
