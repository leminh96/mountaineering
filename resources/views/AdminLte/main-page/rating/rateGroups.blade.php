@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VicTory Group - Admin </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            window.addEventListener("pageshow", function(event) {
                var historyTraversal = event.persisted ||
                    (typeof window.performance != "undefined" &&
                        window.performance.navigation.type === 2);
                if (historyTraversal) {
                    // Handle page restore.
                    window.location.reload();
                }
            });

            @if (session()->has('mess'))
                var mess = {!! json_encode(session()->get('mess')) !!};


                Swal.fire({
                    icon: {!! json_encode(session()->get('icon')) !!},
                    title: mess,
                    text: {!! json_encode(session()->get('text')) !!}
                });
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/removeMessSession') }}",

                });
            @endif
            $('a').click(function(event) {
                var newestAdminLoginId = null;
                var currentAdminLoginId = {!! json_encode(session()->get('admin')->id) !!};

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/getNewestAdminLoginId') }}",
                    success: function(data) {
                        newestAdminLoginId = data.adminId;
                        if (newestAdminLoginId != null && currentAdminLoginId !=
                            newestAdminLoginId) {
                            event.preventDefault();
                            window.location.reload();
                        }
                    }
                });



            });

            $('button').click(function(event) {
                var newestAdminLoginId = null;
                var currentAdminLoginId = {!! json_encode(session()->get('admin')->id) !!};

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/getNewestAdminLoginId') }}",
                    success: function(data) {
                        newestAdminLoginId = data.adminId;
                        if (newestAdminLoginId != null && currentAdminLoginId !=
                            newestAdminLoginId) {
                            event.preventDefault();
                            window.location.reload();
                        }
                    }
                });



            });

            function SetRatingStarResult() {
                $('.star-rating-result').each(function() {
                    var ratingValue = parseFloat($(this).find('.rating-value-result').val());
                    var stars = $(this).find('.fa-star');

                    stars.each(function(index) {
                        if (ratingValue >= index + 1) {
                            $(this).removeClass('fa-regular').addClass('fa-solid');
                        } else {
                            $(this).removeClass('fa-solid').addClass('fa-regular');
                        }
                    });
                });
            }

            SetRatingStarResult();

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()


        })
    </script>
    <style>
        .truncate-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1 !important;
            /* Số dòng tối đa muốn hiển thị cho tin tức chính*/
            -webkit-box-orient: vertical !important;
        }

        .truncate-text img {
            display: none !important;
        }

        .truncate-text figure {
            display: none !important;

        }

        .truncate-text table {
            display: none !important;
        }

        .truncate-text figcaption {
            display: none !important;
        }

        .truncate-text .hero-container {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Rate-groups</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Content Header (Page header) -->
        <div class="content">
            <div class="container-fluid">
                {{-- <div class="row"> --}}
                <div class="timeline timeline-inverse">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Average Rating groups</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                @foreach ($groupsList as $group)
                                    <li class="item">
                                        <div class="product-img">
                                            {{-- <img src="{{ asset('/') }}AdminLte/dist/img/default-150x150.png"
                                                alt="Product Image" class="img-size-50"> --}}
                                            @if (
                                                $group->photo == null ||
                                                    $group->photo == '' ||
                                                    !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                                <img src="{{ asset('/img/groups/unknown.png') }}"
                                                    class="img-fluid rounded h-100 img-size-50" alt="">
                                            @else
                                                <img src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}"
                                                    class="img-fluid rounded h-100 img-size-50" alt="">
                                            @endif
                                        </div>
                                        <div class="product-info text-start">

                                            <a href="{{ url('/admin/groups/detail?id=' . $group->id) }}"
                                                class="product-title truncate-text float-left">{{ $group->name }}</a>
                                            <br>
                                            <span class="badge ">
                                                <div class="d-flex justify-content-start star-rating-result mb-3 mt-1">
                                                    <span class="fa-regular fa-star text-warning " data-rating="1"></span>
                                                    <span class="fa-regular fa-star text-warning" data-rating="2"></span>
                                                    <span class="fa-regular fa-star text-warning" data-rating="3"></span>
                                                    <span class="fa-regular fa-star text-warning" data-rating="4"></span>
                                                    <span class="fa-regular fa-star text-warning" data-rating="5"></span>
                                                    @if ($group->averageRating == null)
                                                        <input type="hidden" name="whatever1" class="rating-value-result"
                                                            value="0">
                                                    @else
                                                        <input type="hidden" name="whatever1" class="rating-value-result"
                                                            value="{{ $group->averageRating }}">
                                                    @endif
                                                </div>
                                            </span>

                                        </div>
                                    </li>
                                @endforeach
                                <!-- /.item -->


                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection



@section('script')
    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/') }}AdminLte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/') }}AdminLte/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}AdminLte/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/') }}AdminLte/dist/js/pages/dashboard2.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

@endsection
