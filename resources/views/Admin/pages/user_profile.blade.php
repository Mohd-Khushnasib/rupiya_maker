@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $adminlogin)
@extends('Admin.layouts.master')
@section('main-content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.btn-close {
    margin-left: auto;
}
.disabled-div {
    pointer-events: none;
    opacity: 0.6;
    background-color: #f5f5f5;
}
</style>
<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Main Content Start Here  -->
<div class="container" id="main-container">
    <!-- Admin Name Start Here -->
        <input type="hidden" id="admin_name" value="{{$adminlogin->name}}" class="form-control">
    <!-- Admin Name End Here -->

    <!-- BEGIN Content -->
    <div id="main-content">
        <!-- BEGIN Page Title -->
        <div class="page-title lead_page_title ">
            <div>
                <!-- <h3 class="theam_color_text"><i class="fa fa-user"></i> User Deatils</h3> -->
                <h3 class="theam_color_text"><i class="fa fa-user"></i> {{$leads->name ?? ''}}</h3>
            </div>

            <!-- @php
            $leadCount = \DB::table('tbl_lead')->where('leadid', $leads->leadid)->count();
            @endphp
            @if (isset($leads->lead_status) && $leads->lead_status == 'FILE COMPLETED' &&
            isset($leads->lead_login_status) && $leads->lead_login_status != 'Login')
            <div>
                @if ($leadCount <= 4) <button class="btn" id="copyThisLeadBtn" data-id="{{$leads->id}}">COPY THIS
                    LEAD</button>
                    @endif
                    <button class="btn" id="fileSentBtn" data-id="{{$leads->id}}">FILE SENT TO LOGIN</button>
            </div>
            @endif -->

            @php
                $leadCount = \DB::table('tbl_lead')->where('leadid', $leads->leadid)->count();
            @endphp

            @if (isset($leads->lead_status) && $leads->lead_status == 'FILE COMPLETED' &&
                isset($leads->lead_login_status) && $leads->lead_login_status != 'Login' &&
                (!isset($leads->login_status) || $leads->login_status == ''))
                <div>
                    @if ($leadCount <= 4) 
                        <button class="btn" id="copyThisLeadBtn" data-id="{{$leads->id}}">COPY THIS LEAD</button>
                    @endif
                    <button class="btn" id="fileSentBtn" data-id="{{$leads->id}}">FILE SENT TO LOGIN</button>
                </div>
            @endif




        </div>
        <!-- END Page Title -->
        <!-- BEGIN Main Content -->
        <div class="row">

            <div class="col-md-12">
                <div class="tabbable">
                    <ul id="myTab1" class="nav nav-tabs">
                        <li class="active"><a href="#leads" data-toggle="tab"><i class="fa fa-home"></i>
                                Lead Details</a></li>
                        <li><a href="#obligation" data-toggle="tab"><i class="fa fa-user"></i>
                                Obligation</a></li>
                        <li><a href="#Login_form" data-toggle="tab"><i class="fa fa-user"></i>
                                Login Form</a></li>
                        <li><a href="#Remark" data-toggle="tab"><i class="fa fa-user"></i>
                                Remark</a></li>
                        <li><a href="#Task" data-toggle="tab"><i class="fa fa-user"></i>
                                Task</a></li>
                        <li><a href="#Attachement" data-toggle="tab"><i class="fa fa-user"></i>
                                Attachement</a></li>
                        <li><a href="#leads_activety" data-toggle="tab"><i class="fa fa-user"></i>
                                Leads Activity</a></li>
                    </ul>

                    <div id="myTabContent1" class="tab-content">
                        <!-- Accordian Start Here  -->
                        <div class="tab-pane fade in active all_tabs_bg" id="leads">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-group accordion" id="accordion2">

                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle" data-toggle="collapse"
                                                            href="#collapseOne2"><i class="fa icon-chevron"></i> About
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne2" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        <div class="lead_deatails_card" style="padding: 10px;">
                                                            <div class="edit_btn_on_lead" id="edit_about_lead"
                                                                data-id="{{$leads->id ?? ''}}"
                                                                data-data_code="{{$leads->data_code ?? ''}}"
                                                                data-name="{{$leads->name ?? ''}}"
                                                                data-pincode="{{$leads->pincode ?? ''}}">
                                                                <!-- <i class="fa fa-pencil" style="color: black;"></i> -->
                                                                <i class="fas fa-edit" style="color: black;"></i>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="all_leads_section">
                                                                        <h5>Id</h5>
                                                                        <p>{{$leads->leadid ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Data Code</h5>
                                                                        <p>{{$leads->datacode_name ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Alternate Number</h5>
                                                                        <p>{{$leads->alternate_mobile ?? ''}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="all_leads_section">
                                                                        <h5>Product Name</h5>
                                                                        <p>{{$leads->product_name ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Customer Name</h5>
                                                                        <p>{{$leads->name ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Pin Code & City </h5>
                                                                        <p>{{$leads->pincode ?? ''}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="all_leads_section">
                                                                        <h5>Campaign Name</h5>
                                                                        <p>{{$leads->campaign_name ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Mobile Number</h5>
                                                                        <p>{{$leads->mobile ?? ''}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                            href="#collapseTwo2"><i class="fa icon-chevron"></i> How To
                                                            process</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo2" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="lead_deatails_card" style="padding: 10px;">
                                                            <div class="edit_btn_on_lead" id="edit_lead_process"
                                                                data-id="{{$leads->id ?? ''}}"
                                                                data-loan_amount="{{$leads->loan_amount ?? ''}}"
                                                                data-process="{{$leads->process ?? ''}}"
                                                                data-bank_id="{{$leads->bank_id ?? ''}}"
                                                                data-product_need_id="{{$leads->product_need_id ?? ''}}"
                                                                data-casetype_id="{{$leads->casetype_id ?? ''}}"
                                                                data-tenure="{{$leads->tenure ?? ''}}"
                                                                data-year="{{$leads->year ?? ''}}">
                                                                <!-- <i class="fa fa-pencil" style="color: black;"></i> -->
                                                                <i class="fa fa-edit" style="color: black;"></i>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="all_leads_section">
                                                                        <h5>Bank Name</h5>
                                                                        <p>{{$leads->bank_name ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Loan amount</h5>
                                                                        <p>₹ <span id="user_loan_amount">{{$leads->loan_amount ?? ''}}</span> </p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>How To Process</h5>
                                                                        <p>{{$leads->process ?? ''}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="all_leads_section">
                                                                        <h5>Product Need</h5>
                                                                        <p>{{$leads->product_need ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Required Tenure</h5>
                                                                        <p>{{$leads->tenure ?? ''}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="all_leads_section">
                                                                        <h5>Case type</h5>
                                                                        <p>{{$leads->casetype ?? ''}}</p>
                                                                    </div>
                                                                    <div class="all_leads_section">
                                                                        <h5>Year</h5>
                                                                        <p>{{$leads->year ?? ''}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                             <!-- Operation Section Start Here  -->
                                             @if($leads->lead_login_status === 'Login' || $leads->lead_status === 'FILE SENT TO LOGIN')
                                                <!-- Operations Section - This will now appear first -->
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                                href="#collapseFour"><i class="fa icon-chevron"></i> Operations</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseFour" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <div class="lead_deatails_card" style="padding: 10px;">
                                                                <div class="edit_btn_on_lead" id="edit_lead_operation"
                                                                    data-id="{{$leads->id ?? ''}}"
                                                                    data-channel_id="{{$leads->channel_id ?? ''}}"
                                                                    data-los_number="{{$leads->los_number ?? ''}}"
                                                                    data-amount_approved="{{$leads->amount_approved ?? ''}}"
                                                                    data-rate="{{$leads->rate ?? ''}}"
                                                                    data-pf_insurance="{{$leads->pf_insurance ?? ''}}"
                                                                    data-tenure_given="{{$leads->tenure_given ?? ''}}"
                                                                    data-tenure_year="{{$leads->tenure_year ?? ''}}"
                                                                    data-amount_disbursed="{{$leads->amount_disbursed ?? ''}}"
                                                                    data-internal_top="{{$leads->internal_top ?? ''}}"
                                                                    data-cashback_to_customer="{{$leads->cashback_to_customer ?? ''}}"
                                                                    data-disbursment_date="{{$leads->disbursment_date ?? ''}}">
                                                                    <i class="fa fa-edit" style="color: black;"></i>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="all_leads_section">
                                                                            <h5>Channel Name</h5>
                                                                            <p>{{$leads->channel_name ?? ''}}</p>
                                                                        </div>
                                                                        <div class="all_leads_section">
                                                                            <h5>Rate</h5>
                                                                            <p>{{$leads->rate ?? ''}}</p>
                                                                        </div>
                                                                        <div class="all_leads_section">
                                                                            <h5>Amount Disbursed</h5>
                                                        <p>₹ <span id="user_amount_disbursed">{{$leads->amount_disbursed ?? ''}}</span> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="all_leads_section">
                                                                            <h5>Los Number</h5>
                                                                            <p>{{$leads->los_number ?? ''}}</p>
                                                                        </div>
                                                                        <div class="all_leads_section">
                                                                            <h5>PF & Insurance</h5>
                                                                            <p>₹ {{$leads->pf_insurance ?? ''}}</p>
                                                                        </div>
                                                                        <div class="all_leads_section">
                                                                            <h5>Internal Top</h5>
                                                                            <p>₹ <span id="user_internal_top">{{$leads->internal_top ?? ''}}</span> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="all_leads_section">
                                                                            <h5>Amount Approved</h5>
                                                            <p>₹ <span id="user_amount_approved">{{$leads->amount_approved ?? ''}}</span> </p>
                                                                        </div>
                                                                        <div class="all_leads_section">
                                                                            <h5>Tenure Given</h5>
                                                                            <p>{{$leads->tenure_given ?? ''}}</p>
                                                                        </div>
                                                                        <div class="all_leads_section">
                                                                            <h5>Cashback To Customer</h5>
                                                                            <p>₹ <span id="user_cashback_to_customer">{{$leads->cashback_to_customer ?? ''}}</span> </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="all_leads_section">
                                                                            <h5>Net Disbursment Amount</h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-7" style="background-color: green;">
                                                                        <div class="all_leads_section" style="padding: 10px; justify-content:center;">
                                                                            <h5 style="color:white;"> ₹ <span id="user_total"> {{ ($leads->amount_disbursed ?? 0) - ($leads->internal_top ?? 0) }}
                                                                            </span></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="all_leads_section">
                                                                            <h5>Disbursment Date</h5>
                                                                            <p>{{ $leads->disbursment_date }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- Operation Section End Here  -->

                                            <!-- Important Question Section (Ye hamesha dikhega) -->
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-toggle="collapse"
                                                            href="#collapseThree2"><i class="fa icon-chevron"></i>
                                                            Important Question</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree2" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        @php
                                                            $impQuestions = DB::table('tbl_imp_question')
                                                            ->leftJoin('tbl_product', 'tbl_product.id', '=', 'tbl_imp_question.product_id')
                                                            ->select('tbl_imp_question.*', 'tbl_product.product_name')
                                                            ->where('tbl_imp_question.product_id', $leads->product_id) // Filter by product_id
                                                            ->orderBy('tbl_imp_question.id', 'desc')
                                                            ->get();   
                                                            $selectedImpQuestions = explode(',', $leads->imp_que); 
                                                        @endphp
                                                        @foreach ($impQuestions as $question)
                                                            <p>
                                                                <input type="checkbox" name="imp_question[]" value="1"
                                                                    data-lead-id="{{ $leads->id }}"
                                                                    data-question-id="{{ $question->id }}"
                                                                    class="imp-checkbox"
                                                                    @if(in_array($question->id, $selectedImpQuestions)) checked @endif>
                                                                {{ $loop->iteration }}. {{ $question->imp_question_name }}
                                                                <button class="playButton" data-audio-id="audio-{{ $question->id }}">Play</button>
                                                                    <audio class="audioPlayer" id="audio-{{ $question->id }}" src="{{ $question->audio }}"></audio>
                                                                </p>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Operation Section End  Here  -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Accordian End Here  -->


                        <!-- Obligation Form Here -->
                        <div class="tab-pane fade all_tabs_bg" id="obligation">
                            <div class="boligation_tabls">
                                <form action="javascript:void(0);" id="edit_obligation_form" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="id" value="{{$leads->id ?? ''}}" hidden>
                                    <input type="text" name="admin_id" value="{{$adminlogin->id ?? ''}}" hidden>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="text-light control-label"> Salary</label>
                                                <div class="controls">
                                                    <!-- <input type="text" value="{{$leads->salary ?? ''}}" name="salary"
                                                        placeholder="₹" class="form-control"> -->
                                                    <input type="text" id="salary" name="salary" placeholder="₹"
                                                        class="form-control"
                                                        value="{{ isset($leads->salary) ? number_format($leads->salary) : '' }}"
                                                        oninput="formatSalary(this)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="text-light control-label"> Yearly Bonus</label>
                                                <div class="controls">
                                                    <!-- <input type="text" value="{{$leads->yearly_bonus ?? ''}}"
                                                        name="yearly_bonus" placeholder="₹" class="form-control"> -->
                                                    <!-- Yearly Bonus -->
                                                    <input type="text" id="yearly_bonus"
                                                        value="{{ $leads->yearly_bonus ?? '' }}" name="yearly_bonus"
                                                        placeholder="₹" class="form-control"
                                                        oninput="formatSalary(this)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="text-light control-label"> Loan amount
                                                    required</label>
                                                <div class="controls">
                                                    <!-- <input type="text" value="{{$leads->loan_amount ?? ''}}"
                                                        name="loan_amount" placeholder="₹" class="form-control"> -->
                                                    <!-- Loan Amount -->
                                                    <input type="text" id="loan_amount"
                                                        value="{{ $leads->loan_amount ?? '' }}" name="loan_amount"
                                                        placeholder="₹" class="form-control"
                                                        oninput="formatSalary(this)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-11">
                                            <div class="form-group">
                                                <label class="text-light control-label">Company name</label>
                                                <div class="controls">
                                                    <input type="text" value="{{$leads->company_name ?? ''}}"
                                                        name="company_name" placeholder="Comapny Name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <a style="margin-top: 23px;" href="https://www.zaubacorp.com/"
                                                target="_blank" class="btn">check</a>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label text-light">Company type</label>
                                                <div class="controls">
                                                    <select name="company_type" id="companyType" class="form-control"
                                                        data-placeholder="Choose a Category" tabindex="1">
                                                        <option value="" disabled
                                                            {{ !isset($leads->company_type) ? 'selected' : '' }}>--
                                                            Company Type --</option>
                                                        <option value="LLP FIRM"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'LLP FIRM' ? 'selected' : '' }}>
                                                            LLP FIRM</option>
                                                        <option value="LIMITED FIRM"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'LIMITED FIRM' ? 'selected' : '' }}>
                                                            LIMITED FIRM</option>
                                                        <option value="PRIVATE LIMITED FIRM"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'PRIVATE LIMITED FIRM' ? 'selected' : '' }}>
                                                            PRIVATE LIMITED FIRM</option>
                                                        <option value="DEFENCE"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'DEFENCE' ? 'selected' : '' }}>
                                                            DEFENCE</option>
                                                        <option value="GOVERNMENT DOCTOR"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'GOVERNMENT DOCTOR' ? 'selected' : '' }}>
                                                            GOVERNMENT DOCTOR</option>
                                                        <option value="GOVERNMENT TEACHER"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'GOVERNMENT TEACHER' ? 'selected' : '' }}>
                                                            GOVERNMENT TEACHER</option>
                                                        <option value="PARTENERSHIP FIRM"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'PARTENERSHIP FIRM' ? 'selected' : '' }}>
                                                            PARTENERSHIP FIRM</option>
                                                        <option value="PROPRITER"
                                                            {{ isset($leads->company_type) && $leads->company_type == 'PROPRITER' ? 'selected' : '' }}>
                                                            PROPRITER</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label text-light">Company Category</label>
                                                <div class="controls">
                                                    <!-- Second Dropdown -->
                                                    <select name="company_category_id" id="productSelect"
                                                        class="form-control" data-placeholder="Choose a Category"
                                                        tabindex="1">
                                                        <option disabled="true" selected="true">-- Select Company
                                                            Category --</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="text-light control-label"> Obligation</label>
                                                <div class="controls">
                                                    <input type="text" name="obligation"
                                                        value="{{$leads->obligation ?? ''}}" id="obligation_section"
                                                        readonly class="form-control"
                                                        style="height:45px !important;font-weight: bold; font-size: 17px;background-color:red;color:white;">
                                                    <!-- hidden  -->
                                                    <input type="hidden" value="{{$leads->obligation ?? ''}}"
                                                        id="obligation_section_hidden" readonly class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="text-light control-label"> Bt Pos</label>
                                                <div class="controls">
                                                    <input type="text" name="pos" value="{{$leads->pos ?? ''}}"
                                                        id="pos_section" readonly class="form-control"
                                                        style="height:45px !important;font-weight: bold; font-size: 17px;background-color:green;color:white;">
                                                    <!-- hidden -->
                                                    <input type="hidden" value="{{$leads->pos ?? ''}}"
                                                        id="pos_section_hidden" readonly class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="text-light control-label"> Cibil Score</label>
                                                <div class="controls">
                                                    <input type="text" name="cibil_score" id="cibil_score"
                                                        value="{{$leads->cibil_score}}" class="form-control"
                                                        maxlength="3">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-advance" style="padding: 0px;">
                                            <thead style="background-color: black;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Loan Type</th>
                                                    <th>Bank Name</th>
                                                    <th>Total Loan Amount</th>
                                                    <th>Bt POS</th>
                                                    <th>EMI</th>
                                                    <th>BT OR Obligate</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dynamicRows">
                                                <!-- Start Here Invoice -->
                                                <tr id="templateRow">
                                                    <td>1</td>
                                                    <td>
                                                        <select name="product_id[]" class="form-control product-select"
                                                            tabindex="1">
                                                            <option disabled="true" selected="true">Select Product
                                                            </option>
                                                            @php
                                                            $productsdata = DB::table('tbl_product')->orderBy('id',
                                                            'desc')->get();
                                                            @endphp
                                                            @foreach($productsdata as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->product_name ?? '' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="bank_id[]" class="form-control bank-select"
                                                            tabindex="1">
                                                            <option disabled="true" selected="true">Select Bank</option>
                                                            @php
                                                            $banksdata = DB::table('tbl_bank')->orderBy('id',
                                                            'desc')->get();
                                                            @endphp
                                                            @foreach($banksdata as $item)
                                                            <option value="{{ $item->id }}">{{ $item->bank_name ?? '' }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="total_loan_amount[]"
                                                            class="form-control"></td>
                                                    <td><input type="text" name="bt_pos[]" class="form-control bt_pos"
                                                            placeholder="" oninput="updateTotal()"></td>
                                                    <td><input type="text" name="bt_emi[]" class="form-control bt_emi"
                                                            placeholder=""></td>
                                                    <td>
                                                        <select name="bt_obligation[]" class="form-control" tabindex="1" required>
                                                            <option value="" disabled selected>-- Select Category --</option>
                                                            <option value="BT">BT</option>
                                                            <option value="Obligation">Obligation</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-success" id="addMore">Add
                                                            More</button>
                                                    </td>
                                                </tr>
                                                <!-- End Here Invoice -->     
                                            </tbody>
                                                
                                            <tr>
                                                <td class="total_text_table_footer" colspan="4">Total</td>
                                                <td class="total_text_table_footer" colspan="1">₹<span
                                                        id="totalPos">0</span></td>
                                                <td class="total_text_table_footer" colspan="3">₹<span
                                                        id="totalEmi">0</span></td>
                                            </tr>
                                        </table>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary btn_obligation_submit"
                                                    style="float:right;font-weight:bold;font-weight:bold;font-size:20px;">Save</button>
                                            </div>
                                        </div>
                                        <br>



                                        <!-- Obligation History Start Here -->
                                        @php
                                            $adminId = $adminlogin->id; // Admin ID
                                            $leadId = $leads->id; // Lead ID 
                                            // Fetch obligations where admin_id and lead_id match
                                            $obligations = DB::table('tbl_obligation')
                                                ->where('admin_id', $adminId)
                                                ->where('lead_id', $leadId)
                                                ->get();
                                        @endphp 
                                        <div class="row" @if($obligations->isEmpty()) style="display: none;" @endif>
                                            <div class="col-sm-12">
                                                <!-- Table -->
                                                <table id="obligationTable" class="table">
                                                    <tr>
                                                        <th style="color: white;">#</th>
                                                        <th style="color: white;">Loan Type</th>
                                                        <th style="color: white;">Bank Name</th>
                                                        <th style="color: white;">Total Loan Amount</th>
                                                        <th style="color: white;">Bt POS</th>
                                                        <th style="color: white;">EMI</th>
                                                        <th style="color: white;">BT OR Obligate 
                                                            <select id="filterSelect" class="form-control">
                                                                <option disabled selected>-- Select BT OR Obligate --</option>
                                                                <option value="BT">BT</option>
                                                                <option value="Obligation">Obligation</option>
                                                            </select>
                                                        </th>
                                                    </tr>

                                                    @foreach($obligations as $key => $obligation)
                                                    <tr style="background-color: {{ $obligation->bt_obligation == 'BT' ? 'green' : ($obligation->bt_obligation == 'Obligation' ? 'red' : '') }};">
                                                        <input type="hidden" name="admin_id[]" value="{{ $adminlogin->id }}">
                                                        <input type="hidden" name="lead_id[]" value="{{ $leads->id }}">
                                                        <input type="hidden" name="obligation_id[]" value="{{ $obligation->id }}">

                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            <select name="product_id1[]" class="form-control product-select">
                                                                <option disabled selected>Select Product</option>
                                                                @foreach($productsdata as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $obligation->product_id ? 'selected' : '' }}>
                                                                    {{ $item->product_name ?? '' }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="bank_id1[]" class="form-control bank-select">
                                                                <option disabled selected>Select Bank</option>
                                                                @foreach($banksdata as $item)
                                                                <option value="{{ $item->id }}" {{ $item->id == $obligation->bank_id ? 'selected' : '' }}>
                                                                    {{ $item->bank_name ?? '' }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type="text" name="total_loan_amount1[]" class="form-control"
                                                                value="{{ $obligation->total_loan_amount }}"></td>
                                                        <td><input type="text" name="bt_pos1[]" class="form-control bt_pos"
                                                                value="{{ $obligation->bt_pos }}"></td>
                                                        <td><input type="text" name="bt_emi1[]" class="form-control bt_emi"
                                                                value="{{ $obligation->bt_emi }}"></td>
                                                        <td>
                                                            <select name="bt_obligation1[]" class="form-control">
                                                                <option disabled selected>-- Select Category --</option>
                                                                <option value="BT" {{ $obligation->bt_obligation == 'BT' ? 'selected' : '' }}>BT</option>
                                                                <option value="Obligation" {{ $obligation->bt_obligation == 'Obligation' ? 'selected' : '' }}>Obligation</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="btn btn-danger obligationdelete small-btn" data-id="{{ $obligation->id }}">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>

                                                <div style="display:flex;justify-content:end;padding:10px 0px"> 
                                                    <button type="button" class="btn btn-primary" style="float:right;font-weight:bold;font-size:20px;" id="editObligation">Edit</button>
                                                    <button type="button" class="btn btn-primary" style="float:right;font-weight:bold;font-size:20px;display:none;" id="updateObligation">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Obligation History End Here --> 

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade all_tabs_bg" id="leads_activety">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button class="btn" id="download_activity">Save as pdf</button>
                                    </div>
                                </div>
                                <ul class="timeline">

                                    @if($lead_activity->isNotEmpty())
                                    @foreach($lead_activity as $item)
                                    <li>
                                        <span class="tl-icon"><i class="fa fa-clock-o"></i></span>
                                        <span
                                            class="tl-time">{{ \Carbon\Carbon::parse($item->date)->format('h:i A') }}</span>
                                        <span class="tl-title">{{ $item->lead_status ?? '' }}</span>
                                        <span class="tl-arrow"></span>
                                        <div class="tl-content">
                                            <p class="tl-date">
                                                <span
                                                    class="tl-numb-day">{{ \Carbon\Carbon::parse($item->date)->format('d') }}</span>
                                                <span
                                                    class="tl-text-day">{{ \Carbon\Carbon::parse($item->date)->format('l') }}</span>
                                                <span
                                                    class="tl-month">{{ \Carbon\Carbon::parse($item->date)->format('F Y') }}</span>
                                            </p>
                                            <p>{{ $item->lead_status ?? '' }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                    @else
                                    <li>
                                        <span class="tl-title">No activity found.</span>
                                    </li>
                                    @endif

                                    <li class="clearfix"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade all_tabs_bg" id="Login_form">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-sm-12 d-flex">
                                        <button class="btn" id="download_login_form">Download as pdf</button>
                                        <a href="{{ url('/user_link/'.$leads->id) }}" class="btn btn-primary"
                                            style="float:right;" target="_blank">Share Link</a>
                                    </div>
                                </div>
                                <!-- <form id="form-container"> -->
                                <form id="edit_loginform_form" action="javascript:void(0);"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <input type="text" name="id" value="{{$leads->id ?? ''}}" hidden>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE NAME USE FOR LOGIN
                                                    CALL</label>
                                                <input type="text" name="reference_name"
                                                    value="{{$leads->reference_name ?? ''}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">Addhar number</label>
                                                <input type="text" name="aadhar_no" id="aadhar_no"
                                                    value="{{$leads->aadhar_no ?? ''}}" class="form-control">
                                                    <!-- aadhar_no Error min and max 12 digits -->
                                                    <span id="aadharnoError" style="color:red;display:none;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">Qualifiaction</label>
                                                <select name="qualification" class="form-control" id="statusSelect">
                                                    <option value="" disabled
                                                        <?php echo empty($leads->qualification) ? 'selected' : ''; ?>>
                                                        Select</option>
                                                    <option value="10th"
                                                        <?php echo $leads->qualification === '10th' ? 'selected' : ''; ?>>
                                                        10th</option>
                                                    <option value="12th"
                                                        <?php echo $leads->qualification === '12th' ? 'selected' : ''; ?>>
                                                        12th</option>
                                                    <option value="Graduate"
                                                        <?php echo $leads->qualification === 'Graduate' ? 'selected' : ''; ?>>
                                                        Graduate</option>
                                                    <option value="Master"
                                                        <?php echo $leads->qualification === 'Master' ? 'selected' : ''; ?>>
                                                        Master</option>
                                                    <option value="Phd"
                                                        <?php echo $leads->qualification === 'Phd' ? 'selected' : ''; ?>>
                                                        Phd</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">CUSTOMER NAME</label>
                                                <input type="text" name="name" value="{{$leads->name ?? ''}}"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">Pan card Number</label>
                                                <input type="text" name="pan_card_no" id="pan_card_no"
                                                    value="{{$leads->pan_card_no ?? ''}}" class="form-control">
                                                     <!-- aadhar_no Error min and max 10 digits -->
                                                     <span id="pancardnoError" style="color:red;display:none;"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">SALARY ACCOUNT BANK
                                                    NAME</label>
                                                <div class="controls">
                                                    <select name="product_id" class="form-control"
                                                        data-placeholder="Choose a Category" tabindex="1">
                                                        <option disabled="true" selected="true">Select Product</option>
                                                        @php
                                                        $products = DB::table('tbl_product')->orderBy('id',
                                                        'desc')->get();
                                                        @endphp
                                                        @foreach($products as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ isset($leads->product_id) && $leads->product_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->product_name ?? '' }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">Mobile Number</label>
                                                <input type="text" name="mobile" value="{{$leads->mobile ?? ''}}"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">DOB</label>
                                                <!-- <input type="date" name="dob" id="dob" value="{{$leads->dob ?? ''}}"
                                                    class="form-control"> -->
                                                    <input type="text" name="dob" id="dob" value="{{$leads->dob ?? ''}}" class="form-control" maxlength="10" placeholder="DD-MM-YYYY">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">Account Number</label>
                                                <input id="account_no" type="text" name="account_no"
                                                    value="{{$leads->account_no ?? ''}}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">Alt Mobile
                                                    Number</label>
                                                <input type="text" name="alternate_mobile"
                                                    value="{{$leads->alternate_mobile ?? ''}}" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">Father Name</label>
                                                <input type="text" name="father_name"
                                                    value="{{$leads->father_name ?? ''}}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label text-light">IFSC Code</label>
                                                <input type="text" name="ifsc_code" value="{{$leads->ifsc_code ?? ''}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-sm-12">
                                            <h5>This Link Share to Customer to fill there deatils
                                                <a href="{{url('/user_link/'.$leads->id)}}">
                                                    Share</a>
                                            </h5>
                                        </div> -->
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">MOTHER NAME</label>
                                                <input type="text" name="mother_name"
                                                    value="{{$leads->mother_name ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">MARITAL STATUS</label>
                                                <select name="marital_status" class="form-control" id="marital_status">
                                                    <option value="" disabled
                                                        <?php echo empty($leads->marital_status) ? 'selected' : ''; ?>>
                                                        Select</option>
                                                    <option value="Single"
                                                        <?php echo $leads->marital_status === 'Single' ? 'selected' : ''; ?>>
                                                        Single</option>
                                                    <option value="Married"
                                                        <?php echo $leads->marital_status === 'Married' ? 'selected' : ''; ?>>
                                                        Married</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="spouseNameDiv" style="display: none;">
                                            <div class="form-group">
                                                <label class="control-label text-light">SPOUSE NAME</label>
                                                <input type="text" name="spouse_name"
                                                    value="{{$leads->spouse_name ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3" id="spouseDobDiv" style="display: none;">
                                            <div class="form-group">
                                                <label class="control-label text-light">SPOUSE DOB</label>
                                                <!-- <input type="date" name="spouse_dob" id="spouse_dob"
                                                    value="{{$leads->spouse_dob ?? ''}}" class="form-control"> -->
                                                    <input type="text" name="spouse_dob" id="spouse_dob"
                                                    value="{{$leads->spouse_dob ?? ''}}" maxlength="10" placeholder="DD-MM-YYYY" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label text-light">CURRENT ADDRESS</label>
                                                <textarea name="current_address"
                                                    class="form-control">{{$leads->current_address ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label text-light">CURRENT ADDRESS
                                                    LANDMARK</label>
                                                <textarea class="form-control"
                                                    name="current_address_landmark">{{$leads->current_address_landmark ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">CURRENT ADDRESS
                                                    TYPE</label>
                                                <select class="form-control" name="current_address_type"
                                                    id="currentAddressType">
                                                    <option value="" disabled
                                                        <?php echo empty($leads->current_address_type) ? 'selected' : ''; ?>>
                                                        Select</option>
                                                    <option value="Owned"
                                                        <?php echo $leads->current_address_type === 'Owned' ? 'selected' : ''; ?>>
                                                        Owned</option>
                                                    <option value="Rented"
                                                        <?php echo $leads->current_address_type === 'Rented' ? 'selected' : ''; ?>>
                                                        Rented</option>
                                                    <option value="Company Provided"
                                                        <?php echo $leads->current_address_type === 'Company Provided' ? 'selected' : ''; ?>>
                                                        Company Provided</option>
                                                </select>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">CURRENT ADDRESS
                                                    PROOF</label>

                                                <select class="form-control" name="current_address_proof"
                                                    id="currentAddressType">
                                                    <option value="" disabled
                                                        <?php echo empty($leads->current_address_proof) ? 'selected' : ''; ?>>
                                                        Select</option>
                                                    <option value="Aadhar"
                                                        <?php echo $leads->current_address_proof === 'Aadhar' ? 'selected' : ''; ?>>
                                                        Aadhar</option>
                                                    <option value="Utility Bill"
                                                        <?php echo $leads->current_address_proof === 'Utility Bill' ? 'selected' : ''; ?>>
                                                        Utility Bill</option>
                                                    <option value="Rental Agreement"
                                                        <?php echo $leads->current_address_proof === 'Rental Agreement' ? 'selected' : ''; ?>>
                                                        Rental Agreement</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">NUMBER OF YEARS LIVING
                                                    IN
                                                    CURRENT ADDRESS</label>
                                                <input type="number" name="living_current_address_year"
                                                    value="{{$leads->living_current_address_year ?? '' }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">NUMBER OF YEARS LIVING
                                                    IN
                                                    CURRENT CITY</label>
                                                <input type="number" name="living_current_city_year"
                                                    value="{{$leads->living_current_city_year ?? '' }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label text-light">PERMANENT
                                                    ADDRESS</label>
                                                <textarea class="form-control"
                                                    name="permanent_address">{{$leads->permanent_address ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label text-light">PERMANENT ADDRESS
                                                    LANDMARK</label>
                                                <textarea class="form-control"
                                                    name="permanent_address_landmark">{{$leads->permanent_address_landmark ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">COMPANY NAME</label>
                                                <input type="text" name="company_name" value="{{$leads->company_name}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">YOUR DESIGNATION</label>
                                                <input type="text" name="designation"
                                                    value="{{$leads->designation ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">YOUR DEPARTMENT</label>
                                                <input type="text" name="department"
                                                    value="{{$leads->department ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">DOJ IN CURRENT
                                                    COMPANY</label>
                                                <input type="text" name="current_company" id="current_company"
                                                    value="{{$leads->current_company ?? ''}}" maxlength="10" placeholder="DD-MM-YYYY" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">CURRENT WORK
                                                    EXPEIRINCE</label>
                                                <input type="text" name="current_work_experience"
                                                    value="{{$leads->current_work_experience ?? ''}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">TOTAL WORK
                                                    EXPERINCE</label>
                                                <input type="text" name="total_work_experience"
                                                    value="{{$leads->total_work_experience ?? ''}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">PERSONAL EMAIL</label>
                                                <input type="email" name="personal_email"
                                                    value="{{$leads->personal_email ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">WORK EMAIL</label>
                                                <input type="email" name="work_email"
                                                    value="{{$leads->work_email ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label text-light">office ADDRESS</label>
                                                <textarea class="form-control"
                                                    name="office_address">{{$leads->office_address ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label text-light">office ADDRESS
                                                    LANDMARK</label>
                                                <textarea class="form-control"
                                                    name="office_address_landmark">{{$leads->office_address_landmark ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h5 style="color: #03b0f5 !important;">1st Reference</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE NAME</label>
                                                <input type="text" name="reference_name1"
                                                    value="{{$leads->reference_name1 ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE mobile
                                                    number</label>
                                                <input type="text" id="reference_mobile1" name="reference_mobile1"
                                                    value="{{$leads->reference_mobile1 ?? ''}}" class="form-control">
                                                <!-- Mobile Number 10 Digits Only Allowed Message Here  -->
                                                <span id="reference_mobile1Error" style="color:red;display:none"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE
                                                    RELATION</label>
                                                <select class="form-control" name="reference_relation1"
                                                    id="currentAddressType">
                                                    <option value="" disabled
                                                        <?php echo empty($leads->reference_relation1) ? 'selected' : ''; ?>>
                                                        Select</option>
                                                    <option value="Friend"
                                                        <?php echo $leads->reference_relation1 === 'Friend' ? 'selected' : ''; ?>>
                                                        Friend</option>
                                                    <option value="Relative"
                                                        <?php echo $leads->reference_relation1 === 'Relative' ? 'selected' : ''; ?>>
                                                        Relative</option>
                                                    <option value="Colleague"
                                                        <?php echo $leads->reference_relation1 === 'Colleague' ? 'selected' : ''; ?>>
                                                        Colleague</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE
                                                    ADDRESS</label>
                                                <textarea class="form-control"
                                                    name="reference_address1">{{$leads->reference_address1 ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h5 style="color: #03b0f5 !important;">2nd Reference</h5>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE NAME</label>
                                                <input type="text" name="reference_name2"
                                                    value="{{$leads->reference_name2 ?? ''}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE mobile
                                                    number</label>
                                                <input type="text" id="reference_mobile2" name="reference_mobile2"
                                                    value="{{$leads->reference_mobile2 ?? ''}}" class="form-control">
                                                <!-- Mobile Number 10 Digits Only Allowed Message Here  -->
                                                <span id="reference_mobile2Error" style="color:red;display:none"></span>
                                            </div>

                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE
                                                    RELATION</label>
                                                <select class="form-control" name="reference_relation2"
                                                    id="currentAddressType">
                                                    <option value="" disabled
                                                        <?php echo empty($leads->reference_relation2) ? 'selected' : ''; ?>>
                                                        Select</option>
                                                    <option value="Friend"
                                                        <?php echo $leads->reference_relation2 === 'Friend' ? 'selected' : ''; ?>>
                                                        Friend</option>
                                                    <option value="Relative"
                                                        <?php echo $leads->reference_relation2 === 'Relative' ? 'selected' : ''; ?>>
                                                        Relative</option>
                                                    <option value="Colleague"
                                                        <?php echo $leads->reference_relation2 === 'Colleague' ? 'selected' : ''; ?>>
                                                        Colleague</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">REFERENCE
                                                    ADDRESS</label>
                                                <textarea class="form-control"
                                                    name="reference_address2">{{$leads->reference_address2 ?? ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn_loginform_update"
                                        style="background-color:green;color:white">Save</button>
                                </form>
                            </div>
                        </div>

                        <!-- Remark Start Here -->
                        <div class="tab-pane fade all_tabs_bg" id="Remark">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="label_color_text">Remark</h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="messages-input-form">
                                            <form id="add_remark" method="POST" action="javascript:void(0);">
                                                @csrf
                                                <div class="input">
                                                    <input type="hidden" name="lead_id" value="{{$leads->id}}">
                                                    <input type="hidden" name="admin_id"
                                                        value="{{$adminlogin->id ?? ''}}">
                                                    <input type="text" name="remark" placeholder="Write here..."
                                                        class="form-control">
                                                </div>
                                                <div class="buttons">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-share"></i></button>
                                                </div>
                                            </form>
                                        </div>

                                        <ul class="messages messages-stripped">
                                            @if($remarks->isEmpty())
                                            @else
                                            @php
                                            $sr = 1;
                                            @endphp
                                            @foreach($remarks as $item)
                                            <li>
                                                <img src="{{asset('Admin/img/demo/avatar/avatar2.jpg')}}" alt="">
                                                <div>
                                                    <div>
                                                        <h5 class="theam_color">{{$item->createdby ?? ''}}</h5>
                                                        <span class="time">
                                                            <i class="fa fa-clock-o"></i>
                                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i A', $item->date, 'Asia/Kolkata')->diffForHumans() }}
                                                        </span>
                                                    </div>
                                                    <p>{{$item->remark ?? ''}}</p>
                                                </div>
                                            </li>
                                            @php
                                            $sr++;
                                            @endphp
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Remark End Here -->

                        <div class="tab-pane fade all_tabs_bg" id="Task">
                            <div class="boligation_tabls">
                                <div class="row">
                                    <div class="col-md-12" style="display:flex;justify-content:end">
                                        <button type="button" class="btn btn-info" id="openModalBtn">
                                            Add Task
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="label_color_text">All Task</h3>
                                    </div>

                                    <div class="col-md-12" style="margin-top: 20px;">
                                        <div class="table-responsive" style="border:0">
                                            <table class="table table-advance" id="table1">
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
                                                    @if($tasks->isEmpty())
                                                    @else
                                                    @php
                                                    $sr = 1;
                                                    @endphp
                                                    @foreach($tasks as $item)
                                                    <tr class="table-flag-blue">
                                                        <td><input type="checkbox"></td>
                                                        <td>{{$item->createdby ?? ''}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="edittask"
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
                                                        <td>{{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d-M-Y') : '' }}
                                                        </td>
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
                        <div class="tab-pane fade all_tabs_bg" id="Attachement">
                            <div class="boligation_tabls">

                                <!-- Start Attachment Here  -->
                                <form id="edit_attachment_form" action="javascript:void(0)" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="admin_id" value="{{$adminlogin->id}}">
                                    <input type="hidden" name="lead_id" value="{{$leads->id}}">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">CIBIL REPORT</label>
                                                <input type="file" name="cibil_report_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">PASSPORT SIZE PHOTO</label>
                                                <input type="file" name="passport_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">PAN CARD</label>
                                                <input type="file" name="pan_card_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">Aadhar Card</label>
                                                <input type="file" name="aadhar_card_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">3 MONTHS SALARY SLIP</label>
                                                <input type="file" name="salary_3month_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">SALARY ACCOUNT BANKING</label>
                                                <input type="file" name="salary_account_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">BT LOAN DOCUMENTS</label>
                                                <input type="file" name="bt_loan_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">CREDIT CARD STATEMENT</label>
                                                <input type="file" name="credit_card_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">ELECTRICITY BILL</label>
                                                <input type="file" name="electric_bill_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">FORM 16 & 26AS</label>
                                                <input type="file" name="form_16_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">OTHER DOCUMENTS</label>
                                                <input type="file" name="other_document_image[]" class="form-control" multiple>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label class="control-label text-light">All file PASSWORD</label>
                                                <textarea class="form-control" name="all_file_password" autocorrect="on">{{$leads->all_file_password ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary text-white btn_attachment_update" style="float:right;font-weight:bold;font-size:20px;" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>

                                <!-- End Attachment Here  -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="label_color_text">All Attachement</h3>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="card task_card ">
                                            <div class="car-header">
                                                <h5 class="label_color_text">Timing</h5>
                                                <!-- <p>Today , 12:14 Am</p> -->
                                                <p>Today , 12:14 Am</p>
                                            </div>
                                            <div class="car-header" style="margin-bottom: 10px; justify-content: end;">
                                                <button class="btn view-btn" data-lead_id="{{$leads->id}}"
                                                    data-admin_id="{{$leads->admin_id}}" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal">View</button>
                                                <button class="btn" id="downloadButton">Download</button>
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
    </div>
</div>
<!-- Main Content End Here  -->




<!-- Delete Confirmation Modal Oblogation History Data -->
<div id="obligationdeletemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;">Delete Obligation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p>Are you sure you want to delete this? This action cannot be undone.</p>
                <form id="obligationdelete_form" action="javascript:void(0);" method="post">
                    @csrf
                    <input type="hidden" name="id" id="obligation_delete_id" value="" class="form-control">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between" style="margin-top: 15px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- modal Add task  -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="modalTitle">Add Task</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <!-- <form class="mail-compose form-horizontal" action="#"> -->
                    <form id="add_task" method="post" class="mail-compose form-horizontal" action="javascript:void(0);">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}"> <!-- admin_id-->
                        <input type="hidden" name="lead_id" value="{{$leads->id}}"> <!-- lead_id-->
                        <p>
                            <label for="">Created By</label>
                            <input type="text" value="{{$adminlogin->name}}" class="form-control" disabled>
                        </p>
                        <p><input type="text" name="subject" placeholder="Subject" class="form-control"></p>
                        <p><textarea name="message" class="form-control wysihtml5" rows="6"></textarea></p>
                        <p>
                            <select name="task_type[]" data-placeholder="Type Task"
                                class="form-control chosen AddChosen" tabindex="6">
                                <option value="To Do">To Do</option>
                                <option value="Call">Call</option>
                                <option value="Pendency">Pendency</option>
                                </optgroup>
                            </select>
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
                            <select name="assign[]" data-placeholder="Assign" class="form-control chosen AddChosen"
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
<!-- modal end  -->

<!-- Modal About Section Modal Start Here -->
<div id="editaboutmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="editaboutmodalLabel">Edit About</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_about_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="edit_id" value="" class="form-control">
                        <!-- <div class="col-sm-12">
                            <label for="data_code">Data Code</label>
                            <input type="text" name="data_code" id="edit_data_code" class="form-control" placeholder="Enter Data Code">
                        </div> -->
                        <div class="col-sm-12">
                            <label for="bank_name">Data Code</label>
                            <select name="data_code" class="form-control" id="edit_data_code">
                                @php
                                $data_codes = DB::table('tbl_datacode')->get();
                                @endphp
                                @foreach($data_codes as $item)
                                <option value="{{ $item->id }}">{{ $item->datacode_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="name">Customer Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" placeholder="FIRST NAME & LAST NAME">
                        </div>
                        <div class="col-sm-12">
                            <label for="pincode">Pin Code</label>
                            <!-- <input type="text" name="pincode" id="edit_pincode" class="form-control" placeholder="201301, NEW DELHI"> -->
                            <input type="text" name="pincode" id="edit_pincode" class="form-control" placeholder="201301, NEW DELHI" oninput="validatePincode(this)">
                            <span id="edit_pincodecheck" style="color: red; display: none;">Please enter a valid pincode format: 123456 , City</span>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn_update" style="margin-top:15px; float:right;"
                                type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit About Section Modal End Here -->

<!-- Modal Operation Section Modal Start Here -->
<div id="editoperationmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="editoperationmodalLabel">Edit Operation Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_operation_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="edit_operation_id" value="" class="form-control">
                        <!-- <div class="col-sm-12">
                            <label for="channel_name">Channel Name</label>
                            <input type="text" name="channel_name" id="edit_channel_name" class="form-control">
                        </div> -->
                        <div class="col-sm-12">
                            <label for="bank_name">Channel Name</label>
                            <select name="channel_id" class="form-control" id="edit_channel_name">
                                @php
                                $channel_names = DB::table('tbl_channel_name')->get();
                                @endphp
                                @foreach($channel_names as $item)
                                <option value="{{ $item->id }}">{{ $item->channel_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="los_number">Los Number</label>
                            <input type="text" name="los_number" id="edit_los_number" placeholder="Los Number" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="amount_approved">Amount Approved</label>
                            <input type="text" name="amount_approved" id="edit_amount_approved" placeholder="₹" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="rate">Rate</label>
                            <input type="text" name="rate" id="edit_rate" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="pf_insurance">Pf & Insurance</label>
                            <input type="text" name="pf_insurance" id="edit_pf_insurance" class="form-control" placeholder="Pf & Insurance">
                        </div>
                        <!-- <div class="col-sm-12">
                            <label for="tenure_given">Tenure Given</label>
                            <input type="text" name="tenure_given" id="edit_tenure_given" placeholder="Tenure Given" class="form-control">
                        </div> -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">REQUIRED TENURE</label>
                                <div class="controls">
                                    <input list="edit_tenureListOperation" name="tenure_given" id="edit_tenure_given" class="form-control" placeholder="Select Months">
                                    <datalist id="edit_tenureListOperation">
                                        <script>
                                            for (let i = 1; i <= 84; i++) {
                                                document.write(`<option value="${i} Month${i > 1 ? 's' : ''}"></option>`);
                                            }
                                        </script>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <div class="controls">
                                    <input type="text" name="tenure_year" id="edit_tenure_year" placeholder="Years"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <label for="amount_disbursed">Amount Disbursed</label>
                            <input type="text" name="amount_disbursed" id="edit_amount_disbursed" placeholder="₹" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="internal_top">Internal Top</label>
                            <input type="text" name="internal_top" id="edit_internal_top" placeholder="Internal Top" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="cashback_to_customer">Cashback To Customer</label>
                            <input type="text" name="cashback_to_customer" id="edit_cashback_to_customer" placeholder="Cashback To Customer" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="disbursment_date">Disbursment Date</label>
                            <input type="date" name="disbursment_date" id="edit_disbursment_date" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary btn_update" style="margin-top:15px; float:right;"
                                type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Operation Section Modal End Here -->

<!-- Modal Process Section Modal Start Here -->
<div id="editprocessmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="editprocessmodalLabel">Edit Process</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="edit_process_form" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" id="edit_process_id" value="" class="form-control">
                        <div class="col-sm-12">
                            <label for="bank_name">Bank Name</label>
                            <select name="bank_id" class="form-control" id="edit_bank_name">
                                @php
                                $banks = DB::table('tbl_bank')->get();
                                @endphp
                                @foreach($banks as $item)
                                <option value="{{ $item->id }}">{{ $item->bank_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="bank_name">Product Need</label>
                            <select name="product_need_id" class="form-control" id="edit_product_need_name">
                                @php
                                $product_needs = DB::table('tbl_product_need')->get();
                                @endphp
                                @foreach($product_needs as $item)
                                <option value="{{ $item->id }}">{{ $item->product_need }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="bank_name">Case Type</label>
                            <select name="casetype_id" class="form-control" id="edit_casetype">
                                @php
                                $casetypedata = DB::table('tbl_casetype')->get();
                                @endphp
                                @foreach($casetypedata as $item)
                                <option value="{{ $item->id }}">{{ $item->casetype }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12">
                            <label for="loan_amount">Loan Amount</label>
                            <input type="text" name="loan_amount" id="edit_loan_amount" placeholder="₹" class="form-control">
                        </div>
                        <div class="col-sm-12">
                            <label for="process">How To Process</label>
                            <textarea name="process" id="edit_process" class="form-control" rows="4"></textarea>
                        </div>

                        <!-- Start Tenure Months 24 Here  -->
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">REQUIRED TENURE</label>
                                <div class="controls">
                                    <input list="edit_tenureList" name="tenure" id="edit_tenure" class="form-control"
                                        placeholder="Select Months">
                                    <datalist id="edit_tenureList">
                                        <option value="1 Month"></option>
                                        <option value="2 Months"></option>
                                        <option value="3 Months"></option>
                                        <option value="4 Months"></option>
                                        <option value="5 Months"></option>
                                        <option value="6 Months"></option>
                                        <option value="7 Months"></option>
                                        <option value="8 Months"></option>
                                        <option value="9 Months"></option>
                                        <option value="10 Months"></option>
                                        <option value="11 Months"></option>
                                        <option value="12 Months"></option>
                                        <option value="13 Months"></option>
                                        <option value="14 Months"></option>
                                        <option value="15 Months"></option>
                                        <option value="16 Months"></option>
                                        <option value="17 Months"></option>
                                        <option value="18 Months"></option>
                                        <option value="19 Months"></option>
                                        <option value="20 Months"></option>
                                        <option value="21 Months"></option>
                                        <option value="22 Months"></option>
                                        <option value="23 Months"></option>
                                        <option value="24 Months"></option>
                                    </datalist>
                                </div>
                            </div>
                        </div> -->
                        <!-- 24 Months End Here -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">REQUIRED TENURE</label>
                                <div class="controls">
                                    <input list="edit_tenureList" name="tenure" id="edit_tenure" class="form-control" placeholder="Select Months">
                                    <datalist id="edit_tenureList">
                                        <script>
                                            for (let i = 1; i <= 84; i++) {
                                                document.write(`<option value="${i} Month${i > 1 ? 's' : ''}"></option>`);
                                            }
                                        </script>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Year</label>
                                <div class="controls">
                                    <input type="text" name="year" id="edit_year" placeholder="Years"
                                        class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- End Here  -->

                        <div class="col-sm-12">
                            <button class="btn btn-primary btn_process_update" style="margin-top:15px; float:right;"
                                type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Process Section Modal End Here -->

<!-- Modal View Attachments Here -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black;font-weight: 900;" id="viewModalLabel">Attachments Details
                </h5>
                <button type="button" class="btn-close close-modal-btn" data-bs-dismiss="modal"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <!-- Start Here  -->
                <div id="modal-content"></div>
                <!-- End Here  -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal-btn" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal View Attachments Here -->
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

<!-- EditTask Start Here -->
<div id="editmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: black;" id="editModalLabel">Edit Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <form id="edit_task" action="javascript:void(0);" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="admin_id" value="{{$adminlogin->id}}" class="form-control">
                        <!-- Admin Id -->
                        <input type="hidden" name="task_id" id="edit_task_id" value="" class="form-control">
                        <!-- Task Id -->
                        <div class="col-sm-12 mb-2">
                            <label for="subject">Created By</label>
                            <input type="text" id="created_by" class="form-control" readonly>
                        </div>

                        <div class="col-sm-12">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="edit_subject" class="form-control" disabled>
                        </div>
                        <div class="col-sm-12 disabled-div">
                            <textarea id="edit_message" name="message" class="form-control wysihtml5"
                                disabled></textarea>
                        </div>
                        <div class="col-sm-12">
                            <select name="task_type" id="edit_task_type" data-placeholder="Type Task"
                                class="form-control chosen EditChoosen" tabindex="6" disabled>
                                <option value="To Do">To Do</option>
                                <option value="Call">Call</option>
                                <option value="Pendency">Pendency</option>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <div class="controls">
                                <label for="">Lead / Login</label>
                                <select id="edit_lead_type" name="lead_type" class="form-control"
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
                                <select id="edit_lead_id" name="lead_id" class="form-control">
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
                            <input type="date" name="date" id="edit_date" class="form-control" disabled>
                        </div>
                        <div class="col-sm-6">
                            <input type="time" name="time" id="edit_time" class="form-control" disabled>
                        </div>

                        <div class="col-sm-6">
                            <select name="assign[]" id="edit_assign" data-placeholder="Assign"
                                class="form-control chosen EditChoosen" multiple="multiple" tabindex="6" disabled>
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

                        <div class="col-sm-12"
                            style="display: flex; justify-content: space-between; align-items: center;">

                            <!-- <button class="btn btn-success" style="margin: 0 auto;" type="submit">Completed</button> -->

                            <!-- Task Status Check -->
                            <input type="hidden" id="form_task_id" value="">
                            <input type="hidden" id="logged_in_user_id" value="{{ $adminlogin->id }}">
                            <!-- <button id="task_status_button" class="btn btn-success" style="margin: 0 auto;"
                                type="button">Completed</button> -->
                            <button id="task_status_button" class="btn btn-success task_status_button" style="margin: 0 auto;"
                                type="button">Task Closed</button>
                            <!-- Task Status Check -->

                            <div style="display: flex; gap: 10px;">
                                <button id="edit_button" class="btn btn-primary" style="margin-top: 15px;"
                                    type="button">Edit</button>
                                <button id="update_button" class="btn btn-success"
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
                                                    <form id="add_comment_task" method="POST"
                                                        action="javascript:void(0);">
                                                        @csrf
                                                        <div class="input">
                                                            <input type="hidden" name="task_id" id="comment_task_id"
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
                                                <ul class="messages messages-stripped" id="get_comment">
                                                    <!-- @if($remarks->isEmpty())
                                                    @else
                                                    @php
                                                    $sr = 1;
                                                    @endphp
                                                    @foreach($remarks as $item)
                                                    <li>
                                                        <img src="{{asset('Admin/img/demo/avatar/avatar2.jpg')}}" alt="">
                                                        <div>
                                                            <div>
                                                                <h5 class="theam_color">{{$item->name ?? ''}}</h5>
                                                                <span class="time"><i class="fa fa-clock-o"></i>
                                                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d h:i A', $item->date, 'Asia/Kolkata')->diffForHumans() }}
                                                                </span>
                                                            </div>
                                                            <p>{{$item->name ?? ''}}</p>
                                                        </div>
                                                    </li>
                                                    @php
                                                    $sr++;
                                                    @endphp
                                                    @endforeach
                                                    @endif -->
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


<!-- Lead Move to Login Assigned Operation Start Here -->
<div class="modal fade" id="assignAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:black">Assign Operation Department</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="assignAdminForm">
                    <input type="hidden" id="lead_id" name="lead_id">
                    <label>Select Operation Department</label>
                    <select id="adminSelect" name="admin_ids[]" multiple class="form-control OperationDepartment"></select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitAssign">Assign</button>
            </div>
        </div>
    </div>
</div>
<!-- Lead Move to Login Assigned Operation End Here -->



<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- Obligation History Delete With Calculation -->
<script>
    $(document).on('click', '.obligationdelete', function () {
    var id = $(this).data("id");
    $("#obligation_delete_id").val(id);
    $("#obligationdeletemodal").modal("show");
    // Store reference to the row
    var row = $(this).closest("tr");
    $("#obligationdelete_form").off("submit").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{ url('/delete_obligation') }}", // Change this to your actual delete route
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function (data) {
                if (data.success == "success") {
                    $("#obligationdeletemodal").modal("hide");
                    $("#obligationdelete_form")[0].reset();
                    swal("Obligation Deleted Successfully!", "", "success");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    row.remove();
                } else {
                    swal("Error!", "Failed to delete obligation", "error");
                }
            },
            error: function (error) {
                swal("Something Went Wrong!", "", "error");
            },
        });
    });
});
</script>
<!-- Obligation History Delete With Calculation -->




<!-- Valid Pincode About Section me  -->
<script>
function validatePincode(inputField) {
    const errorMessage = document.getElementById(inputField.id + 'check');
    let value = inputField.value.trim();
    // Allow only numeric characters for the first 6 digits
    const numericOnly = /^[0-9]*$/;
    // Agar 6 digits hain, aur koi comma nahi hai, toh comma add karo
    if (value.length === 6 && !value.includes(',')) {
        inputField.value = value + ", ";
    }
    // Regex for valid format: 6 digits followed by a comma and optional space
    const regex = /^(\d{6}),\s*/;
    // Restrict input to only numeric characters for the pincode
    if (!numericOnly.test(value.slice(0, 6))) {
        inputField.setCustomValidity("Please enter only numeric characters for the pincode.");
        errorMessage.style.display = 'inline';
        return;
    }
    // Check if the value is valid and does not contain alphabets
    const restrictedPattern = /^(?!878787$)\d{6}$/; // Check if not '878787'
    if (value.match(regex) && restrictedPattern.test(value.slice(0, 6))) {
        errorMessage.style.display = 'none';
        inputField.setCustomValidity("");
    } else if (value.length > 6) {
        inputField.value = value.slice(0, 6) + ", ";
        errorMessage.style.display = 'none';
    } else {
        inputField.setCustomValidity("Please enter a valid pincode format: 123456 , City");
        errorMessage.style.display = 'inline';
    }
}
</script>
<!-- Valid Pincode About Section me  -->



<!-- Choosen Operation Section -->
<script>
    $(document).ready(function () {
    $(".OperationDepartment").chosen({
        width: "100%", // Set width to 100%
        allow_single_deselect: true // Allow deselecting options
    });
});
</script>


<!-- ReOrdering BT and Obligation After Change The Select Box Start Here -->
<script>
$(document).ready(function() {
    $('#filterSelect').change(function() {
        var selectedValue = $(this).val(); // Get the selected filter value
        var rows = $('#obligationTable tr').not(':first').get(); // Get all rows except the header

        // Sort rows based on the selected filter
        rows.sort(function(a, b) {
            var aValue = $(a).find('select[name="bt_obligation1[]"]').val(); // Get BT/Obligation value of row A
            var bValue = $(b).find('select[name="bt_obligation1[]"]').val(); // Get BT/Obligation value of row B

            if (selectedValue === 'BT') {
                return aValue === 'BT' ? -1 : 1; // Move BT rows to the top
            } else if (selectedValue === 'Obligation') {
                return aValue === 'Obligation' ? -1 : 1; // Move Obligation rows to the top
            }
            return 0; // No change
        });

        // Re-append sorted rows to the table
        $.each(rows, function(index, row) {
            $('#obligationTable').append(row);
        });
    });
});
</script>
<!-- ReOrdering BT and Obligation After Change The Select Box Start Here -->




<!-- This is for updated obligation here -->
<script>
$(document).ready(function () {
    $("#updateObligation").click(function () {
        let obligations = [];
        $("tr").each(function () {
            let admin_id = $(this).find("input[name='admin_id[]']").val();
            let lead_id = $(this).find("input[name='lead_id[]']").val();
            let obligation_id = $(this).find("input[name='obligation_id[]']").val();
            let product_id = $(this).find("select[name='product_id1[]']").val();
            let bank_id = $(this).find("select[name='bank_id1[]']").val();
            let total_loan_amount = $(this).find("input[name='total_loan_amount1[]']").val();
            let bt_pos = $(this).find("input[name='bt_pos1[]']").val();
            let bt_emi = $(this).find("input[name='bt_emi1[]']").val();
            let bt_obligation = $(this).find("select[name='bt_obligation1[]']").val();

            if (obligation_id && product_id && bank_id) {
                obligations.push({
                    admin_id: admin_id,
                    lead_id: lead_id,
                    obligation_id: obligation_id,
                    product_id: product_id,
                    bank_id: bank_id,
                    total_loan_amount: total_loan_amount,
                    bt_pos: bt_pos,
                    bt_emi: bt_emi,
                    bt_obligation: bt_obligation
                });
            }
        });


        $.ajax({
            url: "{{ url('/update-obligation') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify({ obligations: obligations }),
            contentType: "application/json",
            success: function (response) {
                swal(response.message, '', 'success');
                window.location.reload();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("Error updating obligations");
            }
        });
    });
});
</script>



<!-- 01-02-2025  dob,spouse_dob, doj--> 
<script>
document.querySelectorAll("#dob, #spouse_dob, #current_company").forEach(function (input) {
    input.addEventListener("input", function (e) {
        let value = e.target.value.replace(/\D/g, ""); // Sirf numbers allow karega (0-9)
        if (value.length > 8) {
            value = value.substring(0, 8); // Maximum 8 digits allow karega
        }
        let formattedValue = "";
        // Date validation (DD should be 01-31)
        if (value.length >= 2) {
            let day = parseInt(value.substring(0, 2));
            if (day < 1) day = "01"; 
            if (day > 31) day = "31";
            formattedValue += day.toString().padStart(2, "0") + "-"; // Ensure two-digit format
        } else {
            formattedValue += value;
        }
        // Month validation (MM should be 01-12)
        if (value.length >= 4) {
            let month = parseInt(value.substring(2, 4));
            if (month < 1) month = "01";
            if (month > 12) month = "12";
            formattedValue += month.toString().padStart(2, "0") + "-"; // Ensure two-digit format
        } else if (value.length > 2) {
            formattedValue += value.substring(2, 4);
        }
        // Year (YYYY)
        if (value.length > 4) {
            formattedValue += value.substring(4, 8);
        }
        e.target.value = formattedValue; // Final formatted value set karega
    });
});
</script>
<!-- 01-02-2025 d0b,spouse_dob,doj -->

<!-- Marital Status SIngle ke Case me Spouse name and dob hide rhenge  -->
<script>
$(document).ready(function() {
    var maritalStatus = $("#marital_status").val();
    if (maritalStatus === 'Single') {
        $("#spouseNameDiv").hide();
        $("#spouseDobDiv").hide();
    }
    $("#marital_status").change(function() {
        toggleSpouseFields();
    });

    function toggleSpouseFields() {
        var maritalStatus = $("#marital_status").val();
        if (maritalStatus === 'Married') {
            $("#spouseNameDiv").show();
            $("#spouseDobDiv").show();
        } else {
            $("#spouseNameDiv").hide();
            $("#spouseDobDiv").hide();
        }
    }
});
</script>

<!-- Only Digit Not Allowed Special Character Start Here -->
<script>
$(document).ready(function() {
    $("#account_no, #reference_mobile1, #reference_mobile2, #aadhar_no").on("input", function() {
        let value = $(this).val();
        // Sirf 0-9 digits allow karega, baki sab remove karega (spaces, letters, symbols)
        let cleanedValue = value.replace(/[^0-9]/g, '');
        $(this).val(cleanedValue);
    });
});

// Check 10 Digits
$('#aadhar_no').on('input', function() {
    const aadharNumber = $(this).val();
    if (aadharNumber.length !== 12 && aadharNumber.length > 0) {
        $('#aadharnoError').show().text("Aadhar Number must be exactly 12 digits.");
    } else {
        $('#aadharnoError').hide();
    }
});
// Pancard no 
$('#pan_card_no').on('input', function() {
    const pancardNumber = $(this).val();
    if (pancardNumber.length !== 10 && pancardNumber.length > 0) {
        $('#pancardnoError').show().text("Pan Card Number must be exactly 10 digits.");
    } else {
        $('#pancardnoError').hide();
    }
});
</script>
<!-- Mobile Number 10 Digits Allowed Only -->
<script>
$('#reference_mobile1').on('input', function() {
    const mobileNumber = $(this).val();
    if (mobileNumber.length !== 10 && mobileNumber.length > 0) {
        $('#reference_mobile1Error').show().text("Mobile number must be exactly 10 digits.");
    } else {
        $('#reference_mobile1Error').hide();
    }
});

$('#reference_mobile2').on('input', function() {
    const mobileNumber2 = $(this).val();
    if (mobileNumber2.length !== 10 && mobileNumber2.length > 0) {
        $('#reference_mobile2Error').show().text("Mobile number must be exactly 10 digits.");
    } else {
        $('#reference_mobile2Error').hide();
    }
});
</script>
<!-- Mobile Number 10 Digits Allowed Only -->
<!-- Only Digit Not Allowed Special Character End Here -->


<!-- Edit Tenure And Year Start Here  -->
<script>
document.getElementById("edit_tenure").addEventListener("change", function() {
    const months = parseInt(this.value); // Get selected months
    const yearInput = document.getElementById("edit_year");

    if (!isNaN(months)) {
        const years = Math.floor(months / 12); // Calculate years
        const remainingMonths = months % 12; // Calculate remaining months

        if (years > 0 && remainingMonths > 0) {
            yearInput.value =
                `${years}.${(remainingMonths / 12).toFixed(1).slice(2)} Years`; // Format as "1.6 Years"
        } else if (years > 0) {
            yearInput.value = `${years} Years`; // Format as "1 Year"
        } else {
            yearInput.value = `${remainingMonths} Months`; // Format as "6 Months"
        }
    } else {
        yearInput.value = ""; // Clear input if no selection
    }
});

// Edit Tenure Operation 
document.getElementById("edit_tenure_given").addEventListener("change", function() {
    const months = parseInt(this.value); // Get selected months
    const yearInput = document.getElementById("edit_tenure_year");

    if (!isNaN(months)) {
        const years = Math.floor(months / 12); // Calculate years
        const remainingMonths = months % 12; // Calculate remaining months

        if (years > 0 && remainingMonths > 0) {
            yearInput.value =
                `${years}.${(remainingMonths / 12).toFixed(1).slice(2)} Years`; // Format as "1.6 Years"
        } else if (years > 0) {
            yearInput.value = `${years} Years`; // Format as "1 Year"
        } else {
            yearInput.value = `${remainingMonths} Months`; // Format as "6 Months"
        }
    } else {
        yearInput.value = ""; // Clear input if no selection
    }
});
</script>
<!-- Edit Tenure And Year End Here  -->



<script>
// Format Salary Function
function formatSalary(input) {
    // Sirf numbers ko allow karna, ₹ aur commas ko handle karna
    let value = input.value.replace(/[^0-9]/g, ''); // Sirf numbers ko rakhenge
    if (value) {
        input.value = '₹ ' + new Intl.NumberFormat('en-IN').format(value); // ₹ aur commas laga rahe hain
    } else {
        input.value = '₹ ';
    }
}

// Form submit hone par value ko clean karna (₹ aur commas ko remove karna)
document.querySelector("form").addEventListener("submit", function(event) {
    let salaryInput = document.getElementById("salary");
    if (salaryInput) salaryInput.value = salaryInput.value.replace(/[^0-9]/g,
    ''); // ₹ aur commas ko remove karna

    let yearlyBonusInput = document.getElementById("yearly_bonus");
    if (yearlyBonusInput) yearlyBonusInput.value = yearlyBonusInput.value.replace(/[^0-9]/g,
    ''); // ₹ aur commas ko remove karna

    let loanAmountInput = document.getElementById("loan_amount");
    if (loanAmountInput) loanAmountInput.value = loanAmountInput.value.replace(/[^0-9]/g,
    ''); // ₹ aur commas ko remove karna

    let editloanAmountInput = document.getElementById("edit_loan_amount");
    if (editloanAmountInput) editloanAmountInput.value = editloanAmountInput.value.replace(/[^0-9]/g,
    ''); // ₹ aur commas ko remove karna


});

// Page load par format apply karega for all fields
document.addEventListener("DOMContentLoaded", function() {
    let salaryInput = document.getElementById("salary");
    if (salaryInput && salaryInput.value.trim() !== '') {
        salaryInput.value = '₹ ' + new Intl.NumberFormat('en-IN').format(salaryInput.value.replace(/[^0-9]/g,
            ''));
    }

    let yearlyBonusInput = document.getElementById("yearly_bonus");
    if (yearlyBonusInput && yearlyBonusInput.value.trim() !== '') {
        yearlyBonusInput.value = '₹ ' + new Intl.NumberFormat('en-IN').format(yearlyBonusInput.value.replace(
            /[^0-9]/g, ''));
    }

    let loanAmountInput = document.getElementById("loan_amount");
    if (loanAmountInput && loanAmountInput.value.trim() !== '') {
        loanAmountInput.value = '₹ ' + new Intl.NumberFormat('en-IN').format(loanAmountInput.value.replace(
            /[^0-9]/g, ''));
    }

    let editloanAmountInput = document.getElementById("edit_loan_amount");
    if (editloanAmountInput && editloanAmountInput.value.trim() !== '') {
        editloanAmountInput.value = '₹ ' + new Intl.NumberFormat('en-IN').format(editloanAmountInput.value.replace(
            /[^0-9]/g, ''));
    }

    // for total obligation
    let obligation_sectionInput = document.getElementById("obligation_section");
    if (obligation_sectionInput && obligation_sectionInput.value.trim() !== '') {
        obligation_sectionInput.value = '₹ ' + new Intl.NumberFormat('en-IN').format(obligation_sectionInput
            .value.replace(/[^0-9]/g, ''));
    }
    // for total BT
    let pos_sectionInput = document.getElementById("pos_section");
    if (pos_sectionInput && pos_sectionInput.value.trim() !== '') {
        pos_sectionInput.value = '₹ ' + new Intl.NumberFormat('en-IN').format(pos_sectionInput.value.replace(
            /[^0-9]/g, ''));
    }

});
</script>

<!-- Mobile No Validate Only Digits Allowed Start Here -->
<script>
$(document).ready(function() {
    $("#cibil_score").on("input", function() {
        let value = $(this).val();
        // Sirf 0-9 digits allow karega aur max 3 characters rakhega
        let cleanedValue = value.replace(/[^0-9]/g, '').slice(0, 3);
        $(this).val(cleanedValue);
    });
});
</script>
<!-- Mobile No Validate Only Digits Allowed End Here -->

<!-- LeadLoginStatus Onchange Case Data Filter  -->
<script>
$(document).ready(function() {
    $('#edit_lead_type').change(function() {
        var leadType = $(this).val(); // Selected Lead Type
        $.ajax({
            url: "{{ url('lead-login-status') }}", // API Endpoint
            type: 'GET',
            data: {
                lead_login_status: leadType
            }, // Sending selected lead type
            dataType: 'json',
            success: function(response) {
                $('#edit_lead_id').html(
                    '<option selected="true" disabled="true">Select Lead</option>');
                if (response.length > 0) {
                    $.each(response, function(key, value) {
                        $('#edit_lead_id').append('<option value="' + value.id +
                            '">' + value.name + '</option>');
                    });
                } else {
                    $('#edit_lead_id').append('<option disabled>No Leads Found</option>');
                }
            }
        });
    });
});
</script>
<!-- LeadLoginStatus Change On Filter Data -->


<!-- Addtask Form Here -->
<script>
$("#add_task").submit(function(e) {
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
                document.getElementById("add_task").reset();
                $("#myModal").modal("hide");
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
<!-- Addtask Form Here -->

<!-- Disabled krna Task ko Edit ke case me by default after edit active all fields -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let editButton = document.getElementById("edit_button");
    let updateButton = document.getElementById("update_button");
    let editMessage = document.getElementById("edit_message"); // ✅ Textarea Select

    // Disable hone wale fields (div ko bhi select karenge)
    let fieldsToDisable = [
        "#edit_subject",
        "#edit_lead_type",
        "select[name='lead_id']",
        "#edit_task_type",
        "#edit_date",
        "#edit_time",
        "#edit_assign",
        "#edit_message",
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


<!--  edittask modal -->
<script>
$(document).on('click', '.edittask', function() {
    var id = $(this).data('id'); // task id
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
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        var formattedDate = 
            ("0" + dateObj.getDate()).slice(-2) + " " +   // DD
            monthNames[dateObj.getMonth()] + " " +        // MMM
            dateObj.getFullYear();                        // YYYY

        var formattedTime = created_time ? formatTime(created_time) : ""; 
        $("#created_by").val(createdBy + " - " + formattedDate + " " + formattedTime);
    } else {
        $("#created_by").val(createdBy); // Agar date nahi hai to sirf name show hoga
    }

    // Function to format time in 12-hour format with AM/PM
    function formatTime(timeStr) {
        var timeParts = timeStr.split(":");
        var hours = parseInt(timeParts[0], 10);
        var minutes = timeParts[1] ? timeParts[1].slice(0, 2) : "00"; // Ensure minutes are extracted properly
        
        var ampm = hours >= 12 ? "PM" : "AM"; // Set AM/PM correctly
        hours = hours % 12 || 12; // Convert 24-hour to 12-hour format

        // Ensure 2-digit hour and minute format
        var formattedHours = ("0" + hours).slice(-2);
        var formattedMinutes = ("0" + minutes).slice(-2);

        return formattedHours + ":" + formattedMinutes + " " + ampm;
    }


    // lead_id
    var lead_id = $(this).data('lead_id');
    $("#edit_lead_id").val(lead_id).prop("selected", true).trigger("change");

    $("#edit_task_id").val(id);
    $("#form_task_id").val(id); // form task id jisse status check krke Completed and Open Again button show krenge

    $("#comment_task_id").val(id);
    $("#edit_subject").val(subject);
    // Set message textarea
    $("#edit_message").data("wysihtml5").editor.setValue(message);

    // set chosen select box with search
    $("#edit_task_type").val(task_type).trigger("chosen:updated");
    $("#edit_task_type option").each(function() {
        if ($(this).val() !== task_type) {
            $(this).prop("disabled", false);
        } else {
            $(this).prop("disabled", false);
        }
    });
    $("#edit_task_type").trigger("chosen:updated");

    // Set lead type selected in option tag
    $("#edit_lead_type").val(lead_type);
    // Set date and time values
    $("#edit_date").val(date); // Set date
    $("#edit_time").val(time); // Set time

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
        $("#edit_time").val(formattedTime);
    }
    // Set selected values for the "assign[]" multiple select
    $("#edit_assign").val(selectedAdmins).trigger("chosen:updated");
    // Task Status Fetch Karna
    $.ajax({
        url: "{{url('/get-task-status')}}", // API jo task_status return kare
        method: 'GET',
        data: {
            task_id: id
        },
        success: function(response) {
            console.log(response);
            if (response.task_status === "Close Task") {
                $(".task_status_button").text("Open Again").removeClass("btn-success").addClass(
                    "btn-warning");
            } else if (response.task_status === "Open Task") {
                $(".task_status_button").text("Close Task").removeClass("btn-warning").addClass(
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
                $('#get_comment').append(commentHTML);
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
    // task History data end here


    $("#editmodal").modal("show");
});
</script>
<!-- Edit Task End Here -->

<!-- Task Status Update Start Here -->
<script>
$(document).on('click', '#task_status_button', function(e) {
    e.preventDefault();

    var task_id = $("#form_task_id").val();
    var admin_id = $("#logged_in_user_id").val();
    var current_status = $(this).text().trim();
    // alert(current_status);
    // var new_status = (current_status === "Completed") ? "Completed" : "Open Task";
    var new_status = (current_status === "Close Task") ? "Close Task" : "Open Task";

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
                // $("#task_status_button").text(new_status)
                //     .toggleClass("btn-success btn-warning");
                var updated_text = (new_status === "Open Task") ? "Close Task" : "Open Again";
                var button_class = (new_status === "Open Task") ? "btn-success" : "btn-warning";
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
<!-- Task Status Update End Here -->

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


<!-- Copy This Lead START HERE  -->
<script>
$('#copyThisLeadBtn').click(function() {
    var leadId = $(this).data('id');
    $.ajax({
        url: "{{url('/copy-this-lead')}}",
        method: 'POST',
        data: {
            lead_id: leadId
        },
        success: function(data) {
            if (data.status === 'success') {
                swal(data.message, "", "success");
                setTimeout(function() {
                    window.location.reload();
                }, 1500);
            } else {
                swal(data.message, "", "error");
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});
</script>
<!-- Copy This Lead End HERE  -->

<!-- Complete Status to FILE SENT TO LOGIN START HERE  -->
<script>
// $('#fileSentBtn').click(function() {
//     var leadId = $(this).data('id');
//     swal({
//         title: "Are you sure?",
//         text: "Do you want to send this file?",
//         icon: "warning",
//         buttons: ["No, Cancel", "Yes, Send it!"],
//         dangerMode: true,
//     }).then((willSend) => {
//         if (willSend) {
//             $.ajax({
//                 url: "{{url('/update-file-sentto-login')}}",
//                 method: 'POST',
//                 data: {
//                     lead_id: leadId,
//                 },
//                 success: function(data) {
//                     if (data.status === 'success') {
//                         swal(data.message, "", "success");
//                         setTimeout(function() {
//                             window.location.href = "/admin-dashboard";
//                         }, 1500);

//                     } else {
//                         swal("Error!", data.message, "error");
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     swal("Error!", "Something went wrong!", "error");
//                 }
//             });
//         }
//     });
// });

$(document).ready(function () {
    // Open Confirmation on Button Click
    $('#fileSentBtn').click(function () {
        var leadId = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "Do you want to send this file?",
            icon: "warning",
            buttons: ["No, Cancel", "Yes, Send it!"],
            dangerMode: true,
        }).then((willSend) => {
            if (willSend) {
                $('#lead_id').val(leadId); // Set Lead ID in hidden field
                $('#adminSelect').empty(); // Clear previous options
                // Fetch Admin Users
                $.ajax({
                    url: "{{ url('/get-admin-users') }}",
                    method: "GET",
                    // success: function (data) {
                    //     console.log(data);
                    //     if (data.status === 'success') {
                    //         $.each(data.users, function (index, user) {
                    //             $('#adminSelect').append(`<option value="${user.id}">${user.name}</option>`);
                    //         });
                    //         $('#adminSelect').trigger("OperationDepartment:updated"); // Update chosen.js
                    //     }
                    // }
                    success: function (data) {
                        console.log("Full Response:", data);
                        if (data.status === 'success' && Array.isArray(data.users)) {
                            console.log("Users Array:", data.users);
                            $('#adminSelect').empty(); 
                            $.each(data.users, function (index, user) {
                                console.log("Appending:", user.id, user.name);
                                $('#adminSelect').append(`<option value="${user.id}">${user.name}</option>`);
                            });

                            $('#adminSelect').trigger("chosen:updated");
                        } else {
                            console.log("No users found or incorrect response format.");
                        }
                    }
                });
                $('#assignAdminModal').modal('show');
            }
        });
    });

    // Handle Form Submission
    // $('#submitAssign').click(function () 
    // {
    //     var formData = $('#assignAdminForm').serialize();
    //     $.ajax({
    //         url: "{{ url('/update-file-sentto-login') }}",
    //         method: "POST",
    //         data: formData,
    //         success: function (data) {
    //             if (data.status === 'success') {
    //                 swal("Success", data.message, "success");
    //                 $('#assignAdminModal').modal('hide');
    //                 setTimeout(function () {
    //                     window.location.href = "/show_pl_od_leads";
    //                 }, 1500);
    //             } else {
    //                 swal("Error!", data.message, "error");
    //             }
    //         },
    //         error: function () {
    //             swal("Error!", "Something went wrong!", "error");
    //         }
    //     });
    // });

    // before submitting the form, check if all checkboxes are checked
    $('#submitAssign').click(function () 
    {
        var allChecked = true;
        // Check if all checkboxes are checked
        $('.imp-checkbox').each(function () {
            if (!$(this).prop('checked')) {
                allChecked = false;
                return false; // Break loop if any checkbox is unchecked
            }
        });
        if (!allChecked) {
            swal("Error!", "Please check all important questions before submitting.", "error");
            return;
        }
        var formData = $('#assignAdminForm').serialize();
            $.ajax({
                url: "{{ url('/update-file-sentto-login') }}",
                method: "POST",
                data: formData,
                success: function (data) {
                    if (data.status === 'success') {
                        swal("Success", data.message, "success");
                        $('#assignAdminModal').modal('hide');
                        setTimeout(function () {
                            window.location.href = "/show_pl_od_leads";
                        }, 1500);
                    } else {
                        swal("Error!", data.message, "error");
                    }
                },
                error: function () {
                    swal("Error!", "Something went wrong!", "error");
                }
            });
        });
    // end here 

});
</script>
<!-- FILE SENT TO LOGIN END HERE  -->


<!-- Checked Imp Question Here -->
<script>
// function updateImpQuestion(checkbox) 
//{
//     const leadId = $(checkbox).data('lead-id');
//     const newValue = $(checkbox).is(':checked') ? 1 : 0; // If checked, set 1; otherwise, set 0.

//     // Make an AJAX request to update the value in the database
//     $.ajax({
//         url: "{{url('/update-imp-question')}}",
//         method: 'POST',
//         data: {
//             id: leadId,
//             imp_question: newValue,
//         },
//         success: function(data) {
//             if (data.success == 'success') {
//                 swal("Important Question Saved Successfully!", "", "success");
//             } else {
//                 swal("Failed to Save", "", "error");
//             }
//         },
//         error: function(errResponse) {
//             swal("Something Went Wrong!", "", "error");
//         }
//     });
// }
</script>



<!-- All Important Question Checked then imp_question me 1 or 0 and imp_que me tbl_imp_question ki primary id (implode me jayegi) -->
<script>
$(document).ready(function () {
    let allChecked = false; // Track previous state

    // Initialize the checkbox selection based on saved state (from the database)
    $(".imp-checkbox").each(function () {
        let savedQuestions = "{{ $savedQuestionIds ?? '' }}".split(","); // Fetch saved IDs
        if (savedQuestions.includes($(this).data("question-id").toString())) {
            $(this).prop("checked", true);
        }
    });

    // When any checkbox changes
    $(".imp-checkbox").change(function () {
        let leadId = $(this).data("lead-id");
        let totalCheckboxes = $(".imp-checkbox").length;
        let checkedCheckboxes = $(".imp-checkbox:checked").length;
        let newValue = checkedCheckboxes === totalCheckboxes ? 1 : 0; // Set 1 if all checked, else 0
        let selectedIds = $(".imp-checkbox:checked").map(function () {
            return $(this).data("question-id");
        }).get().join(","); // Get all selected question IDs

        // Check if the state has changed
        if (checkedCheckboxes === totalCheckboxes && !allChecked) {
            allChecked = true; // Mark as all checked
        } else if (checkedCheckboxes !== totalCheckboxes && allChecked) {
            allChecked = false; // Mark as not all checked
        }

        // AJAX Request
        $.ajax({
            url: "{{url('/update-imp-question')}}",
            method: "POST",
            data: {
                id: leadId,
                imp_question: newValue, // Send 1 if all are checked, otherwise 0
                imp_que: selectedIds // Send all selected IDs
            },
            success: function (data) {
                if (data.success === "success") {
                    swal("Important Question Saved Successfully!", "", "success");
                } else {
                    swal("Failed to Save", "", "error");
                }
            },
            error: function () {
                swal("Something Went Wrong!", "", "error");
            }
        });
    });
});
</script>
<!-- All Important Question Checked then imp_question me 1 or 0 and imp_que me tbl_imp_question ki primary id (implode me jayegi) -->

<!-- Audio Play click button in Important Question -->
<script>
$(document).ready(function () {
    // Play audio when play button is clicked
    $(".playButton").click(function () {
        let audioId = $(this).data("audio-id"); // Get the audio ID from data attribute
        let audioElement = $("#" + audioId)[0]; // Get the corresponding audio element
        // Pause any other audio if playing
        $(".audioPlayer").each(function () {
            let otherAudio = this;
            if (otherAudio !== audioElement && !otherAudio.paused) {
                otherAudio.pause(); // Pause other audio if it's playing
                $(otherAudio).siblings(".playButton").text("Play"); // Reset button text to "Play"
            }
        });
        // Check if audio is already playing
        if (audioElement.paused) {
            audioElement.play(); // Play the audio if it's paused
            $(this).text("Pause"); // Change button text to "Pause"
        } else {
            audioElement.pause(); // Pause the audio if it's playing
            $(this).text("Play"); // Change button text to "Play"
        }
    });
});
</script>
<!-- Audio Play click button in Important Question -->





<!-- Append Row Here Obligation -->
<script>
$(document).ready(function() {
    let rowCount = 1;
    // Add a new row
    $(document).on('click', '#addMore', function() {
        rowCount++;
        let newRow = $('#templateRow').clone();
        newRow.removeAttr('id');
        newRow.find('input[type="text"]').val('');
        newRow.find('select').prop('selectedIndex', 0);
        newRow.find('td:first').text(rowCount);

        newRow.find('#addMore')
            .removeAttr('id')
            .addClass('btn-danger removeRow')
            .removeClass('btn-success')
            .text('Remove');
        $('#dynamicRows').append(newRow);
        updateTotal();
    });

    // Remove a row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        updateRowNumbers();
        updateTotal();
    });

    // This is for Updated Row Here 
    $(document).on('change', 'select[name="bt_obligation1[]"]', function() {
        var bt_obligation1 = $(this).val();
        var row1 = $(this).closest('tr');

        if (bt_obligation1 === 'BT') {
            // row.find('input[name="bt_emi[]"]').val(''); // Clear BT EMI input
            row1.css('background-color',
            'green'); // Change bg color of the entire row to green
        } else if (bt_obligation1 === 'Obligation') {
            // row.find('input[name="bt_pos[]"]').val(''); // Clear BT POS input
            row1.css('background-color',
            'red'); // Change bg color of the entire row to red
        }
        updateTotal();
    });

    // old here 
    $(document).on('change', 'select[name="bt_obligation[]"]', function() {
        var bt_obligation = $(this).val();
        var row = $(this).closest('tr');

        if (bt_obligation === 'BT') {
            // row.find('input[name="bt_emi[]"]').val(''); // Clear BT EMI input
            row.closest('tr').css('background-color',
            'green'); // Change bg color of the entire row to green
        } else if (bt_obligation === 'Obligation') {
            // row.find('input[name="bt_pos[]"]').val(''); // Clear BT POS input
            row.closest('tr').css('background-color',
            'red'); // Change bg color of the entire row to red
        }
        updateTotal();
    });

    // Recalculate totals when input values change
    $(document).on('input', 'input[name="bt_pos[]"], input[name="bt_emi[]"]', function() {
        updateTotal();
    });

    // Update row numbers
    function updateRowNumbers() {
        $('#dynamicRows tr').each(function(index, row) {
            if (!$(row).hasClass('total_text_table_footer')) {
                $(row).find('td:first').text(index + 1);
            }
        });
        rowCount = $('#dynamicRows tr').length;
    }

    // Update total calculation
    function updateTotal() {
        let totalPos = 0;
        let totalEmi = 0;
        $('#dynamicRows tr').each(function() {
            var bt_obligation = $(this).find('select[name="bt_obligation[]"]').val();

            var btPos = Math.floor($(this).find('input[name="bt_pos[]"]').val() || 0);
            var btEmi = Math.floor($(this).find('input[name="bt_emi[]"]').val() || 0);

            // Condition to only add BT POS if category is not 'Obligation'
            if (bt_obligation !== 'Obligation') {
                totalPos += btPos; // Add to total for BT POS
            }
            // Condition to only add Obligation EMI if category is not 'BT'
            if (bt_obligation !== 'BT') {
                totalEmi += btEmi; // Add to total for Obligation EMI
            }
        });
        // Update total amounts on the page
        let totalPosAmount = Math.floor(totalPos);
        let totalEmiAmount = Math.floor(totalEmi);

        $('#totalPos').text(totalPosAmount); // Update the total for BT POS
        $('#totalEmi').text(totalEmiAmount); // Update the total for Obligation EMI

        // Hidden values for additional sections
        let pos_section_hidden = Math.floor($('#pos_section_hidden').val() || 0);
        let TotalPosAmount = totalPosAmount + pos_section_hidden;

        let obligation_section_hidden = Math.floor($('#obligation_section_hidden').val() || 0);
        let TotalObligationAmount = totalEmiAmount + obligation_section_hidden;

        $('#pos_section').val('₹ ' + Math.floor(TotalPosAmount).toLocaleString('en-IN'));  
        $('#obligation_section').val('₹ ' + Math.floor(TotalObligationAmount).toLocaleString('en-IN'));  

        // $('#pos_section').val(Math.floor(TotalPosAmount)); // total pos amount post value
        // $('#obligation_section').val(Math.floor(TotalObligationAmount)); // total obligation post value
    }
    // Update total on `pos_section` input changes
    $(document).on('input', '#pos_section', function() {
        updateTotal();
    });
    // Update total on `obligation_section` input changes
    $(document).on('input', '#obligation_section', function() {
        updateTotal();
    });
});
</script>
<!-- Append Row Here -->



<!-- Onchange Company type to company category  -->
<script>
$(document).ready(function()
{
    $('#companyType').on('change', function() {
        let companyType = $(this).val();
        let validTypes = ['LLP FIRM', 'LIMITED FIRM', 'PRIVATE LIMITED FIRM'];
        // Check if the selected company type is valid
        if (validTypes.includes(companyType)) {
            // Show the dropdown, enable it, and show a loading message
            $('#productSelect').prop('disabled', false).show().empty().append(
                '<option disabled="true" selected="true">Loading...</option>');

            // Show the entire 'Company Category' section
            $('#productSelect').closest('.form-group').closest('.col-sm-12').show();
            // Make AJAX request to fetch the product data
            $.ajax({
                url: "{{url('/fetch-company-category')}}",
                method: 'POST',
                data: {
                    company_type: companyType,
                },
                success: function(response) {
                    // Clear existing options and set default option
                    $('#productSelect').empty().append(
                        '<option disabled="true" selected="true">Select Product</option>'
                    );

                    // If valid data is returned, populate the dropdown
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            $('#productSelect').append(
                                `<option value="${item.id}">${item.company_name} - ${item.company_category} - ${item.company_bank}</option>`
                            );
                        });
                    } else {
                        // If no data is found, display a "No Data Found" message
                        $('#productSelect').append(
                            '<option disabled="true">No Data Found</option>');
                    }
                },
                error: function() {
                    alert('Failed to fetch data. Please try again.');
                },
            });
        } else {
            // When an invalid company type is selected, disable and hide the product dropdown
            $('#productSelect').prop('disabled', true).hide().empty().append(
                '<option disabled="true" selected="true">Select Product</option>'
            );
            // Hide the entire 'Company Category' section
            $('#productSelect').closest('.form-group').closest('.col-sm-12').hide();
        }
    });

    // Trigger change on page load if a value is already selected (for example, when editing a lead)
    let companyType = $('#companyType').val();
    let validTypes = ['LLP FIRM', 'LIMITED FIRM', 'PRIVATE LIMITED FIRM'];
    if (!validTypes.includes(companyType)) {
        // If selected company type is not valid, disable and hide the product dropdown
        $('#productSelect').prop('disabled', true).hide().empty().append(
            '<option disabled="true" selected="true">Select Product</option>'
        );
        $('#productSelect').closest('.form-group').closest('.col-sm-12').hide();
    }
});
</script>



<!-- View Attachments Js Start Here -->
<script>
// Close modal button
$(document).on('click', '.close-modal-btn', function() {
    $('#viewModal').modal('hide');
});

// Use delegated event binding for dynamically added buttons
$(document).ready(function() {
    $(document).on('click', '.view-btn', function() {
        let leadId = $(this).data('lead_id');
        let adminId = $(this).data('admin_id');
        $.ajax({
            url: "{{ url('/fetch-data') }}",
            type: 'GET',
            data: {
                lead_id: leadId,
                admin_id: adminId
            },
            success: function(response) {
                if (response.message) {
                    $('#modal-content').html('<p class="text-danger">' + response.message + '</p>');
                } else {
                    // Create modal content dynamically
                    let content = `
                        <p><strong>All File Password  :  </strong> ${response.all_file_password}</p>
                    `;
                    let imagesContent = '';
                    const imageFields = [
                        'cibil_report_image', 'passport_image', 'pan_card_image',
                        'aadhar_card_image', 'salary_3month_image',
                        'salary_account_image',
                        'bt_loan_image', 'credit_card_image', 'electric_bill_image',
                        'form_16_image', 'other_document_image'
                    ];

                    // Iterate through all the image fields
                    imageFields.forEach(function(field) {
                        if (response[field] && response[field].length > 0) {
                            let rowContent = '';
                            // Split the URLs by commas (for multiple images or PDFs)
                            let fileUrls = response[field].split(',');

                            // Loop through each URL and generate a preview
                            fileUrls.forEach(function(fileUrl) {
                                let fileExtension = fileUrl.split('.').pop().toLowerCase();
                                let filePreview = '';

                                // Check the file type and generate preview accordingly
                                if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                                    filePreview = `
                                        <img src="${fileUrl}" alt="${field}" style="width: 100px; height: 100px;" />
                                    `;
                                } else if (fileExtension === 'pdf') {
                                    filePreview = `
                                        <a href="${fileUrl}" target="_blank">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/87/PDF_file_icon.svg"
                                                alt="PDF Preview" style="width: 100px; height: 100px;" />
                                        </a>
                                    `;
                                }

                                // Add the file preview in a row
                                rowContent += `
                                    <div class="col-4 col-sm-4 mb-3">
                                        <p><strong>${field.replace('_', ' ').toUpperCase()}:</strong></p>
                                        ${filePreview}
                                        <button class="btn btn-danger btn-sm delete-btn"
                                                data-admin_id="${adminId}"
                                                data-lead_id="${leadId}"
                                                data-column_name="${field}"
                                                data-file_url="${fileUrl}">
                                            Delete
                                        </button>
                                    </div>
                                `;
                            });

                            // Wrap the row content in a div with class "row"
                            imagesContent += `
                                <div class="row mb-4">
                                    ${rowContent}
                                </div>
                            `;
                        }
                    });

                    // Set the modal content
                    $('#modal-content').html(content + imagesContent);
                    $('#viewModal').modal('show');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                $('#modal-content').html('<p class="text-danger">Failed to load data.</p>');
            }
        });
    });

    // Delete Single Attachment Start Here
    $(document).on('click', '.delete-btn', function() {
        let adminId = $(this).data('admin_id');
        let leadId = $(this).data('lead_id');
        let columnName = $(this).data('column_name');
        let fileUrl = $(this).data('file_url');

        // Confirm before deleting
        if (confirm('Are you sure you want to delete this file?')) {
            $.ajax({
                url: "{{ url('/delete_attachment_single_file') }}",
                type: 'POST',
                data: {
                    admin_id: adminId,
                    lead_id: leadId,
                    column_name: columnName,
                    file_url: fileUrl // Send the specific file URL to be deleted
                },
                success: function(response) {
                    if (response.success) {
                        alert('File deleted successfully.');
                        location.reload(); // Reload the page or re-fetch data
                    } else {
                        alert('Failed to delete the file: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting file:', error);
                    alert('An error occurred while deleting the file.');
                }
            });
        }
    });
    // Delete Single Attachment End Here
});

</script>
<!-- View Attachments Js End Here -->

<!-- This code for Attachments pdf and image download -->
<script>
document.getElementById('downloadButton').addEventListener('click', function() {
    let itemId = @json($leads->id);
    const url = `/download-zip/${itemId}`;
    window.location.href = url;
});
</script>
<!-- This code for Attachments pdf and image download -->


<!-- Edit About Section Modal Start Here  -->
<script>
$(document).on('click', '#edit_about_lead', function() {
    var id = $(this).data('id');
    var data_code = $(this).data('data_code');
    var name = $(this).data('name');
    var pincode = $(this).data('pincode');
    $("#edit_id").val(id);
    // $("#edit_data_code").val(data_code);
     // selected data_code dropdown start here
     $("#edit_data_code option").each(function() {
        if ($(this).val() == data_code) {
            $(this).prop('selected', true);
        }
    });

    $("#edit_name").val(name);
    $("#edit_pincode").val(pincode);
    $("#editaboutmodal").modal("show");
});

// Edit Process Modal Start here
$(document).on('click', '#edit_lead_process', function() {
    var id = $(this).data('id');
    var loan_amount = $(this).data('loan_amount');
    var process = $(this).data('process');
    var bank_id = $(this).data('bank_id'); // bank_id
    var product_need_id = $(this).data('product_need_id'); // product need
    var casetype_id = $(this).data('casetype_id'); // product need
    // new here
    var tenure = $(this).data('tenure') ?? '';
    var year = $(this).data('year') ?? '';
    // var year = tenure ? Math.floor(tenure / 12) : '';

    // Format loan_amount in Indian format
    if (loan_amount) {
        loan_amount = '₹ ' + new Intl.NumberFormat('en-IN').format(Number(loan_amount));
    }

    $("#edit_process_id").val(id);
    $("#edit_loan_amount").val(loan_amount);
    $("#edit_process").val(process);
    // edit new
    $("#edit_tenure").val(tenure);
    $("#edit_year").val(year);

    // selected bank_id dropdown start here
    $("#edit_bank_name option").each(function() {
        if ($(this).val() == bank_id) {
            $(this).prop('selected', true);
        }
    });
    // selected bank_id dropdown end here
    // selected product_need_id dropdown start here
    $("#edit_product_need_name option").each(function() {
        if ($(this).val() == product_need_id) {
            $(this).prop('selected', true);
        }
    });
    // selected product_need_id dropdown end here
    // selected casetype_id dropdown start here
    $("#edit_casetype option").each(function() {
        if ($(this).val() == casetype_id) {
            $(this).prop('selected', true);
        }
    });
    // selected casetype_id dropdown end here
    $("#editprocessmodal").modal("show");
});



// Add Remark In Lead Profile Start Here
// $("#add_remark").submit(function(e) {
//     e.preventDefault();
//     var formData = new FormData(this);
//     $.ajax({
//         type: "post",
//         url: "{{url('/add_remark')}}",
//         data: formData,
//         dataType: "json",
//         contentType: false,
//         processData: false,
//         cache: false,
//         encode: true,
//         success: function(data) {
//             if (data.success == 'success') {
//                 swal("Remark Added Successfully", "", "success");
//                 setTimeout(function() {
//                     window.location.reload();
//                 }, 1000);
//             } else {
//                 swal("Remark Not Added", "", "error");
//             }
//         },
//         error: function(err) {}
//     });
// });

$(document).ready(function () {
    // Remove localStorage if user comes from another page
    if (performance.navigation.type === 1) {
        // Page refresh hone par storage remove mat karo
    } else {
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


    // AJAX Form Submission for Remarks
    $("#add_remark").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{url('/add_remark')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                if (data.success === 'success') {
                    swal("Remark Added Successfully", "", "success");

                    // Keep the "Remark" tab open
                    localStorage.setItem("activeTab", "#Remark");

                    // Reload page after 1 second
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    swal("Remark Not Added", "", "error");
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});

// Add Remark In Lead Profile End Here

// Edit Operation Start Here 
$(document).on('click', '#edit_lead_operation', function() {
    var id = $(this).data('id');
    var channel_id = $(this).data('channel_id');
    var los_number = $(this).data('los_number');
    var amount_approved = $(this).data('amount_approved');
    var rate = $(this).data('rate');
    var pf_insurance = $(this).data('pf_insurance');
    var tenure_given = $(this).data('tenure_given');
    var tenure_year = $(this).data('tenure_year');
    var amount_disbursed = $(this).data('amount_disbursed');
    var internal_top = $(this).data('internal_top');
    var cashback_to_customer = $(this).data('cashback_to_customer');
    var disbursment_date = $(this).data('disbursment_date');
    $("#edit_operation_id").val(id);
    // $("#edit_channel_name").val(channel_name);
    // selected product_need_id dropdown start here
    $("#edit_channel_name option").each(function() {
        if ($(this).val() == channel_id) {
            $(this).prop('selected', true);
        }
    });


    // Approved Amount 
    var approvedAmount = "₹" + amount_approved.toLocaleString('en-IN');
    $("#edit_amount_approved").val(approvedAmount);
    $("#edit_amount_approved").on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^0-9]/g, '');
        if (value === '' || value === '0') {
            $(this).val('');
        } else {
            var approvedAmountValue = "₹" + Number(value).toLocaleString('en-IN');
            $(this).val(approvedAmountValue);
        }
    });

    // Amount Disbursed Amount
    var amountdisbursedAmount = "₹" + amount_disbursed.toLocaleString('en-IN');
    // Set the formatted value in the input field
    $("#edit_amount_disbursed").val(amountdisbursedAmount);
    // When the user types in the input, remove the ₹ symbol to allow numeric input only
    $("#edit_amount_disbursed").on('input', function() {
        var value = $(this).val();
        // Remove the ₹ symbol and any non-numeric characters
        value = value.replace(/[^0-9]/g, '');
        // If value is empty or 0, set the input to be blank
        if (value === '' || value === '0') {
            $(this).val('');
        } else {
            // Add ₹ symbol back and format the amount with commas in Indian format
            var disbursedAmountValue = "₹" + Number(value).toLocaleString('en-IN');
            $(this).val(disbursedAmountValue);
        }
    });

    // Internal Top
    var internal_topAmount = "₹" + internal_top.toLocaleString('en-IN');
    $("#edit_internal_top").val(internal_topAmount);
    $("#edit_internal_top").on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^0-9]/g, '');
        if (value === '' || value === '0') {
            $(this).val('');
        } else {
            var internal_topAmountValue = "₹" + Number(value).toLocaleString('en-IN');
            $(this).val(internal_topAmountValue);
        }
    });
    // Internal Top
    var cashback_to_customerAmount = "₹" + cashback_to_customer.toLocaleString('en-IN');
    $("#edit_cashback_to_customer").val(cashback_to_customerAmount);
    $("#edit_cashback_to_customer").on('input', function() {
        var value = $(this).val();
        value = value.replace(/[^0-9]/g, '');
        if (value === '' || value === '0') {
            $(this).val('');
        } else {
            var cashback_to_customerValue = "₹" + Number(value).toLocaleString('en-IN');
            $(this).val(cashback_to_customerValue);
        }
    });


    $("#edit_los_number").val(los_number);
    $("#edit_rate").val(rate);
    $("#edit_pf_insurance").val(pf_insurance);
    $("#edit_tenure_given").val(tenure_given);
    $("#edit_tenure_year").val(tenure_year);
    // $("#edit_amount_disbursed").val(amount_disbursed);
    // $("#edit_internal_top").val(internal_top);
    // $("#edit_cashback_to_customer").val(cashback_to_customer);
    $("#edit_disbursment_date").val(disbursment_date);
    $("#editoperationmodal").modal("show");
});
// Edit Operation End Here 



// Add comment task In Edit Task Pannel Start Here
$("#add_comment_task").submit(function(e) {
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

// Edit Task Section Data
$("#edit_task").submit(function(e) {
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
                $("#edit_task")[0].reset();
                $("#editaboutmodal").modal("hide");
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


// Edit About Section Data
$("#edit_about_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/updateAboutsection')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $(".btn_update").prop("disabled", false);
                $("#edit_about_form")[0].reset();
                $("#editaboutmodal").modal("hide");
                swal("About Section Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("About Section Not Update!", "", "error");
                $(".btn_update").prop('disabled', false);
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
            $(".btn_update").prop('disabled', false);
        }
    });
});

// Edit Operation Section Data
$("#edit_operation_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/updateoperationsection')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $("#edit_operation_form")[0].reset();
                $("#editoperationmodal").modal("hide");
                swal("Operation Section Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Operation Section Not Update!", "", "error");
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
        }
    });
});
// End Operation Here 

// Edit Process Data
$("#edit_process_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/updateProcess')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $(".btn_process_update").prop("disabled", false);
                $("#edit_process_form")[0].reset();
                $("#editprocessmodal").modal("hide");
                swal("Process Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Process Not Update!", "", "error");
                $(".btn_process_update").prop('disabled', false);
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
            $(".btn_process_update").prop('disabled', false);
        }
    });
});

// Edit Login Form Start here
$("#edit_loginform_form").submit(function(e) {
    e.preventDefault();

    var reference_mobile1 = $("#reference_mobile1").val();
    var reference_mobile2 = $("#reference_mobile2").val();
    var aadhar_no = $("#aadhar_no").val();
    var pancard_no = $("#pan_card_no").val();
    // Validate aadhar_no
    if (!aadhar_no || aadhar_no.length !== 12 || isNaN(aadhar_no)) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Aadhar Number must be exactly 12 digits');
        return; // Prevent form submission if validation fails
    }
    // Validate aadhar_no
    if (!pancard_no || pancard_no.length !== 10 || isNaN(pancard_no)) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Pan Card Number 10 digits');
        return; // Prevent form submission if validation fails
    }

    // Validate reference_mobile1
    if (!reference_mobile1 || reference_mobile1.length !== 10 || isNaN(reference_mobile1)) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Reference1 Mobile Number must be exactly 10 digits');
        return; // Prevent form submission if validation fails
    }

    // Validate reference_mobile2
    if (!reference_mobile2 || reference_mobile2.length !== 10 || isNaN(reference_mobile2)) {
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Reference Mobile 2 must be exactly 10 digits');
        return; // Prevent form submission if validation fails
    }

    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/updateLoginForm')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            console.log(data);
            if (data.success == 'success') {
                $(".btn_loginform_update").prop("disabled", false);
                swal("Login Form Save Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Login Form Not Save!", "", "error");
                $(".btn_loginform_update").prop('disabled', false);
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
            $(".btn_loginform_update").prop('disabled', false);
        }
    });
});

// Edit Obligation Form Start here
$("#edit_obligation_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/updateObligationsection')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                swal("Obligation Save Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Obligation Save!", "", "error");
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
        }
    });
});
// Edit Obligation Form End here

// Attachment Update Start here
$("#edit_attachment_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/updateAttachment')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                $(".btn_attachment_update").prop("disabled", false);
                swal("Attachment Updated Successfull", "", "success");
                setTimeout(function() {
                    location.reload(true);
                }, 1000);
            } else {
                swal("Attachment Not Update!", "", "error");
                $(".btn_process_update").prop('disabled', false);
            }
        },
        error: function(errResponse) {
            swal("Somthing Went Wrong!", "", "error");
            $(".btn_attachment_update").prop('disabled', false);
        }
    });
});
</script>
<!-- Edit Modal End Here  -->

<script>
$(document).ready(function() {
    $('#openModalBtn').on('click', function() {
        // $('#modalTitle').text('Add Task');
        $('#myModal').modal('show');
    });

    $('#saveChangesBtn').on('click', function() {
        alert('Your changes have been saved!');
        $('#myModal').modal('hide');
    });

    $('#myModal').on('shown.bs.modal', function() {
        console.log('Modal is now fully visible!');
    });

    $('#myModal').on('hidden.bs.modal', function() {
        console.log('Modal has been closed.');
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    function formatBank(option) {
        if (!option.id) return option.text;
        const logo = $(option.element).data("logo");
        return $(
            `<span><img src="img/demo/bank/${logo}" alt="${option.text}" style="width: 40px; height: 15px; margin-right: 10px;" />${option.text}</span>`
        );
    }

    $(".bank-select").select2({
        templateResult: formatBank,
        templateSelection: formatBank,
        minimumResultsForSearch: Infinity,
    });
});
</script>

<!-- activity download section    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
document.getElementById('download_activity').addEventListener('click', function() {
    const {
        jsPDF
    } = window.jspdf;
    const pdf = new jsPDF();

    // Title
    pdf.setFontSize(18);
    pdf.setFont("helvetica", "bold");
    pdf.text("Lead Activity", 10, 10);

    // Timeline Data
    const timelineItems = document.querySelectorAll('.timeline li');
    let yPosition = 20; // Start y position for the content

    timelineItems.forEach(item => {
        const timeElem = item.querySelector('.tl-time');
        const titleElem = item.querySelector('.tl-title');
        const dayElem = item.querySelector('.tl-numb-day');
        const textDayElem = item.querySelector('.tl-text-day');
        const monthElem = item.querySelector('.tl-month');
        const descriptionElem = item.querySelector('.tl-content p:last-child');

        const time = timeElem ? timeElem.innerText : 'N/A';
        const title = titleElem ? titleElem.innerText : 'N/A';
        const day = dayElem ? dayElem.innerText : 'N/A';
        const textDay = textDayElem ? textDayElem.innerText : 'N/A';
        const month = monthElem ? monthElem.innerText : 'N/A';
        const description = descriptionElem ? descriptionElem.innerText : 'N/A';

        pdf.setFontSize(14);
        pdf.text(`Time: ${time}`, 10, yPosition);
        pdf.text(`Title: ${title}`, 10, yPosition + 10);
        pdf.text(`Date: ${day} ${textDay}, ${month}`, 10, yPosition + 20);
        pdf.setFontSize(12);
        pdf.text(`Description: ${description}`, 10, yPosition + 30);

        yPosition += 50; // Move y position for the next item
        if (yPosition > 280) { // Create a new page if content exceeds the page height
            pdf.addPage();
            yPosition = 20;
        }
    });
    // Save PDF
    pdf.save("timeline.pdf");
});
</script>
<!-- download login form  -->
<script>
document.getElementById('download_login_form').addEventListener('click', async function() {
    // alert("ok");
    const {
        jsPDF
    } = window.jspdf;
    const pdf = new jsPDF();

    const form = document.getElementById('form-container');
    const originalBackground = form.style.backgroundColor;

    form.style.backgroundColor = "#000";
    form.style.transform = "scale(0.13)";
    form.style.transformOrigin = "top left";

    try {

        const formWidth = form.scrollWidth;
        const formHeight = form.scrollHeight;

        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (formHeight * pdfWidth) / formWidth;

        pdf.setPage(1);
        pdf.internal.pageSize.setHeight(pdfHeight);
        await pdf.html(form, {
            callback: function(doc) {
                // Save the PDF once the form content has been added
                doc.save('form.pdf');
            },
            x: 3,
            y: 3,
            html2canvas: {
                scale: 1.2, // Adjust for quality scaling
                windowWidth: form.scrollWidth, // Match the form's width
                windowHeight: form.scrollHeight, // Match the form's height
                backgroundColor: "#ffffff", // Ensure background is white, or choose your preferred color
            },
        });

    } catch (error) {
        console.error("Error generating PDF:", error);
        alert("An error occurred while generating the PDF. Check the console for details.");
    } finally {
        // Restore original styles after PDF generation
        form.style.backgroundColor = originalBackground;
        form.style.transform = ""; // Reset scaling
        form.style.transformOrigin = ""; // Reset transform origin
    }
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
document.querySelectorAll('textarea').forEach(textarea => {
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
</script>


<!-- Jab BT/Obligation History ko update kre to by default disabled rhe Edit pr click krne pr Update and active ho jaye all fields  -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Sabhi inputs aur selects disable karna
        function disableFields() {
            document.querySelectorAll("#obligationTable input, #obligationTable select").forEach(field => {
                field.setAttribute("disabled", "disabled");
            });
        }
        // Sabhi inputs aur selects enable karna
        function enableFields() {
            document.querySelectorAll("#obligationTable input, #obligationTable select").forEach(field => {
                field.removeAttribute("disabled");
            });
        }
        // By default disable all fields
        disableFields();
        // Edit button click event
        document.getElementById("editObligation").addEventListener("click", function () {
            enableFields();
            document.getElementById("editObligation").style.display = "none"; // Hide Edit button
            document.getElementById("updateObligation").style.display = "inline-block"; // Show Update button
        });
        // Update button click event
        document.getElementById("updateObligation").addEventListener("click", function () {
            disableFields();
            document.getElementById("updateObligation").style.display = "none"; // Hide Update button
            document.getElementById("editObligation").style.display = "inline-block"; // Show Edit button
        });
    });
</script>





<script>
// Function to format the input with ₹ symbol and comma
function formatLoanAmount(input) {
    let value = input.value.replace(/[^0-9]/g, ''); // Sirf numbers allow karega
    if (value) {
        input.dataset.rawValue = value; // Raw numeric value store karega (database ke liye)
        input.value = '₹ ' + new Intl.NumberFormat('en-IN').format(value); // Formatted value show karega
    } else {
        input.dataset.rawValue = ''; // Agar empty ho to raw value bhi empty rakhega
        input.value = '';
    }
}

// Input event pe formatting apply karega
document.getElementById("edit_loan_amount").addEventListener("input", function() {
    formatLoanAmount(this);
});

// Form submit hone se pehle sirf numeric value bhejna
document.querySelector("form").addEventListener("submit", function(event) {
    let editLoanAmountInput = document.getElementById("edit_loan_amount");
    if (editLoanAmountInput) {
        editLoanAmountInput.value = editLoanAmountInput.dataset.rawValue || ''; // Sirf numbers bhejna
    }
});

// Page load par agar koi value ho to format karega
document.addEventListener("DOMContentLoaded", function() {
    let editLoanAmountInput = document.getElementById("edit_loan_amount");
    if (editLoanAmountInput && editLoanAmountInput.value.trim() !== '') {
        formatLoanAmount(editLoanAmountInput);
    }
});

</script>







<!-- 5,00,000 formate show here  -->
<script>
    // Loan Amount ₹ 3,40,000 formate
    document.addEventListener("DOMContentLoaded", function () {
        let amountSpan = document.getElementById("user_loan_amount");
        let amountValue = amountSpan.innerText.trim().replace(/,/g, ''); // Remove existing commas

        if (!isNaN(amountValue) && amountValue) {
            // Convert the amount to a number and format it in Indian style
            let formattedAmount = new Intl.NumberFormat('en-IN').format(Number(amountValue));
            amountSpan.innerText = formattedAmount; // Update the span with formatted amount
        }
    });

     // Amount Approved ₹ 3,40,000 formate
    document.addEventListener("DOMContentLoaded", function () {
        let edit_approved_Amount = document.getElementById("user_amount_approved");
        let rawAmount = edit_approved_Amount.innerText.trim(); // Get the raw value from the span

        if (rawAmount) {
            // Convert the amount to a number and format it in Indian style
            let formattedAmount = new Intl.NumberFormat('en-IN').format(Number(rawAmount));
            edit_approved_Amount.innerText = formattedAmount; // Update the span with formatted amount
        }
    });
    // Amount Disbursed ₹ 3,40,000 formate
    document.addEventListener("DOMContentLoaded", function () {
        let user_amount_disbursed = document.getElementById("user_amount_disbursed");
        let rawAmount = user_amount_disbursed.innerText.trim(); // Get the raw value from the span

        if (rawAmount) {
            // Convert the amount to a number and format it in Indian style
            let formattedAmount = new Intl.NumberFormat('en-IN').format(Number(rawAmount));
            user_amount_disbursed.innerText = formattedAmount; // Update the span with formatted amount
        }
   });

   // Internal Top Like ₹ 3,40,000 formate
    document.addEventListener("DOMContentLoaded", function () {
            let user_internal_top = document.getElementById("user_internal_top");
            let rawAmount = user_internal_top.innerText.trim(); // Get the raw value from the span

            if (rawAmount) {
                // Convert the amount to a number and format it in Indian style
                let formattedAmount = new Intl.NumberFormat('en-IN').format(Number(rawAmount));
                user_internal_top.innerText = formattedAmount; // Update the span with formatted amount
            }
    });

    // Cashback To Customer Like ₹ 3,40,000 formate
    document.addEventListener("DOMContentLoaded", function () {
            let user_cashback_to_customer = document.getElementById("user_cashback_to_customer");
            let rawAmount = user_cashback_to_customer.innerText.trim(); // Get the raw value from the span

            if (rawAmount) {
                // Convert the amount to a number and format it in Indian style
                let formattedAmount = new Intl.NumberFormat('en-IN').format(Number(rawAmount));
                user_cashback_to_customer.innerText = formattedAmount; // Update the span with formatted amount
            }
    });
     // User Total Like ₹ 3,40,000 formate
     document.addEventListener("DOMContentLoaded", function () {
            let user_total = document.getElementById("user_total");
            let rawAmount = user_total.innerText.trim(); // Get the raw value from the span

            if (rawAmount) {
                // Convert the amount to a number and format it in Indian style
                let formattedAmount = new Intl.NumberFormat('en-IN').format(Number(rawAmount));
                user_total.innerText = formattedAmount; // Update the span with formatted amount
            }
    });
</script>

<!-- Edit Rate Like 22% -->
<script>
document.getElementById('edit_rate').addEventListener('input', function(e) {
    let value = this.value.replace('%', ''); // Remove '%' if it exists
    // Allow only numbers and limit input to 2 digits
    value = value.replace(/\D/g, ''); // Remove non-numeric characters
    if (value.length > 2) {
        value = value.slice(0, 2); // Limit to max 2 digits
    }
    // Handle backspace case
    if (e.inputType === "deleteContentBackward" && this.value.endsWith('%')) {
        this.value = value; // Remove '%' first
    } else {
        this.value = value ? value + '%' : ''; // Append '%' only if there's a number
    }
});
</script>




@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif