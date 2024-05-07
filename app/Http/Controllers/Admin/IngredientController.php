<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Position;
use App\Model\Table;
use App\Model\Blog;
use App\Model\Dish;
use App\Model\Ingredient;
use App\Model\Bill;
use App\Model\Recipe;
use App\Model\Personnel;
use App\Model\Policy;
use App\Model\Post;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\IngredientRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $ingredients = Ingredient::all();
        $ingredient_count = Ingredient::count();
        $dish_count = Dish::count();
        $policy_count = Policy::count();
        $category_count = Category::count();
        $position_count = Position::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $post_count = Post::count();
        $personnel_count = Personnel::count();
        $blog_count = Blog::count();
        $recipe_count = Recipe::count();
        $table_count = Table::where('status', 0)->count();
        return view('admin.ingredient.index')->with([
            'company' => $company,
            'ingredients' => $ingredients,
            'ingredient_count' => $ingredient_count,
            'dish_count' => $dish_count,
            'blog_count' => $blog_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'personnel_count' => $personnel_count,
            'table_count' => $table_count,
            'policy_count' => $policy_count,
            'position_count' => $position_count,
            'recipe_count' => $recipe_count,
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
        $ingredient_count = Ingredient::count();
        $dish_count = Dish::count();
        $policy_count = Policy::count();
        $category_count = Category::count();
        $recipe_count = Recipe::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $position_count = Position::count();
        $blog_count = Blog::count();
        $table_count = Table::where('status', 0)->count();
        return view('admin.ingredient.add')->with([
            'company' => $company,
            'ingredient_count' => $ingredient_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'dish_count' => $dish_count,
            'policy_count' => $policy_count,
            'position_count' => $position_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'recipe_count' => $recipe_count,
            'blog_count' => $blog_count,
            'personnel_count' => $personnel_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'post_count' => $post_count,
            'table_count' => $table_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'quantity' => $request->quantity,
                'units' => $request->units,
                'price' => $request->price,
                'user_id' => Auth::user()->id
            ];
            $ingredient = Ingredient::create($data);
            DB::commit();
            return redirect()->route('ingredients.index');
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
        $ingredient = Ingredient::find($id);
        if ($ingredient) {
            $company = Company::first();
            $policy_count = Policy::count();
            $ingredient_count = Ingredient::count();
            $dish_count = Dish::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $blog_count = Blog::count();
            $post_count = Post::count();
            $recipe_count = Recipe::count();
            $personnel_count = Personnel::count();
            $position_count = Position::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            return view('admin.ingredient.edit')->with([
                'company' => $company,
                'ingredient' => $ingredient,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'ingredient_count' => $ingredient_count,
                'blog_count' => $blog_count,
                'dish_count' => $dish_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'post_count' => $post_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'personnel_count' => $personnel_count,
                'policy_count' => $policy_count,
                'table_count' => $table_count,
                'position_count' => $position_count,
                'recipe_count' => $recipe_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('ingredients.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IngredientRequest $request, $id)
    {
        try {
            $ingredient = Ingredient::find($id);
            if ($ingredient) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'units' => $request->units,
                    'price' => $request->price,
                    'user_id' => Auth::user()->id
                ];
                $ingredient = $ingredient->update($data);
                DB::commit();
                return redirect()->route('ingredients.index');
            } else {
                return redirect()->route('ingredients.index');
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
            $ingredient = Ingredient::find($id);
            if ($ingredient) {
                DB::beginTransaction();
                $ingredient->delete();
                DB::commit();
                return redirect()->route('ingredients.index');
            } else {
                return redirect()->route('ingredients.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
