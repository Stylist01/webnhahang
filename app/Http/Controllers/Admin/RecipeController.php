<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Dish;
use App\Model\Ingredient;
use App\Model\Position;
use App\Model\Post;
use App\Model\Personnel;
use App\Model\Blog;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Policy;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Bill;
use App\Model\Recipe;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\RecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $recipes = Recipe::all();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $personnel_count = Personnel::count();
        $dish_count = Dish::count();
        $position_count = Position::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $policy_count = Policy::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $post_count = Post::count();
        $blog_count = Blog::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        return view('admin.recipe.index')->with([
            'company' => $company,
            'recipes' => $recipes,
            'recipe_count' => $recipe_count,
            'blog_count' => $blog_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'ingredient_count' => $ingredient_count,
            'personnel_count' => $personnel_count,
            'dish_count' => $dish_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'post_count' => $post_count,
            'policy_count' => $policy_count,
            'position_count' => $position_count,
            'table_count' => $table_count,
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
        $dishs = Dish::all();
        $ingredients = Ingredient::all();
        $company = Company::first();
        $position_count = Position::count();
        $recipe_count = Recipe::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $ingredient_count = Ingredient::count();
        $blog_count = Blog::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        return view('admin.recipe.add')->with([
            'company' => $company,
            'recipe_count' => $recipe_count,
            'dishs' => $dishs,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'ingredients' => $ingredients,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'ingredient_count' => $ingredient_count,
            'dish_count' => $dish_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'position_count' => $position_count,
            'blog_count' => $blog_count,
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
    public function store(RecipeRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'dish_id' => $request->dish_id,
                'ingredient_id' => $request->ingredient_id,
                'quantity' => $request->quantity,
                'user_id' => Auth::user()->id
            ];
            $recipe = Recipe::create($data);
            DB::commit();
            return redirect()->route('recipes.index');
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
        $recipe = Recipe::find($id);
        if ($recipe) {
            $dishs = Dish::all();
            $ingredients = Ingredient::all();
            $company = Company::first();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $personnel_count = Personnel::count();
            $blog_count = Blog::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $dish_count = Dish::count();
            $position_count = Position::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $post_count = Post::count();
            $policy_count = Policy::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            return view('admin.recipe.edits')->with([
                'company' => $company,
                'recipe' => $recipe,
                'dishs' => $dishs,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'ingredients' => $ingredients,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'personnel_count' => $personnel_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'dish_count' => $dish_count,
                'post_count' => $post_count,
                'position_count' => $position_count,
                'table_count' => $table_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('recipes.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecipeRequest $request, $id)
    {
        try {
            $recipe = Recipe::find($id);
            if ($recipe) {
                DB::beginTransaction();
                $data = [
                    'dish_id' => $request->dish_id,
                    'ingredient_id' => $request->ingredient_id,
                    'quantity' => $request->quantity,
                    'user_id' => Auth::user()->id
                ];
                $recipe = $$recipe->update($data);
                DB::commit();
                return redirect()->route('recipes.index');
            } else {
                return redirect()->route('recipes.index');
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
            $recipe = Recipe::find($id);
            if ($recipe) {
                DB::beginTransaction();
                $recipe->delete();
                DB::commit();
                return redirect()->route('recipes.index');
            } else {
                return redirect()->route('recipes.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
