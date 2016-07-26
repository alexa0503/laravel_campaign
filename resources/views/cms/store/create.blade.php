@extends('cms.layout')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>店铺管理 - 添加</h2>
                    </div>
                </div>
                <!-- Start .row -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body pt0 pb0">
                                {{ Form::open(array('route' => ['admin.store.store'], 'class'=>'form-horizontal group-border stripped', 'id'=>'form')) }}
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">店铺名称</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input type="text" name="title" class="form-control" value="">
                                            <label class="help-block" for="title"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">地址</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input type="text" name="address" class="form-control" value="">
                                            <label class="help-block" for="address"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">所属省份</label>
                                        <div class="col-lg-10 col-md-9">
                                            <select class="form-control" name="province" id="province">
                                                <option value="">请选择省份</option>
                                            </select>
                                            <label class="help-block" for="province"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">所属城市</label>
                                        <div class="col-lg-10 col-md-9">
                                            <select class="form-control" name="city" id="city">
                                                <option value="">请选择城市</option>
                                            </select>
                                            <label class="help-block" for="city"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group hide">
                                        <label for="text" class="col-lg-2 col-md-3 control-label">排序[从小到大]</label>
                                        <div class="col-lg-10 col-md-9">
                                            <input type="text" name="order_no" id="order_no" class="form-control" value="999">
                                            <label class="help-block" for="title"></label>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    <div class="form-group">
                                        <label class="col-lg-2 col-md-3 control-label"></label>
                                        <div class="col-lg-10 col-md-9">
                                            <button class="btn btn-default ml15" type="submit">提 交</button>
                                            <a class="btn btn-default ml15" href="{{route('admin.province.index')}}">返回</a>
                                        </div>
                                    </div>
                                    <!-- End .form-group  -->
                                    {{ Form::close() }}
                            </div>
                        </div>
                        <!-- End .panel -->
                    </div>
                    <!-- col-lg-12 end here -->
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
function getCities(cities_data,city)
{
    var id = $('#province').val();
    console.log(cities_data[id]);
    if( cities_data[id] ){
        var html;
        $.each(cities_data[id].cities,function(key,value){
            html += '<option value="'+key+'">'+value+'</option>'
        })
        $('#city').append(html);
        if(city){
            $('#city').val(city);
        }
    }
}
$(document).ready(function() {
    $.getJSON('{{url("api/cities")}}',function(data){
        var html;
        $.each(data,function(key,value){
            html += '<option value="'+key+'">'+value.title+'</option>'
        })
        $('#province').append(html);
        getCities(data);

        $('#province').change(function(){
            $('#city').html('<option value="">请选择城市</option>');
            getCities(data);
        })

    });
    $('#order_no').TouchSpin({
        min: 0,
        max: 999999
    });
    $('#form').ajaxForm({
        dataType: 'json',
        success: function() {
            $('#form .form-group .help-block').empty();
            $('#form .form-group').removeClass('has-error');
            location.href='{{route("admin.store.index")}}?province='+$('#province').val()+'&city='+$('#city').val();
        },
        error: function(xhr){
            var json = jQuery.parseJSON(xhr.responseText);
            var keys = Object.keys(json);
            //console.log(keys);
            $('#form .form-group .help-block').empty();
            $('#form .form-group').removeClass('has-error');
            $('#form .form-group').each(function(){
                var name = $(this).find('input,textarea,select').attr('name');
                if( jQuery.inArray(name, keys) != -1){
                    $(this).addClass('has-error');
                    $(this).find('.help-block').html(json[name]);
                }
            })
        }
    });

});
</script>
<!--
<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script>
    $('.article-ckeditor').ckeditor({
        filebrowserBrowseUrl: '{!! url('filemanager/index.html') !!}'
    });
</script>
-->
@endsection
