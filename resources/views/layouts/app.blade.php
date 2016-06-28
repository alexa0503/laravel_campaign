<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>单挑肌肤BUG</title>
    <link rel="stylesheet" href="{{asset('assets/css/common.css')}}">
    <script>
        var shareData = {
            'title': '{{env("WECHAT_SHARE_TITLE")}}',
            'desc': '{{env("WECHAT_SHARE_DESC")}}',
            'link': '{{url("/")}}',
            'imgUrl': '{{ asset(env("WECHAT_SHARE_IMG"))}}'
        }
        function wxShare(data) {
            /* 请修改以下文字和图片，定制分享文案 */
            DATAForWeixin.setTimeLine({
                title: data.title,
                imgUrl: data.imgUrl,
                link: data.link
                //success:function(){}
            });
            DATAForWeixin.setAppMessage({
                title: data.title,
                desc: data.desc,
                imgUrl: data.imgUrl,
                link: data.link
                //success:function(){}
            });
            DATAForWeixin.setQQ({
                title: data.title,
                desc: data.desc,
                imgUrl: data.imgUrl,
                link: data.link
            });
        }
    </script>
    <!--移动端版本兼容 -->
    <script type="text/javascript">
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth / 640;
        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi , user-scalable=no">');
            } else {
                document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi , user-scalable=no">');
            }
        } else {
            document.write('<meta name="viewport" content="width=640, minimum-scale=0.1, maximum-scale=1.0 , user-scalable=no" />');
        }
    </script>
    <!--移动端版本兼容 end -->
</head>
<body>
@yield('content')

<script src="{{asset('assets/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.imgpreload.js')}}"></script>
<script src="{{asset('assets/js/jquery.eraser.js')}}"></script>
<script src="{{asset('assets/js/touch.js')}}"></script>
<script src="{{asset('assets/js/common.js')}}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="http://wx.addechina.net/resources/Scripts/weixinjssdk.js"></script>
@yield('scripts')
<script>
// 可设置为 true 以调试
   DATAForWeixin.debug = false;
   //账号的appid
   DATAForWeixin.appId = '{{env("WECHAT_APPID")}}';
   DATAForWeixin.openid = '';
   DATAForWeixin.sharecampaign = '{{env("WECHAT_CAMPAIGN_NAME")}}';//campaign名称
   wxShare(shareData)
</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?0f140859aee948a0688beea164bd6667";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<audio src="{{asset('assets/images/bgm.mp3')}}" id="bgm" preload="auto" autoplay loop style="display:none; height:0;"></audio>
<a href="javascript:void(0);" class="bmgBtn" onClick="bgmCon();"><img src="{{asset('assets/images/bgmBtn1.png')}}" class="bgm1"><img src="{{asset('assets/images/bgmBtn2.png')}}" class="bgm2" style="display:none;"></a>
</body>
</html>
