<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Dish;
use App\Model\Ingredient;
use App\Model\Post;
use App\Model\Recipe;
use App\Model\Blog;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Bill;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Position;
use App\Model\Personnel;
use App\Traits\StorageImageTrait;
use App\Model\Policy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\TableRequest;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $tables = Table::all();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $category_count = Category::count();
        $dish_count = Dish::count();
        $position_count = Position::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $blog_count = Blog::count();
        $post_count = Post::count();
        $recipe_count = Recipe::count();
        $policy_count = Policy::count();
        $ingredient_count = Ingredient::count();
        return view('admin.table.index')->with([
            'company' => $company,
            'tables' => $tables,
            'table_count' => $table_count,
            'position_count' => $position_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'dish_count' => $dish_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'personnel_count' => $personnel_count,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'policy_count' => $policy_count,
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
        $table_count = Table::where('status', 0)->count();
        $category_count = Category::count();
        $dish_count = Dish::count();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $recipe_count = Recipe::count();
        $policy_count = Policy::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $blog_count = Blog::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.table.add')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'position_count' => $position_count,
            'blog_count' => $blog_count,
            'personnel_count' => $personnel_count,
            'post_count' => $post_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TableRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'people' => $request->people,
                'floor' => $request->floor,
                'user_id' => Auth::user()->id
            ];
            $table = Table::create($data);
            DB::commit();
            return redirect()->route('tables.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::find($id);
        if ($table) {
            $company = Company::first();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $position_count = Position::count();
            $category_count = Category::count();
            $dish_count = Dish::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $blog_count = Blog::count();
            $post_count = Post::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $policy_count = Policy::count();
            $ingredient_count = Ingredient::count();
            return view('admin.table.edit')->with([
                'company' => $company,
                'table' => $table,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'position_count' => $position_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'blog_count' => $blog_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('tables.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TableRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TableRequest $request, $id)
    {
        try {
            $table = Table::find($id);
            if ($table) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'people' => $request->people,
                    'floor' => $request->floor,
                    'user_id' => Auth::user()->id
                ];
                $table = $table->update($data);
                DB::commit();
                return redirect()->route('tables.index');
            } else {
                return redirect()->route('tables.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
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
            $table = Table::find($id);
            if ($table) {
                DB::beginTransaction();
                $table->delete();
                DB::commit();
                return redirect()->route('tables.index');
            } else {
                return redirect()->route('tables.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
        }
    }
}
