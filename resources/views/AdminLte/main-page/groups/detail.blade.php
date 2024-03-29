@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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

            $('.group_data').addClass('active')

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



        })
    </script>
    <style>
        iframe {
            width: 100%;
        }

        .modal {
            overflow-y: auto;
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
                        <h1>Organization Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"> <a href="{{ url('/admin/groups/table') }}">Organizations
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
                            <div class=" text-center " style="max-height: 500px">



                                @if (
                                    $group->photo == null ||
                                        $group->photo == '' ||
                                        !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                    <img class=" img-fluid " src="{{ asset('/img/groups/unknown.png') }}"
                                        alt="User profile picture" style="max-height: 500px">
                                @else
                                    <img class=" img-fluid "
                                        src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}"
                                        alt="User profile picture" style="max-height: 500px">
                                @endif

                                {{-- <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('/') }}AdminLte/dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
                            </div>

                            <h3 class="profile-username text-center font-weight-bold">{{ $group->name }}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Id</b> <span class="float-right">{{ $group->id }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Leader</b> <span class="float-right">{{ $group->leader_name }}</span>
                                </li>

                                <li class="list-group-item">
                                    <b>Location (city)</b>
                                    <span class="float-right">
                                        @if ($group->city_id == null && $group->city_id == '')
                                            <p class="text-danger m-0">*No specific location</p>
                                        @else
                                            @foreach ($citiesList as $city)
                                                @if ($city->id == $group->city_id)
                                                    {{ $city->name }}
                                                @endif
                                            @endforeach
                                        @endif
                                    </span>
                                </li>
                                <li class="list-group-item">
                                    <b>Related Mountains</b>

                                    <ul class="float-right">

                                        @foreach ($mountainsList as $mountain)
                                            @foreach ($mountainList as $option)
                                                @if ($option->id == $mountain->id && $option->group_id == $group->id)
                                                    <li><a>{{ $mountain->name }}</a></li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>


                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right">
                                        @if ($group->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif

                                    </a>
                                </li>
                            </ul>




                            @if ($group->deactivated == 0)
                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                                    data-target="#deactivate{{ $group->id }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Deactivate
                                </button>
                            @else
                                <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                    data-target="#activate{{ $group->id }}">
                                    <i class="fa-solid fa-circle-right"></i>
                                    Activate
                                </button>
                            @endif
                            <!-- Remove modal -->
                            <form action="{{ url('/admin/groups/activate') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $group->id }}">
                                <input type="hidden" name="currentUrl"
                                    value="/admin/groups/detail?id={{ $group->id }}">


                                <div class="modal fade" id="deactivate{{ $group->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to deactivate group
                                                    "{{ $group->name }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will not remove the group from server</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="deactivate">Confirm
                                                    deactivate</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- End Remove modal -->

                                <!-- Active modal -->

                                <div class="modal fade" id="activate{{ $group->id }}">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure to activate group
                                                    "{{ $group->name }}"</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>This action will reactivate the group from server</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="button"
                                                    value="activate">Confirm
                                                    activate</button>
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
                        <h3 class="card-title">Organization Description</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($group->description) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Organization Contact</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! html_entity_decode($group->contact) !!}
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Organization Map Location</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body d-flex justify-content-center">
                        {!! html_entity_decode($group->api) !!}
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
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
@endsection
