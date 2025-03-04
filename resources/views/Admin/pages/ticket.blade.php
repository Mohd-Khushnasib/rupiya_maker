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
 <!-- Admin Name Start Here -->
 <input type="hidden" id="admin_name" value="{{$adminlogin->name}}" class="form-control">
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title  ">
            <div style="display: flex; justify-content: space-between;">
                <h3 class="theam_color_text"><i class="fa fa-list"></i> Ticket</h3>
                <div class="zxyzz">
                    <button type="button" class="btn btn-info" id="openModalBtn">
                        Create Ticket
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
                        <li class="active"><a href="#all" data-toggle="tab"><i class="fa fa-home"></i>
                                All  <span class="notification_nav">{{ $totalTickets }}</span></a></li>
                        <li><a href="#openticket" data-toggle="tab"><i class="fa fa-user"></i>
                                Open Ticket <span class="notification_nav">{{ $totalOpenTickets }}</span></a></li>
                        <li><a href="#closeticket" data-toggle="tab"><i class="fa fa-user"></i>
                                close Ticket <span class="notification_nav">{{ $totalClosedTickets }}</span></a></li>
                    </ul>
                    <div id="myTabContent1" class="tab-content">
                        <!-- allticket Start Here -->
                        <div class="tab-pane fade in active all_tabs_bg" id="all">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="controls">
                                            <select class="form-control" data-placeholder="Assignn" tabindex="1">
                                                <option value="">Assignn</option>
                                                <option value="1">By Me</option>
                                                <option value="1">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-2">
                                        <div class="controls">
                                            <select class="form-control" data-placeholder="Assignn" tabindex="1">
                                                <option value="">Task Type</option>
                                                <option value="1">Lead</option>
                                                <option value="1">Login</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Created By</th>
                                                        <th>Ticket Status</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($tickets->isEmpty())
                                                    @else
                                                    @php
                                                    $sr = 1;
                                                    @endphp
                                                    @foreach($tickets as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>{{$item->task_status ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ $item->assign }}"
                                                                data-id="{{ $item->id }}">
                                                                {{$item->subject ?? ''}}
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

                        <!-- openticket Start Here -->
                        <div class="tab-pane fade all_tabs_bg" id="openticket">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance taskTable" id="table2">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Created By</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($open_tickets)) {{-- Check if array is not empty --}}
                                                    @php $sr = 1; @endphp
                                                    @foreach($open_tickets as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ $item->assign }}"
                                                                data-id="{{ $item->id }}">
                                                                {{$item->subject ?? ''}}
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
                                                    @php $sr++; @endphp
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- openticket Start Here -->

                        <!-- closeticket Start Here -->
                        <div class="tab-pane fade all_tabs_bg" id="closeticket">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance taskTable" id="table3">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Created By</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($closed_tickets))
                                                    @php $sr = 1; @endphp
                                                    @foreach($closed_tickets as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-assign="{{ $item->assign }}"
                                                                data-id="{{ $item->id }}">
                                                                {{$item->subject ?? ''}}
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
                                                    @php $sr++; @endphp
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- closeticket Start Here -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Task Modal Start Here -->
<div id="AddTicketModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:black;" id="modalTitle">Add Ticket</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form id="add_form" method="post" class="mail-compose form-horizontal" action="javascript:void(0);">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}">
                        <p>
                            <label for="">Created By</label>
                            <input type="text" value="{{$adminlogin->name}}" class="form-control" disabled>
                        </p>
                        <p><input type="text" name="subject" placeholder="Subject" class="form-control"></p>
                        <p><textarea name="message" class="form-control wysihtml5" rows="6"></textarea></p>
                        
                        <p>
                            <select name="assign[]" data-placeholder="Assign" class="form-control ticket_chosen" multiple="multiple" tabindex="6">
                                <optgroup label="Designation">
                                    @php
                                    $admins = DB::table('admin')->orderBy('id', 'desc')->get();
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
<div id="editticketmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="editticketmodalLabel">Edit Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <form class="edit_ticket" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}" class="form-control">
                        <!-- Admin Id -->
                        <input type="hidden" name="ticket_id" value="" class="form-control edit_ticket_id">
                        <!-- Task Id -->
                        <div class="col-sm-12 mb-2">
                            <label for="subject">Created By</label>
                            <input type="text" id="created_by" value="{{$adminlogin->name}}" class="form-control created_by" readonly>
                        </div>
                        <div class="col-sm-12">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" class="form-control edit_subject" disabled>
                        </div>
                        <div class="col-sm-12 disabled-div">
                            <textarea name="message" class="form-control wysihtml5 edit_message"
                                disabled></textarea>
                        </div>
                        <div class="col-sm-12">
                            <!-- <select name="assign[]" id="edit_assign" data-placeholder="Assign"
                                class="form-control chosen EditChoosen edit_assign" multiple="multiple" tabindex="6" disabled>
                                <optgroup label="Designation">
                                    @php
                                    $admins = DB::table('admin')->orderBy('id', 'desc')->get();
                                    @endphp
                                    @foreach($admins as $item)
                                    <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                    @endforeach
                                </optgroup>
                            </select> -->
                                @php
                                    $admins = DB::table('admin')->orderBy('id', 'desc')->get();
                                @endphp

                                <select name="assign[]" id="edit_assign" data-placeholder="Assign"
                                        class="form-control chosen EditChoosen edit_assign" multiple="multiple" tabindex="6" disabled>
                                    <optgroup label="Designation">
                                        @foreach($admins as $item)
                                            <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>

                        </div>

                        <div class="col-sm-12"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <!-- Task Status Check -->
                            <input type="hidden" class="form_ticket_id" value="">
                            <input type="hidden" class="logged_in_user_id" value="{{ $adminlogin->id }}">
                            <button class="btn btn-success task_status_button" style="margin: 0 auto;"
                                type="button">Ticket Closed</button>
                                
                            <!-- <button class="btn btn-success task_status_button" style="margin: 0 auto;"
                                type="button">Close Ticket</button> -->
                            <!-- Task Status Check -->

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
                                                    <form id="add_comment" class="add_comment_ticket" method="POST"
                                                        action="javascript:void(0);">
                                                        @csrf
                                                        <div class="input">
                                                            <input type="hidden" name="ticket_id" class="comment_ticket_id"
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



