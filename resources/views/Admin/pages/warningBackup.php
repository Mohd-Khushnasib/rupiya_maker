@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $adminlogin)
@extends('Admin.layouts.master')
@section('main-content')

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    .disabled-div {
    pointer-events: none;
    /* Disable clicks, inputs, and interactions */
    opacity: 0.6;
    /* Thoda transparent banane ke liye */
    background-color: #f5f5f5;
    /* Light grey background */
}
</style>
<div class="container" id="main-container">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title  ">
            <div style="display: flex; justify-content: space-between;">
                <h3 class="theam_color_text"><i class="fa fa-list"></i> Warning</h3>
                <div class="zxyzz">
                    <button type="button" class="btn btn-info" id="openModalBtn">
                        Create Warning
                    </button>
                </div>
            </div>
        </div>
        <!-- END Page Title -->
        <!-- BEGIN Main Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable">
                    <ul id="myTab1" class="nav nav-tabs">
                        <li class="active">
                            <a href="#all" data-toggle="tab"><i class="fa fa-home"></i>
                                All</a></li>
                    </ul>
                    <div id="myTabContent1" class="tab-content">

                        <!-- allticket Start Here -->
                        <div class="tab-pane fade in active all_tabs_bg" id="all">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <!-- <div class="col-sm-2">
                                        <div class="controls">
                                            <select class="form-control" data-placeholder="Assignn" tabindex="1">
                                                <option value="">Assignn</option>
                                                <option value="1">By Me</option>
                                                <option value="1">Other</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Action</th>
                                                        <th>Created By</th>
                                                        <th>Ticket Status</th>
                                                        <th>Warning Type</th>
                                                        <th>Message</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($warnings->isEmpty())
                                                    @else
                                                    @php
                                                    $sr = 1;
                                                    @endphp
                                                    @foreach($warnings as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="text-white btn btn-danger delete small-btn"
                                                                data-id="{{ $item->id }}">
                                                                Delete
                                                            </a>
                                                        </td>

                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>{{$item->task_status ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-warningtype_id="{{$item->warningtype_id}}"
                                                                data-message="{{$item->message}}"
                                                                data-assign="{{ json_encode($item->assign) }}"
                                                                data-id="{{ $item->id }}">
                                                                {{$item->warning_name ?? ''}}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="view-full-message"
                                                                data-message="{{ $item->message }}">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td>{{$item->assigned_names ?? '' }}</td>
                                                    </tr>
                                                    @php
                                                    $sr++;
                                                    @endphp
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- allticket Start Here -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Task Modal Start Here -->
<div id="AddWarningModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:black;" id="modalTitle">Add Warning</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="add_form" method="post" class="mail-compose form-horizontal" action="javascript:void(0);">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}">
                        <p>
                            <label for="">Issued By</label>
                            <input type="text" value="{{$adminlogin->name}}" class="form-control" disabled>
                        </p>
                        <p>
                            <select name="warningtype_id" data-placeholder="Issued To" class="form-control warning_chosen"
                                tabindex="6">
                                <option selected="true" disabled="true">-- Select Warning Type --</option>
                                @php
                                    $warnings = DB::table('tbl_warning_type')->orderBy('id', 'desc')->get();
                                @endphp
                                @foreach($warnings as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->warning_name ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                        </p>
                        <p><textarea name="message" class="form-control wysihtml5" rows="6"></textarea></p>
                        <p>
                        <label for="">Issued To</label>
                            <select name="assign[]" data-placeholder="Issued To" class="form-control warning_chosen" tabindex="6">
                                <optgroup label="Designation">
                                    @php
                                    $admins = DB::table('admin')
                                                ->where('role', '!=', 'Admin') // Exclude records where role is 'Admin'
                                                ->orderBy('id', 'desc')
                                                ->get();
                                    @endphp
                                    @foreach($admins as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name ?? '' }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </p>
                        <p>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-rocket"></i>
                                Add</button>
                            <a type="button" class="btn">Cancel</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Task Modal End Here -->

<!-- Edit Task Start Here -->
<div id="editwarningmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="editwarningmodalLabel">Edit Warning</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">

                    <form class="edit_warning" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}" class="form-control">
                        <!-- Admin Id -->
                        <input type="hidden" name="warning_id" value="" class="form-control edit_warning_id">
                        <!-- Task Id -->

                        <div class="col-sm-12 mb-2">
                            <label for="subject">Issued By</label>
                            <input type="text" value="{{$adminlogin->name}}" class="form-control" readonly>
                        </div>

                        <div class="col-sm-12">
                            <label for="subject">Warning Type</label>
                            <select name="warningtype_id" id="edit_warningtype_id" 
                                    class="form-control chosen EditChoosen" tabindex="6" disabled>
                                @php
                                    $warningTypes = DB::table('tbl_warning_type')->get();
                                @endphp
                                @foreach($warningTypes as $warning)
                                    <option value="{{ $warning->id }}" 
                                        {{ $warning->id == old('warningtype_id', $edit_warningtype_id ?? '') ? 'selected' : '' }}>
                                        {{ $warning->warning_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-sm-12 disabled-div">
                            <textarea name="message" class="form-control wysihtml5 edit_message"
                                disabled></textarea>
                        </div>
                        
                        <div class="col-sm-12">
                        <label for="subject">Issued TO</label>
                            <select name="assign[]" id="edit_assign" data-placeholder="Assign"
                                class="form-control chosen EditChoosen edit_assign" tabindex="6" disabled>
                                <optgroup label="Designation">
                                    @php
                                    $admins = DB::table('admin')
                                                ->where('role', '!=', 'Admin') // Exclude records where role is 'Admin'
                                                ->orderBy('id', 'desc')
                                                ->get();
                                    @endphp
                                    @foreach($admins as $item)
                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-sm-12" style="display: flex; justify-content: right;">
                            <div style="display: flex; gap: 10px;">
                                <button id="edit_button" class="btn btn-primary edit_button" style="margin-top: 15px;"
                                    type="button">Edit</button>
                                <button id="update_button" class="btn btn-success update_button"
                                    style="margin-top: 15px; display: none;" type="submit">Update</button>
                            </div>
                        </div>

                    </form>
                    <!-- task edit form end here -->

                    <!-- Add Comment And History Start Here -->
                    <div class="col-sm-12">
                        <p>
                        <div class="tabbable">
                            <ul id="myTab1" class="nav nav-tabs">
                                <li class="active"><a href="#comment1" data-toggle="tab"><i class="fa fa-home"></i>
                                        Add Comments</a></li>
                                <li><a href="#history1" data-toggle="tab"><i class="fa fa-user"></i>
                                        History</a></li>
                            </ul>
                            <div id="myTabContent1" class="tab-content">
                                <div class="tab-pane fade in active all_tabs_bg" id="comment1">
                                    <div class="boligation_tabls">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="messages-input-form">
                                                    <form id="add_comment" class="add_comment_warning" method="POST"
                                                        action="javascript:void(0);">
                                                        @csrf
                                                        <div class="input">
                                                            <input type="hidden" name="warning_id" class="comment_warning_id"
                                                                value="">
                                                            <input type="hidden" name="admin_id"
                                                                value="{{$adminlogin->id ?? ''}}">
                                                            <input type="text" name="comment"
                                                                placeholder="Write here..." class="form-control">
                                                        </div>
                                                        <div class="buttons">
                                                            <button type="submit" class="btn btn-primary"><i
                                                                    class="fa fa-share"></i></button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <!-- Data Load From Ajax  -->
                                                <ul class="messages messages-stripped" id="get_comments">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade all_tabs_bg" id="history1">
                                    <div class="boligation_tabls">
                                        <div class="table-responsive">
                                            <table class="table table-advance" style="padding: 0px;">
                                                <thead>
                                                    <tr class="history_table">
                                                        <th>#</th>
                                                        <th>Date</th>
                                                        <th>Created By</th>
                                                        <th>Changes</th>
                                                    </tr>
                                                </thead>
                                                <!-- get History data for task related -->
                                                <tbody id="get_history">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </p>
                    </div>
                    <!-- Add Comment And History End Here -->
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
<!-- Edit Task End Here -->

<!-- Message Show -->
<div id="messageModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;">Full Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="fullMessageContent" style="color:black;"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Message Show -->


<!-- Delete Start Here -->
<div id="deletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Delete Warning</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p>Are you sure you want to delete this? This action cannot be undone.</p>
                <form id="delete_form" action="javascript:void(0);" method="post">
                    @csrf
                    <input type="hidden" name="id" id="delete_id" value="" class="form-control">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between" style="margin-top: 15px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn_delete">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete End Here -->



<!-- JS Links Start Here -->
 <!-- jQuery Library (Required for Chosen) -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<!-- Chosen Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>



<script>
    // delete
    $(document).on('click', '.delete', function() {
        var id = $(this).data("id");
        $("#delete_id").val(id);
        $("#deletemodal").modal("show");
    });

    // delete here
    $("#delete_form").submit(function(e) 
    {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{url('/delete_warning')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                if (data.success == 'success') {
                    $(".btn_delete").prop('disabled', false);
                    $("#deletemodal").modal("hide");
                    $("#delete_form")[0].reset();
                    swal("Warning Delete Successfully! ", "", "success");
                    window.location.reload();
                } else {
                    swal('Warning Not Delete', '', 'error');
                    $(".btn_delete").prop("disabled", false);
                }
            },
            error: function(error) {
                swal('Something Went Wrong!', '', 'error');
                $(".btn_delete").prop("disabled", false);
            }
        });
    });
</script>

<!-- Warning Status Update Start Here -->
<script>
$(document).on('click', '.warning_status_button', function(e) {
    e.preventDefault();
    var warning_id = $(".form_warning_id").val();
    var admin_id = $(".logged_in_user_id").val();
    var current_status = $(this).text().trim();
    var new_status = (current_status === "Close Ticket") ? "Close Ticket" : "Open Ticket";
    $.ajax({
        url: "{{ url('/update-ticket-status') }}",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            warning_id: warning_id,
            admin_id: admin_id,
            task_status: new_status
        },
        success: function(response) {
            if (response.success === 'success') {
                var updated_text = (new_status === "Open Ticket") ? "Close Ticket" : "Open Again";
                var button_class = (new_status === "Open Ticket") ? "btn-success" : "btn-warning";
                $(".warning_status_button").text(updated_text)
                    .removeClass("btn-success btn-warning")
                    .addClass(button_class);

                swal(new_status + " Successfully!", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
            alert("Failed to update task status.");
        }
    });
});
</script>
<!-- Warning Status Update End Here -->


<!-- Disabled krna Task ko Edit ke case me by default after edit active all fields -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
    let editButton = document.getElementsByClassName("edit_button")[0];
    let updateButton = document.getElementsByClassName("update_button")[0];
    let editMessage = document.getElementsByClassName("wysihtml5")[0]; 

    let fieldsToDisable = [
        ".edit_subject",
        ".edit_assign",
        ".edit_message",
        ".disabled-div"
    ];

    // Page Load par sabhi fields disable karna
    fieldsToDisable.forEach(selector => {
        let field = document.querySelector(selector);
        if (field) {
            field.setAttribute("disabled", "disabled");
            field.classList.add("disabled-div");
        }
    });

    // Chosen select ko disable karna
    $(".chosen").prop("disabled", true).trigger("chosen:updated"); 
    // $(".AddChosen").prop("disabled", true).trigger("chosen:updated"); 

    editButton.addEventListener("click", function() {
        fieldsToDisable.forEach(selector => {
            let field = document.querySelector(selector);
            if (field) {
                field.removeAttribute("disabled");
                field.classList.remove("disabled-div");
            }
        });

        // Chosen selects ko enable karke refresh karna
        $(".chosen").prop("disabled", false).trigger("chosen:updated"); 
        // $(".AddChosen").prop("disabled", false).trigger("chosen:updated"); 
        
        editButton.style.display = "none";
        updateButton.style.display = "inline-block";
    });
});

// Chosen select initialization
$(document).ready(function() {
    $(".warning_chosen").chosen({
        width: '100%',
        allow_single_deselect: true
    });
});

</script>

<!-- Datatable Here -->
<script>
$(document).ready(function() {
        // Remove localStorage if user comes from another page
        if (performance.navigation.type !== 1) {
        localStorage.removeItem("activeTab");
    }
    var activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
        $('#myTab1 a[href="' + activeTab + '"]').tab("show");
    }
    $("#myTab1 a").on("click", function () {
        var activeTab = $(this).attr("href");
        localStorage.setItem("activeTab", activeTab);
    });
    
    $('.taskTable').DataTable({
        "pageLength": 100,
        dom: 'Bfrtip'
    });
});
</script>

