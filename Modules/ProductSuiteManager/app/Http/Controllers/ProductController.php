<?php

namespace Modules\ProductSuiteManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\ProductSuiteManager\Http\Requests\ProductsRequest\NewProductRequest;
use Modules\ProductSuiteManager\Http\Requests\ProductsRequest\UpdateProductRequest;
use Modules\ProductSuiteManager\Models\Category;
use Modules\ProductSuiteManager\Models\Product;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return response()->json([
            'products' => [
                 ProductResource::collection(Product::paginate(9))->response()
                ->getData()
            ]
        ])->setStatusCode(200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewProductRequest $request)
    {

        $cateType = Category::query()->where('id' , $request->get('category_id'))
            ->firstOrFail();

        if ($cateType->type == 'blog')
        {
            return  response()->json([
                'data' => [
                    'message' => 'دسته بندی انتخاب شده نمیتواند از نوع بلاگ باشد برای محصولات'
                ]
            ]);
        }

        $pic = $request->file('pic')->store('public/products/pic');

        $pic = str_replace('public','/storage',$pic);

        $slug = str_replace
        (['!',' ','(',')','{','}','[',']'],'-',$request->get('name'));

        $product = Product::query()->create([
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'slug' => $slug,
            'price' => $request->get('price'),
            'description' => $request->get('description'),
            'quantity' => $request->get('quantity'),
            'pic' => $pic
        ]);

        return response()->json([
            'data' => [
                'message' => 'محصول با موفقیت ایجاد شد',
                'product' => new ProductResource($product)
            ]
        ])->setStatusCode(200);
    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {

        return response()->json([
            'data' => [
                'product' => new ProductResource($product)
            ]
        ])->setStatusCode(200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        $nameExists = Product::query()->where('name',$request->get('name'))
            ->where('id' ,'!=',$product->id)
            ->exists();

        if ($nameExists)
        {
            return response([
                'data'=>[
                    'message' => 'این اسم از قبل وجود دارد لطفا اسم دیگری انتخاب کنید'
                ]
            ]);
        }

        if ($request->filled('category_id'))
        {
            $cateType = Category::query()->where('id' , $request->get('category_id'))
                ->firstOrFail();

            if ($cateType->type == 'blog')
            {
                return  response()->json([
                    'data' => [
                        'message' => 'دسته بندی انتخاب شده نمیتواند از نوع بلاگ باشد برای محصولات'
                    ]
                ]);
            }
        }

        $pic =  $product->pic;

        if ($request->hasFile('pic'))
        {

            $old_image = str_replace('/storage','public',$pic);

            Storage::delete($old_image);

            $pic = $request->file('pic')->store('public/products/pic');

            $pic = str_replace('public','/storage',$pic);

        }
        $slug = str_replace
        (['!',' ','(',')','{','}','[',']'],'-',$request->get('name',$product->name));

        $product->update([
            'category_id' => $request->get('category_id',$product->category_id),
            'name' => $request->get('name',$product->name),
            'slug' => $slug,
            'price' => $request->get('price',$product->price),
            'description' => $request->get('description',$product->description),
            'quantity' => $request->get('quantity',$product->quantity),
            'pic' => $pic
        ]);


        return response()->json([
            'data' =>
            [
                'message' => $product->name.' '.'با موفقیت اپدیت شد',
                'product' => new ProductResource($product)
            ]
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        if ($product->has_discount && $product->galleries()->count() > 0)
        {
            return response()->json([
                'data' => [
                    'message' => 'محصول مورده نظر را نمیتوان حذف کرد'
                ]
            ]);
        }

        $old_image = str_replace('/storage','public',$product->pic);

        Storage::delete($old_image);

        $product->delete();

        return response()->json([
            'data' => [
                'message' => $product->name.' '.'با موفقیت پاک شد'

            ]
        ])->setStatusCode(200);
    }


}
