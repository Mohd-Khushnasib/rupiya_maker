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
                <select id="leadStatusFilter" class="form-control" tabindex="1">
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
                <span style="color:white"><b>From</b></span> &ensp;
                <input type="date" id="fromdate"> &ensp;&ensp;
                <span style="color:white"><b>To</b></span> &ensp;
                <input type="date" id="todate"> &emsp;
                <button type="button" id="DateFilter" class="btn btn-md btn-success">
                    <i class="fa fa-filter"></i> Filter
                </button>
            </div>
            <!-- Date Filter End Here -->

        </div>
        <input type="hidden" name="admin_id" id="admin_id" value="{{$adminlogin->id}}">
        <!-- END Page Title -->
        <div class="row">

            <!-- Activity Date Filter Start Here -->
            <div class="col-sm-12">
                <!-- Date Filter Start Here -->
                <div>
                    <span style="color:white"><b>From Activity Date</b></span> &ensp;
                    <input type="date" id="activityfromdate"> &ensp;
                    <button type="button" id="ActivityDateFilter" class="btn btn-md btn-success">
                        <i class="fa fa-filter"></i> Activity Filter
                    </button> &ensp;
                    <button type="button" id="resetFilters" class="btn btn-md btn-danger">
                        <i class="fa fa-refresh"></i> Reset
                    </button>
                </div>
            <!-- Date Filter End Here -->
            </div>
            <!-- Activity Date Filter End Here -->


            <div class="col-md-12">
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                           
                        <a href="javascript:void(0);" class="" id="exportButtonExcel"><img width="30" height="30" src="https://img.icons8.com/color/30/export-excel.png" alt="ms-excel"/></a>

                            <!-- Search Data Start Here -->
                            <input type="text" class="search_data" placeholder="Search Here">
                            <!-- Search Data End Here -->

                        </div>
                        <div class="btn-group">
                             <!-- Multiple Delete Button -->
                            <a id="openDeleteModal" class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip" 
                            title="Delete selected" href="#"><i class="fa fa-trash-o"></i></a>
                            <!-- Multiple Delete Button -->
                        </div>
                    </div>
                    <br><br>
                    <div class="table-responsive">
                        <table id="leadsTablenew" class="table table-advance leadsTablenew filterleadsTablenew">
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
                                    <th>Date</th>
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
                            </tbody>
                        </table>

                        <!-- Pagination links will be Start here -->
                        <nav class="mt-2">
                            <ul id="pagination" class="pagination" style="display: flex;justify-content: center;">
                            </ul>
                        </nav>
                        <!-- Pagination links will be End here -->
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- END Main Content -->
    </div>
    <!-- END Content -->
</div>
<!-- Main Content End Here  -->
<input type="hidden"  id="search"/>


<!-- Delete Start Here -->
<div id="deletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Delete Login</h4>
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
                <h4 class="modal-title" style="color: black;" id="exampleModalLabel">Multiple Delete Login</h4>
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
<div id="filterRemarkModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="filterRemarkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterRemarkModalLabel" style="color:black;font-weight:bold">Filter Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="filter_form" action="javascript:void(0);" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{$adminlogin->id}}" name="admin_id">
                    <input type="hidden" id="filterLeadIdInput" name="lead_id">
                    <textarea id="filterRemarkTextarea" rows="4" name="remark" class="form-control" placeholder="Enter remark" required></textarea>
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
                                <select name="assign[]" data-placeholder="Assign"
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
<!-- Filter Task Modal End Here  -->

<!-- Filter Lead Status Modal Start Here -->
<div id="filterleadStatusModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    style="color:black;font-weight:bold">Filter Remark</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="filterstatusTextarea" name="login_status_note"
                    class="form-control" style="width:100%"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="filtersaveStatus">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Filter Lead Status Modal End Here -->


<!-- JS Links Start Here -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- JS Links Start Here -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- DataTables Start Here -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>


