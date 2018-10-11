<div class="pageHeader">
    <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="{{ url()->current() }}" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        文件名称：
                        <input type="text" name="name" value="{{ Request::input('name') }}"/>
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
        <li><a class="add" href="{{ route('RuLong.storages.test') }}" mask="true" rel="dialog_{{ time() }}" target="dialog" width="400" height="240" title="上传文件"><span>上传文件</span></a></li>
        </ul>
    </div>

    <table class="table" width="100%" layoutH="112">
        <thead>
            <tr>
                <th width="50" orderField="id" @if (Request::input('orderField') == 'id') class="{{ Request::input('orderDirection') }}" @endif>编号</th>
                <th width="200">文件名称</th>
                <th width="205">HASH</th>
                <th width="80">文件类型</th>
                <th width="60">占用空间</th>
                <th></th>
                <th width="120">上传时间</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storages as $storage)
            <tr>
                <td>{{ $storage->id }}</td>
                <td>{{ $storage->name }}</td>
                <td>{{ $storage->hash }}</td>
                <td>{{ $storage->type }}</td>
                <td>{{ $storage->size }}</td>
                <td>{{ $storage->path }}</td>
                <td>{{ $storage->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="panelBar">
        <form id="pagerForm" method="post" action="#rel#">
            <input type="hidden" name="page" value="{{ $storages->currentPage() }}" />
            <input type="hidden" name="numPerPage" value="{{ $storages->perPage() }}" />
            <input type="hidden" name="orderField" value="{{ Request::input('orderField') }}" />
            <input type="hidden" name="orderDirection" value="{{ Request::input('orderDirection') }}" />
        </form>
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option @if ($storages->perPage() == 30) selected @endif value="30">30</option>
                <option @if ($storages->perPage() == 100) selected @endif value="100">100</option>
                <option @if ($storages->perPage() == 200) selected @endif value="200">200</option>
            </select>
            <span>条，共 {{ $storages->total() }} 条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="{{ $storages->total() }}" numPerPage="{{ $storages->perPage() }}" pageNumShown="10" currentPage="{{ $storages->currentPage() }}"></div>
    </div>
</div>
