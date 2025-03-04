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
    <!-- Admin Name End Here -->
    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title  ">
            <div style="display: flex; justify-content: space-between;">
                <h3 class="theam_color_text"><i class="fa fa-list"></i> Task</h3>
                <div class="zxyzz">
                    <button type="button" class="btn btn-info" id="openModalBtn">
                        Create Task
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
                                All <span class="notification_nav">{{ $total_tasks }}</span></a></li>
                        <li><a href="#duetoday" data-toggle="tab"><i class="fa fa-user"></i>
                                Due Today <span class="notification_nav">{{ $total_duetoday }}</span></a></li>
                        <li><a href="#upcomming" data-toggle="tab"><i class="fa fa-user"></i>
                                Upcomming <span class="notification_nav">{{ $total_upcoming }}</span></a></li>
                        <li><a href="#overdues" data-toggle="tab"><i class="fa fa-user"></i>
                                Overdues <span class="notification_nav">{{ $total_overdues }}</span></a></li>
                        <li><a href="#completed" data-toggle="tab"><i class="fa fa-user"></i>
                                Completed <span class="notification_nav">{{ $total_task_completed }}</span></a></li>
                    </ul>
                    <div id="myTabContent1" class="tab-content">
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
                                    <div class="col-sm-2">
                                        <div class="controls">
                                            <select class="form-control" data-placeholder="Assignn" tabindex="1">
                                                <option value="">Task Type</option>
                                                <option value="1">Lead</option>
                                                <option value="1">Login</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance" id="table1">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Created By</th>
                                                        <th>Task Status</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Type Task</th>
                                                        <th>Lead / Login</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($tasks->isEmpty())
                                                    @else
                                                    @php
                                                    $sr = 1;
                                                    @endphp
                                                    @foreach($tasks as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>{{$item->task_status ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-task_type="{{$item->task_type}}"
                                                                data-lead_type="{{$item->lead_type}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ json_encode($item->assign) }}"
                                                                data-lead_id="{{ $item->lead_id }}"
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
                                                        <td>{{$item->task_type ?? ''}}</td>
                                                        <td>{{$item->lead_type ?? ''}}</td>
                                                        <td>{{$item->lead_name ?? ''}}</td>
                                                        <td>{{$item->date ?? ''}}</td>
                                                        <td>{{$item->time ?? ''}}</td>
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

                        <!-- DueToday Task Start Here -->
                        <div class="tab-pane fade all_tabs_bg" id="duetoday">
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
                                                        <th>Type Task</th>
                                                        <th>Lead / Login</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($duetoday)) {{-- Check if array is not empty --}}
                                                    @php $sr = 1; @endphp
                                                    @foreach($duetoday as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-task_type="{{$item->task_type}}"
                                                                data-lead_type="{{$item->lead_type}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ json_encode($item->assign) }}"
                                                                data-lead_id="{{ $item->lead_id }}"
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
                                                        <td>{{$item->task_type ?? ''}}</td>
                                                        <td>{{$item->lead_type ?? ''}}</td>
                                                        <td>{{$item->lead_name ?? ''}}</td>
                                                        <td>{{$item->date ?? ''}}</td>
                                                        <td>{{$item->time ?? ''}}</td>
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
                        <!-- DueToday Task Start Here -->

                        <div class="tab-pane fade all_tabs_bg" id="upcomming">
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
                                                        <th>Type Task</th>
                                                        <th>Lead / Login</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($upcoming))
                                                    @php $sr = 1; @endphp
                                                    @foreach($upcoming as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-task_type="{{$item->task_type}}"
                                                                data-lead_type="{{$item->lead_type}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ json_encode($item->assign) }}"
                                                                data-lead_id="{{ $item->lead_id }}"
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
                                                        <td>{{$item->task_type ?? ''}}</td>
                                                        <td>{{$item->lead_type ?? ''}}</td>
                                                        <td>{{$item->lead_name ?? ''}}</td>
                                                        <td>{{$item->date ?? ''}}</td>
                                                        <td>{{$item->time ?? ''}}</td>
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
                        <div class="tab-pane fade all_tabs_bg" id="overdues">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance taskTable" id="table4">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Created By</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Type Task</th>
                                                        <th>Lead / Login</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($overdues))
                                                    @php $sr = 1; @endphp
                                                    @foreach($overdues as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-task_type="{{$item->task_type}}"
                                                                data-lead_type="{{$item->lead_type}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ json_encode($item->assign) }}"
                                                                data-lead_id="{{ $item->lead_id }}"
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
                                                        <td>{{$item->task_type ?? ''}}</td>
                                                        <td>{{$item->lead_type ?? ''}}</td>
                                                        <td>{{$item->lead_name ?? ''}}</td>
                                                        <td>{{$item->date ?? ''}}</td>
                                                        <td>{{$item->time ?? ''}}</td>
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
                        <!-- Completed Task Start Here -->
                        <div class="tab-pane fade all_tabs_bg" id="completed">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance taskTable" id="table5">
                                                <thead>
                                                    <tr>
                                                        <th style="width:18px"><input type="checkbox"></th>
                                                        <th>Created By</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Type Task</th>
                                                        <th>Lead / Login</th>
                                                        <th>Customer Name</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Assign</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($task_completed)) {{-- Check if array is not empty --}}
                                                    @php $sr = 1; @endphp
                                                    @foreach($task_completed as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edit"
                                                                data-subject="{{$item->subject}}"
                                                                data-message="{{$item->message}}"
                                                                data-task_type="{{$item->task_type}}"
                                                                data-lead_type="{{$item->lead_type}}"
                                                                data-date="{{$item->date}}" data-time="{{$item->time}}"
                                                                data-assign="{{ json_encode($item->assign) }}"
                                                                data-lead_id="{{ $item->lead_id }}"
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
                                                        <td>{{$item->task_type ?? ''}}</td>
                                                        <td>{{$item->lead_type ?? ''}}</td>
                                                        <td>{{$item->lead_name ?? ''}}</td>
                                                        <td>{{$item->date ?? ''}}</td>
                                                        <td>{{$item->time ?? ''}}</td>
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
                        <!-- Completed Task End Here -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Task Modal Start Here -->
<div id="AddTaskModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:black;" id="modalTitle">Add Task</h4>
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
                            <select name="task_type[]" data-placeholder="Type Task" class="form-control chosen"
                                tabindex="6">
                                <option value="To Do">To Do</option>
                                <option value="Call">Call</option>
                                <option value="Pendency">Pendency</option>
                                </optgroup>
                            </select>
                        </p>
                        <p>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Lead / Login</label>
                                <div class="controls">
                                    <select name="lead_type" id="lead_type" class="form-control"
                                        data-placeholder="Choose Here" tabindex="1">
                                        <option selected="true" disabled="true">Select Lead Type</option>
                                        <option value="Lead">Lead</option>
                                        <option value="Login">Login</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Customer Name</label>
                                <div class="controls">
                                    <select name="lead_id" id="customer_name" class="form-control"
                                        data-placeholder="Choose Here" tabindex="1">
                                        <option selected="true" disabled="true">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        </p>
                        <p>
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <input type="time" name="time" class="form-control">
                            </div>
                        </div>
                        </p>
                        <p>
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
<div class="modal fade editmodal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                <h4 class="modal-title" style="color: black;" id="editModalLabel">Edit Task</h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
            <div class="row">
                <form class="edit_task" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <input type="hidden" name="admin_id" value="{{$adminlogin->id}}" class="form-control">
                    <!-- Admin Id -->
                    <input type="hidden" name="task_id" id="edit_task_id" value="" class="form-control edit_task_id">
                    <!-- Task Id -->
                    <div class="col-sm-12 mb-2">
                        <label for="subject">Created By</label>
                        <input type="text" id="created_by" class="form-control created_by" readonly>
                    </div>

                    <div class="col-sm-12">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="edit_subject" class="form-control edit_subject" disabled>
                    </div>
                    <div class="col-sm-12 disabled-div">
                        <textarea id="edit_message" name="message" class="form-control wysihtml5 edit_message" disabled></textarea>
                    </div>
                    <div class="col-sm-12">
                        <select name="task_type" id="edit_task_type" data-placeholder="Type Task"
                            class="form-control chosen EditChoosen edit_task_type" tabindex="6" disabled>
                            <option value="To Do">To Do</option>
                            <option value="Call">Call</option>
                            <option value="Pendency">Pendency</option>
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <div class="controls">
                            <label for="">Lead / Login</label>
                            <select id="edit_lead_type" name="lead_type" class="form-control edit_lead_type"
                                data-placeholder="Choose a Category" tabindex="1" disabled>
                                <option selected="true" disabled="true">Select Lead Type</option>
                                <option value="Lead">Lead</option>
                                <option value="Login">Login</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="control-label">Customer Name </label>
                        <div class="controls">
                            <select id="edit_lead_id" name="lead_id" class="form-control edit_lead_id">
                                @php
                                $leadsdata = DB::table('tbl_lead')->get();
                                @endphp
                                @foreach($leadsdata as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <input type="date" name="date" id="edit_date" class="form-control edit_date" disabled>
                    </div>
                    <div class="col-sm-6">
                        <input type="time" name="time" id="edit_time" class="form-control edit_time" disabled>
                    </div>

                    <div class="col-sm-6">
                        <select name="assign[]" id="edit_assign" data-placeholder="Assign"
                            class="form-control chosen EditChoosen edit_assign" multiple="multiple" tabindex="6" disabled>
                            <optgroup label="Designation">
                                @php
                                $admins = DB::table('admin')->orderBy('id', 'desc')->get();
                                @endphp
                                @foreach($admins as $item)
                                <option value="{{ $item->id }}">{{ $item->name ?? '' }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <div class="col-sm-12" style="display: flex; justify-content: space-between; align-items: center;">
                        <!-- Task Status Check -->
                        <input type="hidden" id="form_task_id" class="form_task_id" value="">
                        <input type="hidden" id="logged_in_user_id" class="logged_in_user_id"
                            value="{{ $adminlogin->id }}">
                        <!-- <button id="task_status_button" class="btn btn-success task_status_button" style="margin: 0 auto;"
                            type="button">Completed</button> -->
                            <button id="task_status_button" class="btn btn-success task_status_button" style="margin: 0 auto;"
                            type="button">Task Closed</button>
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
                                                <form class="add_comment_task" method="POST" action="javascript:void(0);">
                                                    @csrf
                                                    <div class="input">
                                                        <input type="hidden" name="task_id" id="comment_task_id" class="comment_task_id" value="">
                                                        <input type="hidden" name="admin_id"
                                                            value="{{$adminlogin->id ?? ''}}">
                                                        <input type="text" name="comment" placeholder="Write here..."
                                                            class="form-control">
                                                    </div>
                                                    <div class="buttons">
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fa fa-share"></i></button>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- Data Load From Ajax  -->
                                            <ul class="messages messages-stripped" id="get_comment">
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
                                            <tbody class="get_history">

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
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<script>
$(document).ready(function() 
{
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
<!-- LeadLoginStatus Onchange Case Data Filter  -->
<script>
// Add Task Me Onchange
$(document).ready(function() {
    $('#lead_type').change(function() {
        var leadType = $(this).val();
        // alert(leadType);
        $.ajax({
            url: "{{url('lead-login-status')}}",
            type: 'GET',
            data: {
                lead_login_status: leadType
            },
            dataType: 'json',
            success: function(response) {
                $('#customer_name').html(
                    '<option selected="true" disabled="true">Select</option>');
                if (response.length > 0) {
                    $.each(response, function(key, value) {
                        $('#customer_name').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                } else {
                    $('#customer_name').append('<option disabled>No Leads Found</option>');
                }
            }
        });
    });
});

// Edit task me Onchange
$(document).ready(function() {
    $('.edit_lead_type').change(function() {
        var leadType = $(this).val();
        alert(leadType);
        $.ajax({
            url: "{{url('lead-login-status')}}",
            type: 'GET',
            data: {
                lead_login_status: leadType
            },
            dataType: 'json',
            success: function(response) {
                $('.edit_lead_id').html(
                    '<option selected="true" disabled="true">Select</option>');
                if (response.length > 0) {
                    $.each(response, function(key, value) {
                        $('.edit_lead_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                } else {
                    $('.edit_lead_id').append('<option disabled>No Leads Found</option>');
                }
            }
        });
    });
});
</script>

<!--  edit task modal -->
<script>
$(document).on('click', '.edit', function() {
    var id = $(this).data('id');
    var subject = $(this).data('subject');
    var message = $(this).data('message');
    var task_type = $(this).data('task_type');
    var lead_type = $(this).data('lead_type');
    var date = $(this).data('date');
    var time = $(this).data('time');
    var selectedAdmins = JSON.parse($(this).data('assign'));

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
        $(".created_by").val(createdBy); // Agar date nahi hai to sirf name show hoga
    }
    // Function to format time in 12-hour format with AM/PM
    function formatTime(timeStr) {
        var timeParts = timeStr.split(":");
        var hours = parseInt(timeParts[0], 10);
        var minutes = timeParts[1]; // Pehle ye missing tha

        var ampm = hours >= 12 ? "" : ""; // AM/PM set kiya
        hours = hours % 12 || 12; // Convert 24-hour to 12-hour format

        // Ensure 2-digit hour and minute format
        var formattedHours = ("0" + hours).slice(-2);
        var formattedMinutes = ("0" + minutes).slice(-2);

        return formattedHours + ":" + formattedMinutes + " " + ampm;
    }


    // lead_id
    var lead_id = $(this).data('lead_id');
    $(".edit_lead_id").val(lead_id).prop("selected", true).trigger("change");
    $(".edit_task_id").val(id);
    $(".form_task_id").val(id); // form task id jisse status check krke Completed and Open Again button show krenge
    $(".comment_task_id").val(id);
    $(".edit_subject").val(subject);
    // Set message textarea
    $(".edit_message").data("wysihtml5").editor.setValue(message);
    // set chosen select box with search

    $(".edit_task_type").val(task_type).trigger("chosen:updated");
    $(".edit_task_type option").each(function() {
        if ($(this).val() !== task_type) {
            $(this).prop("disabled", false);
        } else {
            $(this).prop("disabled", false);
        }
    });
    $(".edit_task_type").trigger("chosen:updated");
    // Set lead type selected in option tag
    $(".edit_lead_type").val(lead_type);
    // Set date and time values
    $(".edit_date").val(date); // Set date
    $(".edit_time").val(time); // Set time

    // Convert time from 12-hour format (h:i A) to 24-hour format (HH:MM)
    function convertTo24HourFormat(time12hr) {
        var time = time12hr.split(' ');
        var timeArr = time[0].split(':');
        var hour = parseInt(timeArr[0], 10);
        var minute = timeArr[1];
        var suffix = time[1].toUpperCase(); // AM or PM
        if (suffix === 'PM' && hour !== 12) {} else if (suffix === 'AM' && hour === 12) {
            hour = 0;
        }
        return ('0' + hour).slice(-2) + ':' + minute;
    }
    if (time) {
        var formattedTime = convertTo24HourFormat(time);
        $(".edit_time").val(formattedTime);
    }
    // Set selected values for the "assign[]" multiple select
    $(".edit_assign").val(selectedAdmins).trigger("chosen:updated");
    // Task Status Fetch Karna
    $.ajax({
        url: "{{url('/get-task-status')}}", // API jo task_status return kare
        method: 'GET',
        data: {
            task_id: id
        },
        success: function(response) {
            console.log(response);
            if (response.task_status === "Completed") {
                $(".task_status_button").text("Open Again").removeClass("btn-success").addClass(
                    "btn-warning");
            } else if (response.task_status === "Open Task") {
                $(".task_status_button").text("Completed").removeClass("btn-warning").addClass(
                    "btn-success");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching task status:", error);
        }
    });         
    // Task Status Fetch End

    // task comment show start here
    $.ajax({
        url: "{{url('/get-task-comments')}}",
        method: 'GET',
        data: {
            task_id: id
        },
        success: function(response) {
            console.log(response);
            $('#get_comment').empty();
            response.forEach(function(item) {
                console.log("Raw Date:", item.date);
                var formattedDate = moment(item.date, "YYYY-MM-DD hh:mm A").locale('en')
                    .fromNow();
                console.log("Formatted Date:", formattedDate); // Debugging ke liye
                var commentHTML = `
                    <li>
                        <img src="{{asset('Admin/img/demo/avatar/avatar2.jpg')}}" alt="">
                        <div>
                            <div>
                                <h5 class="theam_color">${item.createdby}</h5>
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    ${formattedDate}
                                </span>
                            </div>
                            <p>${item.comment}</p>
                        </div>
                    </li>
                `;
                $('#get_comment').html(commentHTML);
                
            });
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
    // task comment end here

    // Task History Data show here
    $.ajax({
        url: "{{ url('/get-task-history') }}",
        method: 'GET',
        data: {
            task_id: id
        },
        success: function(response) {
            console.log(response); // Debugging ke liye check karein
            // Task History Section
            $('.get_history').empty();
            // Check if response is an array and has data
            if (!Array.isArray(response) || response.length === 0) {
                $('.get_history').append(`<tr><td colspan="4">No history available</td></tr>`);
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
                    $('.get_history').append(historyRow);
                    sr++;
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error:", error);
        }
    });
    // task History data end here
    $(".editmodal").modal("show");
});
</script>

<!-- Task Status Update Start Here -->
<script>
$(document).on('click', '.task_status_button', function(e) {
    e.preventDefault();

    var task_id = $(".form_task_id").val();
    var admin_id = $(".logged_in_user_id").val();
    var current_status = $(this).text().trim();
    var new_status = (current_status === "Completed") ? "Completed" : "Open Task";
    $.ajax({
        url: "{{ url('/update-task-status') }}",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
            task_id: task_id,
            admin_id: admin_id,
            task_status: new_status
        },
        success: function(response) {
            if (response.success === 'success') {
                $(".task_status_button").text(new_status)
                    .toggleClass("btn-success btn-warning");
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
<!-- Task Status Update End Here -->

<script>
// Add comment task In Edit Task Pannel Start Here
$(".add_comment_task").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/add_comment')}}",
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

<!-- Disabled krna Task ko Edit ke case me by default after edit active all fields -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let editButton = document.getElementsByClassName("edit_button")[0];
    let updateButton = document.getElementsByClassName("update_button")[0];
    let editMessage = document.getElementsByClassName("wysihtml5")[0]; 

    // Disable hone wale fields (div ko bhi select karenge)
    let fieldsToDisable = [
        ".edit_subject",
        ".edit_lead_type",
        ".edit_lead_id",
        ".edit_task_type",
        ".edit_date",
        ".edit_time",
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
    $(".chosen").attr("disabled", true).trigger("chosen:updated"); // this chosen disabled edit task case
    // $(".EditChoosen").attr("disabled", true).trigger("EditChoosen:updated");
    $(".AddChosen").attr("disabled", false).trigger("AddChosen:updated"); // this chosen active add task case

    editButton.addEventListener("click", function() {
        fieldsToDisable.forEach(selector => {
            let field = document.querySelector(selector);
            if (field) {
                field.removeAttribute("disabled");
                field.classList.remove("disabled-div");
            }
        });
        // Chosen selects ko enable karke refresh karna
        $(".chosen").removeAttr("disabled").trigger(
        "chosen:updated"); // this chosen active edit task case
        // $(".EditChoosen").removeAttr("disabled").trigger("EditChoosen:updated");
        $(".AddChosen").removeAttr("disabled", true).trigger(
        "AddChosen:updated"); // this chosen disabled add task case
        editButton.style.display = "none";
        updateButton.style.display = "inline-block";
    });
});
</script>

<script>
    // Edit Task Section Data
$(".edit_task").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/update_task')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $(".edit_task")[0].reset();
                $(".editmodal").modal("hide");
                swal("Task Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Task Update!", "", "error");
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
        }
    });
});
// Edit Task End Here
</script>


<script>
$('.chosen').chosen({
    width: '100%',
    allow_single_deselect: true
});
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

<!-- add task -->
<script>
$("#add_form").submit(function(e) {
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
                document.getElementById("add_form").reset();
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
</script>

<script>
$(document).ready(function() {
    $('#openModalBtn').on('click', function() {
        $('#AddTaskModal').modal('show');
    });

    $('#saveChangesBtn').on('click', function() {
        alert('Your changes have been saved!');
        $('#AddTaskModal').modal('hide');
    });

    $('#AddTaskModal').on('shown.bs.modal', function() {
        console.log('Modal is now fully visible!');
    });

    $('#AddTaskModal').on('hidden.bs.modal', function() {
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