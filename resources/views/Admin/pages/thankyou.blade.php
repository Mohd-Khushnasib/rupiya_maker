<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Thank You</h3>
                    </div>
                    <div class="card-body text-center">
                        <!-- Add Thank You Image Here -->
                        <img src="{{asset('Admin/img/thankyou.jpg')}}" alt="Thank You" class="img-fluid mb-3" style="height:300px;width:300px">
                        <h5>Your Form has been placed successfully</h5>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

    <!-- JS Start Here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
    window.onload = function () {
        history.pushState(null, null, window.location.href);
        window.onpopstate = function () {
            history.pushState(null, null, window.location.href);
        };
    };
    </script>
</body>
</html>
