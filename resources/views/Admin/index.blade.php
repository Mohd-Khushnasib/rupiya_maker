@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $admin_login)
@extends('Admin.layouts.master')
@section('main-content')
@php
$total_user = 0;
$total_user = DB::table('users')->count();
@endphp
<style>
    .comment-badge {
        background-color: red; 
        color: white; 
        font-size: 12px;
        font-weight: bold;
        padding: 3px 6px;
        border-radius: 5px;
        margin-left: 5px;
    }
</style>
<div class="container" id="main-container">
<input type="hidden" name="admin_id" class="form-control admin_id" value="{{$admin_login->id}}">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title">
            <div>
                <h1 class="theam_color_text"><i class="fa fa-home theam_color "></i>
                    Updates ok</h1>
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
                
                <!-- Section Start Here -->
                <!-- <div class="feed_card_section">
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
                </div> -->
                <!-- Section End Here -->

                <!-- Feed Container -->
                <div id="feedContainer"></div> 
                <!-- Feed Container -->
                 

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
// Call function after page loads
$(document).ready(function() {
    showdata();
});


function timeAgo(dateString) {
    let date = new Date(dateString.replace(/-/g, "/"));
    let now = new Date();
    let seconds = Math.floor((now - date) / 1000);

    let intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60,
        second: 1
    };

    for (let unit in intervals) {
        let interval = Math.floor(seconds / intervals[unit]);
        if (interval >= 1) {
            return `${interval} ${unit}${interval > 1 ? 's' : ''} ago`;
        }
    }
    return "Just now";
}

function showdata() {
    $.ajax({
        type: "POST",
        url: "{{ url('fetch_feeds') }}",
        data: {
            _token: "{{ csrf_token() }}"
        },
        dataType: 'json',
        success: function(response) {
            if (response.status == 1) {
                var feedContainer = $("#feedContainer");
                feedContainer.html(''); // ✅ Purana data clear kare
                
                response.data.forEach(function(feed) {
                    let commentsHTML = '';

                    if (feed.comments) {
                        let commentsArray = feed.comments.split('||'); // Comments ko split karein
                        let commentersArray = feed.commenter_names ? feed.commenter_names.split('||') : [];
                        let commentDatesArray = feed.comment_dates ? feed.comment_dates.split('||') : []; // ✅ Comment Dates

                        commentsArray.forEach((comment, index) => {
                            let commenterName = commentersArray[index] || 'Anonymous';
                            let commentTime = commentDatesArray[index] ? timeAgo(commentDatesArray[index]) : 'Just now';

                            commentsHTML += `
                                <li>
                                    <img src="{{asset('Admin/img/demo/avatar/avatar2.jpg')}}" alt="">
                                    <div>
                                        <div>
                                            <h5 class="theam_color">${commenterName}</h5>
                                            <span class="time"><i class="fa fa-clock-o"></i> ${commentTime}</span>
                                        </div>
                                        <p>${comment}</p>
                                    </div>
                                </li>`;
                        });
                    } else {
                        commentsHTML = `<li>No comments yet</li>`;
                    }

                    var feedHTML = `
                        <div class="feed_card_section">
                            <div class="row">
                                <div class="col-md-12" style="display: flex; justify-content: space-between;">
                                    <div class="profile_section_post">
                                        <div class="profile_post">
                                            <img src="${feed.image ? feed.image : 'default-image.jpg'}" alt="">
                                        </div>
                                        <div class="all_text_withnaem">
                                            <a href="#">${feed.creator_name ? feed.creator_name : 'Unknown'}</a>
                                            <p>${formatDate(feed.date)}</p>
                                            <p>${feed.message}</p>
                                        </div>
                                    </div>
                                    <div class="pin_feed_section">
                                        <i class="fa fa-thumb-tack pin-icon"  
                                            data-id="${feed.id}" 
                                            style="cursor: pointer; color: ${feed.pinned == 1 ? 'blue' : 'gray'};">
                                        </i>
                                        <i class="fa fa-eye">${feed.views ? feed.views : 0}</i>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-10">
                                    <img src="${feed.image ? feed.image : 'Not Found'}" class="feed_post_img" alt="">
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                            <hr>
                            <div class="tabbable">
                                <ul id="myTab1" class="nav nav-tabs">
                                    <li class="active"><a href="#like-${feed.id}" data-toggle="tab"><i class="fa fa-heart"></i> Like</a></li>
                                    <li>
    <a href="#comment-${feed.id}" data-toggle="tab">
        <i class="fa fa-comment"></i> Comments 
        <span class="badge bg-danger comment-badge">${feed.total_comments}+</span>
    </a>
</li>


                                </ul>
                                <div id="myTabContent1" class="tab-content">
                                    <div class="tab-pane fade in active all_tabs_bg" id="like-${feed.id}"></div>
                                    <div class="tab-pane fade all_tabs_bg" id="comment-${feed.id}">
                                        <div class="boligation_tabls">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <ul class="messages messages-stripped">
                                                        ${commentsHTML}
                                                    </ul>

                                                    <div class="messages-input-form">
                                                        <form method="POST" action="#">
                                                            <div class="input">
                                                                <input type="text" name="text" placeholder="Write here..." class="form-control comment">
                                                            </div>
                                                            <div class="buttons">
                                                                <button type="button" class="btn btn-primary comment-submit"
                                                                    data-id="${feed.id}">
                                                                    <i class="fa fa-share"></i>
                                                                </button>
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
                    `;

                    feedContainer.append(feedHTML);
                });
            } else {
                console.log("No data found");
            }
        },
        error: function(err) {
            console.error("Error fetching data", err);
        }
    });
}


