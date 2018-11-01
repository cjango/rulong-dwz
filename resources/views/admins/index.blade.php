<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="{{ url()->current() }}" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        用户名：
                        <input type="text" name="username" value="{{ Request::input('username') }}"/>
                    </td>
                    <td>
                        昵称：
                        <input type="text" name="nickname" value="{{ Request::input('nickname') }}"/>
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
            <li><a class="add" href="{{ route('RuLong.admins.create') }}" mask="true" rel="dialog_{{ time() }}" target="dialog" width="400" height="240" title="添加用户"><span>添加用户</span></a></li>
        </ul>
    </div>

    <table class="table" width="100%" layoutH="112">
        <thead>
            <tr>
                <th width="50" orderField="id" @if (Request::input('orderField') == 'id') class="{{ Request::input('orderDirection') }}" @endif>编号</th>
                <th width="100">用户名</th>
                <th width="100">昵称</th>
                <th></th>
                <th width="140" orderField="created_at" @if (Request::input('orderField') == 'created_at') class="{{ Request::input('orderDirection') }}" @endif>注册时间</th>
                <th width="50" orderField="logins_count" @if (Request::input('orderField') == 'logins_count') class="{{ Request::input('orderDirection') }}" @endif>登录</th>
                <th width="120">上次登录IP</th>
                <th width="140">上次登录时间</th>
                <th width="80"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->nickname }}</td>
                <td></td>
                <td>{{ $admin->created_at }}</td>
                <td>{{ $admin->logins_count }}</td>
                <td>{{ $admin->lastLogin->login_ip }}</td>
                <td>{{ $admin->lastLogin->created_at }}</td>
                <td>
                    <a title="编辑" target="dialog" href="{{ route('RuLong.admins.edit', $admin) }}" rel="dialog_{{ time() }}" mask="true" width="400" height="240" class="btnEdit">编辑</a>
                    <a title="删除" target="ajaxDelete" href="{{ route('RuLong.admins.destroy', $admin) }}" class="btnDel">删除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="panelBar">
        <form id="pagerForm" method="post" action="#rel#">
            <input type="hidden" name="page" value="{{ $admins->currentPage() }}" />
            <input type="hidden" name="numPerPage" value="{{ $admins->perPage() }}" />
            <input type="hidden" name="orderField" value="{{ Request::input('orderField') }}" />
            <input type="hidden" name="orderDirection" value="{{ Request::input('orderDirection') }}" />
        </form>
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option @if ($admins->perPage() == 30) selected @endif value="30">30</option>
                <option @if ($admins->perPage() == 100) selected @endif value="100">100</option>
                <option @if ($admins->perPage() == 200) selected @endif value="200">200</option>
            </select>
            <span>条，共 {{ $admins->total() }} 条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="{{ $admins->total() }}" numPerPage="{{ $admins->perPage() }}" pageNumShown="10" currentPage="{{ $admins->currentPage() }}"></div>
    </div>
</div>
