<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <meta name="theme-color" content="#000000" />
    <meta name="author" content="" />
    <meta name="keyword" content="" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/material-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/blueimp-gallery.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme-bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}" />
    {{-- <link href={{ asset('/public/css/bootstrap.min.css') }} rel="stylesheet" /> --}}
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    {{-- <link rel="stylesheet" href="lib/animate/animate.min.css" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('lib/animate/animate.min.css') }}" />
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />


    <!-- Customized Bootstrap Stylesheet -->


    <link href={{ asset('css/style.css') }} rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    @yield('pagecss')
    @yield('plugins')
    <script>
        var siteAddr = "{{ url('') }}/";
        var defaultPageLimit = 20;
        var csrfToken = "{{ csrf_token() }}";
        var requestErrorMessage = "Unable to complete request";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    </script>
</head>
<?php
$body_id = 'index';
if (auth()->check()) {
    $body_id = 'main';
}
$page_name = request()->segment(1) ?? 'index';
$page_action = request()->segment(2) ?? 'index';
$body_class = "$page_name-$page_action";
?>

<body id="<?php echo $body_id; ?>" class="with-login <?php echo $body_class; ?>">
    <div id="page-wrapper">

        <div id="main-content">
            {{-- @include('appheader_front') --}}
            <x-navbar></x-navbar>
            <!-- Page Main Content Start -->
            <div id="page-content">
                @yield('content')

                @include('appfooter_front')
            </div>
            <!-- Page Main Content [End] -->
            <!-- Page Footer Start -->

            <!-- Page Footer Ends -->
        </div>
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        {{-- <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script> --}}
        <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
        <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>
        <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>



        <!-- Template Javascript -->
        <script src={{ asset('js/main.js') }}></script>

        <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/app-plugins.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/chartjs-3.3.2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/flatpickr.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/dropzone.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/page-scripts.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/form-page-scripts.js') }}"></script>
        @yield('pagejs')
        <script>
            window.onload = (event) => {
                @if (Session::has('success'))
                    let successAlert = document.getElementById('app-toast-success');
                    let bsAlert = new bootstrap.Toast(successAlert);
                    bsAlert.show();
                @endif
                @if (Session::has('danger'))
                    let errorAlert = document.getElementById('app-toast-danger');
                    let bsAlert = new bootstrap.Toast(errorAlert);
                    bsAlert.show();
                @endif
            }
        </script>
</body>

</html>
