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
    public function index($id = null)
 {
        if ($id) {
            $Blog = Blog::where('id', $id)->first();
        } else {
            $Blog = Blog::paginate(10);
        }
        return response()->json($Blog);
    
}

    /**
     * Show the form for creating a new resource.
     */
    public function store(storeRequest $request)  
    {  
     
        $category = Category::findOrFail($request->get('category_id'));  
    
        
        $picPath = $request->file('pic')->store('public/products/pic');  
        $pic = str_replace('public', '/storage', $picPath);  
    
        $user_id = User::findOrFail($request->get('user_id'));
        $blog = Blog::create([  
            'user_id' => $user_id->id,
            'category_id' => $category->id,  
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
    public function update(updateRequest $request, $id)  
    {   
        
        $blog = Blog::find($id);  
        
        if (!$blog) {  
            return response()->json([  
                'data' => [  
                    'message' => 'بلاگ یافت نشد'  
                ]  
            ], 404);   
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
    
        if ($request->filled('category_id')) {  
            $category = Category::find($request->get('category_id'));  
            if (!$category) {  
                return response()->json(['message' => 'دسته‌بندی یافت نشد'], 404);  
            }  
        }  
    
        $pic = $blog->pic;   
    
        if ($request->hasFile('pic')) {  
            if ($pic) {  
                $old_image = str_replace('/storage', 'public', $pic);  
                Storage::delete($old_image);  
            }  
            
            $picPath = $request->file('pic')->store('public/products/pic');  
            $pic = str_replace('public', '/storage', $picPath);  
        }  
        
        
        $blog->update([  
            'category_id' => $request->get('category_id', $blog->category_id),  
            'title' => $request->get('title', $blog->title),  
            'description' => $request->get('description', $blog->description),  
            'pic' => $pic,  
        ]);  
    
       
        $blog->refresh();  
        
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
    public function delete(Request $request,$id)
    {
        $Blog = Blog::where('id', $request->id)->first();
        if ($Blog) {
            $Blog->delete();
            return response()->json('Blog deleted successfully!');
        } else {
            return response()->json('Blog not found!');
        }
    }
}
