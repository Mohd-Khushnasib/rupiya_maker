@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $adminlogin)
@extends('Admin.layouts.master')
@section('main-content')
<style>
div.dataTables_length label {
    float: left;
    text-align: left;
    color: white;
    font-weight: bold;
}

div.dataTables_filter label {
    font-weight: bold;
    color: white;
    float: right;
}

div.dataTables_info {
    padding-top: 8px;
    display: none;
}
</style>

<!-- Main Content Start Here  -->
<div class="container" id="main-container">
    <div id="main-content">
        <div class="page-title lead_page_title ">
            <div>
                <h3><i class="fa fa-file"></i> All PL & OD Login</h3>
            </div>
            <!-- Lead Status Wise Filter Start Here  -->
            <div>
                <select id="leadStatusFilter" class="form-control" onchange="filterTable()" tabindex="1">
                    <option value="" selected>-- Select Login Status --</option>
                    <option value="NEW FILE">NEW FILE</option>
                    <option value="SENT TO BANK">SENT TO BANK</option>
                    <option value="UNDERWRITING">UNDERWRITING</option>
                    <option value="REELOK">REELOK</option>
                    <option value="REELOK-HIGH PRIORITY">REELOK-HIGH PRIORITY</option>
                    <option value="APPROVED">APPROVED</option>
                    <option value="DISBURSED">DISBURSED</option>
                    <option value="DEAL LOST">DEAL LOST</option>
                    <option value="DEAL LOST-CUSTOMER NI">DEAL LOST-CUSTOMER NI</option>
                    <option value="DEAL LOST-ABND">DEAL LOST-ABND</option>
                    <option value="DEAL LOST-OVERLEVRAGED">DEAL LOST-OVERLEVRAGED</option>
                    <option value="DEAL LOST-CIBIL LOW">DEAL LOST-CIBIL LOW</option>
                    <option value="DEAL LOST-BOUNCING">DEAL LOST-BOUNCING</option>
                    <option value="DEAL LOST-LOCATION NOT MAPPED">DEAL LOST-LOCATION NOT MAPPED</option>
                    <option value="DEAL LOST-DISBURSED BY OTHER">DEAL LOST-DISBURSED BY OTHER</option>
                    <option value="DEAL LOST-MULTI LOGIN DISBURSED BY US">DEAL LOST-MULTI LOGIN DISBURSED BY US</option>
                </select>
            </div>

            <!-- Lead Status Wise Filter End Here  -->

            <!-- Date Filter Start Here -->
            <div>
                <form method="GET" action="{{ url('/show_pl_od_login') }}">
                    @csrf
                    <span style="color:white"><b>From</b></span> &ensp;
                    <input type="date" name="fromdate" value="{{ old('fromdate', $fromdatenew ?? '') }}"> &ensp;&ensp;
                    <span style="color:white"><b>To</b></span> &ensp;
                    <input type="date" name="todate" value="{{ old('todate', $enddatenew ?? '') }}"> &emsp;
                    <button class="btn btn-md btn-success">
                        <i class="fa fa-filter"></i> Filter
                    </button>
                </form>
            </div>
            <!-- Date Filter End Here -->



        </div>
        <input type="hidden" name="admin_id" id="admin_id" value="{{$adminlogin->id}}">
        <!-- END Page Title -->
        <div class="row">
            <div class="col-md-12">
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <!-- Multiple Delete Button -->
                            <a id="openDeleteModal"
                                class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip"
                                title="Multiple Delete" href="#"><i class="fa fa-trash-o"></i></a>
                            <!-- Multiple Delete Button -->

                            <a class="btn btn-circle btn-bordered btn-fill btn-to-success show-tooltip"
                                title="Add new record" href="#"><i class="fa fa-plus"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill btn-to-warning show-tooltip"
                                title="Edit selected" href="#"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip"
                                title="Delete selected" href="#"><i class="fa fa-trash-o"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-circle btn-bordered btn-fill show-tooltip" title="Print" href="#"><i
                                    class="fa fa-print"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill show-tooltip" title="Export to PDF"
                                href="#"><i class="fa fa-file-text-o"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill show-tooltip" title="Export to Exel"
                                href="#"><i class="fa fa-table"></i></a>
                        </div>
                        <div class="btn-group">
                            <a class="btn btn-circle btn-bordered btn-fill btn-to-lime show-tooltip" title="Refresh"
                                href="#"><i class="fa fa-repeat"></i></a>
                        </div>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="leadsTable" class="table table-advance leadsTable filterleadsTable">
                            <thead style="background-color: black;">
                                <tr>
                                    <th>#</th>
                                    <th style="width:18px"><input type="checkbox"></th>
                                    <th>Action</th>
                                    <th>Team Name</th>
                                    <th>Manager Name</th>
                                    <th>TL</th>
                                    <th>Agent</th>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Product</th>
                                    <th>Pincode & City</th>
                                    <th>Loan Amount</th>
                                    <th>Company Name</th>
                                    <th>Company Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pl_od_login->isEmpty())
                                @else
                                @php
                                $sr = 1;
                                @endphp
                                @foreach($pl_od_login as $item)
                                <tr>
                                    <td>{{$sr}}</td>
                                    <!-- <td><input type="checkbox"></td> -->
                                    <td><input type="checkbox" class="checkbox" data-id="{{ $item->id }}"></td>
                                    <td>
                                        <a class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip delete"
                                            title="Delete Lead" href="javascript:void(0);" data-id="{{ $item->id }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                    <td>Team 1 </td>
                                    <td>Manager 1 </td>
                                    <td>XYZ</td>
                                    <td>XYZ</td>
                                    <td><a href="{{url('/user_profile/'.$item->id)}}">{{$item->name ?? ''}} </a></td>
                                    <td>
                                        <div class="form-group">
                                            <div class="controls">

                                                <!-- <select tabindex="6" class="chosen form-control leadStatusSelect"  -->
                                                <select tabindex="6" class="form-control leadStatusSelect"
                                                    data-id="{{ $item->id }}" data-selected="{{ $item->login_status }}"
                                                    data-row="{{ $sr }}" data-placeholder="Choose a Category"
                                                    tabindex="1" id="leadStatusSelectChoosen">
                                                    <optgroup label="Designation">
                                                        @php
                                                        $leadStatuses = [
                                                        'NEW FILE', 'SENT TO BANK', 'UNDERWRITING', 'REELOK',
                                                        'REELOK-HIGH PRIORITY',
                                                        'APPROVED', 'DISBURSED', 'DEAL LOST',
                                                        'DEAL LOST-CUSTOMER NI', 'DEAL LOST-ABND', 'DEAL
                                                        LOST-OVERLEVRAGED',
                                                        'DEAL LOST-CIBIL LOW', 'DEAL LOST-BOUNCING', 'DEAL LOST-LOCATION
                                                        NOT MAPPED', 'DEAL LOST-DISBURSED BY OTHER','DEAL LOST-MULTI
                                                        LOGIN DISBURSED BY US'
                                                        ];
                                                        @endphp

                                                        @foreach ($leadStatuses as $status)
                                                        <option value="{{ $status }}"
                                                            {{ strcasecmp($item->login_status, $status) === 0 ? 'selected' : '' }}>
                                                            {{ $status }}
                                                        </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>

                                                <!-- leadStatusModal for editing lead status note Start Here -->
                                                <div id="leadStatusModal" class="modal fade" tabindex="-1" role="dialog"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    style="color:black;font-weight:bold">Remark</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <textarea id="statusTextarea" name="lead_status_note"
                                                                    class="form-control" style="width:100%"></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    id="saveStatus">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Lead Status Modal End Here -->
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Action Button Remark And Task -->
                                    <td>
                                        <select class="form-control action-dropdown" data-leadid="{{ $item->id }}">
                                            <option selected="true" disabled="true">Select</option>
                                            <option value="remark">Remark</option>
                                            <option value="task">Task</option>
                                        </select>
                                    </td>
                                    <!-- Action Button Remark And Task -->
                                    <td>{{$item->product_name ?? ''}}</td>
                                    <td>{{$item->pincode ?? ''}}</td>
                                    <td>₹ {{ number_format($item->loan_amount, 0, '.', ',') }}</td>
                                    <td>{{$item->company_name ?? ''}}</td>
                                    <td>Financial Services</td>
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
        <!-- END Main Content -->
    </div>
    <!-- END Content -->
