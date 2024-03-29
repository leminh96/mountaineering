@extends('nhap.layout.user')

@section('content')




<div class="container-fluid blog py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our Blog</small>
            <h1 class="display-5 mb-5">Featured News</h1>
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow bounceInUp" data-wow-delay="0.1s">
                @foreach($category as $cate)
                <li class="nav-item p-2">
                    <a class="d-flex mx-2 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#">
                        <span class="text-dark" style="width: 150px;">{{$cate->name}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="row wow bounceInUp" data-wow-delay="0.1s">
            <div class="col-md-12">
                <!-- Tin chính trong controller lấy 1 mới nhất theo id-->
                <div class="card mb-4">
                    <div class="row g-0 blog-item">
                        <div class="col-md-5 overflow-hidden">
                            <img src="{{asset('/img/article/'.$featuredNews->id.'/'.$featuredNews->photo)}}" class="img-fluid w-100" alt="">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title"><a href="#">{{ $featuredNews->name }}</a></h5>
                                <p class="card-text truncate-text">{{ $featuredNews->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row wow bounceInUp" data-wow-delay="0.3s">
            <!--Tin phụ lấy 3, controller skip 1 take (3)-->
            @foreach($otherNews as $news)
            <div class="col-4 card">
                <div class="blog-item">
                    <div class="overflow-hidden">
                        <img src="{{asset('user/img/article/'.$news->id.'/'.$news->photo)}}" class="img-fluid w-100" width="170" height="70">
                    </div>
                    <div class="card-body">
                        <h5><a href="#" class="card-title truncate-text1">{{$news->name}}</a></h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <div class="row" style="padding-top:30px">
            <div class="col-md-12">
                <div class="card-deck">
                    <!-- các tin còn lại, skip(4) take(100)-->
                    @foreach($otherNews1 as $news1)
                    <div class="card mb-4 wow bounceInUp" data-wow-delay="0.3s">
                        <div class="row blog-item">
                            <div class="col-3 overflow-hidden">
                                <img src="{{asset('user/img/article/'.$news1->id.'/'.$news->photo)}}" class="img-fluid w-100" width="100" height="50">
                            </div>
                            <div class="col-9">
                                <div class="card-body">
                                    <h5 class="card-title truncate-text1"><a href="#">{{ $news1->name }}</a></h5>
                                    <p class="card-text truncate-text5">{{ $news1->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .truncate-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 9;
        /* Số dòng tối đa muốn hiển thị cho tin tức chính*/
        -webkit-box-orient: vertical;
    }

    .truncate-text1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        /* Số dòng tối đa muốn hiển thị cho tin tức phụ*/
        -webkit-box-orient: vertical;
    }

    .truncate-text5 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        /* Số dòng tối đa muốn hiển thị cho tin tức còn lại*/
        -webkit-box-orient: vertical;
    }
</style>