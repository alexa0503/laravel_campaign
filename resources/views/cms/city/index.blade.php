@extends('cms.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>城市管理</h2>
                    </div>

                </div>
                <!-- Start .row -->
                <div class="row" style="min-height:800px;">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <select class="form-control" name="province">
                                        <option value="">请选择省份</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{$province->id}}" @if (Request::get('province') == $province->id) selected="selected" @endif>{{$province->title}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <hr />
                                <div class="dd" id="nestable">
                                    <ol class="dd-list">
                                        @foreach ($cities as $city)
                                        <li class="dd-item dd3-item" data-id="{{$city->id}}">
                                            <div class="dd-handle dd3-handle">Drag</div>
                                            <div class="dd3-content">{{$city->title}}
                                                <div class="pull-right"><a href="{{route('admin.city.edit',['id'=>$city->id])}}" class="btn btn-xs btn-link">编辑</a>
                                            <a href="{{route('admin.city.destroy',['id'=>$city->id])}}" class="btn btn-xs btn-link delete">删除</a></div></div>
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>
                                <div class="clearfix"></div>
                                @if (count($cities) > 0)
                                <hr />
                                <form class="form-horizontal" id="form" action="{{route('admin.city.order')}}" method="post">
                                    <input type="hidden" id="nestable-output" name="order_no" />
                                    <button class="btn btn-default">确认排序</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                </div>
                <!-- End .row -->
            </div>
            <!-- End .page-content-inner -->
        </div>
        <!-- / page-content-wrapper -->
    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('select[name="province"]').change(function(){
        var province = $(this).val();
        location.href = '{{route("admin.city.index")}}?province='+province;
    })
    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    $('#press-type').change(function(){
        $('#form-type').submit();
    })
    $('.delete').click(function(){
        var url = $(this).attr('href');
        var obj = $(this).parents('.dd-item');
        if( confirm('该操作无法返回,是否继续?')){
            $.ajax(url, {
                dataType: 'json',
                method: 'DELETE',
                success: function(json){
                    if(json.ret == 0){
                        obj.remove();
                    }
                    else{
                        alert(json.msg);
                    }
                },
                error: function(){
                    alert('请求失败~');
                }
            });
        }
        return false;
    })
    $('#form').ajaxForm({
        dataType: 'json',
        success: function(json) {
            if( json.ret == 0 ){
                location.reload();
            }
            else{
                alert(json.msg);
            }
            //location.href='{{route("admin.province.index")}}';
        },
        error: function(xhr){
            alert('服务器异常，请稍候重试')
        }
    });
});
</script>
@endsection
