<div class="pageHeader">
    <form id="searchForm_{{ uniqid() }}" rel="pagerForm" onsubmit="return navTabSearch(this);" action="{{ url()->current() }}" method="post">
        <div class="searchBar">

            <ul class="searchContent">
                <li>
                    <label>用户名称：</label>
                    <input type="text" name="username" value="{{ Request::input('username') }}"/>
                </li>
                <li>
                    <select class="combox" name="province">
                        <option value="">所有请求</option>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="PUT">PUT</option>
                        <option value="PATCH">PATCH</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </li>
            </ul>

            <div class="subBar">
                <ul>
                    <li><div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div></li>
                    <li><a class="button" href="{{ route('Admin.test.search') }}" target="dialog" mask="true"><span>高级检索</span></a></li>
                </ul>
            </div>

        </div>
    </form>
</div>

<div class="pageContent">

    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="{{ route('Admin.test.create') }}" target="navTab"><span>添加</span></a></li>
            <li><a class="delete" href="{{ route('Admin.test.destroy', 'destroy') }}" target="selectedDelete" title="确实要删除这些记录吗?"><span>批量删除</span></a></li>
            <li><a class="edit" href="/test/{sid}/edit" target="dialog" warn="请选择一个用户"><span>修改</span></a></li>
            <li class="line">line</li>
            <li><a class="icon" href="{{ route('Admin.test.export') }}" target="dwzExport" targetType="navTab" title="实要导出这些记录吗?"><span>导出EXCEL</span></a></li>
        </ul>
    </div>

    <table class="table" width="100%" layoutH="138">
        <thead>
            <tr>
                <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
                <th width="50" orderField="id" @if (Request::input('orderField') == 'id') class="{{ Request::input('orderDirection') }}" @endif>编号</th>
                <th width="100">用户名</th>
                <th width="100">昵称</th>
                <th></th>
                <th width="50" orderField="login" @if (Request::input('orderField') == 'login') class="{{ Request::input('orderDirection') }}" @endif>登录</th>
                <th width="120" orderField="created_at" @if (Request::input('orderField') == 'created_at') class="{{ Request::input('orderDirection') }}" @endif>注册时间</th>
                <th width="80"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($values as $value)
            <tr target="sid" rel="{{ $value->id }}">
                <td><input name="ids" value="{{ $value->id }}" type="checkbox"></td>
                <td>{{ $value->id }}</td>
                <td>{{ $value->username }}</td>
                <td>{{ $value->password }}</td>
                <td></td>
                <td>{{ $value->login }}</td>
                <td>{{ $value->created_at }}</td>
                <td>
                    <a title="删除" target="ajaxDelete" href="{{ route('Admin.test.destroy', $value) }}" class="btnDel">删除</a>
                    <a title="编辑" target="dialog" href="{{ route('Admin.test.edit', $value) }}" class="btnEdit">编辑</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="panelBar">
        <form id="pagerForm" method="post" action="#rel#">
            <input type="hidden" name="page" value="{{ $values->currentPage() }}" />
            <input type="hidden" name="numPerPage" value="{{ $values->perPage() }}" />
            <input type="hidden" name="orderField" value="{{ Request::input('orderField') }}" />
            <input type="hidden" name="orderDirection" value="{{ Request::input('orderDirection') }}" />
        </form>
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option @if ($values->perPage() == 30) selected @endif value="30">30</option>
                <option @if ($values->perPage() == 100) selected @endif value="100">100</option>
                <option @if ($values->perPage() == 200) selected @endif value="200">200</option>
            </select>
            <span>条，共 {{ $values->total() }} 条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="{{ $values->total() }}" numPerPage="{{ $values->perPage() }}" pageNumShown="10" currentPage="{{ $values->currentPage() }}"></div>
    </div>

</div>
