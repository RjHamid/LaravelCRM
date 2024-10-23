<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Blog\Http\Requests\storeRequest;
use Modules\Blog\Http\Requests\updateRequest;
use Modules\Blog\Models\Blog;
use Modules\Blog\Transformers\BlogResource;
use Modules\ProductSuiteManager\Models\Category;
use Modules\User\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json([
            'data' => [
                'blogs' => BlogResource::collection(Blog::paginate(9))
            ]
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     */

    public function show(Blog $blog)
    {
        return response()->json([
            'data' => [
                'blog' => new BlogResource($blog)
            ]
        ]);
    }

    public function store(storeRequest $request)  
    {

        $cateType = Category::query()->where('id' , $request->get('category_id'))
            ->firstOrFail();

        if ($cateType->type == 'product')
        {
            return  response()->json([
                'data' => [
                    'message' => 'دسته بندی انتخاب شده نمیتواند از نوع محصول باشد برای بلاگ'
                ]
            ]);
        }

        $picPath = $request->file('pic')->store('public/Blog/pic');  
        $pic = str_replace('public', '/storage', $picPath);  
    
      
        $blog = Blog::create([  
            'user_id' => $request->get('user_id'),
            'category_id' => $request->get('category_id'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),  
            'pic' => $pic,  
        ]);  
    
         
        return response()->json([  
            'data' => [  
                'message' => 'بلاگ با موفقیت ایجاد شد',  
                'blog' => new BlogResource($blog),  
            ]  
        ])->setStatusCode(201); 
    } 

    /**
     * Store a newly created resource in storage.
     */
 

    /**
     * Show the specified resource.
     */
    // public function show($id)
    // {
    //     return view('blog::show');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(updateRequest $request, Blog $blog)  
    {

        if ($request->filled('category_id'))
        {
            $cateType = Category::query()->where('id' , $request->get('category_id'))
                ->firstOrFail();

            if ($cateType->type == 'product')
            {
                return  response()->json([
                    'data' => [
                        'message' => 'دسته بندی انتخاب شده نمیتواند از نوع محصول باشد برای بلاگ'
                    ]
                ]);
            }
        }
      
    
        $titleExists = Blog::query()  
            ->where('title', $request->get('title'))  
            ->where('id', '!=', $blog->id)  
            ->exists();  
    
        if ($titleExists) {  
            return response()->json([  
                'data' => [  
                    'message' => 'این عنوان از قبل وجود دارد لطفا عنوان دیگری انتخاب کنید'  
                ]  
            ], 400);   
        }  
    
         
    
        $pic = $blog->pic;   
    
        if ($request->hasFile('pic')) {  
            if ($pic) {  
                $old_image = str_replace('/storage', 'public', $pic);  
                Storage::delete($old_image);  
            }  
            
            $picPath = $request->file('pic')->store('public/Blog/pic');  
            $pic = str_replace('public', '/storage', $picPath);  
        }  
        
        
        $blog->update([  
            'category_id' => $request->get('category_id', $blog->category_id),  
            'title' => $request->get('title', $blog->title),  
            'description' => $request->get('description', $blog->description),  
            'pic' => $pic,  
        ]);  
    
       
       
        
        return response()->json([  
            'data' => [  
                'message' => 'بلاگ با موفقیت به‌روزرسانی شد',  
                'blog' => new BlogResource($blog)  
            ]  
        ], 200);  
    }  
    

    /**
     * Update the specified resource in storage.
     */
 

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Blog $Blog)
    {
        if ($Blog) {
            $Blog->delete();
            return response()->json('Blog deleted successfully!');
        } else {
            return response()->json('Blog not found!');
        }
    }
}
