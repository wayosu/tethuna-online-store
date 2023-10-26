<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>Mordenize</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/front/img/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet"
        href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/css/style.min.css" />

    @stack('styles')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/front/img/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/front/img/favicon.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!--  Body Wrapper -->
    @yield('content')

    <!--  Import Js Files -->
    <script
        src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/libs/jquery/dist/jquery.min.js">
    </script>
    <script
        src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/libs/simplebar/dist/simplebar.min.js">
    </script>
    <script
        src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js">
    </script>
    <!--  core files -->
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/app.min.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/app.init.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/app-style-switcher.js">
    </script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/sidebarmenu.js"></script>

    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/custom.js"></script>

    @stack('scripts')
</body>

</html>
