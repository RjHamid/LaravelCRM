<?php

namespace Modules\Comments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Comments\Http\Requests\NewCommentRequest;
use Modules\Comments\Http\Requests\UpdateCommentRequest;
use Modules\Comments\Models\Comment;
use Modules\Comments\Transformers\CommentResource;
use Modules\ProductSuiteManager\Models\Product;

class CommentsController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function indexP($type)
    {

        $CommendWithType = Comment::query()->where('type' , $type)
            ->where('status' ,  'published')
            ->paginate(9);

        return response()->json([
            'data' => [
                'comments' => CommentResource::collection($CommendWithType)->response()
                ->getData()
            ]
        ])->setStatusCode(200);
    }
    /**
     * Display a listing of the resource.
     */
    public function indexN($type)
    {
        $CommendWithType = Comment::query()->where('type' , $type)
            ->where('status', 'not-published')
            ->paginate(9);

        return response()->json([
            'data' => [
                'comments' => CommentResource::collection($CommendWithType)
                ->response()->getData()
            ]
        ])->setStatusCode(200);
    }


    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(NewCommentRequest $request,$type,$id)
    {

        switch ($type)
        {
            case 'product' :
                $productExists = Product::query()->where('id' , $id)
                    ->exists();

                if ($productExists)
                {
                    /*این بخش برای user باید update بشه*/
                    $comment =  Comment::query()->create([
                        'user_id' => 1,
                        'type' => $type,
                        'data_id' => $id,
                        'description' => $request->get('description'),
                    ]);

                    return response()->json([
                        'data' => [
                            'message' => 'کامنت مورده نظر با موفقیت انجام شد'
                        ]
                    ])->setStatusCode(200);
                } else
                {
                    return  response()->json([
                        'data' => [
                            'message' => 'ایدی فرستاده شده درست نیست'
                        ]
                    ])->setStatusCode(200);
                }
                break;
            case 'blog' :
                return response([
                    'data'=> ''
                ]);
                break;
            default :
                return response()->json([
                    'data'=> [
                        'message'  => ' (product,blog) تایپ فرستاده شده مورده قبول نیست'
                    ]
                ]);
        }

    }

    /**
     * Show the specified resource.
     */
    public function show(Comment $comment)
    {
        return response()->json([
            'data' => [
                'comment' => new CommentResource($comment)
            ]
        ])->setStatusCode(200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {


        $comment->update([
            'description' => $request->get('description',$comment->description),
            'status' => $request->get('status',$comment->status)
        ]);

        return response()->json([
            'data' => [
                'message' => 'کامنت مورده نظر با موفقیت اپدیت شد'
            ]
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();


        return response()->json([
            'data' => [
                'message' => 'کامنت مورده نظر با موفقیت پاک شد'
            ]
        ])->setStatusCode(200);
    }
}
