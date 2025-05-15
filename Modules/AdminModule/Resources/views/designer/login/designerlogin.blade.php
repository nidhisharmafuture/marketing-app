<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketing App - Login</title>

    <!-- Required CSS -->
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('superadmin/assets/css/style.css') }}">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('superadmin/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('superadmin/assets/images/logo.svg') }}">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>

                            <form class="pt-3" method="POST" action="{{ route('designer.login-process') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                                </div>
                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN IN
                                    </button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input"> Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-primary">Forgot password?</a>
                                </div>
                                <div class="mb-2 d-grid gap-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="mdi mdi-facebook me-2"></i>Connect using Facebook
                                    </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="#" class="text-primary">Create</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required JS -->
    <script src="{{ asset('superadmin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('superadmin/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('superadmin/assets/js/misc.js') }}"></script>
    <script src="{{ asset('superadmin/assets/js/settings.js') }}"></script>
    <script src="{{ asset('superadmin/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('superadmin/assets/js/jquery.cookie.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr Alert Display -->
    <script>
        @if (session('message'))
            toastr.success("{{ session('message') }}");
        @elseif (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
</body>
</html>
