<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Bill;
use App\Model\Dish;
use App\Model\Position;
use App\Model\Ingredient;
use App\Model\Recipe;
use App\Model\Post;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Blog;
use App\Model\Policy;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Personnel;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    use StorageImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        $blog_count = Blog::count();
        $company = Company::first();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $category_count = Category::count();
        $policy_count = Policy::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.blog.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'blogs' => $blogs,
            'personnel_count' => $personnel_count,
            'post_count' => $post_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'base_url' => 'http://lizardon.com',
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
        $blog_count = Blog::count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $dish_count = Dish::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $post_count = Post::count();
        $recipe_count = Recipe::count();
        $policy_count = Policy::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.blog.add')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'post_count' => $post_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'personnel_count' => $personnel_count,
            'policy_count' => $policy_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'user_id' => Auth::user()->id
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image', 'blog');
            if (!empty($dataUploadImage)) {
                $data['image'] = $dataUploadImage['file_path'];
            }
            $blog = Blog::create($data);
            DB::commit();
            return redirect()->route('blogs.index');
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
        $blog = Blog::find($id);
        if ($blog) {
            $blog_count = Blog::count();
            $company = Company::first();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $dish_count = Dish::count();
            $post_count = Post::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $policy_count = Policy::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.blog.edit')->with([
                'company' => $company,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'blog' => $blog,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('blogs.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        try {
            $blog = Blog::find($id);
            if ($blog) {
                DB::beginTransaction();
                $data = [
                    'user_id' => Auth::user()->id
                ];
                $dataUploadImage = $this->storageTraitUpload($request, 'image', 'blog');
                if (!empty($dataUploadImage)) {
                    $data['image'] = $dataUploadImage['file_path'];
                }
                $blog = $blog->update($data);
                DB::commit();
                return redirect()->route('blogs.index');
            } else {
                return redirect()->route('blogs.index');
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
            $blog = Blog::find($id);
            if ($blog) {
                DB::beginTransaction();
                $blog = $blog->delete();
                DB::commit();
                return redirect()->route('blogs.index');
            } else {
                return redirect()->route('blogs.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
