<div class="pageContent">
    <div style="float:left;width:240px;border-right:1px #B8D0D6 solid;">
        <div class="pageHeader">
            <h2 style="line-height:24px;">菜单结构</h2>
        </div>
        <ul class="tree treeFolder expand" layoutH="36">
            @foreach($menuTree as $menu)
            <li><a>{{ $menu->title }}</a>
                <ul>
                    @foreach($menu->children as $child)
                    <li><a href="" title="">{{ $child->title }}</a>
                        @foreach($child->children as $son)
                        <ul>
                            <li><a href="" title="">{{ $son->title }}</a></li>
                        </ul>
                        @endforeach
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>
    <div style="margin-left:245px;border-left:1px #B8D0D6 solid;">
        <div class="pageHeader">
            <form rel="pagerForm" onsubmit="return navTabSearch(this);" action="{{ url()->current() }}" method="post">
                <div class="searchBar">
                    <table class="searchContent">
                        <tr>
                            <td>
                                菜单名称：
                                <input type="text" name="keyword" value="{{ Request::input('keyword') }}"/>
                            </td>
                            <td>
                                <input type="hidden" name="parent_id" value="{{ Request::get('parent_id') }}">
                                <div class="buttonActive"><div class="buttonContent"><button type="submit">检索结果</button></div></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
        <div class="panelBar">
            <ul class="toolBar">
                @if (Request::get('parent_id'))
                <li><a class="add" href="{{ route('RuLong.menus.create', ['parent_id' => Request::get('parent_id')]) }}" target="dialog" mask="true" width="400" height="250" rel="diaolog_{{ time() }}" title="添加菜单"><span>添加菜单</span></a></li>
                @else
                <li><a class="add" href="{{ route('RuLong.menus.create') }}" target="dialog" mask="true" width="400" height="250" rel="diaolog_{{ time() }}" title="添加菜单"><span>添加菜单</span></a></li>
                @endif
            </ul>
        </div>
        <table class="table" width="100%" layoutH="112">
            <thead>
                <tr>
                    <th width="40">ID</th>
                    <th width="130">菜单名称</th>
                    <th width="50">排序</th>
                    <th>URL</th>
                    <th width="120">创建时间</th>
                    <th width="120">更新时间</th>
                    <th width="80"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                <tr target="sid" rel="{$vo.id}">
                    <td>{{ $menu->id }}</td>
                    <td><a href="{{ route('RuLong.menus.index', ['parent_id' => $menu->id]) }}"  target="navTab" rel="menus" title="菜单管理">{{ $menu->title }}</a></td>
                    <td>{{ $menu->sort }}</td>
                    <td>{{ $menu->uri }}</td>
                    <td>{{ $menu->created_at }}</td>
                    <td>{{ $menu->updated_at }}</td>
                    <td>
                        <a title="编辑" target="dialog" href="{{ route('RuLong.menus.edit', $menu) }}" rel="dialog_{{ time() }}" mask="true" width="400" height="250" class="btnEdit">编辑</a>
                        <a title="删除" target="ajaxDelete" href="{{ route('RuLong.menus.destroy', $menu) }}" class="btnDel">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="panelBar">
            <form id="pagerForm" method="post" action="#rel#">
                <input type="hidden" name="page" value="{{ $menus->currentPage() }}" />
                <input type="hidden" name="numPerPage" value="{{ $menus->perPage() }}" />
                <input type="hidden" name="orderField" value="{{ Request::input('orderField') }}" />
                <input type="hidden" name="orderDirection" value="{{ Request::input('orderDirection') }}" />
            </form>
            <div class="pages">
                <span>显示</span>
                <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                    <option @if ($menus->perPage() == 30) selected @endif value="30">30</option>
                    <option @if ($menus->perPage() == 100) selected @endif value="100">100</option>
                    <option @if ($menus->perPage() == 200) selected @endif value="200">200</option>
                </select>
                <span>条，共 {{ $menus->total() }} 条</span>
            </div>
            <div class="pagination" targetType="navTab" totalCount="{{ $menus->total() }}" numPerPage="{{ $menus->perPage() }}" pageNumShown="10" currentPage="{{ $menus->currentPage() }}"></div>
        </div>

    </div>
</div>