</div>
<!-- Main Content End Here  -->

<!-- Delete Start Here -->
<div id="deletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Delete Lead</h4>
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



<!-- Multiple Delete Lead Here -->
<div id="multipledeletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Multiple Delete Leads</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete these leads? This action cannot be undone.</p>
                <form id="multiple_delete_form" action="javascript:void(0);" method="post">
                    @csrf
                    <input type="hidden" name="id" id="multiple_delete_id" value="" class="form-control">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between" style="margin-top: 15px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger btn_delete">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Multiple Delete Lead End Here -->




<!-- Remark Modal Start Here From Action Button -->
<div id="remarkModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;font-weight:bold">Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form" action="javascript:void(0);" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{$adminlogin->id}}" name="admin_id">
                    <input type="hidden" id="leadIdInput" name="lead_id">
                    <textarea id="statusTextarea" name="remark" class="form-control" style="width:100%"
                        required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Remark Modal End Here  -->

<!-- Filter Remark Modal Here  -->
<div id="filterRemarkModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="filterRemarkModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterRemarkModalLabel" style="color:black;font-weight:bold">Filter Remark
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="filter_form" action="javascript:void(0);" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{$adminlogin->id}}" name="admin_id">
                    <input type="hidden" id="filterLeadIdInput" name="lead_id">
                    <textarea id="filterRemarkTextarea" rows="4" name="remark" class="form-control"
                        placeholder="Enter remark" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="filterSaveRemarkStatus" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Filter Remark End Here -->

