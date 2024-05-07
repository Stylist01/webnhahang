<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\Model\CartDetail;
use App\Model\Dish;
use App\Model\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'cart.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::query()
            ->where('carts.customer_id', Auth::guard('customer')->user()->id)
            ->get();
        $dishes = Dish::query()
            ->orderBy('dishes.updated_at', 'DESC')
            ->get();
        return view($this->pathView . 'index', compact('carts', 'dishes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request)
    {
        try {
            if($request->customer_id && !empty($request->customer_id)) {
                DB::beginTransaction();
                $nowDate = Carbon::now();
                $str = str_replace('-', '', $nowDate->toDateTimeString());
                $str = str_replace(':', '', $str);
                $str = str_replace(' ', '', $str);
                $order_id = Str::random(5) . '_' . $str;
                $data_cart = [
                    'order_id' => $order_id,
                    'customer_id' => $request->customer_id,
                    'status_payment' => Order::UNPAID,
                ];
                $cart = Cart::query()
                    ->where('carts.customer_id', $request->customer_id)
                    ->first();
                if ($cart) {
                    $cart_detail = CartDetail::query()
                        ->where('cart_details.order_id', $cart->order_id)
                        ->where('cart_details.dish_id', $request->dish_id)
                        ->first();
                    if ($cart_detail) {
                        $cart_detail->update(['quantity' => $cart_detail->quantity + $request->quantity]);
                    } else {
                        $data_cart_detail = [
                            'order_id' => $cart->order_id,
                            'dish_id' => $request->dish_id,
                            'quantity' => $request->quantity,
                        ];
                        $cart_detail = CartDetail::create($data_cart_detail);
                    }
                } else {
                    $cart = Cart::create($data_cart);
                    $data_cart_detail = [
                        'order_id' => $cart->order_id,
                        'dish_id' => $request->dish_id,
                        'quantity' => $request->quantity,
                    ];
                    $cart_detail = CartDetail::create($data_cart_detail);
                }
                DB::commit();
                return redirect()->route('fe.cart');
            } else {
                return redirect()->route('fe.login');
            }
        } catch (Exception $e) {
            Log::error('[CartController][addCart] error ' . $e->getMessage());
            DB::rollBack();
            abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteOneCart(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = CartDetail::find($request->cart_detail_id);
                if ($data) {
                    $data_other = CartDetail::where('id', '<>', $data->id)->where('order_id', $data->order_id)->first();
                    if (!$data_other) {
                        Cart::where('order_id', $data->order_id)->delete();
                    }
                    $data->delete();
                    return response()->json([
                        'code' => 200,
                    ]);
                }
                return response()->json([
                    'code' => 400,
                ]);
            } catch (Exception $e) {
                Log::error('[CartController][deleteOneCart] error ' . $e->getMessage());
                DB::rollBack();
                return response()->json([
                    'code' => 400,
                ]);
            }
        } else {
            return response()->json([
                'code' => 400,
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAllCart(Request $request)
    {
        if ($request->ajax()) {
            try {
                $datas = CartDetail::where('order_id', $request->order_id)->get();
                if (count($datas) > 0) {
                    foreach ($datas as $data) {
                        $data->delete();
                    }
                    Cart::where('order_id', $request->order_id)->delete();
                    return response()->json([
                        'code' => 200,
                    ]);
                }
                return response()->json([
                    'code' => 400,
                ]);
            } catch (Exception $e) {
                Log::error('[CartController][deleteAllCart] error ' . $e->getMessage());
                DB::rollBack();
                return response()->json([
                    'code' => 400,
                ]);
            }
        } else {
            return response()->json([
                'code' => 400,
            ]);
        }
    }
}
