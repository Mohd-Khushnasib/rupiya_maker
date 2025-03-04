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
                        <li class="breadcrumb-item active">Update Profile</li>
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
                          <label for="Name">Name</label>
                          <input type="text" name="name" id="name" value="{{$adminlogin->name}}" class="form-control" placeholder="Name" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                          <label for="eventInput2">Email Address</label>
                          <input class="form-control" value="{{$adminlogin->email}}" type="text" id="email" name="email" placeholder="Email">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="mb-3">
                          <label for="eventInput3">Mobile No</label>
                          <input type="number" value="{{$adminlogin->mobile}}" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="text-end">
                            <button type="submit" class="btn btn-primary mt-2">
                            Update Profile
                            </button>
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

<!-- JS Links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    // category add here 
    $("#add_form").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: "{{url('/profile/admin')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            encode: true,
            success: function(data) {
                if (data.success == 'success') {
                    swal("Good job!", "Update profile Successfully ", "success", {
                        button: "OK",
                    }).then((value) => {
                        location.reload();
                    });

                } 
                else if (data.success == 'not_match') {
                    swal("Error", "Something Went Wrong", "error", {
                        button: "OK",
                    }).then((value) => {
                        location.reload();
                    });
                }
            },
            error: function(err) {
                
            }
        });

    });
    // category end here
</script>


@endsection
@endforeach
@else
<script>
    window.location.href = "{{url('/login')}}";
</script>
@endif
