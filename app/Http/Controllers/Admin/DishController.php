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
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Personnel;
use App\Model\Recipe;
use App\Model\Ingredient;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\DishRequest;

class DishController extends Controller
{
    use StorageImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $dishs = Dish::all();
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
        return view('admin.dish.index')->with([
            'company' => $company,
            'dishs' => $dishs,
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
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
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
        $categories = Category::all();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $post_count = Post::count();
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $position_count = Position::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        return view('admin.dish.add')->with([
            'company' => $company,
            'categories' => $categories,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'recipe_count' => $recipe_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DishRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DishRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'name_link' => convert_name($request->name)
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image', 'dish');
            if (!empty($dataUploadImage)) {
                $data['image'] = $dataUploadImage['file_path'];
            }
            $dish = Dish::create($data);
            DB::commit();
            return redirect()->route('dishs.index');
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
        $dish = Dish::find($id);
        if ($dish) {
            $company = Company::first();
            $categories = Category::all();
            $dish_count = Dish::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $category_count = Category::count();
            $personnel_count = Personnel::count();
            $position_count = Position::count();
            $blog_count = Blog::count();
            $table_count = Table::where('status', 0)->count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            return view('admin.dish.edit')->with([
                'company' => $company,
                'dish' => $dish,
                'categories' => $categories,
                'position_count' => $position_count,
                'policy_count' => $policy_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'dish_count' => $dish_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'personnel_count' => $personnel_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'blog_count' => $blog_count,
                'table_count' => $table_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('dishs.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DishRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DishRequest $request, $id)
    {
        try {
            $dish = Dish::find($id);
            if ($dish) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'price' => $request->price,
                    'content' => $request->content,
                    'category_id' => $request->category_id,
                    'user_id' => Auth::user()->id,
                    'name_link' => convert_name($request->name)
                ];
                $dataUploadImage = $this->storageTraitUpload($request, 'image', 'dish');
                if (!empty($dataUploadImage)) {
                    $data['image'] = $dataUploadImage['file_path'];
                }
                $dish = $dish->update($data);
                DB::commit();
                return redirect()->route('dishs.index');
            } else {
                return redirect()->route('dishs.index');
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
            $dish = Dish::find($id);
            if ($dish) {
                DB::beginTransaction();
                $dish->delete();
                DB::commit();
                return redirect()->route('dishs.index');
            } else {
                return redirect()->route('dishs.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
