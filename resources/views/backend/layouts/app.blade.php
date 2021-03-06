<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{asset('backend')}}/img/logo/logo.png" rel="icon">
  <title> @yield('title') </title>
  <link href="{{asset('backend')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('backend')}}/css/ruang-admin.min.css" rel="stylesheet">
  <link href="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
  @include('backend.layouts.sidebar')
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
  @include('backend.layouts.topbar')

        <!-- Topbar -->

        <!-- Container Fluid-->

@yield('content')

        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
              <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{asset('backend')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('backend')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="{{asset('backend')}}/js/ruang-admin.min.js"></script>
  <script src="{{asset('backend')}}/vendor/chart.js/Chart.min.js"></script>
  <script src="{{asset('backend')}}/js/demo/chart-area-demo.js"></script>
  <script src="{{asset('backend')}}/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{asset('backend')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
@yield('script')
</body>

</html>
