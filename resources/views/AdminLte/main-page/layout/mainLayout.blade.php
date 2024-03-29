<!DOCTYPE html>
<html lang="en">

<head>
    @yield('head')
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble img-circle elevation-3" style="opacity: .8"
                src="{{ asset('/') }}AdminLte/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="150"
                width="150">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">{{ $notify }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach ($emailNotify as $email)
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-3"></i>From: {{ $email->name }}
                                <span class="float-right text-muted text-sm">{{ $email->timeAgo }}</span>
                            </a>
                        @endforeach
                        <a href="{{ url('admin/contact/emails') }}" class="dropdown-item dropdown-footer">See All
                            Emails</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-block btn-outline-danger btn-md text-danger"
                        href="{{ url('/admin/logout?command=logout') }}" role="button">
                        Log Out
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/admin/dashboard') }}" class="brand-link">
                <img src="{{ asset('/') }}AdminLte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Victory Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                @include('AdminLte.main-page.layout.profile')

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url('/admin/dashboard') }}" class="nav-link bg-danger">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg-info" data-toggle="modal" data-target="#add-country">
                                <i class="nav-icon fas fa-solid fa-earth-asia"></i>
                                <p>
                                    Add Country
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link bg-info" data-toggle="modal" data-target="#add-city">
                                <i class="nav-icon fas fa-solid fa-city"></i>
                                <p>
                                    Add City
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-solid fa-mountain-sun"></i>
                                <p>
                                    User Manager
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/accounts/table') }}" class="nav-link user_data ">
                                        <i class="nav-icon far fa-solid fa-database"></i>
                                        <p>Data table</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/accounts/add') }}" class="nav-link user_add">
                                        <i class="nav-icon far fa-solid fa-square-plus"></i>
                                        <p>Add new account</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-solid fa-mountain-sun"></i>
                                <p>
                                    Mountains Manager
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/mountains/table') }}" class="nav-link mountain_data">
                                        <i class="nav-icon far fa-solid fa-database"></i>
                                        <p>Data table</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/mountains/add') }}" class="nav-link mountain_add">
                                        <i class="nav-icon far fa-solid fa-square-plus"></i>
                                        <p>Add new mountain</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-solid fa-newspaper"></i>
                                <p>
                                    Articles Manager
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/articles/table') }}" class="nav-link article_data">
                                        <i class="nav-icon far fa-solid fa-database"></i>
                                        <p>Data table</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/articles/add') }}" class="nav-link article_add">
                                        <i class="nav-icon far fa-solid fa-square-plus"></i>
                                        <p>Add new post</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-solid fa-people-group"></i>
                                <p>
                                    Organizations Manager
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/admin/groups/table') }}" class="nav-link group_data">
                                        <i class="nav-icon far fa-solid fa-database"></i>
                                        <p>Data table</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/admin/groups/add') }}" class="nav-link group_add">
                                        <i class="nav-icon far fa-solid fa-square-plus"></i>
                                        <p>Add new organization</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-regular fa-star-half-stroke"></i>
                                <p>
                                    Rating
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/rating/rateMountains') }}" class="nav-link">
                                        <i class="nav-icon far fa-regular fa-star"></i>
                                        <p>Moutains</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="pages/charts/flot.html" class="nav-link">
                                        <i class="nav-icon far fa-regular fa-star"></i>
                                        <p>Articles</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ url('admin/rating/rateGroups') }}" class="nav-link">
                                        <i class="nav-icon far fa-regular fa-star"></i>
                                        <p>Groups</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">Contact</li>


                        <li class="nav-item">
                            <a href="{{ url('/admin/contact/emails') }}" class="nav-link bg-success">
                                <i class="nav-icon fas fa-solid fa-envelope"></i>

                                <p>
                                    Emails
                                    <span class="badge badge-info right">{{ $notify }}</span>
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="modal fade" id="add-country">
            <div class="modal-dialog">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Country</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/addCountry') }}" method="post" class="addCountry">
                        @csrf
                        <div class="modal-body">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Country Name</label>
                                    <input name='name' type="text" class="form-control " id="countryName"
                                        placeholder="Enter country name">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="submit" name="button" value="addCountry"
                                class="btn btn-outline-light">Confirm add</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="add-city">
            <div class="modal-dialog">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h4 class="modal-title">Add City</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('/admin/addCity') }}" method="post" class="addCity">
                        @csrf
                        <div class="modal-body">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">City Name</label>
                                    <input name='name' type="text" class="form-control " id="cityName"
                                        placeholder="Enter city name">
                                </div>
                                <div class="form-group ">

                                    <label>City's contry</label>
                                    <select id="city" class="duallistbox" name="countryId">

                                        @foreach ($addCountryList as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                            <button type="submit" name="button" value="addCity"
                                class="btn btn-outline-light">Confirm add</button>
                        </div>
                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- Content Wrapper. Contains page content -->
        @yield('content')

        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->


    @yield('script')

    <script>
        $(document).ready(function() {
            $('.addCountry').submit(function(event) {

                var form = $(this)

                var name = form.find('#countryName').val().trim();


                if (name === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                    form.find('#countryName').addClass('border border-2 border-danger')
                }

                var validateCountryList = {!! json_encode($validateCountryList) !!};
                validateCountryList.forEach(element => {


                    if (element.name.toLowerCase() === name.toLowerCase()) {
                        event.preventDefault();
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Country name "+name+" is already exists !"
                    });
                    form.find('#countryName').addClass('border border-2 border-danger')
                    }

                });


            });


            $('.addCity').submit(function(event) {

                var form = $(this)

                var name = form.find('#cityName').val().trim();

                if (name === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                    form.find('#cityName').addClass('border border-2 border-danger')
                }
                var validateCityList = {!! json_encode($validateCityList) !!};
                validateCityList.forEach(element => {


                    if (element.name.toLowerCase() === name.toLowerCase()) {
                        event.preventDefault();
                        Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "City name "+name+" is already exists !"
                    });
                    form.find('#cityName').addClass('border border-2 border-danger')
                    }

                });

            });

        })
    </script>
</body>

</html>
