@if(session()->get('admin_login'))
@foreach(session()->get('admin_login') as $admin_login)
@extends('Admin.layouts.master')
@section('main-content')
<style>
.custom-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 30px;
    }

    .custom-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .custom-switch-indicator {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .custom-switch-indicator:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 0px;
        bottom: 5px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.custom-switch-indicator {
        background-color: #2196F3;
    }

    input:checked+.custom-switch-indicator:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
        /* Rounded sliders */
        .custom-switch-indicator {
        border-radius: 34px;
    }

    .custom-switch-indicator:before {
        border-radius: 50%;
    }


    .glow-card {
            background: #1a1a1a;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 132, 255, 0.5); /* Glowing effect */
            border: 2px solid rgba(0, 132, 255, 0.7);
        }

        .custom-switch .custom-switch-indicator {
            background: #444;
        }

        .custom-switch input:checked + .custom-switch-indicator {
            background: #0084ff; /* Glowing blue switch */
            box-shadow: 0 0 10px rgba(0, 132, 255, 0.7);
        }
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }
</style>

<!-- Main Content Start Here  -->
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6 d-flex justify-content-center">
        <div class="card glow-card" style="display: flex;  justify-content: center; background: #1a1a1a; padding: 20px; border-radius: 15px; box-shadow: 0 0 10px rgba(0, 132, 255, 0.5); border: 2px solid rgba(0, 132, 255, 0.7); width: 100%;">
            <div class="card-body">
                
                <!-- Title and Share Button in One Row -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 style="color: white; margin: 0;">
                        <i class="fa fa-file"></i> EMI Status
                    </h3>
                    <a href="{{ url('/emi_link/'.$emi->status) }}" class="btn btn-primary" target="_blank">Share Emi Link</a>
                </div>

                <!-- Switch Button Centered -->
                <div class="text-center">
                    <label class="custom-switch">
                        <input type="checkbox" name="custom-switch-checkbox"
                            class="custom-switch-input StatusSwitch"
                            value="{{$emi->id}}" {{ $emi->status == 1 ? 'checked' : '' }}>
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                
            </div>
        </div>
    </div>
</div>



<!-- Main Content End Here  -->


<!-- JS Links Start Here -->
<script src="{{asset('Admin/assets/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
window.jQuery || document.write('<script src="assets/jquery/jquery-2.1.1.min.js"><\/script>')
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// switch start here
$('.StatusSwitch').change(function() {
    var isChecked = $(this).is(':checked');
    var switchLabel = this.value;
    var checkedVal = isChecked ? 1 : 0;
    // Display SweetAlert confirmation dialog with both buttons
    var tableName = "tbl_emi";
    swal({
        title: "Are you sure?",
        text: "You are about to update the status.",
        icon: "warning",
        buttons: ["Cancel", "Yes, update it"],
        dangerMode: true,
    }).then((willUpdate) => {
        if (willUpdate) {
            var formData = new FormData();
            formData.append('id', switchLabel);
            formData.append('status', checkedVal);
            $.ajax({
                type: "POST",
                url: "{{ url('switch_status_update') }}/" + tableName,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                encode: true,
                success: function(data) {
                    swal("Status Updated Successfully", "", "success");
                    window.location.reload();
                },
                error: function(errResponse) {
                    // Handle error if needed
                }
            });
        } else {
            // Revert the checkbox state if the user cancels
            $(this).prop('checked', !isChecked);
            swal("Status Update Cancelled", "", "info");
        }
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