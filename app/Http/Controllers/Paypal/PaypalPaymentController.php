<?php

namespace App\Http\Controllers\Paypal;

use App\Helpers\PayPalHelper;
use App\Helpers\UsdPriceHelper;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\CartDetail;
use App\Model\Order;
use App\PayPalLog;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Str;

class PaypalPaymentController extends Controller
{
    //Thanh toán user
    public function createUser(Request $request)
    {
        $config_paypal = PayPalHelper::paypal(env("PAYPAL_SANDBOX_CLIENT_ID"), env("PAYPAL_SANDBOX_CLIENT_SECRET"));
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials($config_paypal);
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $order = $paypalClient->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => UsdPriceHelper::usdPrice($request->total_money)
                    ],
                    'description' => 'test'
                ]
            ],
        ]);
        DB::beginTransaction();
        try {
            $dataPayPalLog = [
                'vendor_order_id' => $order['id'],
                'data' => $request->all(),
                'status_payment' => Order::PENDING,
            ];
            $pay_pal_log = PayPalLog::create($dataPayPalLog);
            DB::commit();
            return response()->json($order);
        } catch (Exception $e) {
            Log::error('[PaypalPaymentController][captureCeo] error ' . $e->getMessage());
            DB::rollBack();
        }
    }

    public function captureUser(Request $request)
    {
        $datas = json_decode($request->getContent(), true);
        $orderId = $datas['orderId'];
        $config_paypal = PayPalHelper::paypal(env("PAYPAL_SANDBOX_CLIENT_ID"), env("PAYPAL_SANDBOX_CLIENT_SECRET"));
        $paypalClient = new PayPalClient;
        $paypalClient->setApiCredentials($config_paypal);
        $token = $paypalClient->getAccessToken();
        $paypalClient->setAccessToken($token);
        $result = $paypalClient->capturePaymentOrder($orderId);

        DB::beginTransaction();
        try {
            if ($result['status'] === "COMPLETED") {
                $payPalLog = PayPalLog::where('vendor_order_id', $orderId)->first();
                $payPalLog->update(['status_payment' => Order::COMPLETED]);
                $params = $payPalLog['data'];
                $data = Cart::where('order_id', $params['order_id'])->first();
                $status = json_decode($data->status) ?? [];
                $status_new = [
                    Order::WAIT,
                    Carbon::now()->toDateTimeString(),
                ];
                array_push($status, $status_new);
                $detail_order = CartDetail::where('order_id', $params['order_id'])->get();
                $detail = [];
                foreach ($detail_order as $value_order) {
                    $dish = [
                        $value_order->dish_id,
                        $value_order->quantity,
                    ];
                    array_push($detail, $dish);
                }
                $nowDate = Carbon::now();
                $str = str_replace('-', '', $nowDate->toDateTimeString());
                $str = str_replace(':', '', $str);
                $str = str_replace(' ', '', $str);
                $order_id = Str::random(5) . '_' . $str;
                $param_order = [
                    'order_id' => $order_id,
                    'total_money' => $params['total_money'],
                    'status_payment' => $payPalLog['status_payment'],
                    'status' => json_encode($status),
                    'payment' => $params['total_money'],
                    'implementation_date' => Carbon::now()->toDateTimeString(),
                    'vendor_order_id' => $payPalLog['vendor_order_id'],
                    'customer_id' => $params['customer_id'],
                    'detail' => json_encode($detail),
                ];
                CartDetail::where('order_id', $params['order_id'])->delete();
                Cart::where('order_id', $params['order_id'])->delete();
                PayPalLog::where('vendor_order_id', $orderId)->delete();
                $order = Order::create($param_order);
                DB::commit();
            }
            return response()->json($result);
        } catch (Exception $e) {
            Log::error('[PaypalPaymentController][captureCeo] error ' . $e->getMessage());
            DB::rollBack();
        }
    }
}
