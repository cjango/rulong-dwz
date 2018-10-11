<script type="text/javascript">
    function ajaxDeleteDone() {
        $.pdialog.reload('{{ url()->current() }}')
    }
</script>

<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return dialogSearch(this);" action="{{ url()->current() }}" method="get">
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
                    <td>
                        授权状态：
                    </td>
                    <td>
                        <select class="combox" name="authed">
                            <option @if (Request::input('authed') == 'yes') selected @endif value="yes">已授权</option>
                            <option @if (Request::input('authed') == 'no') selected @endif value="no">未授权</option>
                        </select>
                    </td>

                    <td><div class="buttonActive"><div class="buttonContent"><button type="submit">检索结果</button></div></div></td>
                </tr>
            </table>
        </div>
    </form>
</div>

<div class="pageContent">
    <table class="table" width="100%" layoutH="87">
        <thead>
            <tr>
                <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
                <th width="50">编号</th>
                <th width="100">用户名</th>
                <th width="100">昵称</th>
                <th></th>
                <th width="140">注册时间</th>
                <th width="50">登录</th>
                <th width="120">上次登录IP</th>
                <th width="140">上次登录时间</th>
                <th width="80">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
            <tr target="sid" rel="1">
                <td><input name="ids" value="{{ $admin->id }}" type="checkbox"></td>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->username }}</td>
                <td>{{ $admin->nickname }}</td>
                <td></td>
                <td>{{ $admin->created_at }}</td>
                <td>{{ $admin->logins_count }}</td>
                <td>{{ $admin->last_login_time }}</td>
                <td>{{ $admin->last_login_ip }}</td>
                <td>
                    @if (in_array($role->id, $admin->roles()->pluck('role_id')->toArray()))
                    <a title="移除授权" target="ajaxDelete" callback="ajaxDeleteDone" href="{{ route('RuLong.roles.remove', ['role' => $role, 'admin' => $admin]) }}" class="btnDel"></a>
                    @else
                    <a title="授权用户" target="ajaxTodo" callback="ajaxDeleteDone" href="{{ route('RuLong.roles.auth', ['role' => $role, 'admin' => $admin]) }}" class="btnSelect"></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="panelBar">
        <form id="pagerForm" method="get" action="#rel#">
            <input type="hidden" name="page" value="{{ $admins->currentPage() }}" />
            <input type="hidden" name="numPerPage" value="{{ $admins->perPage() }}" />
        </form>
        <div class="pages">
            <span>共 {{ $admins->total() }} 条</span>
        </div>
        <div class="pagination" targetType="dialog" totalCount="{{ $admins->total() }}" numPerPage="{{ $admins->perPage() }}" pageNumShown="10" currentPage="{{ $admins->currentPage() }}"></div>
    </div>
</div>
