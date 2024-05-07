<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Bill;
use App\Model\Blog;
use App\Model\Category;
use App\Model\Company;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Contactdetail;
use App\Model\Dish;
use App\Model\Ingredient;
use App\Model\Order;
use App\Model\Personnel;
use App\Model\Policy;
use App\Model\Position;
use App\Model\Post;
use App\Model\Recipe;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $company = Company::first();
        $contactbills = Contactbill::all();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        $status = Order::STATUS;
        $status_payment = Order::STATUS_PAYMENT;
        return view('admin.order.index')->with([
            'orders' => $orders,
            'status' => $status,
            'status_payment' => $status_payment,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'company' => $company,
            'contactbills' => $contactbills,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'contactdetails' => Contactdetail::all(),
            'dishs' => Dish::all(),
            'personnels' => Personnel::all(),
            'category_count' => $category_count
        ]);
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $company = Company::first();
        $contacts = Contact::all();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        $status = Order::STATUS;
        $status_payment = Order::STATUS_PAYMENT;
        return view('admin.order.detail')->with([
            'order' => $order,
            'status' => $status,
            'status_payment' => $status_payment,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'company' => $company,
            'contacts' => $contacts,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'contactdetails' => Contactdetail::all(),
            'contactbill' => Contactbill::find($id),
            'dishs' => Dish::all(),
            'personnels' => Personnel::all(),
            'category_count' => $category_count
        ]);
    }

    public function update($id, Request $request)
    {
        try {
            $order = Order::find($id);
            if ($order) {
                DB::beginTransaction();
                $status = json_decode($order->status) ?? [];
                $status_new = [
                    $request->status,
                    Carbon::now()->toDateTimeString(),
                ];
                array_push($status, $status_new);
                $data = [
                    'status' => json_encode($status),
                ];
                $order->update($data);
                DB::commit();
                return redirect()->route('order.index');
            } else {
                return redirect()->route('order.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            abort(404);
        }
    }
}
