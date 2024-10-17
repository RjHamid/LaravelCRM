<?php

namespace Modules\Rating\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Comments\Models\Comment;
use Modules\ProductSuiteManager\Models\Product;
use Modules\Rating\Http\Requests\RateRequest;
use Modules\Rating\Models\Rate;
use Modules\Rating\Transformers\RateResource;

class RatingController extends Controller
{

    public function store(RateRequest $request ,$type,$id)
    {
        switch ($type)
        {
            case 'product' :

                $userRateExists = Rate::query()->where('user_id' , 1)
                    ->where('type' , 'product')
                    ->where('data_id' , $id)
                    ->first();

                if (!empty($userRateExists))
                {
                    $userRateExists->update([
                        'rate' => $request->get('rate')
                    ]);

                    return response()->json([
                        'data' => [
                            'message' => 'امتیاز مورده نظر با موفقیت ثبت شد',
                            'rate' => New RateResource($userRateExists)
                        ]
                    ])->setStatusCode(200);
                }


                $productExists = Product::query()->where('id' , $id)
                    ->exists();

                if ($productExists)
                {
                    /*این بخش برای user باید update بشه*/
                    $rating =  Rate::query()->create([
                        'user_id' => 1,
                        'type' => $type,
                        'data_id' => $id,
                        'rate' => $request->get('rate'),
                    ]);

                    return response()->json([
                        'data' => [
                            'message' => 'امتیاز مورده نظر با موفقیت ثبت شد',
                            'rate' => New RateResource($rating)
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
}
