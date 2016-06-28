@extends('layouts.cms')

@section('content')
    <div class="page-content sidebar-page right-sidebar-page clearfix">
        <!-- .page-content-wrapper -->
        <div class="page-content-wrapper">
            <div class="page-content-inner">
                <!-- Start .page-content-inner -->
                <div id="page-header" class="clearfix">
                    <div class="page-header">
                        <h2>授权用户</h2>
                        <span class="txt"></span>
                    </div>

                </div>
                <!-- Start .row -->
                <div class="row">

                    <div class="col-lg-12">
                        <!-- col-lg-12 start here -->
                        <div class="panel panel-default">
                            <!-- Start .panel -->
                            <div class="panel-body">
                                <table id="basic-datatables" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>声音地址</th>
                                        <th>视频地址</th>
                                        <th>点赞数</th>
                                        <th>用户OPEN ID</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($voices as $voice)
                                    <tr>
                                        <td>{{ $voice->id }}</td>
                                        <td><a href="http://voiceoflegend.choose1.net/voice/{{ $voice->voice_id }}.mp3" target="_blank">{{ $voice->voice_id }}</a></td>
                                        <td><a href="http://voiceoflegend.choose1.net/voice/{{ $voice->video_id }}.mp4" target="_blank">{{ $voice->video_id }}</a></td>
                                        <td>{{ $voice->likes }}</td>
                                        <td><a href="{{url('cms/users',['openid'=>$voice->user_openid])}}">{{ $voice->user_openid }}</a></td>
                                        <td>{{ $voice->timestamp }}</td>
                                        <td><a class="btn btn-info btn-sm delete" href="{{url('cms/voice/delete',['id'=>$voice->id])}}">删除</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="dataTables_paginate paging_bootstrap" id="basic-datatables_paginate">
                                            {!! $voices->links() !!}
                                        </div>
                                    </div>
                                </div>
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
$().ready(function(){
    $('.delete').click(function(){
        var url = $(this).attr('href');
        var obj = $(this).parents('td').parent('tr');
        if( confirm('该操作无法返回,是否继续?')){
            $.ajax(url, {
                dataType: 'json',
                method: 'DELETE',
                success: function(json){
                    if(json.ret == 0){
                        obj.remove();
                    }
                },
                error: function(){
                    alert('请求失败~');
                }
            });
        }
        return false;
    })
})
</script>
@endsection
