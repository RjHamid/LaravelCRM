<?php

namespace Modules\ShopFlow\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\ProductSuiteManager\Models\Product;
use Modules\ShopFlow\Http\Requests\CartsRequest\NewCartRequest;
use Modules\ShopFlow\Http\Requests\CartsRequest\UpdateCartRequest;
use Modules\ShopFlow\Models\cart;
use Modules\ShopFlow\Transformers\CartResources\CartResource;

class CartController extends Controller
{


    public function index()
    {

        $carts = cart::query()->where('user_id',1)
            ->where('status' , 'pending')
            ->get();

        if (!empty($carts))
        {
            return response()->json([
                'data' =>[
                    'carts' => CartResource::collection($carts)
                ]
            ])->setStatusCode(200);
        }
        else
        {
            return response()->json([
                'data' => [
                    'message'  => 'سبد خرید خالی است'
                ]
            ])->setStatusCode(200);
        }


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(NewCartRequest $request,Product $product)
    {
       if ($product->quantity > 0)
       {
           /*اینا بعدا باید fix بشه*/

           $CurrentCardExists =   cart::query()->where('user_id' , 1)
               ->where('status','pending')
               ->pluck('unique_code')
               ->first();

           $status = 'pending';

           if (!empty($CurrentCardExists))
           {
               $ProductCartExists = Cart::query()->where('product_id',$product->id)
                   ->where('status','pending')
                   ->first();

               if (!empty($ProductCartExists))
               {

                   $carts = cart::query()->where('user_id' , 1)
                       ->where('status','pending')
                       ->get();

                   return response()->json([
                       'data' =>[
                           'message' => 'این محصول از قبل در سبد خرید  موجود است',
                           'carts' => CartResource::collection($carts)
                       ]
                   ])->setStatusCode(200);
               }

               /*اینجا هم باید change بشه*/

               Cart::query()->create([
                   'unique_code' => $CurrentCardExists,
                   'user_id' => 1,
                   'product_id' => $product->id,
                   'count' => $request->get('count'),
                   'price_unit' => $product->price_with_discount,
                   'status' => $status
               ]);

               $carts = cart::query()->where('user_id' , 1)
                   ->where('status','pending')
                   ->get();

               return response()->json([
                   'data' =>[
                       'message' => 'سبد خرید با موفقت ایجاد شد',
                       'carts' => CartResource::collection($carts)
                   ]
               ])->setStatusCode(200);

           }
           else
           {

               $unique_code = Str::random(15);

               $unique_codeExists = Cart::query()->where('unique_code',$unique_code)
                   ->exists();

               if ($unique_codeExists)
               {
                   return response()->json([
                       'data' =>[
                           'message' => 'مشکلی پیش اومده لطفا دوباره تلاش کنید'
                       ]
                   ])->setStatusCode(200);
               }

             $cart =  Cart::query()->create([
                   'unique_code' => $unique_code,
                   'user_id'  => 1,
                   'product_id' => $product->id,
                   'count' => $request->get('count'),
                   'price_unit' => $product->price_with_discount,
                   'status' => $status
               ]);

               return response()->json([
                   'data' =>[
                       'message' => 'سبد خرید با موفقت ایجاد شد',
                       'cart' => new CartResource($cart)
                   ]
               ])->setStatusCode(200);

           }
       }
       else
       {
           return response()->json([
               'data' => [
                   'message' => 'محصول انتخاب شده موجود نیست'
               ]
           ])->setStatusCode(200);
       }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, cart $cart)
    {
        $cart->update([
            'count' => $request->get('count',$cart->count)
        ]);

        $carts = cart::query()->where('user_id' , 1)
            ->where('status','pending')
            ->get();

        return response()->json([
            'data' =>[
                'message' => 'کارت با موفقت ایجاد اپدیت شد',
                'carts' => CartResource::collection($carts)
            ]
        ])->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        $cart->delete();

        return response()->json([
            'data' => [
                'message' => 'کارت مورده نظر با موفقیت پاک شد'
            ]
        ])->setStatusCode(200);
    }
}
