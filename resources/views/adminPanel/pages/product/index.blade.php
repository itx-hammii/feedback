@extends('adminPanel.layouts.master')
@section('title','Product - Admin Panel')
@section('style')
    <style>
        .clearfix ul{
            margin-bottom: 0 !important;
        }
    </style>
@endsection
@section('pageHeader')
    <div class="row mb-2">
        <div class="col-sm-9">
            <h1 class="m-0">Product Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-3">
            <button type="button" class="btn btn-block btn-secondary float-right" data-toggle="modal" data-target="#createProduct">
                Add Product
            </button>
        </div>
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="card p-0">
        <div class="card-header">
            <h3 class="card-title">Products</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Category</th>
                    <th scope="col">Item Description</th>
                    <th scope="col">Comment Enabel/Disable</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Vote Count</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($products as $key => $product)
                     <tr>
                         <th scope="row">{{ $key+ 1 }}</th>
                         <td>{{$product->title}}</td>
                         <td>{{$product->category}}</td>
                         <td style="width: 40%;" data-toggle="tooltip" data-placement="top" title="{{$product->description}}">{{Str::limit($product->description,200)}}</td>
                         <td>
                             <div class=" start-status">
                                 <div class="">
                                     <input type="checkbox" id="startStatusCheckbox{{$product->id}}"
                                            class="comment pt-5"
                                            data-id="{{$product->id}}" @if($product->is_comment_allowed == 1) checked @endif
                                            data-toggle="toggle" data-on="Enable" data-off="Disable" data-size="sm"
                                            data-onstyle="success" data-offstyle="danger">
                                 </div>
                             </div>
                         </td>
                         <td>{{$product->user->name}}</td>
                         <td>01</td>
                         <td>
                             <a class="btn btn-secondary cursor-pointer text-light"  data-toggle="modal" data-target="#editProduct-{{$product->id}}">
                                 <i class="fa fa-edit"></i>
                             </a>
                             <a href="{{route('product.destroy',$product->id)}}" class="btn btn-danger confirm">
                                 <i class="fa fa-trash"></i>
                             </a>
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

    @include('adminPanel.pages.product.modal')
@endsection
@section('scripts')
    @include('adminPanel.pages.product.scripts')
@endsection