<!-- JS Links Start Here -->
 <!-- jQuery Library (Required for Chosen) -->
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<!-- Chosen Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<!-- Ticket Status Update Start Here -->
<script>
$(document).on('click', '.task_status_button', function(e) {
    e.preventDefault();

    var ticket_id = $(".form_ticket_id").val();
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
            ticket_id: ticket_id,
            admin_id: admin_id,
            task_status: new_status
        },
        success: function(response) {
            if (response.success === 'success') {
                var updated_text = (new_status === "Open Ticket") ? "Close Ticket" : "Open Again";
                var button_class = (new_status === "Open Ticket") ? "btn-success" : "btn-warning";
                $(".task_status_button").text(updated_text)
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
<!-- Ticket Status Update End Here -->


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
    $(".ticket_chosen").chosen({
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

<!--  edit task modal -->
<script>
$(document).on('click', '.edit', function() {
    var id = $(this).data('id'); // task id
    var subject = $(this).data('subject');
    var message = $(this).data('message');
    
    // Multiple Id's Selected Chose Here 
    var selectedAdmins = $(this).data("assign"); // Data-assign attribute se value lo
    if (typeof selectedAdmins === "number") {
        selectedAdmins = [selectedAdmins.toString()]; // Number ko string array me convert karo
    } else if (typeof selectedAdmins === "string") {
        selectedAdmins = selectedAdmins.includes(",") ? selectedAdmins.split(",") : [selectedAdmins];
    } else {
        selectedAdmins = []; // Agar undefined ya null ho to empty array
    }
    // Ensure all elements in selectedAdmins are strings
    selectedAdmins = selectedAdmins.map(String);
    $(".edit_assign option").each(function() {
        var optionValue = $(this).val().toString(); // Ensure string comparison
        if (selectedAdmins.includes(optionValue)) {
            $(this).prop("selected", true);
        } else {
            $(this).prop("selected", false);
        }
    });
    $(".edit_assign").trigger("chosen:updated"); // Chosen select update karo







    // alert(selectedAdmins);
    
    var date = $(this).data('date');
    var time = $(this).data('time');
    // Start Here Admin-2025-02-10 CREATED BY ME
    var createdBy = $("#admin_name").val(); // Admin name
    var created_date = date; // Date
    var created_time = time; // Time
    if (created_date) {
        var dateObj = new Date(created_date);
        // Month names array
        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];
        var formattedDate =
            ("0" + dateObj.getDate()).slice(-2) + " " + // DD
            monthNames[dateObj.getMonth()] + " " + // MMM
            dateObj.getFullYear(); // YYYY
        var formattedTime = created_time ? formatTime(created_time) : "";
        $(".created_by").val(createdBy + " - " + formattedDate + " " + formattedTime);
    } else {
        $(".created_by").val(createdBy); 
    }
    // Function to format time in 12-hour format with AM/PM
    function formatTime(timeStr) {
        var timeParts = timeStr.split(":");
        var hours = parseInt(timeParts[0], 10);
        var minutes = timeParts[1] ? timeParts[1].slice(0, 2) : "00"; // Extract minutes properly
        var ampm = hours >= 12 ? "PM" : "AM"; // Set AM/PM correctly
        hours = hours % 12 || 12; // Convert 24-hour to 12-hour format
        // Ensure 2-digit hour and minute format
        var formattedHours = ("0" + hours).slice(-2);
        var formattedMinutes = ("0" + minutes).slice(-2);
        return formattedHours + ":" + formattedMinutes + " " + ampm;
    }
    // End Here Admin-2025-02-10 CREATED BY ME

    $(".edit_ticket_id").val(id);
    $(".form_ticket_id").val(id); // form task id jisse status check krke Completed and Open Again button show krenge
    $(".comment_ticket_id").val(id);
    $(".edit_subject").val(subject);
    // Set message textarea
    $(".edit_message").data("wysihtml5").editor.setValue(message);

    // Ticket Status Fetch Karna
    $.ajax({
        url: "{{url('/get-ticket-status')}}", // API jo task_status return kare
        method: 'GET',
        data: {
            ticket_id: id
        },
        success: function(response) {
            console.log(response);
            if (response.task_status === "Close Ticket") {
                $(".task_status_button").text("Open Again").removeClass("btn-success").addClass(
                    "btn-warning");
            } else if (response.task_status === "Open Ticket") {
                $(".task_status_button").text("Close Ticket").removeClass("btn-warning").addClass(
                    "btn-success");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching task status:", error);
        }
    });
    // Ticket Status Fetch End
    // ticket comment show start here
    $.ajax({
        url: "{{ url('/get-ticket-comments') }}",
        method: 'GET',
        data: {
            ticket_id: id
        },
        success: function(response) {
            console.log(response);
            $('#get_comments').empty();

            response.forEach(function(item) {
                console.log("Raw Date:", item.date);
                var formattedDate = moment(item.date, "YYYY-MM-DD HH:mm:ss").locale('en')
                    .fromNow();
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
    // ticket comment end here
    // Ticket History Data show here
    $.ajax({
        url: "{{ url('/get-ticket-history') }}",
        method: 'GET',
        data: {
            ticket_id: id
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
    // Ticket History data end here
    $("#editticketmodal").modal("show");
});
</script>

<script>
    // Add comment task In Edit Task Pannel Start Here
    $(".add_comment_ticket").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{url('/add_ticket_comment')}}",
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
        url: "{{url('/add_ticket')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                document.getElementById("add_form").reset();
                $("#AddTicketModal").modal("hide");
                swal("Ticket Added Successfully", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                swal("Ticket Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});

// update Ticket Here 
// Edit Task Section Data
$(".edit_ticket").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/update_ticket')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $(".edit_ticket")[0].reset();
                $(".editticketmodal").modal("hide");
                swal("Ticket Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Ticket Update!", "", "error");
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
        }
    });
});
// Edit Task End Here
</script>
<!-- Add Ticket End Here -->

<script>
$(document).ready(function() {
    $('#openModalBtn').on('click', function() {
        $('#AddTicketModal').modal('show');
    });

    $('#saveChangesBtn').on('click', function() {
        alert('Your changes have been saved!');
        $('#AddTicketModal').modal('hide');
    });

    $('#AddTicketModal').on('shown.bs.modal', function() {
        console.log('Modal is now fully visible!');
    });

    $('#AddTicketModal').on('hidden.bs.modal', function() {
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
