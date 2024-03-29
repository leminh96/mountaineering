@extends('AdminLte.main-page.layout.mainLayout')

@section('head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VicTory Group - Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/summernote/summernote-bs4.min.css">
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
            $('.group_add').addClass('active')

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


            
            $('.addForm').submit(function(event) {
                var name = $('#name').val().trim();
                var leader = $('#leader').val().trim();
                var description = $('#description').val().trim();
                var contact = $('#contact').val().trim();


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
                    $('#name').addClass('border border-2 border-danger')
                } else {
                    $('#name').removeClass('border border-2 border-danger')
                }
                if (leader === '') {
                    console.log('leader empty')
                    $('#leader').addClass('border border-2 border-danger')
                } else {
                    $('#leader').removeClass('border border-2 border-danger')
                }
                if (description === '') {
                    console.log('description empty')
                    $('.description-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.description-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    $('.description-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    $('.description-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                if (contact === '') {
                    console.log('contact empty')
                    $('.contact-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.contact-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    $('.contact-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    $('.contact-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }



            });
        })
    </script>
@endsection

@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Organization Adding</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add new organization</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Infomation</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="addForm" action="{{ url('/admin/groups/proccessAdd') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Organization's name</label>

                                        <input name='name' type="text" class="form-control" id="name"
                                            placeholder="Enter organization name">
                                    </div>
                                    <div class="form-group">
                                        <label for="leader">Organization's leader name</label>

                                        <input name='leader' type="text" class="form-control" id="leader"
                                            placeholder="Enter leader name">
                                    </div>

                                    <div class="form-group description-input">
                                        <label for="description">Organization's description</label>
                                        <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">

                                        </textarea>
                                    </div>
                                    <div class="form-group contact-input">
                                        <label for="contact">Organization's Contact</label>
                                        <textarea name="contact" class="summernote " placeholder="Wrire desctiption here" id="contact">

                                        </textarea>
                                    </div>

                                    <div class="form-group mb-5">
                                        <label for="main-photo">Main photo</label>
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="main-photo" name="main-photo"
                                                accept="image/*">
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 city_dualistbox">

                                        <label>Organization's location (city)</label>
                                        <select id="city" class="duallistbox" name="cityId" >
                                            <option value="-1"  class="text-danger">*No Specific Location</option>

                                            @foreach ($citiesList as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group mb-5">

                                        <label>Related mountains</label>
                                        <select class="duallistbox" multiple="multiple" name="mountains[]">
                                            @foreach ($mountainsList as $mountain)
                                                <option value="{{ $mountain->id }}">{{ $mountain->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="api">Map api</label>
                                        <input name="api" type="text" class="form-control" id="api"
                                            placeholder="Enter api string">
                                    </div>
                                    <div class="form-group">
                                        <label for="dangers">Organization's status</label>
                                        <input name="status" type="checkbox" checked data-bootstrap-switch
                                            data-on-text="activated" data-off-text="deactivated" data-off-color="danger"
                                            data-on-color="success" value="1">

                                    </div>





                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" name="button" value="add"
                                        class="btn btn-block btn-outline-info btn-sm">Confirm
                                        Add</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!------------------------------------------------------------->





                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('script')
    <!-- jQuery -->
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/dropzone"></script> -->
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}AdminLte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}AdminLte/dist/js/demo.js"></script>

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
