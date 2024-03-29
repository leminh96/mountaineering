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



    <link rel="stylesheet" href="{{ asset('/') }}AdminLte/plugins/VenoBox-master/src/venobox.css">
    <!-- daterange picker -->

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
            $('.mountain_data').addClass('active')

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

            $('.editButton').click(function() {
                // Lấy giá trị của thuộc tính data-target
                var target = $(this).data('target');
                var mountainId = $(this).find('input').val();
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/mountains/getCurrentInfo') }}",
                    data: {
                        id: mountainId
                    },
                    success: function(data) {

                        
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group dangers-input">
                      <label for="dangers">Mountain's dangers</label>
                      <textarea name="dangers" class="summernote" placeholder="Wrire desctiption here" id="dangers">
                        ${data.mountain['dangers']}
                        </textarea>
                  </div>`);
                        
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group sheltering-input">
                      <label for="sheltering">Mountain's sheltering</label>
                      <textarea name="sheltering" class="summernote" placeholder="Wrire desctiption here" id="sheltering">
                        ${data.mountain['sheltering']}
                        </textarea>
                  </div>`);
                  var api=data.mountain['api']
                  console.log(api)
                  //alert(decodeURIComponent(api))

                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group">
                      <label for="api">Map api</label>
                      <input name="api" type="text" class="form-control" id="api" placeholder="Enter api string" value="">
                  </div>`);
                  $(target).find('.fill-update-input-box').prepend(`<div class="form-group location-input">
                      <label for="location">Mountain's location</label>
                      <textarea name="location" class="summernote" placeholder="Write description here" id="location">
                        ${data.mountain['location']}
                        </textarea>
                  </div>`);
                  $(target).find('.fill-update-input-box').prepend(`<div class="form-group guides-input">
                      <label for="guides">Guides</label>
                      <textarea name="guides" class="summernote" placeholder="Write description here" id="guides">
                        ${data.mountain['guides']}
                        </textarea>
                  </div>`);
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group history-input">
                      <label for="history">Mountain's history</label>
                      <textarea name="history" class="summernote" placeholder="Write history here" id="history">
                        ${data.mountain['history']}
                        </textarea>
                  </div>`);
                        
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group description-input">
                      <label for="description">Mountain's description</label>
                      <textarea name="description" class="summernote" placeholder="Write description here" id="description">
                        ${data.mountain['description']}
                      </textarea>
                  </div>`);
                        // Sử dụng setTimeout để đảm bảo rằng sau khi textarea được thêm vào DOM, summernote sẽ được khởi tạo

                        // Thêm danh sách vào đầu của #container
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group">
                      <label for="name">Mountain's name</label>
                      <input name='mountain_name' type="text" class="form-control" id="name" placeholder="Enter name" value="${data.mountain['name']}">
                  </div>`);
                  setTimeout(function() {
                    $(target).find('#api').val(data.mountain['api']);
                            $('.summernote').summernote({
                                toolbar: [
                                    // [groupName, [list of button]]
                                    ['style', ['bold', 'italic',
                                        'underline', 'clear'
                                    ]],
                                    ['para', ['ul', 'ol', 'paragraph']],
                                    ['fontsize', ['fontsize']],
                                    ['fontname', ['fontname']],
                                    ['insert', ['link']],
                                    ['color', ['color']],
                                    ['height', ['height']],
                                    ['font', ['strikethrough',
                                        'superscript', 'subscript'
                                    ]]
                                ]
                            });
                        }, 10);

                    }
                });

            });

            $('.updateForm').submit(function(event) {
                var form = $(this);
                var name = form.find('#name').val().trim();
                var description = form.find('#description').val().trim();
                var history = form.find('#history').val().trim();
                var guides = form.find('#guides').val().trim();
                var location = form.find('#location').val().trim();
                var api = form.find('#api').val().trim();
                var sheltering = form.find('#sheltering').val().trim();
                var dangers = form.find('#dangers').val().trim();
                //var main_photo=form.find('#main-photo')[0].files[0];


                if (name === '' || description === '' || history === '' || guides === '' || location ===
                    '' || api === '' || sheltering === '' || dangers === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please fill in all required blanks"
                    });
                }

                var mountainsList = {!! json_encode($mountainsList) !!};

                var error_note = '';
                var currentName = form.find('#currentName').val().trim();

                mountainsList.forEach(element => {
                    if (element.name != currentName && element.name.toLowerCase() === name
                        .toLowerCase()) {
                        event.preventDefault();
                        error_note += 'Mountain name "' + name.toLowerCase() +
                            '" is already exist ! <br>'
                        Swal.fire({
                            icon: "error",
                            title: 'Add failed !',
                            html: error_note

                        });
                    }

                });



                if (name === '') {
                    console.log('name empty')
                    form.find('#name').addClass('border border-2 border-danger')
                } else {
                    form.find('#name').removeClass('border border-2 border-danger')
                }
                if (description === '') {
                    console.log('description empty')
                    form.find('.description-input').find('.note-toolbar').addClass(
                        'border border-2 border-danger')
                    form.find('.description-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    form.find('.description-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    form.find('.description-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                if (history === '') {
                    console.log('history empty')
                    form.find('.history-input').find('.note-toolbar').addClass(
                        'border border-2 border-danger')
                    form.find('.history-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    form.find('.history-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    form.find('.history-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                if (guides === '') {
                    console.log('guides empty')
                    form.find('.guides-input').find('.note-toolbar').addClass(
                        'border border-2 border-danger')
                    form.find('.guides-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    form.find('.guides-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    form.find('.guides-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                if (location === '') {
                    console.log('location empty')
                    form.find('.location-input').find('.note-toolbar').addClass(
                        'border border-2 border-danger')
                    form.find('.location-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    form.find('.location-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    form.find('.location-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                if (api === '') {
                    console.log('api empty')
                    form.find('#api').addClass('border border-2 border-danger')
                } else {
                    form.find('#api').removeClass('border border-2 border-danger')
                }
                if (sheltering === '') {
                    console.log('sheltering empty')
                    form.find('.sheltering-input').find('.note-toolbar').addClass(
                        'border border-2 border-danger')
                    form.find('.sheltering-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    form.find('.sheltering-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    form.find('.sheltering-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                if (dangers === '') {
                    console.log('dangers empty')
                    form.find('.dangers-input').find('.note-toolbar').addClass(
                        'border border-2 border-danger')
                    form.find('.dangers-input').find('.note-editable ').addClass(
                        'border border-2 border-danger')
                } else {
                    form.find('.dangers-input').find('.note-toolbar').removeClass(
                        'border border-2 border-danger')
                    form.find('.dangers-input').find('.note-editable ').removeClass(
                        'border border-2 border-danger')
                }
                // if (!main_photo) {
                //     console.log('main-photo empty')
                //     form.find('#main-photo').addClass('border border-2 border-danger')
                // }else{
                //     form.find('#main-photo').removeClass('border border-2 border-danger')
                // }



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
                        <h1>Mountains Infomation Managerment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Mountains Manager</li>
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
                                <th style="width: 40%">
                                    Name
                                </th>

                                <th style="width: 20%">
                                    Country
                                </th>
                                <th style="width: 8%" class="text-center">
                                    Status
                                </th>
                                <th>
                                    Option
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mountainsList as $mountain)
                                <tr>
                                    <td>
                                        {{ $mountain->id }}
                                    </td>
                                    <td>

                                        <a>
                                            <span class="fw-bold">{{ $mountain->name }}</span>

                                        </a>
                                        <br />

                                    </td>
                                    <td>
                                        @foreach ($countryList as $country)
                                            @if ($country->mountain_id == $mountain->id)
                                                <a>
                                                    {{ $country->name }}
                                                </a>
                                                <br>
                                            @endif
                                        @endforeach
                                        @if (empty($countryList))
                                            <a>
                                                no where
                                            </a>
                                            <br>
                                        @endif
                                        {{-- {{$mountain->country_name}} --}}
                                    </td>

                                    <td class="project-state">

                                        @if ($mountain->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-left">
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('/admin/mountains/detail?id=' . $mountain->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <button type="button" class="btn btn-info btn-sm editButton" data-toggle="modal"
                                            data-target="#update{{ $mountain->id }}">
                                            <input type="hidden" value="{{ $mountain->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </button>
                                        <!-- Update modal -->
                                        {{-- <div class="modal fade" id="update{{ $mountain->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update form for mountain id:
                                                            "{{ $mountain->id }}"</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="updateForm"
                                                        action="{{ url('/admin/mountains/proccessUpdate') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $mountain->id }}">
                                                        <input type="hidden" id="currentName" name="currentName"
                                                            value="{{ $mountain->name }}">
                                                        <input type="hidden" name="mainPhotoName"
                                                            value="{{ $mountain->photo_main }}">

                                                        <div class="modal-body">

                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="name">Mountain's name</label>
                                                                    <input name='mountain_name' type="text"
                                                                        class="form-control" id="name"
                                                                        placeholder="Enter name"
                                                                        value="{{ $mountain->name }}">
                                                                </div>
                                                                <div class="form-group description-input">
                                                                    <label for="description">Mountain's description</label>
                                                                    <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">
                                                                        {!! html_entity_decode($mountain->description) !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group history-input">
                                                                    <label for="history">Mountain's history</label>
                                                                    <textarea name="history" class="summernote" placeholder="Wrire desctiption here" id="history">
                                                                        {!! html_entity_decode($mountain->history) !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group guides-input">
                                                                    <label for="guides">Guides</label>
                                                                    <textarea name="guides" class="summernote" placeholder="Wrire desctiption here" id="guides">
                                                                        {!! html_entity_decode($mountain->guides) !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group location-input">
                                                                    <label for="location">Mountain's location</label>
                                                                    <textarea name="location" class="summernote" placeholder="Wrire desctiption here" id="location">
                                                                        {!! html_entity_decode($mountain->location) !!}

                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="api">Map api</label>
                                                                    <input name="api" type="text"
                                                                        class="form-control" id="api"
                                                                        placeholder="Enter api string"
                                                                        value="{{ $mountain->api }}">
                                                                </div>
                                                                <div class="form-group sheltering-input">
                                                                    <label for="sheltering">Mountain's sheltering</label>
                                                                    <textarea name="sheltering" class="summernote" placeholder="Wrire desctiption here" id="sheltering">
                                                                        {!! html_entity_decode($mountain->sheltering) !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group dangers-input">
                                                                    <label for="dangers">Mountain's dangers</label>
                                                                    <textarea name="dangers" class="summernote" placeholder="Wrire desctiption here" id="dangers">
                                                                        {!! html_entity_decode($mountain->dangers) !!}

                                                                    </textarea>
                                                                </div>

                                                                <div class="form-group mb-5">

                                                                    <label>Countries</label>
                                                                    <select class="duallistbox" multiple="multiple"
                                                                        name="countries[]" id="countries">
                                                                        @foreach ($countriesList as $country)
                                                                            <option
                                                                                @foreach ($countryList as $option)
                                                                            @if ($option->id == $country->id && $option->mountain_id == $mountain->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $country->id }}">
                                                                                {{ $country->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="main-photo">Main photo</label>
                                                                    <br>
                                                                    <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                        src="{{ asset('/img/mountains/' . $mountain->id . '/' . $mountain->photo_main) }}"
                                                                        alt="">
                                                                    <div class="input-group">
                                                                        <input class="form-control  p-0 h-100"
                                                                            type="file" id="main-photo"
                                                                            name="main-photo" accept="image/*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="related-photo">Related photo</label>
                                                                    <br>


                                                                    <!--venobox lightbox -->
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
                                                                                            <a id="firstlink"
                                                                                                class="venobox"
                                                                                                data-gall="mygallery"
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


                                                                    <div class="input-group">
                                                                        <input class="form-control p-0 h-100"
                                                                            type="file" id="related-photo"
                                                                            name="related-photo[]" accept="image/*"
                                                                            multiple>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="video ">Video</label>
                                                                    <br>
                                                                    <!--venobox lightbox -->
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title">Current related videos
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">

                                                                            @foreach ($videoList as $video)
                                                                                @if ($video->mountain_id == $mountain->id)
                                                                                    <div>
                                                                                        <a class="venobox"
                                                                                            data-autoplay="true"
                                                                                            data-vbtype="video"
                                                                                            data-ratio="1x1"
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

                                                                    <div class="input-group">

                                                                        <input name="video[]"
                                                                            class="form-control p-0 h-100" type="file"
                                                                            id="video" multiple accept="video/*">
                                                                    </div>
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
                                        </div> --}}



                                        <div class="modal fade" id="update{{ $mountain->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update form for mountain id:
                                                            "{{ $mountain->id }}"</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="updateForm"
                                                        action="{{ url('/admin/mountains/proccessUpdate') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $mountain->id }}">
                                                        <input type="hidden" id="currentName" name="currentName"
                                                            value="{{ $mountain->name }}">
                                                        <input type="hidden" name="mainPhotoName"
                                                            value="{{ $mountain->photo_main }}">

                                                        <div class="modal-body">

                                                            <div class="card-body fill-update-input-box">
                                                                {{-- <div class="form-group">
                                                                    <label for="name">Mountain's name</label>
                                                                    <input name='mountain_name' type="text"
                                                                        class="form-control" id="name"
                                                                        placeholder="Enter name" value="">
                                                                </div> --}}
                                                                {{-- <div class="form-group description-input">
                                                                    <label for="description">Mountain's description</label>
                                                                    <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">
                                                                        
                                                                    </textarea>
                                                                </div> --}}
                                                                {{-- <div class="form-group history-input">
                                                                    <label for="history">Mountain's history</label>
                                                                    <textarea name="history" class="summernote" placeholder="Wrire desctiption here" id="history">
                                                                       
                                                                    </textarea>
                                                                </div> --}}
                                                                {{-- <div class="form-group guides-input">
                                                                    <label for="guides">Guides</label>
                                                                    <textarea name="guides" class="summernote" placeholder="Wrire desctiption here" id="guides">
                                                                        
                                                                    </textarea>
                                                                </div> --}}
                                                                {{-- <div class="form-group location-input">
                                                                    <label for="location">Mountain's location</label>
                                                                    <textarea name="location" class="summernote" placeholder="Wrire desctiption here" id="location">
                                                                      

                                                                    </textarea>
                                                                </div> --}}
                                                                {{-- <div class="form-group">
                                                                    <label for="api">Map api</label>
                                                                    <input name="api" type="text"
                                                                        class="form-control" id="api"
                                                                        placeholder="Enter api string" value="">
                                                                </div> --}}
                                                                {{-- <div class="form-group sheltering-input">
                                                                    <label for="sheltering">Mountain's sheltering</label>
                                                                    <textarea name="sheltering" class="summernote" placeholder="Wrire desctiption here" id="sheltering">
                                                                        
                                                                    </textarea>
                                                                </div> --}}
                                                                {{-- <div class="form-group dangers-input">
                                                                    <label for="dangers">Mountain's dangers</label>
                                                                    <textarea name="dangers" class="summernote" placeholder="Wrire desctiption here" id="dangers">
                                                                        

                                                                    </textarea>
                                                                </div> --}}

                                                                <div class="form-group mb-5">

                                                                    <label>Countries</label>
                                                                    <select class="duallistbox" multiple="multiple"
                                                                        name="countries[]" id="countries">
                                                                        @foreach ($countriesList as $country)
                                                                            <option
                                                                                @foreach ($countryList as $option)
                                                                            @if ($option->id == $country->id && $option->mountain_id == $mountain->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $country->id }}">
                                                                                {{ $country->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="main-photo">Main photo</label>
                                                                    <br>
                                                                    <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                        src="{{ asset('/img/mountains/' . $mountain->id . '/' . $mountain->photo_main) }}"
                                                                        alt="">
                                                                    <div class="input-group">
                                                                        <input class="form-control  p-0 h-100"
                                                                            type="file" id="main-photo"
                                                                            name="main-photo" accept="image/*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="related-photo">Related photo</label>
                                                                    <br>


                                                                    <!--venobox lightbox -->
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
                                                                                            <a id="firstlink"
                                                                                                class="venobox"
                                                                                                data-gall="mygallery"
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


                                                                    <div class="input-group">
                                                                        <input class="form-control p-0 h-100"
                                                                            type="file" id="related-photo"
                                                                            name="related-photo[]" accept="image/*"
                                                                            multiple>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="video ">Video</label>
                                                                    <br>
                                                                    <!--venobox lightbox -->
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title">Current related videos
                                                                            </h4>
                                                                        </div>
                                                                        <div class="card-body">

                                                                            @foreach ($videoList as $video)
                                                                                @if ($video->mountain_id == $mountain->id)
                                                                                    <div>
                                                                                        <a class="venobox"
                                                                                            data-autoplay="true"
                                                                                            data-vbtype="video"
                                                                                            data-ratio="1x1"
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

                                                                    <div class="input-group">

                                                                        <input name="video[]"
                                                                            class="form-control p-0 h-100" type="file"
                                                                            id="video" multiple accept="video/*">
                                                                    </div>
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

                                        @if ($mountain->deactivated == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deactivate{{ $mountain->id }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                deactivate
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#activate{{ $mountain->id }}">
                                                <i class="fa-solid fa-circle-right"></i>
                                                activate
                                            </button>
                                        @endif
                                        <!-- Remove modal -->
                                        <form action="{{ url('/admin/mountains/activate') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $mountain->id }}">

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



    <script src="{{ asset('/') }}AdminLte/plugins/VenoBox-master/dist/venobox.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('/') }}AdminLte/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('/') }}AdminLte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="{{ asset('/') }}AdminLte/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}AdminLte/plugins/inputmask/jquery.inputmask.min.js"></script>


    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/') }}AdminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>

    <!-- BS-Stepper -->
    <script src="{{ asset('/') }}AdminLte/plugins/bs-stepper/js/bs-stepper.min.js"></script>


    <script src="{{ asset('/') }}AdminLte/plugins/summernote/summernote-bs4.min.js"></script>

    <script src="{{ asset('/') }}AdminLte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Page specific script -->
    <script>
        $(function() {
            new VenoBox({
                selector: '.venobox',
                numeration: true,
                infinigall: true,
                share: true,
                spinner: 'rotating-plane'
            });
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true,
                    showImageNumberLabel: false, // Tắt hiển thị số ảnh
                    gallery: {
                        enabled: false // Tắt chế độ gallery
                    },
                    onHidden: function() {
                        // Đặt lại sự kiện kéo modal sau khi lightbox đã đóng
                        $('.updateForm').draggable();
                    }
                });
            });



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


            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

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
