<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Admin\Product;
use App\Models\User\Comments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('user')->paginate(12);
        return view('adminPanel.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->user_id = auth()->user()->id;
        $product->save();
        flash()->addSuccess('Item created successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::where('id',$id)->first();
        if(!$product) {
            flash()->addError('Could not found record..');
            return redirect()->back();
        }
        $product->title = $request->title;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->save();
        flash()->addSuccess('Item updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id',$id)->first();
        if(!$product) {
            flash()->addError('Could not found record');
            return redirect()->back();
        }
        $product->delete();
        flash()->addSuccess('Item delete successfully');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function enableDisableComment(Request $request,$id)
    {
        $product = Product::where('id',$id)->first();
        if (!$product) {
            $responseData['status'] = 400;
            $responseData['message'] = 'Could not found record..';
            return response()->json($responseData, 400);
        }
        $product->is_comment_allowed = $request->value;
        $product->save();
        $product->refresh();

        $responseData['status'] = 200;
        $responseData['message'] = 'Request has been processed';
        return response()->json($responseData);
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function viewProductComments($id)
    {
        $comments = Comments::where('product_id',$id)->with('user')->paginate('12');
        if(count($comments) == 0) {
            flash('No comments found for this product');
            return redirect()->back();
        }
        return view('adminPanel.pages.product.product-comments',compact('comments'));
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function deleteComment($id)
    {
        $comment = Comments::where('id',$id)->first();
        if (!$comment) {
            flash()->addError('Could not found record');
            return redirect()->back();
        }
        $comment->delete();
        flash()->addSuccess('Comment Deleted Successfully');
        return redirect()->back();
    }
}
