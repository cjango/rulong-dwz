<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="{{ url()->current() }}" method="get">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        角色名称：
                        <input type="text" name="keyword" value="{{ Request::input('keyword') }}"/>
                    </td>
                    <td><div class="buttonActive"><div class="buttonContent"><button type="submit">检索结果</button></div></div></td>
                </tr>
            </table>
        </div>
    </form>
</div>

<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="{{ route('RuLong.roles.create') }}" target="dialog" rel="dialog_{{ uniqid() }}" mask="true" width="400" height="240" title="添加角色"><span>添加角色</span></a></li>
        </ul>
    </div>

    <table class="table" width="100%" layoutH="112">
        <thead>
            <tr>
                <th width="50" orderField="id" @if (Request::input('orderField') == 'id') class="{{ Request::input('orderDirection') }}" @endif>序号</th>
                <th width="150">角色名称</th>
                <th>角色描述</th>
                <th width="60" orderField="users_count" @if (Request::input('orderField') == 'users_count') class="{{ Request::input('orderDirection') }}" @endif>角色人数</th>
                <th width="140">创建时间</th>
                <th width="120">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ $role->users_count }}</td>
                <td>{{ $role->created_at }}</td>
                <td>
                    <a title="角色授权" target="dialog" href="{{ route('RuLong.roles.users', $role) }}" rel="dialog_{{ uniqid() }}" mask="true" width="800" height="500" class="btnAssign"></a>
                    <a title="菜单授权" target="dialog" href="{{ route('RuLong.roles.menus', $role) }}" rel="dialog_{{ uniqid() }}" mask="true" width="500" height="700" class="btnView"></a>
                    <a title="编辑" target="dialog" href="{{ route('RuLong.roles.edit', $role) }}" mask="true" width="400" height="240" class="btnEdit"></a>
                    <a title="删除" target="ajaxDelete" href="{{ route('RuLong.roles.destroy', $role) }}" class="btnDel"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="panelBar">
        <form id="pagerForm" method="get" action="#rel#">
            <input type="hidden" name="page" value="{{ $roles->currentPage() }}" />
            <input type="hidden" name="numPerPage" value="{{ $roles->perPage() }}" />
            <input type="hidden" name="orderField" value="{{ Request::input('orderField') }}" />
            <input type="hidden" name="orderDirection" value="{{ Request::input('orderDirection') }}" />
        </form>
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option @if ($roles->perPage() == 30) selected @endif value="30">30</option>
                <option @if ($roles->perPage() == 100) selected @endif value="100">100</option>
                <option @if ($roles->perPage() == 200) selected @endif value="200">200</option>
            </select>
            <span>条，共 {{ $roles->total() }} 条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="{{ $roles->total() }}" numPerPage="{{ $roles->perPage() }}" pageNumShown="10" currentPage="{{ $roles->currentPage() }}"></div>
    </div>

</div>
