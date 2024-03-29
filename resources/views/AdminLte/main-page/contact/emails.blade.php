@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VicTory Group - Admin</title>

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
                        <h1 class="m-0">Emails</h1>
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
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-danger">
                            New Emails - ({{ $countEs }} received today)
                        </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    @foreach ($newEmails as $email)
                        <div>
                            <i class="fas bg-danger fa-solid fa-envelope"></i>
                            <div class="timeline-item ">

                                <span class="time w-50 d-flex justify-content-between align-items-center py-1 ">
                                    <span>
                                        receive at {{ \Carbon\Carbon::parse($email->created)->format('d/m/Y H:i:s') }}
                                        &nbsp;<i class="far fa-clock"></i>
                                    </span>
                                    <span>
                                        @if ($email->status == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#mask-as-read{{ $email->id }}">
                                                <i class="fas fa-envelope-open-text"></i>
                                                Mask as Read
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#mask-as-unread{{ $email->id }}">
                                                <i class="fas fa-envelope"></i>
                                                Mask as Unread
                                            </button>
                                        @endif
                                    </span>
                                </span>
                                <h3 class="timeline-header ">[From: {{ $email->name }}] - <a
                                        href="#">{{ $email->email }}</a></h3>
                            </div>
                            <div class="timeline-item ">
                                <h5 class="timeline-header overflow-hidden">{{ $email->message }}</h5>
                            </div>

                            <!-- Remove modal -->
                            <form action="{{ url('/admin/contact/read') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $email->id }}">

                                <div class="modal fade" id="mask-as-read{{ $email->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to mask email as read
                                                    "{{ $email->id }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will mask email as READ</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="mask-as-read">Confirm
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Remove modal -->

                                <!-- Active modal -->

                                <div class="modal fade" id="mask-as-unread{{ $email->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to mask email as unread
                                                    "{{ $email->id }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will mask email as UNREAD</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="mask-as-unread">Confirm
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="pb-4">
                        <i class="far  bg-danger fa-solid fa-circle-arrow-down"></i>
                    </div>

                </div>
                {{-- </div> --}}

            </div>
        </div>
        <!--email đã đọc-->
        <div class="content">
            <div class="container-fluid">
                {{-- <div class="row"> --}}
                <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-success">
                            Old Emails
                        </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    @foreach ($oldEmails as $email)
                        <div>
                            <i class="fas bg-success fa-solid fa-envelope"></i>
                            <div class="timeline-item ">

                                <span class="time w-50 d-flex justify-content-between align-items-center py-1 ">
                                    <span>
                                        receive at {{ \Carbon\Carbon::parse($email->created)->format('d/m/Y H:i:s') }}

                                        &nbsp;<i class="far fa-clock"></i>
                                    </span>
                                    <span>
                                        @if ($email->status == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#mask-as-read{{ $email->id }}">
                                                <i class="fas fa-envelope-open-text"></i>
                                                Mask as Read
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#mask-as-unread{{ $email->id }}">
                                                <i class="fas fa-envelope"></i>
                                                Mask as Unread
                                            </button>
                                        @endif
                                    </span>
                                </span>
                                <h3 class="timeline-header ">[From: {{ $email->name }}] - <a
                                        href="#">{{ $email->email }}</a></h3>
                            </div>
                            <div class="timeline-item">
                                <h5 class="timeline-header overflow-hidden">{{ $email->message }}</h5>
                            </div>
                            <!-- Remove modal -->
                            <form action="{{ url('/admin/contact/read') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $email->id }}">

                                <div class="modal fade" id="mask-as-read{{ $email->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to mask email as read
                                                    "{{ $email->id }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will mask email as READ</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="mask-as-read">Confirm
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Remove modal -->

                                <!-- Active modal -->

                                <div class="modal fade" id="mask-as-unread{{ $email->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to mask email as unread
                                                    "{{ $email->id }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will mask email as UNREAD</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="mask-as-unread">Confirm
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="pb-4">
                        <i class="far  bg-success fa-solid fa-circle-arrow-down"></i>
                    </div>

                </div>
                {{-- </div> --}}

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