// Date formatting function
function formatDate(dateString) {
    var date = new Date(dateString);
    return date.toLocaleString('en-US', { month: 'short', day: '2-digit', hour: '2-digit', minute: '2-digit', hour12: true });
}
// Add Post 
$("#add_form").submit(function(e) 
{
    let admin_id = $(".admin_id").val();
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('admin_id', admin_id);
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
                // window.location.reload();     
                // ✅ Form reset karega
                $("#add_form")[0].reset();
                $(".chosen").val([]).trigger("chosen:updated");
                $("#image").val("");
                showdata(); // load here 
            } else {
                swal("Post Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});


// Add Pin Here 
// $(document).on('click', '.pin-icon', function() {
//     var feedId = $(this).data('id'); 
//     var adminId = $(".admin_id").val(); 

//     $.ajax({
//         type: "POST",
//         url: "{{ url('/update_feed_status') }}", // ✅ Laravel API call
//         data: {
//             id: feedId,
//             admin_id: adminId 
//         },
//         dataType: "json",
//         success: function(response) {
//             if (response.status == 1) {
//                 swal("Success", response.message, "success");
//                 showdata();
//             } else {
//                 swal("Error", response.message, "error");
//             }
//         },
//         error: function(err) {
//             swal("Error", "Something went wrong!", "error");
//         }
//     });
// });


$(document).on('click', '.pin-icon', function() {
    var feedId = $(this).data('id'); 
    var adminId = $(".admin_id").val(); 

    $.ajax({
        type: "POST",
        url: "{{ url('/update_feed_status') }}",
        data: {
            id: feedId,
            admin_id: adminId 
        },
        dataType: "json",
        success: function(response) {
            if (response.status == 1) {
                alertify.set('notifier', 'position', 'top-right');
                alertify.success(response.message);
                showdata();
            } else {
                alertify.set('notifier', 'position', 'top-right');
                alertify.error(response.message);
            }
        },
        error: function(err) {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error("Something went wrong!");
        }
    });
});


// Feed Comment Here 
// $(document).on('click', '.comment-submit', function(e) {
//     e.preventDefault(); 
//     var button = $(this);
//     var feedId = button.data('id'); 
//     var adminId = $(".admin_id").val(); 
//     var commentText = $(".comment").val(); 
//     alert("feed id : "+feedId+" => comment : "+commentText);
//     // ✅ AJAX Request Send Karna
//     $.ajax({
//         type: "POST",
//         url: "{{ url('/submit_comment') }}",
//         data: {
//             feed_id: feedId,
//             admin_id: adminId,
//             comment: commentText
//         },
//         success: function(response) {
//             if (response.status == 1) {
//                 swal("Success", response.message, "success");
//                 button.closest('form').find('input[name="comment"]').val('');  // reset field
//                 showdata();  // show feed data here     
//             } else {
//                 swal("Error", response.message, "error");
//             }
//         },
//         error: function(err) {
//             swal("Error", "Something went wrong!", "error");
//         }
//     });
// });


$(document).on('click', '.comment-submit', function(e) {
    e.preventDefault(); 
    var button = $(this);
    var feedId = button.data('id');  
    var adminId = $(".admin_id").val();  
    var commentText = button.closest('.messages-input-form').find('.comment').val();  

    if (!commentText.trim()) {
        swal({
            title: "Error",
            text: "Comment cannot be empty!",
            icon: "error",
            buttons: false, // ❌ OK button hataya
            timer: 1000 // ✅ 2 second me auto close
        });
        return;
    }

    $.ajax({
        type: "POST",
        url: "{{ url('/submit_comment') }}",
        data: {
            feed_id: feedId,
            admin_id: adminId,
            comment: commentText
        },
        success: function(response) {
            if (response.status == 1) {
                swal({
                    text: response.message,
                    icon: "success",
                    buttons: false, // ❌ OK button hataya
                    timer: 2000 // ✅ 2 second me auto close
                });

                button.closest('.messages-input-form').find('.comment').val('');
                showdata(); 
            } else {
                swal({
                    text: response.message,
                    icon: "error",
                    buttons: false, // ❌ OK button hataya
                    timer: 2000 // ✅ 2 second me auto close
                });
            }
        },
        error: function(err) {
            swal({
                text: "Something went wrong!",
                icon: "error",
                buttons: false, // ❌ OK button hataya
                timer: 2000 // ✅ 2 second me auto close
            });
        }
    });
});



</script>


@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif