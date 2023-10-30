@extends('layouts.app')
@section('content')

    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Please choose Item</h1>
                <p class="lead fw-normal text-white-50 mb-0">to write your honest feedback</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-2">
        <div class="container-fluid px-4 px-lg-5 mt-5">
            <div class=" justify-content-center">
                @if(count($products) > 0)
                    <div class="card p-0">
                            <div class="card-header d-flex justify-content-between">
                                <div class="col-sm-8">
                                    <h3 class="card-title">Feedback Items</h3>
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-block btn-secondary" data-toggle="modal" data-target="#createProduct">
                                        Add Item
                                    </button>
                                </div>

                            </div>
                            <div class="card-body p-0">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Item Category</th>
                                        <th scope="col">Item Description</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Vote Count</th>
                                        <th scope="col">Item Detail</th>
                                        <th scope="col">Vote</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $key => $product)
                                        <tr>
                                            <th scope="row">{{ $key+ 1 }}</th>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->category}}</td>
                                            <td style="width: 40%;" data-toggle="tooltip" data-placement="top" title="{{$product->description}}">{{Str::limit($product->description,200)}}</td>
                                            <td>{{$product->user->name}}</td>
                                            <td>{{$product->vote_count}}</td>
                                            <td>
                                                <a href="{{route('product.detail',$product->id)}}" class="btn btn-primary">View Detail</a>
                                            </td>
                                            <td>
                                                <a href="{{route('minus.vote',$product->id)}}" class="btn btn-danger">-</a>
                                                <a href="{{route('add.vote',$product->id)}}" class="btn btn-success">+</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $products->links('vendor.pagination.custom') }}
                            </div>
                        </div>
                @endif
            </div>
            <div class="mt-2 d-flex justify-content-center">
                {{$products->links('vendor.pagination.custom')}}
            </div>
        </div>
    </section>

    @include('adminPanel.pages.product.modal')
@endsection
