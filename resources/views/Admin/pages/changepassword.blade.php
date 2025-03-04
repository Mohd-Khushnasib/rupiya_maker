@if(session('admin_login'))
@foreach(session()->get('admin_login') as $adminlogin)
@extends('Admin.layouts.master')
@section('main-content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">
                                <svg class="stroke-icon">
                                    <use href="{{asset('Admin/assets/svg/icon-sprite.svg#stroke-home')}}">
                                    </use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Admin</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xxl-9 box-col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- <div class="form theme-form"> -->
                                <form action="javascript:void(0);" method="post" id="add_form">
                                    @csrf
                                    <input type="hidden" id="admin_id" name="admin_id" value="{{$adminlogin->id}}" />
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Old Password</label>
                                                <input type="password" name="opass" class="form-control"
                                                    placeholder="Old Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>New Password</label>
                                                <input type="password" name="npass" class="form-control"
                                                    placeholder="New Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label>Confirm Password</label>
                                                <input type="password" name="cpass" class="form-control"
                                                    placeholder="Confirm Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary mt-2">
                                                    Change Password
                                                </button>
                                            </div>
                                        </div>
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

<!-- JS Links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// Change Password start here 
$("#add_form").submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type: "post",
        url: "{{url('/changepassword/admin')}}",
        data: formData,
        dataType: "json",
        contentType: false,
        processData: false,
        cache: false,
        encode: true,
        success: function(data) {
            if (data.success == 'success') {
                swal("Good job!", "Change Password Successfully ", "success", {
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
                // console.log("ok");

            } else if (data.success == 'not_match') {
                swal("Error", "Failed", "error", {
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
            } else if (data.success == 'opass_npass') {
                swal("Error", "New and Confirm Password are not match.", "error", {
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
            } else if (data.success == 'old_pass') {
                swal("Error", "Invalid Current Password", "error", {
                    button: "OK",
                }).then((value) => {
                    location.reload();
                });
            }
        },
        error: function(err) {
            swal("Error!", "Invalid Current Password", "error", {
                button: "OK",
            }).then((value) => {
                location.reload();
            });
        }
    });

});
// Change Password end here
</script>


@endsection
@endforeach
@else
<script>
window.location.href = "{{url('/login')}}";
</script>
@endif