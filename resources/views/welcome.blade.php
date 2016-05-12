@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>
                <div class="panel-body">
                    <canvas id="canvasOne" width="500" height="500">
                        Your browser does not support HTML5 Canvas.
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="application/javascript">
        window.addEventListener("load",function () {
            var w = $('.panel-body').width();
            var h = $('.panel-body').height();
            $('#canvasOne').attr('width',w+'px');
            $('#canvasOne').attr('height',h+'px');
            var canvas = document.getElementById('canvasOne');
            var context = canvas.getContext('2d');
            context.fillStyle = '#000000';
            //context.fillRect(0,0,500,300);
            context.font = '30px Sans-Serif';
            context.textBaseline = 'top';
            context.fillText("Your Application's Landing Page.", 195, 90);
        },false);
    </script>
@endsection