<!-- Task Modal Start Here  -->
<div id="AddTaskModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="task_form" action="javascript:void(0);" method="POST" class="mail-compose form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}">
                        <input type="text" class="form-control" value="{{$adminlogin->name}}" readonly>
                    </div>
                    <input type="hidden" id="taskLeadIdInput" name="lead_id">
                    <div class="form-group">
                        <input type="text" id="taskSubject" name="subject" class="form-control" placeholder="subject">
                    </div>
                    <div class="form-group">
                        <textarea id="taskMessage" name="message" class="form-control wysihtml5" rows="4">
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="task_type[]" data-placeholder="Type Task" class="form-control chosen"
                                    tabindex="6">
                                    <option value="To Do">To Do</option>
                                    <option value="Call">Call</option>
                                    <option value="Pendency">Pendency</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="date" id="taskDate" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="time" id="taskTime" name="time" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="assign[]" id="assignTo" data-placeholder="Assign"
                                    class="form-control chosen" multiple="multiple" tabindex="6">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="modal-footer" style="display: flex; justify-content: start;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-rocket"></i> Add</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Task Modal End Here  -->

<!-- Filter Task Modal Start Here  -->
<div id="filterAddTaskModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="filter_task_form" action="javascript:void(0);" method="POST" class="mail-compose form-horizontal">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}">
                        <input type="text" class="form-control" value="{{$adminlogin->name}}" readonly>
                    </div>
                    <input type="hidden" id="filtertaskLeadIdInput" name="lead_id">
                    <div class="form-group">
                        <input type="text" name="subject" class="form-control" placeholder="subject">
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control wysihtml5" rows="4">
                        </textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="task_type[]" data-placeholder="Type Task" class="form-control chosen"
                                    tabindex="6">
                                    <option value="To Do">To Do</option>
                                    <option value="Call">Call</option>
                                    <option value="Pendency">Pendency</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="time" name="time" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="assign[]" data-placeholder="Assign" class="form-control chosen"
                                    multiple="multiple" tabindex="6">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="modal-footer" style="display: flex; justify-content: start;">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-rocket"></i> Add</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Filter Task Modal End Here  -->

<!-- Filter Lead Status Modal Start Here -->
<div id="filterleadStatusModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black;font-weight:bold">Filter Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="filterstatusTextarea" name="lead_status_note" class="form-control"
                    style="width:100%"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="filtersaveStatus">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Filter Lead Status Modal End Here -->




<!-- JS Links Start Here -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>   -->
<!-- <script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- DataTables Start Here -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>

<!-- Multiple checkbox to delete Start Here -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let selectedIds = [];
    document.querySelectorAll(".checkbox").forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            let id = this.getAttribute("data-id");
            if (this.checked) {
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            } else {
                selectedIds = selectedIds.filter(item => item !== id);
            }
        });
    });
    // Modal Open and Set Selected IDs
    document.getElementById("openDeleteModal").addEventListener("click", function() {
        if (selectedIds.length > 0) {
            document.getElementById("multiple_delete_id").value = selectedIds.join(", ");
            $("#multipledeletemodal").modal("show");
        } else {
            swal("No IDs selected!", "Please select at least one checkbox.", "warning");
        }
    });
    // Multiple Delete Form Submission
    $("#multiple_delete_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("id", selectedIds.join(",")); // Sending selected IDs
        $.ajax({
            type: "POST",
            url: "{{url('/multiple_delete_lead')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                if (data.success === 'success') {
                    $("#multipledeletemodal").modal("hide");
                    $("#multiple_delete_form")[0].reset();
                    swal("Multiple Leads Deleted Successfully!", "", "success");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                } else {
                    swal('Leads Not Deleted', '', 'error');
                }
            },
            error: function(error) {
                swal('Something Went Wrong!', '', 'error');
            }
        });
    });
});
</script>
<!-- Multiple checkbox to delete End Here -->


