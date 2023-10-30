<div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Item Name</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Type product name..." value="{{old('title')}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="category" class="formbold-form-label"> Category </label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select category</option>
                                    <option value="Bug Report" @selected(old('category') == 'Bug Report')>Bug Report</option>
                                    <option value="Feature Request" @selected(old('category') == 'Feature Request')>Feature Request</option>
                                    <option value="Improvement" @selected(old('category') == 'Improvement')>Improvement</option>
                                    <option value="Other" @selected(old('category') == 'Other')>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descriptiona">Item Description</label>
                                <textarea type="text" name="description" id="descriptiona" class="form-control" row="3" placeholder="Type product description...">{{old('description')}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


@if(count($products) > 0)
    @foreach($products as $product)
        <div class="modal fade" id="editProduct-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Item Name</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Type product name..." value="{{$product->title}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="category" class="formbold-form-label"> Category </label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select category</option>
                                            <option value="Bug Report" @selected($product->category== 'Bug Report')>Bug Report</option>
                                            <option value="Feature Request" @selected($product->category == 'Feature Request')>Feature Request</option>
                                            <option value="Improvement" @selected($product->category == 'Improvement')>Improvement</option>
                                            <option value="Other" @selected($product->category == 'Other')>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">Item Description</label>
                                        <textarea type="text" name="description" id="description" class="form-control" row="3" placeholder="Type product description...">{{$product->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endif
