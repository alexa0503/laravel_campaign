<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>馋嘴猴卖友求逗干</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/lato.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="http://wx.ompchina.net/resources/Scripts/weixinjssdk.js"></script>
    <script type="text/javascript">
        var shareData = {
            'title': '{{env("WECHAT_SHARE_TITLE")}}',
            'desc': '{{env("WECHAT_SHARE_DESC")}}',
            'link': '{{env("APP_URL")}}',
            'imgUrl': '{{env("APP_URL")}}'+'{{env("WECHAT_SHARE_IMG")}}'
        }
        DATAForWeixin.debug = false; // 可设置为 true 以调试
        DATAForWeixin.appId = '{{env("WECHAT_APPID")}}',//账号的appid//
        DATAForWeixin.openid = '',
        DATAForWeixin.sharecampaign = '{{env("WECHAT_CAMPAIGN_NAME")}}',//campaign名称

        /* 请修改以下文字和图片，定制分享文案 */
        DATAForWeixin.setTimeLine({
            title: shareData.desc,
            imgUrl: shareData.imgUrl,
            link: shareData.link
            //success:function(){}
        });
        DATAForWeixin.setAppMessage({
            title: shareData.title,
            desc: shareData.desc,
            imgUrl: shareData.imgUrl,
            link: shareData.link
            //success:function(){}
        });
        DATAForWeixin.setQQ({
            title: shareData.title,
            desc: shareData.desc,
            imgUrl: shareData.imgUrl,
            link: shareData.link
        });

    </script>
    @yield('scripts')
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">

    </div>
</nav>

@yield('content')

        <!-- JavaScripts -->
<script src="{{asset('js/jquery.min.js')}}" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
