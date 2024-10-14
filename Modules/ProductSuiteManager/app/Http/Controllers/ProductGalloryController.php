<?php

namespace Modules\ProductSuiteManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\ProductSuiteManager\Models\Gallery;
use Modules\ProductSuiteManager\Models\Product;
use Modules\ProductSuiteManager\Transformers\ProductResources\GalleryIndexResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductGalleryResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductResource;

class ProductGalloryController extends Controller
{
    /**
 * Display a listing of the resource.
 */
    public function index(Product $product)
    {

        if ($product->galleries()->count() > 0)
        {
            return response()->json([
                'data' => [
                    'product' =>  $product->name,
                    'galleries' => ProductGalleryResource::collection($product->galleries)
                ]
            ])->setStatusCode(200);
        } else
        {
            return response()->json([
                'data' => [
                    'message' =>  'محصول مورده نظر عکسی در گالری ندارد ',
                ]
            ])->setStatusCode(200);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Product $product)
    {
        $request->validate([
            'pic' => ['required','mimes:jpg,svg,jpeg,png,mpeg','min:5','max:5024']
        ],[
            'pic.required' => 'فیلد مورده نظر اجباری است',
            'pic.min' => 'عکس مورده نظر باید حداقل باید 5kb باشد ',
            'pic.max' => 'عکس مورده نظر باید حداکثر باید 5mb باشد ',
            'pic.mimes' => 'عکس مورده نظر باید فقط از نوع jpg,svg,jpeg,png,mpeg باشد ',
        ]);

        $pic = $request->file('pic')->store('public/products/galleries');

        $pic = str_replace('public','/storage',$pic);

        $product->galleries()->create([
            'pic' => $pic
        ]);


        return response()->json(
            [
                'data' => [
                    'message' => 'عکس با موفقیت ذخیره شد',
                    'product' => new ProductResource($product)
                ]
            ]
        )->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product,Gallery $gallery)
    {

       /* $galleryExists = Gallery::query()->where('id' , $gallery->id)
        ->where('product_id' , $product->id)
        ->exists();

        if ($galleryExists)
        {
            $pic = str_replace('/storage' , 'public',$gallery->pic);

            Storage::delete($pic);

            $product->galleries()->delete($gallery->id);

            return response()->json([
                'data' => [
                    'message' => 'عکس مورده نظر با موفقیت از گالری پاک شد'
                ]
            ]);
        }
        else
        {
            return response()->json([
                'data' => [
                    'message' => 'مشکلی پش اومده دوباره تلاش کنید'
                ]
            ]);
        }*/

        $pic = str_replace('/storage' , 'public',$gallery->pic);

        Storage::delete($pic);

        Gallery::destroy($gallery->id);

        return response()->json([
            'data' => [
                'message' => 'عکس مورده نظر با موفقیت از گالری پاک شد'
            ]
        ]);


    }
}