<!-- XL Export Linking Start Here  -->
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- XL Export Code Start Here  -->
    <script>
    const { jsPDF } = window.jspdf;
    // Export       
    $('#exportButtonExcel').on('click', function() 
    {
        $.ajax({
            url: "{{url('export_to_excel_plodlogin')}}",
            type: 'GET',
            data: {
                search: searchKeyword,
                login_status: login_status,
                from_date: fromDate,
                to_date: toDate,
                activity_from_date: activityfromDate,
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.data) {
                    // Create a new Workbook and Worksheet
                    var workbook = XLSX.utils.book_new();
                    // Remove anchor tags and their contents from the data
                    var cleanedData = result.data.map(function(row) {
                        var cleanedRow = Object.assign({}, row);
                        for (var key in cleanedRow) {
                            if (cleanedRow.hasOwnProperty(key) && typeof cleanedRow[key] === 'string') {
                                cleanedRow[key] = cleanedRow[key].replace(/<a\b[^>]>(.?)<\/a>/g, '');
                            }
                        }
                        return cleanedRow;
                    });
                    // Convert the data to a worksheet
                    var worksheet = XLSX.utils.json_to_sheet(cleanedData);
                    // Add the Worksheet to the Workbook
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
                    // Convert the Workbook to an Excel file
                    var excelData = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
                    // Save the Excel file as a Blob
                    var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                    var isAndroid = /Android/i.test(navigator.userAgent);
                    saveAs(blob, 'PlOdLogin.xlsx');
                }
            }
        });
    });
    </script>
    <!-- XL Export Code End Here -->








<!-- Pagination With login_status and date filter Start Here  -->
<script>
    let currentPage = 1;
    let searchKeyword = '';
    let login_status = '';
    let fromDate = '';
    let toDate = '';
    let activityfromDate = '';

$(document).ready(function() {
    view_enquiry_api(); // Initial load
    // Searching here 
    $('.search_data').on('input', function() {
        searchKeyword = $(this).val();
        if (searchKeyword.length >= 3 || searchKeyword.length === 0) {
            currentPage = 1;
            view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate, activityfromDate);
        }
    });
    // Date filter here 
    $('#DateFilter').on('click', function() {
        fromDate = $('#fromdate').val();
        toDate = $('#todate').val();
        view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate, activityfromDate);
    });
    // Activity Date filter here 
    $('#ActivityDateFilter').on('click', function() {
        activityfromDate = $('#activityfromdate').val();
        view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate, activityfromDate);
    });
    // Lead status filter call here 
    $('#leadStatusFilter').on('change', function() {
        login_status = $(this).val();
        view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate, activityfromDate);
    });

    // Reset All Filter Here
    $("#resetFilters").click(function () {
        $("#leadStatusFilter").val("");
        $("#fromdate").val("");
        $("#todate").val("");
        $("#activityfromdate").val("");
        $(".search_data").val("");
        view_enquiry_api(currentPage, "", "", "", "", "");
    });
    // Reset All Filter Here

});

