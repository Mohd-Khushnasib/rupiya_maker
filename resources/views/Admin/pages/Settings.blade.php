@if(session()->get('admin_login'))
@extends('Admin.layouts.master')
@section('main-content')

<div class="container" id="main-container">
    <!-- Account Sidebar  Start Here-->
    @include('Admin.pages.account_setting')
   <!-- Account Sidebar End Here -->
   

    <!-- BEGIN Content -->
    <div id="main-content">
        <div class="page-title">
            <div>
                <h1><i class="fa fa-file-o"></i>Dashboard</h1>
            </div>
        </div>
        <div id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="index.html">Home</a>
                    <span class="divider"><i class="fa fa-angle-right"></i></span>
                </li>
                <li class="active">Dashboard</li>
            </ul>
        </div>
    </div>
</div>

@endsection
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif