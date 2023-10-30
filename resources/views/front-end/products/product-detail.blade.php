@extends('layouts.app')
@section('styles') @endsection
@section('content')
    <!-- product detail section start -->
    <section class="py-0">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/500x500/dee2e6/6c757d.jpg" alt="..."></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{$product->title}}</h1>
                    <div class="fs-5 mb-5">
                    </div>
                    <p class="lead">{{$product->description}}</p>
                </div>
            </div>
        </div>
    </section>
    <!-- product detail section end -->

    <!-- product comment section start -->
    <section class="pb-5 pt-2 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Product Feedback</h2>
            <div class="row">
                @if(count($product->comments) > 0)
                    @foreach($product->comments as $comment)
                        <div class="col-12 col-md-6">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between  flex-md-row flex-column mb-2">
                                        <h2 class="card-title">{{$comment->user->name}}</h2>
                                        <p class="card-text">{{\Carbon\Carbon::parse($comment->created_at)->format('F d,Y')}}</p>
                                    </div>
                                    <p class="card-text desc-text">{!! $comment->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 offset-md-3 col-md-6">
                        <div class="card mb-3">
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <h2 class="card-title ">No feedback is given against this Item</h2>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- product comment section end -->

    <!-- product comment form section start -->
    @if($product->is_comment_allowed)
    <section class="pb-5 pt-2 bg-light">
        <div class="container px-4 px-lg-5 mt-2">
            <div class="row">
                <div class="formbold-main-wrapper">

                    <div class="formbold-form-wrapper">
                        <form class="needs-validation" method="POST" action="{{route('product.feedback')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="formbold-form-step-1 active">
                                <div class="form-group">
                                    <label for="description" class="formbold-form-label"> Write your comment </label>
                                    <textarea name="comment" id="description" placeholder="Type here..." class="formbold-form-input @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                                    @error('category')
                                        <div class="invalid-feedback mt-2">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="formbold-form-btn-wrapper">
                                <button class="formbold-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- product comment form section end -->

@endsection