// Initial Function 
function view_enquiry_api(page = 1, search = '', login_status = '', fromDate = '', toDate = '', activityfromDate='') {
    const search_data = search || $(".search_data").val();
    $.ajax({
        url: "{{ url('show_Pl_Od_loginapi') }}",
        type: 'POST',
        data: {
            search: search_data,
            page: page,
            login_status: login_status,
            from_date: fromDate,
            to_date: toDate,
            activity_from_date: activityfromDate
        },
        success: function(data) {
            console.log(data);
            const tbody = $("#leadsTablenew tbody");
            const pagination = $('#pagination');
            tbody.empty();
            pagination.empty();
             // for indexing start here 
             var total_enquiries = data.total;
            var per_page = data.per_page;
            var start_serial_number = (page - 1) * per_page;
            // for indexing end here

            if (data.data && data.data.length > 0) {
                data.data.forEach((item, index) => {
                    const leadStatuses = [
                        'NEW FILE', 'SENT TO BANK', 'UNDERWRITING', 'REELOK', 'REELOK-HIGH PRIORITY',
                        'APPROVED', 'DISBURSED', 'DEAL LOST',
                        'DEAL LOST-CUSTOMER NI', 'DEAL LOST-ABND', 'DEAL LOST-OVERLEVRAGED', 'DEAL LOST-CIBIL LOW',
                        'DEAL LOST-BOUNCING', 'DEAL LOST-LOCATION NOT MAPPED',
                        'DEAL LOST-DISBURSED BY OTHER', 'DEAL LOST-MULTI LOGIN DISBURSED BY US'
                    ];

                    const leadStatusOptions = leadStatuses.map(status => 
                        `<option value="${status}" ${item.login_status === status ? 'selected' : ''}>${status}</option>`
                    ).join('');

                    const actionDropdown = `
                        <select class="form-control action-dropdown" data-leadid="${item.id}">
                            <option selected disabled>Select</option>
                            <option value="remark">Remark</option>
                            <option value="task">Task</option>
                        </select>
                    `;

                    var serial_number = start_serial_number + index + 1;  // for indexing 
                    tbody.append(`
                        <tr>
                            <td>${serial_number}</td>
                            <td><input type="checkbox" class="checkbox" data-id="${item.id}"></td>
                            <td>
                                <a class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip delete" 
                                    title="Delete Lead" 
                                    href="javascript:void(0);" 
                                    data-id="${item.id}">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                            <td>Team 1</td>
                            <td>Manager 1</td>
                            <td>XYZ</td>
                            <td>XYZ</td>
                            <td><a href="{{url('/user_profile/${item.id}')}}">${item.name ?? ''}</a></td>
                            <td>${item.date ?? ''}</td>
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
                $(".action-dropdown").on('change', function() {
                    const selectedAction = $(this).val();
                    const leadId = $(this).data('leadid');
                    const adminId = $("#admin_id").val();

                    if (selectedAction === 'remark') {
                        $('#filterLeadIdInput').val(leadId);
                        $('#filterRemarkTextarea').data('remark', selectedAction);
                        $('#filterRemarkModal').modal('show');
                    } else if (selectedAction === "task") {
                        $("#filtertaskLeadIdInput").val(leadId);
                        $("#filterAddTaskModal").modal("show");
                    }
                });

                // Filter Lead Status Change Here Onchange
                $("#leadsTablenew").on('change', '.filterleadStatusSelect', function() {
                    const dropdown = $(this);  // current dropdown status   addon
                    const originalStatus = dropdown.data('selected'); // Store original status  addon 

                    const selectedStatus = $(this).val();
                    const leadId = $(this).data('id');
                    const modal = $('#filterleadStatusModal');
                    const textarea = $('#filterstatusTextarea');

                    modal.modal('show');  // modal show here 

                    // Handle modal close event like new lead to in progress but not submit then previous status show 
                    modal.off('hidden.bs.modal').on('hidden.bs.modal', function () {
                        dropdown.val(originalStatus); // Reset dropdown to original status if modal is closed
                    });
                    // end here 
                    

                    $('#filtersaveStatus').off('click').on('click', function() {
                        var remark = $("#filterstatusTextarea").val();  // remark validation here 
                        if (remark) {} else {
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.error('Remark required');
                            return;
                        }

                        const updatedStatus = textarea.val();
                        const formData = new FormData();
                        const admin_id = $("#admin_id").val();
                        formData.append('admin_id', admin_id);
                        formData.append('id', leadId);
                        formData.append('login_status', selectedStatus);
                        formData.append('remark', remark);
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/changeloginstatus') }}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            encode: true,
                            success: function(data) {
                                if (data.success === 'success') {
                                    // filterleadStatusModal
                                    swal("Login Status Updated Successfully", "", "success");
                                    $("#filterstatusTextarea").val(""); // Reset textarea
                                    $("#filterleadStatusModal").modal("hide"); // Hide modal
                                    view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate, activityfromDate);
                                } else {
                                    swal("Login Status Not Updated!", "", "error");
                                }
                            },
                            error: function(errResponse) {
                                swal("Something Went Wrong!", "", "error");
                            }
                        });
                        modal.modal('hide');
                    });
                });

                // Generate pagination links
                if (data.last_page > 1) {
                    generatePaginationLinks(data.current_page, data.last_page, search_data, login_status, fromDate, toDate, activityfromDate);
                }
            } else {
                tbody.append(`<tr><td colspan="15" class="text-center">No Leads Found</td></tr>`);
            }
        },
        error: function(err) {
            swal("Error", "Failed to fetch data. Please try again.", "error");
        }
    });
}

// Pagination function here 
function generatePaginationLinks(currentPage, lastPage, searchKeyword, login_status, fromDate, toDate, activityfromDate) {
    const pagination = $('#pagination');
    pagination.html('');

    if (currentPage > 3) {
        pagination.append(`
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(1, '${searchKeyword}', '${login_status}', '${fromDate}', '${toDate}','${activityfromDate}')">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(2, '${searchKeyword}', '${login_status}', '${fromDate}', '${toDate}','${activityfromDate}')">2</a>
            </li>
            <li class="page-item disabled"><a class="page-link">...</a></li>
        `);
    }

    for (let i = Math.max(1, currentPage - 2); i <= Math.min(lastPage, currentPage + 2); i++) {
        pagination.append(`
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${i}, '${searchKeyword}', '${login_status}', '${fromDate}', '${toDate}','${activityfromDate}')">${i}</a>
            </li>
        `);
    }

    if (currentPage < lastPage - 2) {
        pagination.append(`
            <li class="page-item disabled"><a class="page-link">...</a></li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${lastPage - 1}, '${searchKeyword}', '${login_status}', '${fromDate}', '${toDate}','${activityfromDate}')">${lastPage - 1}</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${lastPage}, '${searchKeyword}', '${login_status}', '${fromDate}', '${toDate}','${activityfromDate}')">${lastPage}</a>
            </li>
        `);
    }
}
</script>
<!-- Pagination With login_status and date filter End Here  -->




<!-- Multiple checkbox to delete Start Here -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let selectedIds = [];

    // Event delegation for dynamically added checkboxes
    document.addEventListener("change", function (event) {
        if (event.target.classList.contains("checkbox")) {
            let id = event.target.getAttribute("data-id");
            // alert(id);  // Check if the event is firing

            if (event.target.checked) {
                if (!selectedIds.includes(id)) {
                    selectedIds.push(id);
                }
            } else {
                selectedIds = selectedIds.filter(item => item !== id);
            }
        }
    });

    // Modal Open and Set Selected IDs
    document.getElementById("openDeleteModal").addEventListener("click", function () {
        if (selectedIds.length > 0) {
            document.getElementById("multiple_delete_id").value = selectedIds.join(", ");
            $("#multipledeletemodal").modal("show");
        } else {
            swal("No IDs selected!", "Please select at least one checkbox.", "warning");
        }
    });

    // Multiple Delete Form Submission
    $("#multiple_delete_form").submit(function (e) {
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
            success: function (data) {
                if (data.success === 'success') {
                    $("#multipledeletemodal").modal("hide");
                    $("#multiple_delete_form")[0].reset();
                    swal("Multiple Leads Deleted Successfully!", "", "success");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    swal('Leads Not Deleted', '', 'error');
                }
            },
            error: function (error) {
                swal('Something Went Wrong!', '', 'error');
            }
        });
    });
});

</script>
<!-- Multiple checkbox to delete End Here -->










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
                swal("Remark Added Successfully okok", "", "success");
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
                view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate);
                // setTimeout(function() {
                //     window.location.reload();
                // }, 1000);
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
// $(document).ready(function() {
//     $('.leadsTablenew').DataTable({
//         "pageLength": 100,
//         dom: 'Bfrtip'
//     });
// });
</script>
<!-- Datatable End Here -->



<!-- // Lead Status Change Start Here  -->
<script>
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
            formData.append('remark', updatedStatus); // remark login_status_note

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
</script>
<!-- // Lead Status Change End Here -->


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
                swal("Task Added Successfully Filetr", "", "success");
                view_enquiry_api(currentPage, searchKeyword, login_status, fromDate, toDate); // after submit page not reload and all data show
                // setTimeout(function() {
                //     window.location.reload();
                // }, 1000);
            } else {
                swal("Task Not Added", "", "error");
            }
        },
        error: function(err) {}
    });
});
</script>





<!-- Single Delete Lead Start Here -->
<script>
$(document).on('click', '.delete', function() {
    var id = $(this).data("id");
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


// Export 

          
$('#exportButtonPdf').on('click', function() 
{
    $.ajax({
        url: "{{url('partner/export_to_excel')}}",
        type: 'GET',
        data: {
            search: search_data,
            page: page,
            login_status: login_status,
            from_date: fromDate,
            to_date: toDate
        },
        success: function(response) {
            var result = JSON.parse(response);
            if (result.data) {
                // Remove anchor tags and their contents from the data
                var cleanedData = result.data.map(function(row, index) {
                    var cleanedRow = Object.assign({}, row);
                    cleanedRow["Sr No."] = index + 1; // Add "Sr No." column with sequential numbers
                    for (var key in cleanedRow) {
                        if (cleanedRow.hasOwnProperty(key) && typeof cleanedRow[key] === 'string') {
                            cleanedRow[key] = cleanedRow[key].replace(/<a\b[^>]>(.?)<\/a>/g, '');
                        }
                    }
                    return cleanedRow;
                });

                // Get the table headers from the keys of the first object
                let headers = Object.keys(cleanedData[0]);

                // Move "Sr No." to the first column position
                headers = ["Sr No.", ...headers.filter(header => header !== "Sr No.")];

                // Create a new jsPDF instance in landscape mode
                const doc = new jsPDF('l', 'mm', 'a4');

                // Set font size to be smaller
                const fontSize = 8; // Smaller font size
                doc.setFontSize(fontSize);

                // Calculate column widths
                const pageWidth = doc.internal.pageSize.width - 20; // Page width with margin
                const columnCount = headers.length;
                const columnWidth = pageWidth / columnCount; // Divide the available page width by the number of columns

                // Generate the PDF table
                doc.autoTable({
                    head: [headers],
                    body: cleanedData.map(row => headers.map(header => String(row[header] || ''))),
                    theme: 'grid', // Optional: 'grid', 'striped', 'plain'
                    styles: {
                        fontSize: fontSize, // Apply the smaller font size
                        cellPadding: 1, // Adjust padding for smaller font
                        overflow: 'linebreak'
                    },
                    headStyles: {
                        fillColor: [22, 160, 133], // Custom header background color
                        textColor: [255, 255, 255], // Custom header text color
                        fontSize: fontSize + 1, // Slightly larger font size for headers
                        fontStyle: 'bold'
                    },
                    columnStyles: headers.reduce((styles, header, index) => {
                        styles[index] = { cellWidth: columnWidth };
                        return styles;
                    }, {}),
                    margin: { top: 10 }, // Adjust margin as needed
                    pageBreak: 'auto', // Automatically handle page breaks if needed
                    startY: 20 // Adjust the starting vertical position
                });

                // Save the PDF
                doc.save('income.pdf');
            }
        }
    });
});

</script>
<!-- Single Delete Lead End Here -->


@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif