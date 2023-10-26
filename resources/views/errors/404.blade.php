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
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/css/style.min.css" />
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
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="position-relative overflow-hidden min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
          <div class="row justify-content-center w-100">
            <div class="col-lg-4">
              <div class="text-center">
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/errorimg.svg" alt="" class="img-fluid" width="500">
                <h1 class="fw-semibold mb-7 fs-9">Opps!!!</h1>
                <h4 class="fw-semibold mb-7">This page you are looking for could not be found.</h4>
                @php
                    if (url()->previous() == url()->current()) {
                        $url = url('/');
                    } else {
                        $url = url()->previous();
                    }
                @endphp
                <a class="btn btn-primary" href="{{ $url }}" role="button">Go Back to Previous Page</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!--  Import Js Files -->
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!--  core files -->
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/app.min.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/app.init.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/app-style-switcher.js"></script>
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/sidebarmenu.js"></script>
    
    <script src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/js/custom.js"></script>
  </body>
</html>