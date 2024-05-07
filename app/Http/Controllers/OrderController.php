<?php

namespace App\Http\Controllers;

use App\Model\Cart;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'order.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payment($order_id)
    {
        $cart = Cart::query()
            ->where('carts.order_id', $order_id)
            ->first();
        if ($cart) {
            return view($this->pathView . 'payment', compact('cart'));
        }
        return redirect()->route('fe.cart')->with(['error' => 'Không tồn tại sản phẩm trong giỏ hàng']);
    }

    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $orders = Order::where('customer_id', $customer->id)->orderBy('created_at', 'DESC')->get();
        $status = Order::STATUS;
        $status_payment = Order::STATUS_PAYMENT;
        return view($this->pathView . 'index', compact('customer', 'orders', 'status', 'status_payment'));
    }

    public function getOrderDetail(Request $request)
    {
        $data = Order::where('order_id', $request->order_id)->first();
        return view($this->pathView . 'modal.detail_order', compact('data'));
    }
}
