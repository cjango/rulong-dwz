<div class="pageContent">
    <form method="post" action="{{ route('RuLong.roles.update', $role) }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="58">
            <div class="unit">
                <label>角色名称：</label>
                <input type="text" name="name" value="{{ $role->name }}" class="" />
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>角色描述：</label>
                <textarea name="description" rows="3">{{ $role->description }}</textarea>
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
