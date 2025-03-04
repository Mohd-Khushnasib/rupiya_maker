@if(session()->get('admin_login'))
@extends('Admin.layouts.master')
@section('main-content')
@php
$total_user = 0;
$total_user = DB::table('users')->count();
@endphp
<div class="container" id="main-container">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1 class="theam_color_text"><i class="fa fa-home theam_color "></i>
                    Updates</h1>
            </div>
        </div>
        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-12">
                <!-- <form id="postForm"> -->
                <form id="add_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <textarea name="message" id="message" rows="10" style="width:100%"></textarea>
                    <input type="file" name="image" id="image" style="width:100%;margin-bottom:5px">
                    <div class="">
                        <select name="permition[]" data-placeholder="To :" class="form-control chosen" multiple="multiple" tabindex="6">
                            <option value=""> </option>
                            <optgroup label="Choose">
                                <option value="Manager">Manager</option>
                                <option value="TL">TL</option>
                                <option value="Agent">Consultant</option>
                                <option value="Senior Agent">Senior Consultant</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="feeds_post_btn">
                        <button type="submit" class="btn btn-primary">Post</button>
                        <button class="btn">Cancle</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12" style="margin-top: 15px;">
                <h2 class="theam_color">Feeds</h2>
                <div class="feed_card_section">
                    <div class="row">
                        <div class="col-md-12" style="display: flex; justify-content: space-between !important; ">
                            <div class="profile_section_post">
                                <div class="profile_post">
                                    <img src="https://avatars.mds.yandex.net/i?id=0776231b03a42500ffe93a58496a86ddb08ab983-5252031-images-thumbs&n=13"
                                        alt="">
                                </div>
                                <div class="all_text_withnaem">
                                    <a href="#">Saurabh Singh</a>
                                    <p>Dec 13 12:14 Pm</p>
                                </div>
                                <!-- <p>To All Employee</p> -->
                            </div>
                            <div class="pin_feed_section">
                                <i class="fa fa-thumb-tack"></i>
                                <i class="fa fa-eye">10</i>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <img src="https://pravo-ros.ru/assets/img/bg/home02_i2.jpg" class="feed_post_img" alt="">
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                    <hr>
                    <div class="tabbable">
                        <ul id="myTab1" class="nav nav-tabs">
                            <li class="active"><a href="#history" data-toggle="tab"><i class="fa fa-heart"></i>
                                    Like</a></li>
                            <li><a href="#comment" data-toggle="tab"><i class="fa fa-comment"></i>
                                    Comments</a></li>
                        </ul>
                        <div id="myTabContent1" class="tab-content">
                            <div class="tab-pane fade in active all_tabs_bg" id="history">
                                <!-- <div class="boligation_tabls">
                                    <div class="post_like_icon">
                                        <i class="fa fa-heart"></i>
                                        <i class="fa fa-smile-o"></i>
                                        <i class="fa fa-thumbs-o-up"></i>
                                        <i class="fa fa-thumbs-o-down"></i>
                                        <i class="fa fa-frown-o"></i>
                                    </div>
                                </div> -->
                            </div>
                            <div class="tab-pane fade  all_tabs_bg" id="comment">
                                <div class="boligation_tabls">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="messages messages-stripped">
                                                <li>
                                                    <img src="img/demo/avatar/avatar2.jpg" alt="">
                                                    <div>
                                                        <div>
                                                            <h5 class="theam_color">Saurabh</h5>
                                                            <span class="time"><i class="fa fa-clock-o"></i> 26
                                                                sec
                                                                ago</span>
                                                        </div>
                                                        <p>Saurabh Make Same Changes</p>
                                                    </div>
                                                </li>
                                            </ul>

                                            <div class="messages-input-form">
                                                <form method="POST" action="#">
                                                    <div class="input">
                                                        <input type="text" name="text" placeholder="Write here..."
                                                            class="form-control">
                                                    </div>
                                                    <div class="buttons">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fa fa-share"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- END Main Content -->
    </div>
    <!-- END Content -->
</div>

<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>

<script>
$("#add_form").submit(function(e) 
{
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/admin-feed')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                swal("Post Added Successfully", "", "success");
                window.location.reload();
            } else {
                swal("Post Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});
</script>


@endsection
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif