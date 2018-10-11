<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="{{ url()->current() }}" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        操作用户：
                        <input type="text" name="username" value="{{ Request::input('username') }}"/>
                    </td>
                    <td>
                        操作IP：
                        <input type="text" name="ip" value="{{ Request::input('ip') }}"/>
                    </td>
                    <td>
                        操作路径：
                        <input type="text" name="path" value="{{ Request::input('path') }}"/>
                    </td>
                    <td>
                        <select class="combox" name="method">
                            <option value="">请求类型</option>
                            <option @if (Request::input('method') == 'GET') selected @endif value="GET">GET</option>
                            <option @if (Request::input('method') == 'POST') selected @endif value="POST">POST</option>
                            <option @if (Request::input('method') == 'PUT') selected @endif value="PUT">PUT</option>
                            <option @if (Request::input('method') == 'PATCH') selected @endif value="PATCH">PATCH</option>
                            <option @if (Request::input('method') == 'DELETE') selected @endif value="DELETE">DELETE</option>
                        </select>
                    </td>
                    <td><div class="buttonActive"><div class="buttonContent"><button type="submit">检索结果</button></div></div></td>
                </tr>
            </table>
        </div>
    </form>
</div>

<div class="pageContent">
    <table class="table" width="100%" layoutH="85">
        <thead>
            <tr>
                <th width="50" orderField="id" @if (Request::input('orderField') == 'id') class="{{ Request::input('orderDirection') }}" @endif>编号</th>
                <th width="100">用户</th>
                <th width="100">Path</th>
                <th width="60">Method</th>
                <th width="100">IP</th>
                <th>Input</th>
                <th width="120" orderField="created_at" @if (Request::input('orderField') == 'created_at') class="{{ Request::input('orderDirection') }}" @endif>操作时间</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->admin->username }}</td>
                <td>{{ $log->path }}</td>
                <td>{!! $log->method !!}</td>
                <td>{{ $log->ip }}</td>
                <td>{{ $log->input }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="panelBar">
        <form id="pagerForm" method="post" action="#rel#">
            <input type="hidden" name="page" value="{{ $logs->currentPage() }}" />
            <input type="hidden" name="numPerPage" value="{{ $logs->perPage() }}" />
            <input type="hidden" name="orderField" value="{{ Request::input('orderField') }}" />
            <input type="hidden" name="orderDirection" value="{{ Request::input('orderDirection') }}" />
        </form>
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option @if ($logs->perPage() == 30) selected @endif value="30">30</option>
                <option @if ($logs->perPage() == 100) selected @endif value="100">100</option>
                <option @if ($logs->perPage() == 200) selected @endif value="200">200</option>
            </select>
            <span>条，共 {{ $logs->total() }} 条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="{{ $logs->total() }}" numPerPage="{{ $logs->perPage() }}" pageNumShown="10" currentPage="{{ $logs->currentPage() }}"></div>
    </div>

</div>
