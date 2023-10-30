<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Admin\Product;
use App\Models\User;
use App\Models\User\Comments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(12);
        return view('front-end.products.index',compact('products'));
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
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse
     */
    public function productDetail($id)
    {
        $product = Product::where('id',$id)->with('comments')->first();
        if(!$product) {
            flash()->addError('Could not found record');
            return redirect()->back();
        }
//        $comments = Comments::where('product_id',$id)->with('user')->paginate(6);
        return view('front-end.products.product-detail',compact('product'));
    }

    /**
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function saveProductComment(CommentRequest $request)
    {
        $product = Product::where('id',$request->product_id)->first();
        if($product->is_comment_allowed == 0) {
            flash()->addError('Feedback is not allowed for this');
            return  redirect()->back();
        }
        $comment = new Comments();
        $comment->user_id = auth()->user()->id;
        $comment->product_id = $request->product_id;
        $comment->description = $request->comment;
        $comment->save();
        flash()->addSuccess('Comment saved successfully');
        return redirect()->back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function addProductVote($id)
    {
        $product = Product::where('id',$id)->first();
        if(!$product) {
            flash()->addError('Could not found record');
            return  redirect()->back();
        }
        $product->vote_count = $product->vote_count +1;
        $product->save();
        flash()->addSuccess('Vote counted successfully');
        return redirect()->back();
    }

    public function minusProductVote($id)
    {
        $product = Product::where('id',$id)->first();
        if(!$product) {
            flash()->addError('Could not found record');
            return  redirect()->back();
        }
        if($product->vote_count != 0) {
            $product->vote_count = $product->vote_count - 1;
            $product->save();
        }
        flash()->addSuccess('Vote counted successfully');
        return redirect()->back();
    }

    /**
     * @return JsonResponse
     */
    public function userList()
    {
        $users = User::get();
        return response()->json($users,200);
    }
}
