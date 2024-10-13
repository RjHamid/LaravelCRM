<?php

namespace Modules\ProductSuiteManager\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ProductSuiteManager\Http\Requests\ProductsRequest\ProductDiscountRequest;
use Modules\ProductSuiteManager\Http\Requests\ProductsRequest\UpdateProductDiscountRequest;
use Modules\ProductSuiteManager\Http\Requests\ProductsRequest\UpdateProductRequest;
use Modules\ProductSuiteManager\Models\Discount;
use Modules\ProductSuiteManager\Models\Product;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductDiscountResource;
use Modules\ProductSuiteManager\Transformers\ProductResources\ProductResource;

class ProductDiscountController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductDiscountRequest $request ,Product $product)
    {

        if (!$product->has_discount && $request->get('percent') != 0)
        {
            $product->discount()->create([
                'percent' => $request->get('percent')
            ]);

            return response()->json(
                [
                    'data' => [
                        'message' => $product->name.' تخفیف برای '.' با موفقیت ایجاد شد',
                        'product' => new ProductResource($product)
                    ]
                ]
            )->setStatusCode(201);
        }
        elseif (!$product->has_discount && $request->get('percent') == 0)
        {
            return response()->json(
                [
                    'data' => [
                        'message' => 'مقدار فرستاده شده برای ایجاد تخفیف نمیتواند صفر درصد باشید',

                    ]
                ]
            )->setStatusCode(201);
        }
        else
        {
          return  $this->update( $request, $product);
        }



    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->get('percent') == 0)
        {
            $product->discount()->delete();

            return response()->json([
                'data' => [
                    'message' => ' با موفقیت پاک شد'.$product->name.' '. ' تخفیف محصول'
                ]
            ])->setStatusCode(200);
        }
        else
        {
            $product->discount()->update([
                'percent' => $request->get('percent')
            ]);

            return response()->json([
                'data' => [
                    'message' => ' با موفقیت اپدیت  شد'.$product->name.' '. ' تخفیف محصول',
                    'product' => new ProductResource($product)
                ]
            ])->setStatusCode(200);
        }
    }

    public function ProductWithDiscountIndex()
    {

        $ProductWithDiscount = Product::query()->whereHas('discount')
            ->paginate(9);

        return response()->json([

                'productsWithDiscount' => ProductResource::collection($ProductWithDiscount)
                    ->response()->getData()

        ])->setStatusCode(200);
    }


}
