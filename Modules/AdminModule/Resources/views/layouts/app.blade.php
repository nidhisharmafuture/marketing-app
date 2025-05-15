
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('superadmin/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('superadmin/assets/images/favicon.png')}}" />
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
  
    <!-- DataTables Bootstrap 5 CSS -->
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  
  
  </head>
  <body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <div class="container-scroller">
          @include('adminmodule::layouts.header')

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
            @include('adminmodule::layouts.sidebar')

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
           {{-- content --}}

        @yield('content')


          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
            @include('adminmodule::layouts.footer')

         @stack('scripts')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('superadmin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('superadmin/assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{ asset('superadmin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    
    <!-- DataTables core -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 integration -->
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    
    
    <!-- inject:js -->





    <script src="{{ asset('superadmin/assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/misc.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/settings.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/todolist.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('superadmin/assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>