<!--  Edit Warning modal -->
<script>
$(document).on('click', '.edit', function() {
    var id = $(this).data('id'); // task id
    var warningtype_id = $(this).data('warningtype_id');
    var message = $(this).data('message');
    var selectedAdmins = JSON.parse($(this).data('assign'));

    $(".edit_warning_id").val(id);
    $(".form_warning_id").val(id); // form task id jisse status check krke Completed and Open Again button show krenge
    $(".comment_warning_id").val(id);
    // warningtype_id
    $("#edit_warningtype_id option").each(function() {
        if ($(this).val() == warningtype_id) {
            $(this).prop('selected', true);
        }
    });

    // Set message textarea
    $(".edit_message").data("wysihtml5").editor.setValue(message);
    // Set selected values for the "assign[]" multiple select
    $(".edit_assign").val(selectedAdmins).trigger("chosen:updated");
    // Warning Status Fetch Karna
    $.ajax({
        url: "{{url('/get-warning-status')}}", // API jo task_status return kare
        method: 'GET',
        data: {
            warning_id: id
        },
        success: function(response) {
            console.log(response);
            if (response.task_status === "Close Ticket") {
                $(".warning_status_button").text("Open Again").removeClass("btn-success").addClass(
                    "btn-warning");
            } else if (response.task_status === "Open Ticket") {
                $(".warning_status_button").text("Close Ticket").removeClass("btn-warning").addClass(
                    "btn-success");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching Warning status:", error);
        }
    });
    // Warning Status Fetch End

    // Warning comment show start here
    $.ajax({
        url: "{{ url('/get-warning-comments') }}",
        method: 'GET',
        data: {
            warning_id: id
        },
        success: function(response) {
            console.log(response);
            $('#get_comments').empty();

            response.forEach(function(item) {
                console.log("Raw Date:", item.date);
                var formattedDate = moment(item.date, "YYYY-MM-DD hh:mm A").local().fromNow();
                console.log("Formatted Date:", formattedDate);

                var commentHTML = `
                <li>
                    <img src="{{ asset('Admin/img/demo/avatar/avatar2.jpg') }}" alt="User">
                    <div>
                        <div>
                            <h5 class="theam_color">${item.createdby}</h5>
                            <span class="time"><i class="fa fa-clock-o"></i> ${formattedDate}</span>
                        </div>
                        <p>${item.comment}</p>
                    </div>
                </li>
            `;
                $('#get_comments').append(commentHTML);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
    // Warning comment end here

    // Warning History Data show here
    $.ajax({
        url: "{{ url('/get-warning-history') }}",
        method: 'GET',
        data: {
            warning_id: id
        },
        success: function(response) {
           // console.log(response); // Debugging ke liye check karein
            // Task History Section
            $('#get_history').empty();
            // Check if response is an array and has data
            if (!Array.isArray(response) || response.length === 0) {
                $('#get_history').append(`<tr><td colspan="4">No history available</td></tr>`);
            } else {
                var sr = 1;
                response.forEach(function(item) {
                    var formattedDate = new Date(item.date).toLocaleDateString('en-GB', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });

                    var historyRow = `
                        <tr class="history_table">
                            <td>${sr}</td>
                            <td>${formattedDate}</td>
                            <td>${item.createdby}</td>
                            <td>${item.changes}</td>
                        </tr>
                    `;
                    $('#get_history').append(historyRow);
                    sr++;
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
    // Warning History data end here
    $("#editwarningmodal").modal("show");
});
</script>

<script>
    // Add comment task In Edit Task Pannel Start Here
    $(".add_comment_warning").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{url('/add_warning_comment')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                if (data.success == 'success') {
                    swal("Comment Added Successfully", "", "success");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    swal("Comment Not Added", "", "error");
                }
            },
            error: function(err) {}
        });
    });
    // Add Remark In Edit Comment Pannel End Here
</script>

<!-- Show Message Icon Click pr -->
<script>
$(document).ready(function() {
    $(".view-full-message").click(function(e) {
        e.preventDefault();
        var message = $(this).data("message");
        $("#fullMessageContent").text(message);
        $("#messageModal").modal("show");
    });
});
</script>
<!-- Show Message Icon Click pr -->

<!-- add ticket -->
<script>
$("#add_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_warning')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                document.getElementById("add_form").reset();
                $("#AddWarningModal").modal("hide");
                swal("Warning Added Successfully", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                swal("Warning Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});

// Edit Warning Section Data
$(".edit_warning").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/update_warning')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $(".edit_warning")[0].reset();
                $(".editwarningmodal").modal("hide");
                swal("Warning Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Warning Update!", "", "error");
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
        }
    });
});
// Edit Warning End Here
</script>
<!-- Add Warning End Here -->

<script>
$(document).ready(function() {
    $('#openModalBtn').on('click', function() {
        $('#AddWarningModal').modal('show');
    });

    $('#saveChangesBtn').on('click', function() {
        alert('Your changes have been saved!');
        $('#AddWarningModal').modal('hide');
    });

    $('#AddWarningModal').on('shown.bs.modal', function() {
        console.log('Modal is now fully visible!');
    });

    $('#AddWarningModal').on('hidden.bs.modal', function() {
        console.log('Modal has been closed.');
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
