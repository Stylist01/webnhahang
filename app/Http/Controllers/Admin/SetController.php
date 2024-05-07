<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Position;
use App\Model\Dish;
use App\Model\Policy;
use App\Model\Blog;
use App\Model\Bill;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Post;
use App\Model\Personnel;
use App\Model\Recipe;
use App\Model\Ingredient;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Setdetail;
use App\Model\Tabledetail;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use Carbon\Carbon;
use PDF;

class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $sets = Set::all();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.set.index')->with([
            'company' => $company,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'sets' => $sets,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::first();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.set.add')->with([
            'company' => $company,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
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
            'category_count' => $category_count
        ]);
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
                'name' => $request->name,
                'phone' => $request->phone,
                'quantily' => $request->quantily,
                'date' => $request->date,
                'time' => $request->time,
                'activated' => 1
            ];
            $set = Set::create($data);
            DB::commit();
            return redirect()->route('sets.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $set = Set::find($id);
        if ($set) {
            $company = Company::first();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.set.edit')->with([
                'company' => $company,
                'set' => $set,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'recipe_count' => $recipe_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('sets.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $set = Set::find($id);
            if ($set) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'quantily' => $request->quantily,
                    'date' => $request->date,
                    'time' => $request->time,
                    'activated' => 1
                ];
                $set = $set->update($data);
                DB::commit();
                return redirect()->route('sets.index');
            } else {
                return redirect()->route('sets.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $set = Set::find($id);
            if ($set) {
                DB::beginTransaction();
                $set = $set->delete();
                DB::commit();
                return redirect()->route('sets.index');
            } else {
                return redirect()->route('sets.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function activated($id, $check)
    {
        try {
            DB::beginTransaction();
            if ($check == 0) {
                $check = 1;
            } else {
                $check = 0;
            }
            $dataSetEdit = [
                'activated' => $check,
            ];
            $set = Set::find($id)->update($dataSetEdit);
            DB::commit();
            return redirect()->route('sets.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function table($id)
    {
        $company = Company::first();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.set.table')->with([
            'company' => $company,
            'set' => Set::find($id),
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
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
            'set_id' => $id,
            'tabledetails' => Tabledetail::all(),
            'tables' => Table::all(),
            'category_count' => $category_count
        ]);
    }

    public function status(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataTabledetailCreate = [
                'set_id' => $request->set_id,
                'table_id' => $request->table_id
            ];
            $tabledetail = Tabledetail::create($dataTabledetailCreate);
            $dataTableUpdate = [
                'status' => 2
            ];
            $table = Table::find($dataTabledetailCreate['table_id'])->update($dataTableUpdate);

            $dataSetUpdate = [
                'activated' => 1,
                'status' => 1
            ];
            $set = Set::find($dataTabledetailCreate['set_id'])->update($dataSetUpdate);
            DB::commit();
            $company = Company::first();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.set.table')->with([
                'company' => $company,
                'set' => Set::find($dataTabledetailCreate['set_id']),
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'recipe_count' => $recipe_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'set_id' => $dataTabledetailCreate['set_id'],
                'tabledetails' => Tabledetail::all(),
                'tables' => Table::all(),
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function setbill($id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'set_id' => $id,
                'user_id' => Auth::user()->id
            ];
            $setbill = Setbill::create($data)->id;
            DB::commit();
            $company = Company::first();
            $sets = Set::all();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.set.setbill')->with([
                'company' => $company,
                'sets' => $sets,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'recipe_count' => $recipe_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'setdetails' => Setdetail::all(),
                'setbills' => Setbill::all(),
                'dishs' => Dish::all(),
                'setbill_id' => $setbill,
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function setdetail(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataSetbillCreate = [
                'setbill_id' => $request->setbill_id,
                'dish_id' => $request->dish_id,
                'quantily' => $request->quantily
            ];
            $setdetail = Setdetail::create($dataSetbillCreate);
            DB::commit();
            $company = Company::first();
            $sets = Set::all();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.set.setbill')->with([
                'company' => $company,
                'sets' => $sets,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'recipe_count' => $recipe_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'setdetails' => Setdetail::all(),
                'setbills' => Setbill::all(),
                'dishs' => Dish::all(),
                'setbill_id' => $dataSetbillCreate['setbill_id'],
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function bill()
    {
        $company = Company::first();
        $sets = Set::all();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.setbill.bill')->with([
            'company' => $company,
            'sets' => $sets,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'setdetails' => Setdetail::all(),
            'setbills' => Setbill::all(),
            'dishs' => Dish::all(),
            'category_count' => $category_count
        ]);
    }

    public function detail($id)
    {
        $company = Company::first();
        $sets = Set::all();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.setbill.detail')->with([
            'company' => $company,
            'sets' => $sets,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
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
            'setdetails' => Setdetail::all(),
            'setbill' => Setbill::find($id),
            'setbills' => Setbill::all(),
            'dishs' => Dish::all(),
            'tabledetails' => Tabledetail::all(),
            'tables' => Table::all(),
            'category_count' => $category_count
        ]);
    }

    public function print($id)
    {
        $dt = Carbon::now()->toDateTimeString();
        $datetime = $dt;
        $dt = str_replace("-", "", $dt);
        $dt = str_replace(":", "", $dt);
        $dt = str_replace(" ", "_", $dt);
        $data =
            [
                'setbill' => Setbill::find($id),
                'setdetails' => Setdetail::all(),
                'setbills' => Setbill::all(),
                'dishs' => Dish::all(),
                'tabledetails' => Tabledetail::all(),
                'tables' => Table::all(),
                'company' => Company::first(),
                'dt' => $dt,
                'datetime' => $datetime,
            ];
        $pdf = PDF::loadView('admin/set/print', $data);
        return $pdf->stream('pdf.pdf');
    }

    public function payment($id, $check)
    {
        try {
            DB::beginTransaction();
            if ($check == 0) {
                $check = 1;
            } else {
                $check = 0;
            }
            $dataSetbillEdit = [
                'payment' => $check,
            ];
            $setbill = Setbill::find($id)->update($dataSetbillEdit);
            $setbill = Setbill::find($id);
            $tabledetails = Tabledetail::query()->where('set_id', $setbill->set_id)->get();
            foreach ($tabledetails as $tabledetail) {
                $dataTableUpdate = [
                    'status' => 0
                ];
                $table = Table::find($tabledetail->table_id)->update($dataTableUpdate);
            }
            DB::commit();
            $company = Company::first();
            $sets = Set::all();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.setbill.bill')->with([
                'company' => $company,
                'sets' => $sets,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
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
                'setdetails' => Setdetail::all(),
                'setbills' => Setbill::all(),
                'dishs' => Dish::all(),
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
