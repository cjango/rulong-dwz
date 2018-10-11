<div class="pageContent">
    <form method="post" action="{{ url()->current() }}" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone)">
        <div class="pageFormContent" layoutH="60">
            <ul class="tree treeFolder treeCheck expand">
                @foreach ($menus as $menu)
                <li><a tname="rules[]" tvalue="{{ $menu->id }}" @if (in_array($menu->id, $role->rules ?? [])) checked="false" @endif>{{ $menu->id }} {{ $menu->title }}</a>
                    <ul>
                        @foreach ($menu->children as $child)
                        <li><a tname="rules[]" tvalue="{{ $child->id }}" @if (in_array($child->id, $role->rules ?? [])) checked="false" @endif>{{ $child->title }}</a>
                            @if ($child->children()->count() > 0)
                            <ul>
                                @foreach ($child->children as $son)
                                <li><a tname="rules[]" tvalue="{{ $son->id }}" @if (in_array($son->id, $role->rules ?? [])) checked="false" @endif>{{ $son->title }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
        @csrf
        <div class="formBar">
            <ul>
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存授权</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
