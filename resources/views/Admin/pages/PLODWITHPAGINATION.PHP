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
                <h3><i class="fa fa-file"></i> All PL & OD Leads</h3>
            </div>
            <!-- Lead Status Wise Filter Start Here  -->
            <div>
                <select id="leadStatusFilter" class="form-control" tabindex="1">
                    <option value="" selected>-- Select Lead Status --</option>
                    <option value="NEW LEAD">NEW LEAD</option>
                    <option value="IN PROGRESS">IN PROGRESS</option>
                    <option value="FOLLOW UP">FOLLOW UP</option>
                    <option value="CALLBACK">CALLBACK</option>
                    <option value="IMPORTANT LEADS">IMPORTANT LEADS</option>
                    <option value="LONG FOLLOW UP LEADS">LONG FOLLOW UP LEADS</option>
                    <option value="NOT INTERESTED">NOT INTERESTED</option>
                    <option value="IN DOCUMENTATION">IN DOCUMENTATION</option>
                    <option value="FILE COMPLETED">FILE COMPLETED</option>
                    <option value="LOST LEADS">LOST LEADS</option>
                    <option value="LOST LEADS-SELF EMPLOYED">LOST LEADS-SELF EMPLOYED</option>
                    <option value="LOST LEADS-OVERLEVRAGED">LOST LEADS-OVERLEVRAGED</option>
                    <option value="LOST LEADS-CIBIL LOW">LOST LEADS-CIBIL LOW</option>
                    <option value="LOST LEADS-BOUNCING IN LATEST 3 MONTHS">LOST LEADS-BOUNCING IN LATEST 3 MONTHS</option>
                    <option value="LOST LEADS-REGULAR BOUNCING">LOST LEADS-REGULAR BOUNCING</option>
                    <option value="LOST LEADS-ALREADY DISBURSED BY OTHER">LOST LEADS-ALREADY DISBURSED BY OTHER</option>
                    <option value="LOST LEADS-OTHER REASON">LOST LEADS-OTHER REASON</option>
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
            <div class="col-md-12">
                <div class="box-content">
                    <div class="btn-toolbar pull-right">
                        <div class="btn-group">
                           
                        <a href="javascript:void(0);" class="" id="exportButtonExcel"><img width="30" height="30" src="https://img.icons8.com/color/30/export-excel.png" alt="ms-excel"/></a>
                                            <a href="javascript:void(0);" class="mt-4" id="exportButtonPdf"><img width="30" height="30" src="https://img.icons8.com/color/30/export-pdf.png" alt="ms-excel"/></a>

                            <input type="text" class="search_data">
                            <!-- <a class="btn btn-circle btn-bordered btn-fill btn-to-success show-tooltip"
                                title="Add new record" href="#"><i class="fa fa-plus"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill btn-to-warning show-tooltip"
                                title="Edit selected" href="#"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip"
                                title="Delete selected" href="#"><i class="fa fa-trash-o"></i></a> -->
                        </div>
                        <div class="btn-group">
                             <!-- Multiple Delete Button -->
                             <a id="openDeleteModal" class="btn btn-circle btn-bordered btn-fill btn-to-danger show-tooltip" 
                            title="Delete selected" href="#"><i class="fa fa-trash-o"></i></a>
                            <!-- Multiple Delete Button -->

                            <!-- <a class="btn btn-circle btn-bordered btn-fill show-tooltip" title="Print" href="#"><i
                                    class="fa fa-print"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill show-tooltip" title="Export to PDF"
                                href="#"><i class="fa fa-file-text-o"></i></a>
                            <a class="btn btn-circle btn-bordered btn-fill show-tooltip" title="Export to Exel"
                                href="#"><i class="fa fa-table"></i></a> -->
                        </div>
                        <div class="btn-group">
                            <!-- <a class="btn btn-circle btn-bordered btn-fill btn-to-lime show-tooltip" title="Refresh"
                                href="#"><i class="fa fa-repeat"></i></a> -->
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
                <textarea id="filterstatusTextarea" name="lead_status_note"
                    class="form-control" style="width:100%"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"
                    id="filtersaveStatus">Save</button>
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


<!-- Onchange Lead Status Start Here  -->
<script>

    let currentPage = 1;
    var fromDate ='';
    var toDate ='';
    var lead_status ='';
    var searchKeyword='';


$(document).ready(function() {

    view_enquiry_api(); // Initial load
  

    $('.search_data').keyup(function() {
        var searchKeyword = $(this).val();
        if (searchKeyword.length >= 3) {
            currentPage = 1;
            view_enquiry_api(currentPage, searchKeyword);
        } else {
            view_enquiry_api(currentPage);
        }
    });

    $('#DateFilter').on('click', function() {
        var fromDate = $('#fromdate').val();
        var toDate = $('#todate').val();
        view_enquiry_api(currentPage, searchKeyword, lead_status, fromDate, toDate);
    });
});


