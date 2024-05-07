<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Policy;
use App\Model\Position;
use App\Model\Dish;
use App\Model\Blog;
use App\Model\Personnel;
use App\Model\Bill;
use App\Model\Post;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Ingredient;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Recipe;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        $categories = Category::all();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $blog_count = Blog::count();
        $dish_count = Dish::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $recipe_count = Recipe::count();
        $position_count = Position::count();
        $policy_count = Policy::count();
        $ingredient_count = Ingredient::count();
        return view('admin.category.index')->with([
            'company' => $company,
            'categories' => $categories,
            'table_count' => $table_count,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'bill_count_payment' => $bill_count_payment,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'dish_count' => $dish_count,
            'recipe_count' => $recipe_count,
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
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $personnel_count = Personnel::count();
        $position_count = Position::count();
        $blog_count = Blog::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $policy_count = Policy::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        return view('admin.category.add')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'personnel_count' => $personnel_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'position_count' => $position_count,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'user_id' => Auth::user()->id,
                'name_link' => convert_name($request->name)
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image', 'category');
            if (!empty($dataUploadImage)) {
                $data['image'] = $dataUploadImage['file_path'];
            }
            $category = Category::create($data);
            DB::commit();
            return redirect()->route('categories.index');
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
        $category = Category::find($id);
        if ($category) {
            $company = Company::first();
            $personnel_count = Personnel::count();
            $blog_count = Blog::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $post_count = Post::count();
            $category_count = Category::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $policy_count = Policy::count();
            $position_count = Position::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            return view('admin.category.edit')->with([
                'company' => $company,
                'category_count' => $category_count,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'policy_count' => $policy_count,
                'post_count' => $post_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'category' => $category
            ]);
        } else {
            return redirect()->route('categories.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            if ($category) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'user_id' => Auth::user()->id,
                    'name_link' => convert_name($request->name)
                ];
                $dataUploadImage = $this->storageTraitUpload($request, 'image', 'category');
                if (!empty($dataUploadImage)) {
                    $data['image'] = $dataUploadImage['file_path'];
                }
                $category = $category->update($data);
                DB::commit();
                return redirect()->route('categories.index');
            } else {
                return redirect()->route('categories.index');
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
            $category = Category::find($id);
            if ($category) {
                DB::beginTransaction();
                $category->delete();
                DB::commit();
                return redirect()->route('categories.index');
            } else {
                return redirect()->route('categories.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
