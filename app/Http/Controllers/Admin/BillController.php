<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Dish;
use App\Model\Position;
use App\Model\Ingredient;
use App\Model\Recipe;
use App\Model\Post;
use App\Model\Blog;
use App\Model\Policy;
use App\Model\Personnel;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Bill;
use App\Model\Detail;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\PersonnelRequest;
use Carbon\Carbon;
use PDF;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        $tables = Table::query()->where('status', 0)->get();
        return view('admin.bill.index')->with([
            'company' => $company,
            'tables' => $tables,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'bills' => $bills,
            'post_count' => $post_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'personnel_count' => $personnel_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'table_id' => $request->table_id,
                'user_id' => Auth::user()->id
            ];
            $bill_id = Bill::create($data)->id;
            $dataTableUpdate = [
                'status' => 1
            ];
            $table = Table::find($data['table_id'])->update($dataTableUpdate);
            DB::commit();
            $bills = Bill::all();
            $details = Detail::all();
            $dishs = Dish::all();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $policy_count = Policy::count();
            $blog_count = Blog::count();
            $company = Company::first();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.bill.add')->with([
                'company' => $company,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'bills' => $bills,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'details' => $details,
                'dishs' => $dishs,
                'bill_id' => $bill_id,
                'post_count' => $post_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'bill_id' => $request->bill_id,
                'dish_id' => $request->dish_id,
                'quantily' => $request->quantily
            ];
            $detail = Detail::create($data);
            DB::commit();
            $bills = Bill::all();
            $details = Detail::all();
            $dishs = Dish::all();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $policy_count = Policy::count();
            $blog_count = Blog::count();
            $company = Company::first();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.bill.add')->with([
                'company' => $company,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'bills' => $bills,
                'details' => $details,
                'dishs' => $dishs,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_id' => $data['bill_id'],
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'post_count' => $post_count,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);
        if ($bill) {
            $details = Detail::all();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $policy_count = Policy::count();
            $blog_count = Blog::count();
            $company = Company::first();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $dishs = Dish::all();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            $tables = Table::query()->where('status', 0);
            return view('admin.bill.show')->with([
                'company' => $company,
                'tables' => $tables,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'dishs' => $dishs,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill' => $bill,
                'details' => $details,
                'bill_id' => $id,
                'post_count' => $post_count,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('bills.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);
        if ($bill) {
            $details = Detail::all();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $policy_count = Policy::count();
            $blog_count = Blog::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $company = Company::first();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $dishs = Dish::all();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            $tables = Table::query()->where('status', 0);
            return view('admin.bill.edit')->with([
                'company' => $company,
                'tables' => $tables,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'details' => $details,
                'dishs' => $dishs,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill' => $bill,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'bill_id' => $id,
                'post_count' => $post_count,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('bills.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'bill_id' => $request->bill_id,
                'dish_id' => $request->dish_id,
                'quantily' => $request->quantily
            ];
            $detail = Detail::create($data);
            DB::commit();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $policy_count = Policy::count();
            $details = Detail::all();
            $blog_count = Blog::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $company = Company::first();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $dishs = Dish::all();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            $tables = Table::query()->where('status', 0);
            return view('admin.bill.edit')->with([
                'company' => $company,
                'tables' => $tables,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'dishs' => $dishs,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'details' => $details,
                'bill_id' => $data['bill_id'],
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'post_count' => $post_count,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payment($id, $check, $table_id)
    {
        try {
            $bill = Bill::find($id);
            if ($bill) {
                DB::beginTransaction();
                if ($check == 0) {
                    $check = 1;
                } else {
                    $check = 0;
                }
                $data = [
                    'payment' => $check,
                ];
                $bill = $bill->update($data);
                $dataTableUpdate = [
                    'status' => 0
                ];
                $table = Table::find($table_id)->update($dataTableUpdate);
                DB::commit();
                return redirect()->route('bills.index');
            } else {
                return redirect()->route('bills.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $dt = Carbon::now()->toDateTimeString();
        $datetime = $dt;
        $dt = str_replace("-", "", $dt);
        $dt = str_replace(":", "", $dt);
        $dt = str_replace(" ", "_", $dt);
        $data =
            [
                'dishs' => Dish::all(),
                'details' => Detail::all(),
                'bill' => Bill::find($id),
                'company' => Company::first(),
                'dt' => $dt,
                'datetime' => $datetime
            ];
        $pdf = PDF::loadView('admin/bill/print', $data);
        return $pdf->stream('pdf.pdf');
    }
}