// Intial Function 
function view_enquiry_api(page = 1, search = '', lead_status = '', fromDate = '', toDate = '') {
    var affiliate_id = $("#affiliate_id").val();
    var search_data = search || $(".search_data").val();

    $.ajax({
        url: "{{ url('show_Pl_Od_LeadAPI') }}",
        type: 'POST',
        data: {
            search: search_data,
            page: page,
            lead_status: lead_status,
            from_date: fromDate,
            to_date: toDate
        },
        success: function(data) {

            console.log(data);
            var tbody = $("#leadsTablenew tbody");
            var pagination = $('#pagination');
            tbody.empty();
            pagination.empty();

            if (data.data && data.data.length > 0) {
                
                data.data.forEach(function(item, index) 
                {
                    var leadStatuses = [
                        'NEW LEAD', 'IN PROGRESS', 'FOLLOW UP', 'CALLBACK', 'IMPORTANT LEADS',
                        'LONG FOLLOW UP LEADS', 'NOT INTERESTED', 'IN DOCUMENTATION',
                        'FILE COMPLETED', 'LOST LEADS', 'LOST LEADS-SELF EMPLOYED', 'LOST LEADS-OVERLEVRAGED',
                        'LOST LEADS-CIBIL LOW', 'LOST LEADS-BOUNCING IN LATEST 3 MONTHS',
                        'LOST LEADS-REGULAR BOUNCING', 'LOST LEADS-ALREADY DISBURSED BY OTHER', 'LOST LEADS-OTHER REASON'
                    ];

                    // Generate lead status dropdown options
                    var leadStatusOptions = leadStatuses.map(function(status) {
                        var selected = item.lead_status === status ? 'selected' : '';
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
                                    data-id="${item.id}" data-selected="${item.lead_status}"
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
                            <td>Company Category</td>
                        </tr>
                    `);
                });

                // Add event listener to action dropdown
                $(".action-dropdown").on('change', function() 
                {
                    var selectedAction = $(this).val(); // Get the remark
                    var leadId = $(this).data('leadid'); // Get the associated leadId
                    var adminId = $("#admin_id").val(); // Get the admin id
                    if (selectedAction === 'remark') {
                        // Set the values for leadId and adminId in the modal form
                        $('#filterLeadIdInput').val(leadId); // Set leadId in the input field
                        $('#filterRemarkTextarea').data('remark', selectedAction); // Store selectedAction in the textarea
                        $('#filterRemarkModal').modal('show');
                    }
                    // Filter For task 
                    else if (selectedAction === "task") {
                        $("#filtertaskLeadIdInput").val(leadId);
                        $("#filterAddTaskModal").modal("show");
                    }
                });

                // Filter Lead Status Change Here Onchange
                $("#leadsTablenew").on('change', '.filterleadStatusSelect', function() 
                {
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
                        formData.append('lead_status', selectedStatus); // updated lead status

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
                                    swal("Lead Status Updated Successfully", "", "success");
                                    setTimeout(function() {
                                        location.reload(true); 
                                    }, 1000);
                                } else {
                                    swal("Lead Status Not Updated!", "", "error");
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
                    generatePaginationLinks(data.current_page, data.last_page, search_data, lead_status, fromDate, toDate);
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
function generatePaginationLinks(currentPage, lastPage, searchKeyword, lead_status, fromDate, toDate) {
    let pagination = $('#pagination'); // assuming pagination is a container for pagination links
    pagination.html(''); // Clear existing pagination
    lead_status = lead_status || ''; 
    status = status || '';

    // Show the first two pages
    if (currentPage > 3) {
        pagination.append(`
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(1, '${searchKeyword}', '${lead_status}', '${fromDate}', '${toDate}', '${status}')">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(2, '${searchKeyword}', '${lead_status}', '${fromDate}', '${toDate}', '${status}')">2</a>
            </li>
            <li class="page-item disabled"><a class="page-link">...</a></li>
        `);
    }

    // Show the current page and two pages before and after it
    for (let i = Math.max(1, currentPage - 2); i <= Math.min(lastPage, currentPage + 2); i++) {
        pagination.append(`
            <li class="page-item ${i === currentPage ? 'active' : ''}">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${i}, '${searchKeyword}', '${lead_status}', '${fromDate}', '${toDate}', '${status}')">${i}</a>
            </li>
        `);
    }

    // Show the last two pages
    if (currentPage < lastPage - 2) {
        pagination.append(`
            <li class="page-item disabled"><a class="page-link">...</a></li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${lastPage - 1}, '${searchKeyword}', '${lead_status}', '${fromDate}', '${toDate}', '${status}')">${lastPage - 1}</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="view_enquiry_api(${lastPage}, '${searchKeyword}', '${lead_status}', '${fromDate}', '${toDate}', '${status}')">${lastPage}</a>
            </li>
        `);
    }
}

$("#leadStatusFilter").change(function() {
    var lead_status = $(this).val();
    view_enquiry_api(currentPage, searchKeyword, lead_status, fromDate, toDate, lead_status);
});

</script>
<!-- Onchange Lead Status End Here  -->










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
            formData.append('lead_status', selectedStatus); // updated lead status
            formData.append('remark', updatedStatus); // remark lead_status_note

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
                        swal("Lead Status Updated Successfully", "", "success");
                        setTimeout(function() {
                            location.reload(
                                true); // Reload the page after update
                        }, 1000);
                    } else {
                        swal("Lead Status Not Updated!", "", "error");
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



<!-- Multiple checkbox to delete Start Here -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let selectedIds = [];
    document.querySelectorAll(".checkbox").forEach(checkbox => {
        checkbox.addEventListener("change", function () {
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

<!-- Single Delete Lead Start Here -->
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


// Export 

          
$('#exportButtonPdf').on('click', function() {
   
    
    $.ajax({
        url: "{{url('partner/export_to_excel')}}",
        type: 'GET',
        data: {
            search: search_data,
            page: page,
            lead_status: lead_status,
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