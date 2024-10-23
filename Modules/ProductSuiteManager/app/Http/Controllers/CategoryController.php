<?php

namespace Modules\ProductSuiteManager\Http\Controllers;

use App\Http\Controllers\Controller;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\ProductSuiteManager\Http\Requests\CategoriesRequest\NewCategoryRequest;
use Modules\ProductSuiteManager\Http\Requests\CategoriesRequest\UpdateCategoryRequest;
use Modules\ProductSuiteManager\Models\Category;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryBlogResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryProductResource;
use Modules\ProductSuiteManager\Transformers\CategoryResources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            [
                'data' => [
                    'categories' => CategoryResource::collection(Category::all())
                ]
            ]
        )->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewCategoryRequest $request)
    {
      $slug = str_replace(['!',' ','(',')','{','}','[',']'],'-',$request->get('title'));

      $category =  Category::query()->create([
            'parent_id' => $request->get('parent_id'),
            'title' => $request->get('title'),
            'slug' => $slug,
            'type' => $request->get('type')
        ]);

      return response()->json([
          'data' => [
              'message' => 'دسته بندی با موفقیت ایجاد شد',
              'category' => new CategoryResource($category)
          ]
      ])->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Category $category)
    {

        if ($category->type == 'product')
        {
            return response()->json(
                [
                    'data' => [
                        'category' => new CategoryProductResource($category)
                    ]
                ]
            )->setStatusCode(200);
        }
        if ($category->type == 'blog')
        {
            return response()->json(
                [
                    'data' => [
                        'category' => new CategoryBlogResource($category)
                    ]
                ]
            )->setStatusCode(200);
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $titleExists = Category::query()->where('title',$request->get('title'))
            ->where('id' ,'!=',$category->id)
            ->exists();

        if ($titleExists)
        {
            return response([
                'data'=>[
                    'message' => 'این عنوان از قبل وجود دارد لطفا عنوان دیگری انتخاب کنید'
                ]
            ]);
        }

        $slug = str_replace(['!',' ','(',')','{','}','[',']'],'-',$request->get('title' ,$category->title));

         $category->update([
            'parent_id' =>$request->get('parent_id',$category->parent_id),
            'title' => $request->get('title', $category->title),
            'slug' => $slug,
            'type' => $request->get('type',$category->type)
        ]);

        return response()->json(
            [
                'data' => [
                    'message' => $category->title.' '. 'با موفقیت اپدیت شد',
                    'category' => new CategoryResource($category)
                ]
            ]
        )->setStatusCode(200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        if ($category->products()->count() > 0 && $category->blogs()->count() > 0)
        {
            return response()->json(
                [
                    'data' => [
                        'message'  => 'دسته بندی مورد نظر دارای محصول یا بلاگ است'
                    ]
                ]
            );
        }
        else
        {
            $category->delete();

            return response()->json([
                'data' => [
                    'message' => 'دسته بندی'. $category->title.' '.'با موفقیت پاک شد'
                ]
            ])->setStatusCode(200);
        }


    }

    public function CategoryTypes($type)
    {
        $categories = Category::query()->where('type' , $type)->get();

        if (!empty($categories))
        {
            return response()->json(
                [
                    'data' => [
                        $type.' '.'Category' => CategoryResource::collection($categories)
                    ]
                ]
            )->setStatusCode(200);
        }
        else
        {
            return response()->json(
                [
                    'data' => [
                        'message' => 'تایپ ارسال شده درست نیست'
                    ]
                ]
            )->setStatusCode(200);
        }

     }
}
