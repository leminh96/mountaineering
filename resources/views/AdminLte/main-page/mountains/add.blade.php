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
            $('.mountain_add').addClass('active')


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
                var description = $('#description').val().trim();
                var history = $('#history').val().trim();
                var guides = $('#guides').val().trim();
                var location = $('#location').val().trim();
                var api = $('#api').val().trim();
                var sheltering = $('#sheltering').val().trim();
                var dangers = $('#dangers').val().trim();
                var main_photo = $('#main-photo')[0].files[0];

                if (name === '' || description === '' || history === '' || guides === '' || location ===
                    '' || api === '' || sheltering === '' || dangers === '' || !main_photo) {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                }

                var mountainsList = {!! json_encode($mountainsList) !!};

                var error_note = '';
                mountainsList.forEach(element => {
                    if (element.name.toLowerCase() === name.toLowerCase()) {
                        event.preventDefault();
                        error_note += 'Mountain name "' + name.toLowerCase() + '" is already exist ! <br>'
                        Swal.fire({
                            icon: "error",
                            title: 'Add failed !',
                            html: error_note

                        });
                    }

                });



                if (name === '') {
                    console.log('name empty')
                    $('#name').addClass('border border-2 border-danger')
                } else {
                    $('#name').removeClass('border border-2 border-danger')
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
                if (history === '') {
                    console.log('history empty')
                    $('.history-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.history-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    $('.history-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    $('.history-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
                if (guides === '') {
                    console.log('guides empty')
                    $('.guides-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.guides-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    $('.guides-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    $('.guides-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
                if (location === '') {
                    console.log('location empty')
                    $('.location-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.location-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    $('.location-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    $('.location-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
                if (api === '') {
                    console.log('api empty')
                    $('#api').addClass('border border-2 border-danger')
                } else {
                    $('#api').removeClass('border border-2 border-danger')
                }
                if (sheltering === '') {
                    console.log('sheltering empty')
                    $('.sheltering-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.sheltering-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    $('.sheltering-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    $('.sheltering-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
                if (dangers === '') {
                    console.log('dangers empty')
                    $('.dangers-input').find('.note-toolbar').addClass('border border-2 border-danger')
                    $('.dangers-input').find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    $('.dangers-input').find('.note-toolbar').removeClass('border border-2 border-danger')
                    $('.dangers-input').find('.note-editable ').removeClass('border border-2 border-danger')
                }
                if (!main_photo) {
                    console.log('main-photo empty')
                    $('#main-photo').addClass('border border-2 border-danger')
                } else {
                    $('#main-photo').removeClass('border border-2 border-danger')
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
                        <h1>Mountain Adding</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add new mountain</li>
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
                            <form class="addForm" action="{{ url('/admin/mountains/proccessAdd') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Mountain's name</label>
                                        <input name='mountain_name' type="text" class="form-control" id="name"
                                            placeholder="Enter name">
                                    </div>
                                    <div class="form-group description-input">
                                        <label for="description">Mountain's description</label>
                                        <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">

                                        </textarea>
                                    </div>
                                    <div class="form-group history-input">
                                        <label for="history">Mountain's history</label>
                                        <textarea name="history" class="summernote" placeholder="Wrire desctiption here" id="history">

                                        </textarea>
                                    </div>
                                    <div class="form-group guides-input">
                                        <label for="guides">Guides</label>
                                        <textarea name="guides" class="summernote" placeholder="Wrire desctiption here" id="guides">

                                        </textarea>
                                    </div>
                                    <div class="form-group location-input">
                                        <label for="location">Mountain's location</label>
                                        <textarea name="location" class="summernote" placeholder="Wrire desctiption here" id="location">

                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="api">Map api</label>
                                        <input name="api" type="text" class="form-control" id="api"
                                            placeholder="Enter api string">
                                    </div>
                                    <div class="form-group sheltering-input">
                                        <label for="sheltering">Mountain's sheltering</label>
                                        <textarea name="sheltering" class="summernote" placeholder="Wrire desctiption here" id="sheltering">

                                        </textarea>
                                    </div>
                                    <div class="form-group dangers-input">
                                        <label for="dangers">Mountain's dangers</label>
                                        <textarea name="dangers" class="summernote" placeholder="Wrire desctiption here" id="dangers">

                                        </textarea>
                                    </div>

                                    <div class="form-group mb-5">

                                        <label>Countries</label>
                                        <select class="duallistbox" multiple="multiple" name="countries[]"
                                            id="countries">
                                            @foreach ($countriesList as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="main-photo">Main photo</label>
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="main-photo" name="main-photo"
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="related-photo">Related photo</label>
                                        <div class="input-group">
                                            <input class="form-control" type="file" id="related-photo"
                                                name="related-photo[]" accept="image/*" multiple>
                                        </div>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="video">Video</label>
                                        <div class="input-group">

                                            <input name="video[]" class="form-control" type="file" id="video"
                                                multiple accept="video/*">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="dangers">Mountain's status</label>
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
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['insert', ['link']],
                    ['color', ['color']],
                    ['height', ['height']],
                    ['font', ['strikethrough', 'superscript', 'subscript']]
                ]
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




        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = true


        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#photoTemplate")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var photoDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-photo-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#photoPreviews", // Define the container to display the previews
            clickable: ".photoinput-button", // Define the element that should be used as click trigger to select files.
            acceptedFiles: "image/*" // Quy định loại file được upload

        })

        photoDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                photoDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        photoDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        photoDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        photoDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        photoDropzone.on("error", function(file, errorMessage, xhr) {
            // Xử lý khi có lỗi xảy ra với file
            console.log("Error uploading file:", file, errorMessage);
            // Ví dụ: Hiển thị thông báo lỗi
            Toast.fire({
                icon: 'error',
                title: errorMessage
            })

            // Tùy chỉnh hành động khác tại đây
        });
        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions-photo .start").onclick = function() {
            photoDropzone.enqueueFiles(photoDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions-photo .cancel").onclick = function() {
            photoDropzone.removeAllFiles(true)
        }

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode1 = document.querySelector("#videoTemplate")
        previewNode1.id = ""
        var previewTemplate1 = previewNode1.parentNode.innerHTML
        previewNode1.parentNode.removeChild(previewNode1)

        var videoDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "/target-video-url", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate1,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#videoPreviews", // Define the container to display the previews
            clickable: ".videoinput-button", // Define the element that should be used as click trigger to select files.
            acceptedFiles: "video/*" // Quy định loại file được upload

        })
        videoDropzone.on("addedfile", function(file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function() {
                videoDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        videoDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        videoDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        videoDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        videoDropzone.on("error", function(file, errorMessage, xhr) {
            // Xử lý khi có lỗi xảy ra với file
            console.log("Error uploading file:", file, errorMessage);
            // Ví dụ: Hiển thị thông báo lỗi
            Toast.fire({
                icon: 'error',
                title: errorMessage
            })

            // Tùy chỉnh hành động khác tại đây
        });
    </script>
@endsection
