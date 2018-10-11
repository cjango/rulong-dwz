<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{ config('rulong.title') }} 管理登录</title>
    <link rel="stylesheet" href="{{ admin_assets('themes/css/login.css') }}" />
</head>

<body>
    <div id="login">
        <div id="login_header">
            <h1 class="login_logo">
                <a href=""><img src="{{ admin_assets('themes/default/images/login_logo.png') }}" /></a>
            </h1>
            <div class="login_headerContent">
                <div class="navList">
                    <ul>
                        <li><a href="https://www.cjango.com/" target="_blank">反馈</a></li>
                        <li><a href="https://www.cjango.com/" target="_blank">帮助</a></li>
                    </ul>
                </div>
                <h2 class="login_title"><img src="{{ admin_assets('themes/default/images/login_title.png') }}" /></h2>
            </div>
        </div>
        <div id="login_content">
            <div class="loginForm">
                <form action="{{ url()->current() }}" method="post">
                    <p>
                        <label>用户名：</label>
                        <input type="text" name="username" size="20" class="login_input" />
                    </p>
                    <p>
                        <label>密码：</label>
                        <input type="password" name="password" size="20" class="login_input" />
                    </p>
                    <p>
                        <label>验证码：</label>
                        <input class="code" type="text" name="verify" size="5" />
                        <span><img src="{{ captcha_src() }}" alt="" class="verify" width="75" height="24" /></span>
                    </p>
                    <div class="login_bar">
                        @csrf
                        <input class="sub ajax-post" type="button" value=" " />
                    </div>
                </form>
            </div>
            <div class="login_banner"><img src="{{ admin_assets('themes/default/images/login_banner.jpg') }}" /></div>
            <div class="login_main">
                <ul class="helpList">
                    <li><a href="#">忘记密码怎么办？</a></li>
                    <li><a href="#">忘记密码怎么办？</a></li>
                    <li><a href="#">忘记密码怎么办？</a></li>
                </ul>
                <div class="login_inner">
                    <p>快速开发后台框架</p>
                    <p>基于PHP 7.1+，更快的运行速度</p>
                    <p>Laravel + DwzUI</p>
                </div>
            </div>
        </div>
        <div id="login_footer">
            Copyright &copy; {{ date('Y') }} All Rights Reserved. <a href="https://www.cjango.com/" target="_blank" title="Copyright">C.Jason</a>
        </div>
    </div>
    <script type="text/javascript" src="{{ admin_assets('js/jquery-1.11.3.min.js') }}"></script>
    <script type="text/javascript">
        $('.verify').click(function() {
            $(this).attr('src', '{{ captcha_src() }}&_='+ Math.random());
        });

        $('.ajax-post').click(function(event) {
            event.preventDefault();
            var $form = $(this).parents('form');
            $.post($form.action, $form.serialize(), function(res) {
                if (res.statusCode == 200) {
                    window.location.href = "{{  route('RuLong.index') }}";
                } else {
                    $('.verify').click();
                    alert(res.message)
                }
            });
        });
    </script>
</body>
</html>
