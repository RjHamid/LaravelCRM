<?php

namespace Modules\Coupons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Coupons\Http\Requests\NewCouponRequest;
use Modules\Coupons\Http\Requests\UpdateCouponRequest;
use Modules\Coupons\Models\Coupon;
use Modules\Coupons\Transformers\CouponResource;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([

                'coupons' => CouponResource::collection(Coupon::paginate(9))->response()
                ->getData()

        ])->setStatusCode(200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(NewCouponRequest $request)
    {
        $unique_code = Str::random(10);

        $uniqueCodeExists = Coupon::query()->where('unique_code' , $unique_code)
            ->exists();

        if ($uniqueCodeExists)
        {
            return response()->json([
                'data' => [
                    'message' => 'مشکلی پیش امده لطفا دوباره تلاش کنید'
                ]
            ])->setStatusCode(200);
        }

        $coupon = Coupon::query()->create([
            'unique_code' => $unique_code,
            'percent' => $request->get('percent'),
            'max_amount' => $request->get('max_amount'),
            'max_usage' => $request->get('max_usage'),
            'started_at' => $request->get('started_at'),
            'expire_at' => $request->get('expire_at')
        ]);

        return response()->json([
            'data' => [
                'message' => 'کوپن با موفقیت ایجاد شد',
                'coupon' => new CouponResource($coupon)
            ]
        ])->setStatusCode(200);
    }

    /**
     * Show the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return response()->json([
            'data' => [
                'coupon' => new CouponResource($coupon)
            ]
        ])->setStatusCode(200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {

        $coupon->update([
            'percent' => $request->get('percent', $coupon->percent),
            'max_amount' => $request->get('max_amount', $coupon->max_amount),
            'max_usage' => $request->get('max_usage', $coupon->max_usage),
            'started_at' => $request->get('started_at', $coupon->started_at),
            'expire_at' => $request->get('expire_at', $coupon->expire_at)
        ]);

        return response()->json([
            'data' => [
                'message' => 'کوپن مورده نظر با موفقیت پاک شد',
                'coupon' => new CouponResource($coupon)
            ]
        ])->setStatusCode(200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        /*بعدا باید fix شه*/
        $coupon->delete();

        return response()->json([
            'data' => [
                'message' => 'کوپن مورده نظر با موفقیت پاک شد'
            ]
        ])->setStatusCode(200);
    }
}
