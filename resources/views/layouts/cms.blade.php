<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <!-- Mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="" />
    <!-- Import google fonts - Heading first/ text second -->
    <link href='{{asset('css/font.css')}}' rel='stylesheet' type='text/css'>
    <!-- Css files -->
    <!-- Icons -->
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" />
    <!-- Bootstrap stylesheets (included template modifications) -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <!-- Plugins stylesheets (all plugin custom css) -->
    <link href="{{asset('css/plugins.css')}}" rel="stylesheet" />
    <!-- Main stylesheets (template main css file) -->
    <link href="{{asset('css/main.css')}}" rel="stylesheet" />
    <!-- Custom stylesheets ( Put your own changes here ) -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" />
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('img/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('img/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('img/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('img/ico/apple-touch-icon-57-precomposed.png')}}">
    <link rel="icon" href="{{asset('img/ico/favicon.ico" type="image/png')}}">
    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name="msapplication-TileColor" content="#3399cc" />
</head>
<body>
<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- .page-navbar -->
@include('cms.header')
<!-- / page-navbar -->
<!-- #wrapper -->
<div id="wrapper">
    <!-- .page-sidebar -->
    @include('cms.sidebar')
    <!-- / page-sidebar -->
    <!-- Start #right-sidebar -->
    @include('cms.rightSidebar')
    <!-- End #right-sidebar -->
    <!-- .page-content -->
    @yield('content')
    <!-- / page-content -->
</div>
<!-- / #wrapper -->
@include('cms.footer')
<!-- End #footer  -->
<!-- Back to top -->
<div id="back-to-top"><a href="#">Back to Top</a>
</div>
<!-- Javascripts -->
<!-- Load pace first -->
<script src="{{asset('plugins/core/pace/pace.min.js')}}"></script>
<!-- Important javascript libs(put in all pages) -->
<script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('js/libs/excanvas.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/html5.js')}}"></script>
<script type="text/javascript" src="{{asset('js/libs/respond.min.js')}}"></script>
<![endif]-->
<!-- Bootstrap plugins -->
<script src="{{asset('js/bootstrap/bootstrap.js')}}"></script>
<!-- Core plugins ( not remove ) -->
<script src="{{asset('js/libs/modernizr.custom.js')}}"></script>
<!-- Handle responsive view functions -->
<script src="{{asset('js/jRespond.min.js')}}"></script>
<!-- Custom scroll for sidebars,tables and etc. -->
<script src="{{asset('plugins/core/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js')}}"></script>
<!-- Remove click delay in touch -->
<script src="{{asset('plugins/core/fastclick/fastclick.js')}}"></script>
<!-- Increase jquery animation speed -->
<script src="{{asset('plugins/core/velocity/jquery.velocity.min.js')}}"></script>
<!-- Quick search plugin (fast search for many widgets) -->
<script src="{{asset('plugins/core/quicksearch/jquery.quicksearch.js')}}"></script>
<!-- Bootbox fast bootstrap modals -->
<script src="{{asset('plugins/ui/bootbox/bootbox.js')}}"></script>
<!-- Other plugins ( load only nessesary plugins for every page) -->
<script src="{{asset('plugins/charts/sparklines/jquery.sparkline.js')}}"></script>
<script src="{{asset('js/jquery.dynamic.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/pages/blank.js')}}"></script>
@yield('scripts')
<script>
    $().ready(function () {
        $.get('/cms/user/logs',function (data) {
            $('#userLogs').html(data);
        })

    })
</script>
</body>
</html>