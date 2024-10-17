<?php

namespace Modules\ShopFlow\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ShopFlow\Http\Requests\OrdersRequest\NewOrderRequest;
use Modules\ShopFlow\Http\Requests\OrdersRequest\UpdateOrderRequest;
use Modules\ShopFlow\Models\cart;
use Modules\ShopFlow\Models\order;
use Modules\ShopFlow\Transformers\OrderResources\OrderResource;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([

                'orders' => OrderResource::collection(order::paginate(9))
                ->response()->getData()

        ])->setStatusCode(200);
    }

    /*order for users*/

    public function indexU()
    {
        $orders = order::query()->where('user_id' , 1)
            ->paginate(9);

        if (!empty($orders))
        {
            return response()->json([

                    'orders' => OrderResource::collection($orders)
                        ->response()->getData()

            ])->setStatusCode(200);
        }

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(NewOrderRequest $request)
    {

        $UserCarts = cart::query()->where('user_id',1)
            ->where('status' , 'pending')
            ->get();

        if (!empty($UserCarts))
        {
            $total_price = 0;

            $unique_code = null;

                foreach ($UserCarts as $userCarts)
                {
                    $total_price += $userCarts->count * $userCarts->price_unit;

                    $unique_code = $userCarts->unique_code;
                }
            $orderExists = order::query()->where('unique_code',$unique_code)
                ->exists();

                if ($orderExists)
                {
                    return response()->json([
                        'data' => [
                            'message' => 'این سفارش از قبل ثبط شده'
                        ]
                    ])->setStatusCode(200);
                }

            $order = order::query()->create([
                'user_id' => 1 ,
                'unique_code' => $unique_code,
                'address_id' => $request->get('address_id'),
                'gate' => $request->get('gate'),
                'price_total' => $total_price,
                'status' => 'pending'
            ]);

            $invoice = (new Invoice)->amount($total_price);
            $invoice->via($request->get('gate'));
            $invoice->uuid($order->id);


         return   Payment::purchase($invoice, function($driver, $transactionId) use ($order) {
                $order->update([
                    'transaction_id' => $transactionId
                ]);
            })->pay()->render();

        }
        else
        {
            return response()->json([
                'data' => [
                    'message' => 'سبد خرید خالی است'
                ]
            ])->setStatusCode(200);
        }


    }

    public function callback(Request $request)
    {
        $order = order::query()->where('transaction_id',$request->get('token'))
            ->first();

        if ($request->get('status') == 1)
        {
            $order->update([
                'status' => 'paid',
                'progress_id' => 2
            ]);

            cart::query()->where('unique_code',$order->unique_code)
                ->update(['status' => 'paid']);

            try
            {
                $receipt = Payment::amount($order->price_total)
                    ->transactionId($order->transaction_id)
                    ->verify();


                return response()->json([
                    'data' => [
                        'message' => $receipt
                    ]
                ])->setStatusCode(200);
            }
            catch (InvalidPaymentException  $exception)
            {
                return response()->json([
                    'data' => [
                        'message' => $exception->getMessage()
                    ]
                ])->setStatusCode(200);
            }
        }
        else
        {

            $order->update([
                'status' => 'failed',
                'progress_id' => 7
            ]);

            cart::query()->where('unique_code',$order->unique_code)
                ->update(['status' => 'failed']);
            try
            {
                $receipt = Payment::amount($order->amount)->transactionId($order->transaction_id)
                    ->verify();


                return response()->json([
                    'data' => [
                        'message' => $receipt
                    ]
                ])->setStatusCode(200);
            }
            catch (InvalidPaymentException  $exception)
            {
                return response()->json([
                    'data' => [
                        'message' => $exception->getMessage()
                    ]
                ])->setStatusCode(200);
            }

        }


    }

    /**
     * Show the specified resource.
     */
    public function show(order $order)
    {
        return response()->json([
            'data' => [
                'order' => new OrderResource($order)
            ]
        ])->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, order $order)
    {
        $order->update([
            'status' => $request->get('status',$order->status),
            'progress_id' => $request->get('progress_id',$order->progress_id)
        ]);

        return response()->json([
            'data' => [
                'order' => new OrderResource($order)
            ]
        ])->setStatusCode(200);
    }

}
