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
        <div class="col-sm-6">
            <h1 class="m-0">Product Comments</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('product.index')}}">Products</a></li>
                <li class="breadcrumb-item active">Product Comments</li>
            </ol>
        </div>
    </div><!-- /.row -->
@endsection
@section('content')
    <div class="card p-0">
        <div class="card-header">
            <h3 class="card-title">Product Comments</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Comment Title</th>
                    <th scope="col">Comment Description</th>
                    <th scope="col">Comments Category</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $key => $comment)
                    <tr>
                        <th scope="row">{{ $key+ 1 }}</th>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->title}}</td>
                        <td>{!!$comment->description!!}</td>
                        <td>{{$comment->category}}</td>
                        <td>{{\Carbon\Carbon::parse($comment->created_at)->format('d/m/Y')}}</td>
                        <td>
                            <a href="{{route('delete.comment',$comment->id)}}" class="btn btn-danger confirm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $comments->links('vendor.pagination.custom') }}
        </div>
    </div>

@endsection
@section('scripts')
    @include('adminPanel.pages.product.scripts')
@endsection
