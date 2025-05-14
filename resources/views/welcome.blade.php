






<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Marketing App</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('superadmin/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('superadmin/assets/images/favicon.png')}}" />
  </head>
  <body>
    <div>
            <img src="{{asset('superadmin/img/login-page-bg.jpg') }}" alt="img" class="login-image">
            <div class="login-form-wrapper" style=" border: 1px solid #e5e6e7;max-width: 700px;">
                <div class="row d-flex">
                    <div class="login-logo d-flex justify-content-center">
                        <img src="{{asset('superadmin/img/login-logo.png') }}" alt="logo">
                    </div>

                    <div class="row gap-x-2">
                        <div class="col-md-6">
                            <div class="card">
                                <a href="" class="submit-btn">Login As Super Admin</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <a href="{{ route('admin.loginPage') }}" class="submit-btn">Login As Admin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('superadmin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('superadmin/assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/misc.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/settings.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/todolist.js')}}"></script>
    <script src="{{ asset('superadmin/assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
  </body>
</html>