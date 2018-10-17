<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('rulong.title') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ admin_assets('themes/default/style.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ admin_assets('themes/css/core.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ admin_assets('themes/css/print.css') }}" rel="stylesheet" type="text/css" media="print"/>
    <link href="{{ admin_assets('uploadify/css/uploadify.css') }}" rel="stylesheet" type="text/css" media="screen"/>

    <!--[if IE]>
    <link href="{{ admin_assets('themes/css/ieHack.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="{{ admin_assets('js/speedup.js') }}" type="text/javascript"></script>
    <script src="{{ admin_assets('js/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
    <![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="{{ admin_assets('js/jquery-2.1.4.min.js') }}" type="text/javascript"></script>
    <!--<![endif]-->
    <script src="{{ admin_assets('js/dwz.min.js') }}" type="text/javascript"></script>
    <!-- Ueditor -->
    <script src="{{ admin_assets('ueditor/ueditor.config.js') }}" type="text/javascript"></script>
    <script src="{{ admin_assets('ueditor/ueditor.all.min.js') }}" type="text/javascript"></script>
    <!-- Ueditor -->
    <script src="{{ admin_assets('uploadify/scripts/jquery.uploadify.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(function(){
            DWZ.init("{{ admin_assets('dwz.frag.xml') }}", {
                loginUrl: "{{ route('RuLong.auth.login.dialog') }}",
                loginTitle: "登录",
                statusCode: {ok: 200, error: 400, timeout: 408},
                pageInfo: {pageNum: "page", numPerPage: "numPerPage", orderField: "orderField", orderDirection: "orderDirection"},
                keys: {statusCode: "statusCode", message: "message"},
                ui: {hideMode: 'offsets'},
                debug: false,
                callback: function() {
                    initEnv();
                }
            });
        });
    </script>
</head>

<body>
    <div id="layout">
        <div id="header">
            <div class="headerNav">
                <a class="logo" href="{{ route('RuLong.index') }}">LOGO</a>
                <ul class="nav">
                    <li><a href="{{ route('RuLong.password') }}" target="dialog" rel="dialog_{{ uniqid() }}" width="350" height="220" mask="true">修改密码</a></li>
                    <li><a target="ajaxTodo" href="{{ route('RuLong.auth.logout') }}" title="确定要退出么" callback="logout">退出登录</a></li>
                </ul>
                <script>
                    function logout(data) {
                        alertMsg.correct(data.message);
                        setTimeout(function() {
                            location.href = "{{ route('RuLong.auth.login') }}";
                        }, 1000);
                    }
                </script>
            </div>
        </div>

        <div id="leftside">
            <div id="sidebar_s">
                <div class="collapse">
                    <div class="toggleCollapse"><div></div></div>
                </div>
            </div>
            <div id="sidebar">
                <div class="toggleCollapse"><h2>主菜单</h2><div></div></div>
                <div class="accordion" fillSpace="sidebar">
                    @foreach ($adminMenus as $menu)
                    <div class="accordionHeader">
                        <h2><span>Folder</span>{{ $menu['title'] }}</h2>
                    </div>
                    <div class="accordionContent">
                        @isset($menu['children'])
                        <ul class="tree treeFolder">
                            @foreach ($menu['children'] as $children)
                            <li><a href="{{ route($children['uri']) }}" target="navTab" rel="{{ $children['uri'] }}">{{ $children['title'] }}</a></li>
                            @endforeach
                        </ul>
                        @endisset
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="container">
            <div id="navTab" class="tabsPage">
                <div class="tabsPageHeader">
                    <div class="tabsPageHeaderContent">
                        <ul class="navTab-tab">
                            <li tabid="main" class="main"><a href="javascript:;"><span><span class="home_icon">我的主页</span></span></a></li>
                        </ul>
                    </div>
                    <div class="tabsLeft">left</div>
                    <div class="tabsRight">right</div>
                    <div class="tabsMore">more</div>
                </div>
                <ul class="tabsMoreList">
                    <li><a href="javascript:;">Dashboard</a></li>
                </ul>
                <div class="navTab-panel tabsPageContent layoutBox">
                    <div class="page unitBox">
                        <div class="accountInfo">
                            <div class="alertInfo">
                                <p><span></span></p>
                                <p></p>
                            </div>
                            <div class="right">
                                <p style="color:red"></p>
                            </div>
                            <p><span>{{ config('rulong.title') }}</span></p>
                            <p>欢迎：{{ Admin::user()->nickname }}，上次登录时间：{{ Admin::user()->last_login_time }}，上次登录地址：{{ Admin::user()->last_login_ip }}。</p>
                        </div>
                        <div class="pageFormContent" layoutH="80">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="footer">Copyright &copy; {{ date('Y') }}  All Rights Reserved. <a href="https://www.cjango.com/" target="_blank" title="Copyright">C.Jason</a></div>
</body>
</html>
