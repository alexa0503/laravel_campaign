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
                                        <th>视频</th>
                                        <th>昵称</th>
                                        <th>头像</th>
                                        <th>点赞数</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($voices as $voice)
                                    <tr>
                                        <td>{{ $voice->id }}</td>
                                        <td>
                                            <button class="btn btn-default mr5 mb10 video" data-toggle="modal" data-target="#videoModal" data-audio="http://voiceoflegend.choose1.net/voice/{{ $voice->voice_id }}.mp3" data-video="http://voiceoflegend.choose1.net/video/demo_{{ $voice->video_id }}.mp4">查看视频</button>
                                        </td>
                                        <td>{{ $voice->name }}</td>
                                        <td><img src="{{ $voice->picurl }}" style="max-width:100px;max-height:100px;" /></td>

                                        <td>{{ $voice->likes }}</td>
                                        <td>{{ $voice->timestamp }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm delete" href="{{url('cms/voice/delete',['id'=>$voice->id])}}">删除</a></td>
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
    <!-- Video Modal -->
                    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
                        <div class="modal-dialog" style="width:640px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">视频</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="play-block" data-status="paused">
                                        <audio id="audio" src="" preload="auto"></audio>
                                        <video id="video" src="" width="600" height="360">Your browser does not support the video tag.</video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
@section('scripts')
<script>

$().ready(function(){
    $('.video').click(function(){
        $('#audio').attr('src', $(this).attr('data-audio'));
        $('#video').attr('src', $(this).attr('data-video'));
    })
    $('#play-block').click(function(){
        if( $(this).attr('data-status') == 'paused'){
            $(this).attr('data-status','play');
            $("#video").get(0).play();
            $("#audio").get(0).play();
        }
        else{
            $(this).attr('data-status','paused');
            $("#video").get(0).pause();
            $("#audio").get(0).pause();
        }
    })
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
