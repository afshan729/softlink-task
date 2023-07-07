<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Application</title>

    <!-- Custom fonts for this template-->
    <link href="frontend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="frontend/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                   
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex justify-content-center">

                            <div class="col-lg-6">
                                <div class="p-5">


                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome To Blog Application!</h1>
                                    </div>

                                    @if (Session::has('error'))
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ Session::get('error') }}</li>
                                        </ul>
                                    </div>
                                @endif

                            <form class="user" id="login-form" method="POST" action="{{ route('admin.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control form-control-user" name="email"
                                                aria-describedby="emailHelp" placeholder="Enter Email Address">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control form-control-user" name="password"
                                                placeholder="Password" required>
                                        </div>
                                      {{--  <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> --}}
                                        <span id="login-response"></span>

                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>

                                    </form>
                                    
                                  {{--   <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="frontend/vendor/jquery/jquery.min.js"></script>
    <script src="frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="frontend/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="frontend/js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
            var loginForm = $('#login-form');
            loginForm.submit(function(e) {
                e.preventDefault();
                $('#login-button').attr("disabled", true);
                $('#login-button').html("logging in...");
                var formData = loginForm.serialize();
                 //console.log(formData);
                $.ajax({
                    url: "{{ route('admin.login') }}",
                    method: 'POST',
                    data: formData,
                    success: function(data) {
                        $('#login-button').attr("disabled", true);
                        $('#login-button').html("Login");
                        $('#login-response').html("Login Success!")
                        $('#login-response').css({'color': 'green'})
                        if (data?.message == 'subadmin') {
                            setTimeout(
                            function() {
                                $(location).attr('href', '{{route("admin.dashboard")}}');
                            }, 1000);
                            return true;
                        }
                        setTimeout(
                            function() {
                                $(location).attr('href', '{{route("admin.dashboard")}}');
                            }, 1000);
                    },
                    error: function(data) {
                        $('#login-button').attr("disabled", false);
                        $('#login-button').html("Login");
                        if (data?.responseJSON?.error) {
                            $('#login-response').html(data?.responseJSON?.error)
                            $('#login-response').css({'color': 'red'})
                            return false;
                        }
                        $('#login-response').html("Something went wrong!")
                        $('#login-response').css({'color': 'red'})
                    }
                })
            });
        })
    </script>
</body>

</html>
