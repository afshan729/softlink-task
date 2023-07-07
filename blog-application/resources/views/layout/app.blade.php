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
  <link href="{{asset('frontend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('frontend/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">

  <link href="{{asset('frontend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/select2.min.css')}}" rel="stylesheet" />

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

          @include('include.sidebar')

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            @include('include.navbar')

            <!-- Begin Page Content -->
            @yield('content')
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('include.footer')


            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('admin.logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('frontend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('frontend/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
   {{-- <script src="{{asset('frontend/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('frontend/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('frontend/js/demo/chart-pie-demo.js')}}"></script>--}}
     <!-- Page level plugins -->
     <script src="{{asset('frontend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('frontend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
     <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
     <script>
       
          var availableTags = [];
          $.ajax({
                method: "GET",
                url: "{{route('product-list')}}",

  
            success: function (response){
               // console.log(response);
            startAutocomplete(response);
            }
    });
    function startAutocomplete(availableTags)
    {

          $( "#search_product" ).autocomplete({
            source: availableTags
          });
        }
       
        </script>
     @yield('script')

     <!-- Page level custom scripts -->
     <script src="{{asset('frontend/js/demo/datatables-demo.js')}}"></script>
     
 

</body>

</html>