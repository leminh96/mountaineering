@extends('nhap.layout.user')

@section('content')




<div class="container-fluid blog py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Organizations</small>
            <h1 class="display-5 mb-5">Seek companionship as you conquer new heights together</h1>
        </div>
    </div>
    <div class="container">
        <div class="col-md-12">
            <div class="card-deck">
                @foreach($groups as $group)
                <div class="card mb-4 wow bounceInUp" data-wow-delay="0.3s">
                    <div class="row blog-item">
                        <div class="col-3 overflow-hidden" style="align-items: center; display: flex;">
                            <img src="{{asset('user/img/group/'.$group->id.'/'.$group->photo)}}" class="img-fluid w-100" width="100" height="50">
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <h5 class="card-title truncate-text1"><a href="#">{{ $group->name }}</a></h5>
                                        <p class="card-text truncate-text5">{{ $group->description }}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card-body">
                                        <h5 class="card-title truncate-text1"><a href="#">Contact</a></h5>
                                        <p class="card-text truncate-text5">{{ $group->contact}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-body">
                                        <h5 class="card-title truncate-text1"><a href="#">Leader</a></h5>
                                        <p class="card-text truncate-text5">{{ $group->leader_name }}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card-body">
                                    <a href="{{$group->link}}" target="_blank" class="btn btn-primary py-3 px-5 rounded-pill">Read More<i class="fas fa-arrow-right ps-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div style="height: 300px; overflow: hidden;">
                                {!!html_entity_decode($group->api)!!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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