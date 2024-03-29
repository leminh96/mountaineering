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
    <!-- iCheck for checkboxes and radio inputs -->
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
            $('.article_data').addClass('active')

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


            $('.category-update').change(function() {
                $(this).find('.moveall').prop("disabled", true);
                var category = $(this).find('option:selected');
                if (category.length > 1) {
                    category.each(function() {
                        var selectedValue = $(this).val();
                        if (selectedValue == 1) {
                            $(this).prop("selected", false);
                        }

                    });
                }

            });
            $('.editButton').click(function() {
                // Lấy giá trị của thuộc tính data-target
                var target = $(this).data('target');
                var articleId = $(this).find('input').val();
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json',
                    url: "{{ url('/admin/articles/getCurrentInfo') }}",
                    data: {
                        id: articleId
                    },
                    success: function(data) {
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group">
                      <label for="description">Post's Content</label>
                      <textarea name="description" class="summernote" placeholder="Write description here" id="description">
                        ${data.article['description']}
                      </textarea>
                  </div>`);
                        // Thêm danh sách vào đầu của #container
                        $(target).find('.fill-update-input-box').prepend(`<div class="form-group">
                      <label for="name">Post's name</label>
                      <input name='name' type="text" class="form-control" id="name" placeholder="Enter article name" value="${data.article['name']}">
                  </div>`);
                        setTimeout(function() {
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
                                    ['align', ['ul', 'ol', 'paragraph',
                                        'lineheight'
                                    ]],
                                    ['table', ['table']],
                                    ['link', ['link']],
                                    ['picture', ['picture']],
                                    ['video', ['video']],
                                    ['hr', ['hr']],
                                    ['codeview', ['codeview']],
                                    ['fullscreen', ['fullscreen']],
                                    ['help', ['help']]
                                ],
                                height: 900,


                            });
                        }, .5);

                    }
                });

            });
            $('.updateForm').submit(function(event) {
                var form = $(this);
                var name = form.find('#name').val().trim();
                var description = form.find('#description').val().trim();
                var category = form.find('#category').find('option:selected');
                //var main_photo = form.find('#main-photo')[0].files[0];

                if (name === '' || description === '' || category.length == 0) {
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
                if (description === '') {
                    console.log('description empty')
                    form.find('.note-toolbar').addClass('border border-2 border-danger')
                    form.find('.note-editable ').addClass('border border-2 border-danger')
                } else {
                    form.find('.note-toolbar').removeClass('border border-2 border-danger')
                    form.find('.note-editable ').removeClass('border border-2 border-danger')

                }
                if (category.length == 0) {
                    console.log('category empty')
                    form.find('#category').addClass('border border-2 border-danger')
                } else {
                    form.find('#category').removeClass('border border-2 border-danger')
                }


            });
        })
    </script>
    <style>
        .dark-mode .card .card {
            background-color: #ffffff;
            color: #000000;
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
                        <h1>Articles Managerment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Articles Manager</li>
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

                                <th style="width: 30%">
                                    Name
                                </th>
                                <th style="width: 10%">
                                    Created
                                </th>
                                <th style="width: 15%">
                                    Mountains
                                </th>
                                <th style="width: 10%">
                                    Categories
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
                            @foreach ($articlesList as $article)
                                <tr>
                                    <td>
                                        {{ $article->id }}
                                    </td>
                                    <td>

                                        <a>
                                            {{ $article->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a>
                                            {{ $article->created }}
                                        </a>
                                    </td>
                                    <td>
                                        @foreach ($mountainList as $mountain)
                                            @if ($mountain->article_id == $article->id)
                                                <a>
                                                    {{ $mountain->name }}
                                                </a>
                                                <br>
                                            @endif
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach ($categoryList as $category)
                                            @if ($category->article_id == $article->id)
                                                <a>
                                                    {{ $category->name }}
                                                </a>
                                                <br>
                                            @endif
                                        @endforeach

                                    </td>

                                    <td class="project-state">
                                        @if ($article->deactivated == 0)
                                            <span class="badge badge-success">Activated</span>
                                        @else
                                            <span class="badge badge-danger">Deactivated</span>
                                        @endif
                                    </td>
                                    <td class="project-actions text-left">
                                        <a class="btn btn-primary btn-sm "
                                            href="{{ url('/admin/articles/detail?id=' . $article->id) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>
                                        <button type="button" class="btn btn-info btn-sm editButton" data-toggle="modal"
                                            data-target="#update{{ $article->id }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            <input type="hidden" value="{{ $article->id }}">
                                            Edit
                                        </button>
                                        <!-- Update modal -->
                                        {{-- <div class="modal fade" id="update{{ $article->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update form for article id:
                                                            {{ $article->id }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="updateForm"
                                                        action="{{ url('/admin/articles/proccessUpdate') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $article->id }}">

                                                        <div class="modal-body">


                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="name">Post's name</label>
                                                                    <input name='name' type="text"
                                                                        class="form-control" id="name"
                                                                        placeholder="Enter article name"
                                                                        value="{{ $article->name }}">

                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="description">Post's Content</label>
                                                                    <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">
                                                                        {!! html_entity_decode($article->description) !!}
                                                                    </textarea>
                                                                </div>
                                                                <div class="form-group mb-5">
                                                                    <label for="main-photo">Main photo</label>
                                                                    <br>
                                                                    @if ($article->photo == null || $article->photo == '' || !File::exists(public_path('img/articles/' . $article->id . '/' . $article->photo)))
                                                                        <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                            src="{{ asset('/img/articles/unknown.png') }}"
                                                                            alt="">
                                                                    @else
                                                                        <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                            src="{{ asset('/img/articles/' . $article->id . '/' . $article->photo) }}"
                                                                            alt="">
                                                                    @endif

                                                                    <div class="input-group">
                                                                        <input class="form-control  p-0 h-100"
                                                                            type="file" id="main-photo"
                                                                            name="main-photo" accept="image/*">
                                                                    </div>
                                                                </div>


                                                                <div class="form-group mb-5">

                                                                    <label>Category</label>
                                                                    <select id="category" class="duallistbox category-update "
                                                                        multiple="multiple" name="categories[]">
                                                                        @foreach ($categoriesList as $category)
                                                                            <option
                                                                                @foreach ($categoryList as $option)
                                                                            @if ($option->id == $category->id && $option->article_id == $article->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $category->id }}">
                                                                                {{ $category->name }}
                                                                            </option>
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
                                                                            @if ($option->id == $mountain->id && $option->article_id == $article->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $mountain->id }}">
                                                                                {{ $mountain->name }}</option>
                                                                        @endforeach
                                                                    </select>

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

                                        <div class="modal fade" id="update{{ $article->id }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update form for article id:
                                                            {{ $article->id }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form class="updateForm"
                                                        action="{{ url('/admin/articles/proccessUpdate') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $article->id }}">

                                                        <div class="modal-body">


                                                            <div class="card-body fill-update-input-box">
                                                                {{-- <div class="form-group">
                                                                    <label for="name">Post's name</label>
                                                                    <input name='name' type="text"
                                                                        class="form-control" id="name"
                                                                        placeholder="Enter article name"
                                                                        value="{{ $article->name }}">

                                                                </div> --}}
                                                                {{-- <div class="form-group">
                                                                    <label for="description">Post's Content</label>
                                                                    <textarea name="description" class="summernote " placeholder="Wrire desctiption here" id="description">
                                                                        {!! html_entity_decode($article->description) !!}
                                                                    </textarea>
                                                                </div> --}}
                                                                <div class="form-group mb-5">
                                                                    <label for="main-photo">Main photo</label>
                                                                    <br>
                                                                    @if (
                                                                        $article->photo == null ||
                                                                            $article->photo == '' ||
                                                                            !File::exists(public_path('img/articles/' . $article->id . '/' . $article->photo)))
                                                                        <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                            src="{{ asset('/img/articles/unknown.png') }}"
                                                                            alt="">
                                                                    @else
                                                                        <img class="rounded mx-auto d-block mb-2 img-fluid w-50"
                                                                            src="{{ asset('/img/articles/' . $article->id . '/' . $article->photo) }}"
                                                                            alt="">
                                                                    @endif

                                                                    <div class="input-group">
                                                                        <input class="form-control  p-0 h-100"
                                                                            type="file" id="main-photo"
                                                                            name="main-photo" accept="image/*">
                                                                    </div>
                                                                </div>


                                                                <div class="form-group mb-5">

                                                                    <label>Category</label>
                                                                    <select id="category"
                                                                        class="duallistbox category-update "
                                                                        multiple="multiple" name="categories[]">
                                                                        @foreach ($categoriesList as $category)
                                                                            <option
                                                                                @foreach ($categoryList as $option)
                                                                            @if ($option->id == $category->id && $option->article_id == $article->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $category->id }}">
                                                                                {{ $category->name }}
                                                                            </option>
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
                                                                            @if ($option->id == $mountain->id && $option->article_id == $article->id) 
                                                                            
                                                                            selected 
                                                                            
                                                                            @endif @endforeach
                                                                                value="{{ $mountain->id }}">
                                                                                {{ $mountain->name }}</option>
                                                                        @endforeach
                                                                    </select>

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

                                        @if ($article->deactivated == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deactivate{{ $article->id }}">
                                                <i class="fas fa-trash">
                                                </i>
                                                deactivate
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#activate{{ $article->id }}">
                                                <i class="fa-solid fa-circle-right"></i>
                                                activate
                                            </button>
                                        @endif
                                        <!-- Remove modal -->
                                        <form action="{{ url('/admin/articles/activate') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $article->id }}">

                                            <div class="modal fade" id="deactivate{{ $article->id }}">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Are you sure to deactivate article
                                                                "{{ $article->id }}"</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <p>This action will not remove the article from server</p>
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

                                            <div class="modal fade" id="activate{{ $article->id }}">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Are you sure to activate article
                                                                "{{ $article->id }}"</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <p>This action will reactivate the article from server</p>
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
                height: 900,


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
