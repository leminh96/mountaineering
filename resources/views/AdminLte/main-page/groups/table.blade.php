@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">



    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/daterangepicker/daterangepicker.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
        href="{{ asset('/') }}AdminLte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/') }}AdminLte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <!-- <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/dropzone/min/dropzone.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/summernote/summernote-bs4.min.css">
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
            $('.group_data').addClass('active')


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


            $('.updateForm').submit(function(event) {
                var form = $(this);
                var name = form.find('#name').val().trim();
                var leader = form.find('#leader').val().trim();
                var description = form.find('#description').val().trim();
                var contact = form.find('#contact').val().trim();


                if (name === '' || leader === '' || description === '' || contact === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                }


                if (name === '') {
                    console.log('name empty')
                    form.find('#name').addClass('border border-2 border-danger')
                } else {
                    form.find('#name').removeClass('border border-2 border-danger')
                }
                if (leader === '') {
                    console.log('leader empty')
                    form.find('#leader').addClass('border border-2 border-danger')
                } else {
                    form.find('#leader').removeClass('border border-2 border-danger')
                }
                if (description === '') {
                    console.log('description empty')
                    form.find('.description-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    form.find('.description-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    form.find('.description-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    form.find('.description-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
                if (contact === '') {
                    console.log('contact empty')
                    form.find('.contact-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    form.find('.contact-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    form.find('.contact-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    form.find('.contact-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
            });
        })
    </script>
    <style>
        
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
                        <h1>Organizations Managerment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Organizations Manager</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>
                                <th style="width: 1%">
                                    Id
                                </th>
                                <td style="width: 5%">
                                    Image
                                </td>
                                <th style="width: 25%">
                                    Name
                                </th>
                                <th style="width: 20%">
                                    Leader
                                </th>
                                <th style="width: 15%">
                                    Location (City)
                                </th>

                                <th class="text-center">
                                    Status
                                </th>
                                <th>
                                    Option
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupsList as $group)
                                <tr>
                                    <td>
                                        {{ $group->id }}
                                    </td>
                                    <td>
                                        @if ($group->photo == null || $group->photo == '' || !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                            <img alt="Avatar" class="table-avatar w-100"
                                                src="{{ asset('/img/groups/unknown.png') }}">
                                        @else
                                            <img alt="Avatar" class="table-avatar w-100"
                                                src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}">
                                        @endif
                                    </td>
                                    <td>
                                        <a>
                                            {{ $group->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $group->leader_name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($group->cityName==null)
                                        <a class="text-danger"> 
                                            *No Specific Location
                                        </a>
                                        @else
                                        <a>
                                            {{ $group->cityName }}
                                        </a>
                                        @endif
                                    </td>

                                    <td class="project-state">
                                        @if ($group->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-left">
                                        <a class="btn btn-primary btn-sm " href="{{ url('/admin/groups/detail?id='.$group->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#update{{ $group->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </button>
                                        <!-- Update modal -->
                                        <div class="modal fade" id="update{{ $group->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update form for organization id:
                                                            {{ $group->id }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="updateForm" action="{{ url('/admin/groups/proccessUpdate') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $group->id }}">

                                                        <div class="modal-body">
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="name">Organization's name</label>

                                                                    <input name='name' type="text"
                                                                        class="form-control" id="name"
                                                                        placeholder="Enter organization name"
                                                                        value="{{ $group->name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="leader">Organization's leader
                                                                        name</label>

                                                                    <input name='leader' type="text"
                                                                        class="form-control" id="leader"
                                                                        placeholder="Enter leader name"
                                                                        value="{{ $group->leader_name }}">
                                                                </div>

                                                                <div class="form-group description-input">
                                                                    <label for="description">Organization's
                                                                        description</label>
                                                                    <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">
                                                                        {!! html_entity_decode($group->description) !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group contact-input">
                                                                    <label for="contact">Organization's Contact</label>
                                                                    <textarea name="contact" class="summernote " placeholder="Wrire desctiption here" id="contact">
                                                                        {!! html_entity_decode($group->contact) !!}
                                                                    </textarea>
                                                                </div>

                                                                <div class="form-group mb-5">
                                                                    <label for="main-photo">Main photo</label>
                                                                    <br>
                                                                    @if ($group->photo == null || $group->photo == '' || !File::exists(public_path('img/groups/' . $group->id . '/' . $group->photo)))
                                                                        <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                            src="{{ asset('/img/groups/unknown.png') }}"
                                                                            alt="">
                                                                    @else
                                                                        <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                            src="{{ asset('/img/groups/' . $group->id . '/' . $group->photo) }}"
                                                                            alt="">
                                                                    @endif

                                                                    <div class="input-group">
                                                                        <input class="form-control  p-0 h-100"
                                                                            type="file" id="main-photo"
                                                                            name="main-photo" accept="image/*">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group mb-5">

                                                                    <label>Organization's location (city)</label>
                                                                    <select id="city" class="duallistbox"
                                                                        name="cityId">
                                                                        <option value="-1"  class="text-danger">*No Specific Location</option>

                                                                        @foreach ($citiesList as $city)
                                                                            <option
                                                                                @if ($city->id == $group->city_id) selected @endif
                                                                                value="{{ $city->id }}">
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="form-group mb-5">

                                                                    <label>Related mountains</label>
                                                                    <select class="duallistbox" multiple="multiple"
                                                                        name="mountains[]">
                                                                        @foreach ($mountainsList as $mountain)
                                                                            <option
                                                                                @foreach ($mountainList as $option)
                                                                            @if ($option->id == $mountain->id && $option->group_id == $group->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $mountain->id }}">
                                                                                {{ $mountain->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="api">Map api</label>
                                                                    <input name="api" type="text"
                                                                        class="form-control" id="api"
                                                                        placeholder="Enter api string" value="{{ $group->api }}">
                                                                </div>

                                                            </div>
                                                            <!-- /.card-body -->

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" name="button" value="update"
                                                                class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- End Update modal -->

                                        @if ($group->deactivated == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deactivate{{ $group->id }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                deactivate
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#activate{{ $group->id }}">
                                                <i class="fa-solid fa-circle-right"></i>
                                                activate
                                            </button>
                                        @endif
                                        <!-- Remove modal -->
                                        <form action="{{ url('/admin/groups/activate') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $group->id }}">

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
                                        <!-- End Remove modal -->

                                    </td>
                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
    <!-- REQUIRED SCRIPTS -->
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



    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('/') }}AdminLte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="{{ asset('/') }}AdminLte/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('/') }}AdminLte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('/') }}AdminLte/plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('/') }}AdminLte/plugins/dropzone/min/dropzone.min.js"></script>

    <script src="{{ asset('/') }}AdminLte/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Page specific script -->
    <script>
        $(function() {

            $('.summernote').summernote({
                toolbar: [
                    // Font Style
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['bold', ['bold']],
                    ['italic', ['italic']],
                    ['underline', ['underline']],
                    ['strikethrough', ['strikethrough']],
                    ['superscript', ['superscript']],
                    ['subscript', ['subscript']],
                    ['clear', ['clear']],

                    // Font Align
                    ['style', ['style']],
                    ['height', ['height']],
                    ['ul', ['ul']],
                    ['ol', ['ol']],
                    ['paragraph', ['paragraph']],
                    ['align', ['ul', 'ol', 'paragraph', 'lineheight']],
                    ['table', ['table']],
                    ['link', ['link']],
                    ['picture', ['picture']],
                    ['video', ['video']],
                    ['hr', ['hr']],
                    ['codeview', ['codeview']],
                    ['fullscreen', ['fullscreen']],
                    ['help', ['help']]
                ],
                height: 300,

            });


            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            $('.swalDefaultSuccess').click(function() {
                Toast.fire({
                    icon: 'success',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.swalDefaultInfo').click(function() {
                Toast.fire({
                    icon: 'info',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });
            $('.swalDefaultError').click(function() {
                Toast.fire({
                    icon: 'error',
                    title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                })
            });

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {
                'placeholder': 'mm/dd/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                }
            });

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function(event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>
@endsection
