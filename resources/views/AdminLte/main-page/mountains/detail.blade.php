@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/VenoBox-master/src/venobox.css">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()
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



            $('.mountain_data').addClass('active')
            new VenoBox({
                selector: '.venobox',
                numeration: true,
                infinigall: true,
                share: true,
                spinner: 'rotating-plane'
            });



        })
    </script>
    <style>
        iframe {
            width: 100%;
        }
    </style>
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mountain Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"> <a href="{{ url('/admin/mountains/table') }}">Mountains
                                    Manager</a></li>
                            <li class="breadcrumb-item active"> Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="w-100">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center" style="max-height: 500px">
                                @if (
                                    $mountain->photo_main == null ||
                                        $mountain->photo_main == '' ||
                                        !File::exists(public_path('img/mountains/' . $mountain->id . '/' . $mountain->photo_main)))
                                    <img class=" img-fluid " src="{{ asset('/img/mountains/unknown.png') }}"
                                        alt="User profile picture"style="max-height: 500px">
                                @else
                                    <img class=" img-fluid "
                                        src="{{ asset('/img/mountains/' . $mountain->id . '/' . $mountain->photo_main) }}"
                                        alt="User profile picture" style="max-height: 500px">
                                @endif
                                {{-- <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/') }}AdminLte/dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
                            </div>

                            <h3 class="profile-username text-center font-weight-bold">{{ $mountain->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Id</b> <span class="float-right">{{ $mountain->id }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Location</b> <span class="float-right">{{ $mountain->location }}</span>
                                </li>


                                <li class="list-group-item">
                                    <b>Location (country)</b>
                                    <ul class="float-right">
                                        @foreach ($countriesList as $country)
                                            @foreach ($countryList as $option)
                                                @if ($option->id == $country->id && $option->mountain_id == $mountain->id)
                                                    <li> <a>{{ $country->name }}</a></li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>

                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        @if ($mountain->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif

                                    </a>
                                </li>
                            </ul>




                            @if ($mountain->deactivated == 0)
                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                    data-target="#deactivate{{ $mountain->id }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Deactivate
                                </button>
                            @else
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#activate{{ $mountain->id }}">
                                    <i class="fa-solid fa-circle-right"></i>
                                    Activate
                                </button>
                            @endif
                            <!-- Remove modal -->
                            <form action="{{ url('/admin/mountains/activate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $mountain->id }}">
                                <input type="hidden" name="currentUrl"
                                    value="/admin/mountains/detail?id={{ $mountain->id }}">


                                <div class="modal fade" id="deactivate{{ $mountain->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to deactivate
                                                    "{{ $mountain->name }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will not remove the mountain from server</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="deactivate">Confirm deactivate</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Remove modal -->

                                <!-- Active modal -->

                                <div class="modal fade" id="activate{{ $mountain->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to activate
                                                    "{{ $mountain->name }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will reactivate the mountain from server</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="activate">Confirm activate</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">Current related photos
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($photoList as $photo)
                                @if ($photo->mountain_id == $mountain->id && $photo->name != $mountain->photo_main)
                                    <div class="col-sm-2">
                                        <a id="firstlink" class="venobox" data-gall="mygallery"
                                            data-title="Luke jones @lukejonesdesign"
                                            href="{{ asset('/img/mountains/' . $mountain->id . '/' . $photo->name) }}"><img
                                                class="img-fluid mb-2"
                                                src="{{ asset('/img/mountains/' . $mountain->id . '/' . $photo->name) }}"></a>

                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">Current related videos
                        </h4>
                    </div>
                    <div class="card-body">

                        @foreach ($videoList as $video)
                            @if ($video->mountain_id == $mountain->id)
                                <div>
                                    <a class="venobox" data-autoplay="true" data-vbtype="video" data-ratio="1x1"
                                        data-maxwidth="400px"
                                        href="{{ asset('/img/mountains/' . $mountain->id . '/' . $video->name) }}">
                                        <button type="button"
                                            class="btn btn-block btn-secondary btn-xs  mb-1">{{ $video->name }}</button>
                                    </a>

                                </div>
                            @endif
                        @endforeach




                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Description</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($mountain->description) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">History</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($mountain->history) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Guides</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($mountain->guides) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Sheltering</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($mountain->sheltering) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dangers</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($mountain->dangers) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mountain Map Location</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body d-flex justify-content-center">
                        {!! html_entity_decode($mountain->api) !!}
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection



@section('script')
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}AdminLte/dist/js/demo.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/VenoBox-master/dist/venobox.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
@endsection
