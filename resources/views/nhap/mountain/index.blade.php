@extends('nhap.layout.user')

@section('content')
<style>
    .text-ellipsis {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    /* Custom pagination style phải có cái này k cái nút laravel cấp sẽ to tổ bố*/
    svg {
        width: 50px;
        /* Điều chỉnh chiều rộng của SVG */
        height: 50px;
        /* Điều chỉnh chiều cao của SVG */
    }
</style>
<div class="container-fluid blog py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Mountains</small>
            <h1 class="display-5 mb-5">Find a place to start your journey!</h1>
        </div>
        <div class="row">
            <div class="col-2">ffwefwefwefwe <button>search</button></div>
            <div class="col-10">
                <div class="row gx-4 justify-content-center">
                    <!--$data = ['mountains'=>Mountain::where('deactivated',0)->paginate(9)]; hiện ra tối đa 9 núi/trang-->
                    @foreach($mountains as $mountain)
                    <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.2s">
                        <div class="blog-item">
                            <div class="overflow-hidden rounded">
                                <img src="{{asset('user/img/mountains/'.$mountain->id.'/'.$mountain->photo_main)}}" class="img-fluid w-100" width="170" height="70">
                            </div>
                            <div class="blog-content mx-4 d-flex rounded bg-light">
                                <div class="text-dark bg-primary rounded-start">
                                    <div class="h-100 p-3 d-flex flex-column justify-content-center text-center">
                                        <p class="fw-bold mb-0">{{$mountain->id}}</p>
                                    </div>
                                </div>
                                <a href="{{url('/mountain/'.$mountain->id.'/index')}}" class="h5 lh-base my-auto h-100 p-3 text-ellipsis">{{$mountain->name}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <br><br>
        <div class="text-center">
            {{ $mountains->links()}} <!-- nút sang trang laravel cấp -->
        </div>
    </div>
</div>

@endsection