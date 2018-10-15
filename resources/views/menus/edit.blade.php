<div class="pageContent">
    <form method="post" action="{{ route('RuLong.menus.update', $menu) }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="60">
            <div class="unit">
                <label>菜单名称：</label>
                <input type="text" name="title" value="{{ $menu->title }}" class="required"/>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>上级菜单：</label>
                <select name="parent_id" class="combox">
                    @foreach ($topMenus as $top)
                    <option @if ($top['id'] ==  $menu->parent_id) selected @endif value="{{ $top['id'] }}">{!! $top['title_show'] !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>菜单排序：</label>
                <input type="text" name="sort" value="{{ $menu->sort }}" size="5" class="required digits"/>
            </div>
            <div class="divider"></div>
            <div class="unit">
                <label>菜单地址：</label>
                <input type="text" name="uri" value="{{ $menu->uri }}" class=""/>
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
