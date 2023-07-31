<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key={{ config('midtrans.client_key') }}></script>
    <title>{{ $title ?? 'Sistem Pembayaran SPP' }}</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/assets/jqueryui/jquery-ui.min.css') }}"> --}}

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    {{-- <link rel="stylesheet" href="{{ asset('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.png') }}" />

    {{-- <script src="{{ asset('/assets/jqueryui/jquery-ui.min.js') }}" type="text/javascript"></script> --}}
    {{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script> --}}
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script> --}}
    {{-- <script src="{{ asset('/assets/jquery-3.6.0.min.js') }}" type="text/javascript"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" /> --}}
    {{-- material icon --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}

    {{-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> --}
    }
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    {{-- https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css --}}




    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> --}}


</head>

<body class="sidebar-dark ">
    <div id="top-top" class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class=" d-print-none navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-2">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>

                    <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
                        <img style="width: 180px; height: 90px;"
                            src="{{ asset('/assets/images/logo-sekolah-islam.svg') }}" alt="logo" />
                    </a>
                    {{-- <h6 class="text-white text-sm">Sistem Pembayaran Akademik</h6> --}}
                    {{-- <a class="navbar-brand brand-logo-mini d-print-none" href="index.html">
                        <img src="{{ asset('/assets/images/logo-sekolah.svg') }}" alt="logo" />
                    </a> --}}
                </div>
            </div>
            @php
                date_default_timezone_set('Asia/Jakarta');
                $date = Date('m d Y');
                $b = time();
                $hour = date('G', $b);
                
                if ($hour >= 0 && $hour <= 11) {
                    $time = 'Selamat Pagi ';
                } elseif ($hour >= 12 && $hour <= 14) {
                    $time = 'Selamat Siang  ';
                } elseif ($hour >= 15 && $hour <= 18) {
                    $time = 'Selamat Sore ';
                } elseif ($hour >= 18 && $hour <= 23) {
                    $time = 'Selamat Malam  ';
                }
                
            @endphp
            <div class="navbar-menu-wrapper d-flex align-items-top d-print-none">
                <ul class="navbar-nav">
                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        {{-- <div class="col mt-5">
                            <img style="width: 100px; height: 100px;"
                                src="{{ asset('/assets/images/logo-sekolah-islam.svg') }}" alt="logo" />
                        </div> --}}

                        <h1 class="welcome-text">{{ $time }}, <span
                                class="text-black fw-bold">{{ auth()->user()->nama }}</span>
                        </h1>
                        <h3 class="welcome-sub-text"><b> Selamat Datang di Halaman Sistem Pembayaran Akademik</b> </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item d-none d-lg-block">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control" value="">
                        </div>
                    </li>


                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (auth()->user()->akses_user == 'siswa')
                                @if (auth()->user()->siswas->avatar == null)
                                    <img class="img-xs rounded-circle" src="{{ auth()->user()->avatar() }}"
                                        alt="Profile image">
                                @else
                                    <img class="img-xs rounded-circle" src="{{ auth()->user()->siswas->getAvatar() }}"
                                        alt="Profile image">
                                @endif
                            @elseif(auth()->user()->akses_user == 'bendahara')
                                @if (auth()->user()->bendaharas->avatar == null)
                                    <img class="img-xs rounded-circle" src="{{ auth()->user()->avatar() }}"
                                        alt="Profile image">
                                @else
                                    <img class="img-xs rounded-circle"
                                        src="{{ auth()->user()->bendaharas->getAvatar() }}" alt="Profile image">
                                @endif

                                {{-- @endif --}}
                            @endif

                            {{-- <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg"
                                alt="Profile image"> --}}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                @if (auth()->user()->akses_user == 'siswa')
                                    @if (auth()->user()->siswas->avatar == null)
                                        <img class="img-md rounded-circle" src="{{ auth()->user()->avatar() }}"
                                            alt="Profile image">
                                    @else
                                        <img class="img-md rounded-circle"
                                            src="{{ auth()->user()->siswas->getAvatar() }}" alt="Profile image"
                                            style="max-width: 60px;">
                                    @endif
                                @elseif(auth()->user()->akses_user == 'bendahara')
                                    @if (auth()->user()->bendaharas->avatar == null)
                                        <img class="img-md rounded-circle" src="{{ auth()->user()->avatar() }}"
                                            alt="Profile image">
                                    @else
                                        <img class="img-md rounded-circle"
                                            src="{{ auth()->user()->bendaharas->getAvatar() }}" alt="Profile image"
                                            style="max-width: 60px;">
                                    @endif

                                @endif

                                {{-- <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg"
                                    alt="Profile image"> --}}
                                <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->nama }}</p>
                                <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                            </div>
                            @php
                                $id = auth()->user()->id;
                            @endphp
                            <a href="{{ url('/profile/' . $id) }}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                Profile <span class="badge badge-pill badge-danger"></span></a>

                            <a href="{{ url('/logout') }}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">


            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('layout.sidebar')
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer d-print-none">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Qdeveloper <a
                                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap</a>
                            from Bootstrap</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- plugins:js -->
    <script src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('/assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('/assets/js/template.js') }}"></script>
    <script src="{{ asset('/assets/js/settings.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/todolist.js') }}"></script> --}}
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
    {{-- <script src="{{ asset('/assets/js/Chart.roundedBarCharts.js') }}"></script> --}}
    <!-- End custom js for this page-->
</body>

</html>