<!-- Sibgle Delete Lead Start Here -->
<script>
$(document).on('click', '.delete', function() {
    var id = $(this).data("id");
    alert(id);
    $("#delete_id").val(id);
    $("#deletemodal").modal("show");
});

// delete here
$("#delete_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "{{url('/delete_lead')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $("#deletemodal").modal("hide");
                $("#delete_form")[0].reset();
                swal("Lead Delete Successfully! ", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                swal('Lead Not Added', '', 'error');
            }
        },
        error: function(error) {
            swal('Something Went Wrong!', '', 'error');
        }
    });
});
</script>
<!-- Sibgle Delete Lead End Here -->


<!-- Remark Js Start Here From Action Button -->
<script>
$(document).ready(function() {
    $(".action-dropdown").change(function() {
        var selectedValue = $(this).val();
        var leadId = $(this).data("leadid");

        if (selectedValue === "remark") {
            $("#leadIdInput").val(leadId);
            $("#remarkModal").modal("show");
        } else if (selectedValue === "task") {
            $("#taskLeadIdInput").val(leadId);
            $("#AddTaskModal").modal("show");
        }
    });
});
</script>
<!-- Add Remark -->
<script>
$("#add_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_remark')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                document.getElementById("add_form").reset();
                $("#remarkModal").modal("hide");
                swal("Remark Added Successfully", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                $(".btn_submit").prop("disabled", false);
                swal("Remark Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});

// filter_form
$("#filter_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_remark')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                document.getElementById("filter_form").reset();
                $("#filterRemarkModal").modal("hide");
                swal("Remark Added Successfully", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                $(".btn_submit").prop("disabled", false);
                swal("Remark Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});
</script>


<!-- Database Start Here -->
<script>
$(document).ready(function() {
    $('.leadsTable').DataTable({
        "pageLength": 100,
        dom: 'Bfrtip'
    });
});
</script>
<!-- Datatable End Here -->


<!-- Onchange Lead Status Start Here  -->
<script>
// After Filter Here
function filterTable() {
    var selectedStatus = $('#leadStatusFilter').val();
    $.ajax({
        type: "POST",
        url: "{{url('filter_leads')}}",
        data: {
            login_status: selectedStatus
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            var tbody = $("#leadsTable tbody");
            tbody.html('');

            if (data.data && data.data.length > 0) {
                data.data.forEach(function(item, index) {
                    var leadStatuses = [
                        'NEW FILE', 'SENT TO BANK', 'UNDERWRITING', 'REELOK',
                        'REELOK-HIGH PRIORITY',
                        'APPROVED', 'DISBURSED', 'DEAL LOST',
                        'DEAL LOST-CUSTOMER NI', 'DEAL LOST-ABND', 'DEAL LOST-OVERLEVRAGED',
                        'DEAL LOST-CIBIL LOW', 'DEAL LOST-BOUNCING',
                        'DEAL LOST-LOCATION NOT MAPPED', 'DEAL LOST-DISBURSED BY OTHER',
                        'DEAL LOST-MULTI LOGIN DISBURSED BY US'
                    ];

                    // Generate lead status dropdown options
                    var leadStatusOptions = leadStatuses.map(function(status) {
                        var selected = item.login_status === status ? 'selected' : '';
                        return `<option value="${status}" ${selected}>${status}</option>`;
                    }).join('');

                    // Action dropdown (replacing the lost lead status dropdown)
                    var actionDropdown = `
                        <select class="form-control action-dropdown" data-leadid="${item.id}">
                            <option selected="true" disabled="true">Select</option>
                            <option value="remark">Remark</option>
                            <option value="task">Task</option>
                        </select>
                    `;

                    // Append the row
                    tbody.append(`
                        <tr>
                            <td><input type="checkbox"></td>
                            <td>${index + 1}</td>
                            <td>Team 1</td>
                            <td>Manager 1</td>
                            <td>XYZ</td>
                            <td>XYZ</td>
                            <td><a href="{{url('/user_profile/${item.id}')}}">${item.name ?? ''}</a></td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control filterleadStatusSelect"
                                    data-id="${item.id}" data-selected="${item.login_status}"
                                    data-row="${index + 1}" tabindex="1">
                                    ${leadStatusOptions}
                                    </select>
                                </div>
                            </td>
                            <td>${actionDropdown}</td>
                            <td>${item.product_name ?? ''}</td>
                            <td>${item.pincode ?? ''}</td>
                            <td>₹ ${new Intl.NumberFormat('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(item.loan_amount)}</td>
                            <td>${item.company_name ?? ''}</td>
                            <td>Financial Services</td>
                        </tr>
                    `);
                });
                // Add event listener to action dropdown

                // Filter For Remark
                $(".action-dropdown").on('change', function() {
                    var selectedAction = $(this).val(); // Get the remark
                    var leadId = $(this).data('leadid'); // Get the associated leadId
                    var adminId = $("#admin_id").val(); // Get the admin id
                    if (selectedAction === 'remark') {
                        // Set the values for leadId and adminId in the modal form
                        $('#filterLeadIdInput').val(leadId); // Set leadId in the input field
                        $('#filterRemarkTextarea').data('remark',
                        selectedAction); // Store selectedAction in the textarea
                        $('#filterRemarkModal').modal('show');
                    }
                    // Filter For task
                    else if (selectedAction === "task") {
                        $("#filtertaskLeadIdInput").val(leadId);
                        $("#filterAddTaskModal").modal("show");
                    }
                });
                // End Filter For Remark

                // Filter Lead Status Change Here Onchange
                $("#leadsTable").on('change', '.filterleadStatusSelect', function() {
                    var selectedStatus = $(this).val(); // lead status
                    var leadId = $(this).data('id'); // lead id
                    var modal = $('#filterleadStatusModal');
                    var textarea = $('#filterstatusTextarea');

                    modal.modal('show');
                    $('#filtersaveStatus').off('click').on('click', function() {
                        var updatedStatus = textarea.val(); // Get updated status

                        var formData = new FormData();
                        var admin_id = $("#admin_id").val();
                        formData.append('admin_id', admin_id); // admin id
                        formData.append('id', leadId); // lead id
                        formData.append('login_status',
                        selectedStatus); // updated lead status

                        $.ajax({
                            type: "POST",
                            url: "{{ url('/changeleadstatus') }}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            encode: true,
                            success: function(data) {
                                if (data.success == 'success') {
                                    swal("Lead Status Updated Successfully", "",
                                        "success");
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 1000);
                                } else {
                                    swal("Lead Status Not Updated!", "",
                                        "error");
                                }
                            },
                            error: function(errResponse) {
                                swal("Something Went Wrong!", "", "error");
                            }
                        });
                        modal.modal('hide');
                    });
                });
                // End Filter For Remark



            } else {
                tbody.append(`<tr><td colspan="15" class="text-center">No Leads Found</td></tr>`);
            }
        },
        error: function(err) {
            swal("Error", "Failed to fetch data. Please try again.", "error");
        }
    });
}
</script>
<!-- Onchange Lead Status End Here  -->



<script>
// Lead Status Change Start Here
document.querySelectorAll('.leadStatusSelect').forEach(function(selectElement) {
    selectElement.addEventListener('change', function() {
        // Show modal and set the current status to the textarea
        var selectedStatus = this.value; // lead status
        var id = this.getAttribute('data-id'); // lead id
        // Show the modal and populate the textarea with the selected status
        var modal = $('#leadStatusModal');
        var textarea = $('#statusTextarea');
        // textarea.val(selectedStatus);

        // Open the modal
        modal.modal('show');

        // On saving the new status
        $('#saveStatus').off('click').on('click', function() {
            var updatedStatus = textarea.val(); // remark

            var formData = new FormData();
            var admin_id = $("#admin_id").val();
            formData.append('admin_id', admin_id); // admin id
            formData.append('id', id); // lead id
            formData.append('login_status', selectedStatus); // updated lead status
            formData.append('remark', updatedStatus); // remark lead_status_note

            $.ajax({
                type: "POST",
                url: "{{ url('/changeloginstatus') }}",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                encode: true,
                success: function(data) {
                    if (data.success == 'success') {
                        swal("Login Status Updated Successfully", "", "success");
                        setTimeout(function() {
                            location.reload(
                                true); // Reload the page after update
                        }, 1000);
                    } else {
                        swal("Login Status Not Updated!", "", "error");
                    }
                },
                error: function(errResponse) {
                    swal("Something Went Wrong!", "", "error");
                }
            });
            // Close modal after submission
            modal.modal('hide');
        });
    });
});
// Lead Status Change End Here
</script>

<script>
$("#task_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_task')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                document.getElementById("task_form").reset();
                $("#AddTaskModal").modal("hide");
                swal("Task Added Successfully", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                swal("Task Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});
// Filter Add Task
$("#filter_task_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_task')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                document.getElementById("task_form").reset();
                $("#filterAddTaskModal").modal("hide");
                swal("Task Added Successfully", "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            } else {
                swal("Task Not Added", "", "error");
            }
        },
        error: function(err) {}
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