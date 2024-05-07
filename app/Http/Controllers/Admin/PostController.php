<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Dish;
use App\Model\Position;
use App\Model\Bill;
use App\Model\Ingredient;
use App\Model\Recipe;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Post;
use App\Model\Personnel;
use App\Model\Blog;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Policy;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    use StorageImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $post_count = Post::count();
        $policy_count = Policy::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $blog_count = Blog::count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $personnel_count = Personnel::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.post.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'posts' => $posts,
            'post_count' => $post_count,
            'policy_count' => $policy_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'personnel_count' => $personnel_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
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
        $post_count = Post::count();
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $personnel_count = Personnel::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $position_count = Position::count();
        return view('admin.post.add')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'post_count' => $post_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'blog_count' => $blog_count,
            'personnel_count' => $personnel_count,
            'recipe_count' => $recipe_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
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
    public function store(PostRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'content' => $request->content,
                'name_link' => convert_name($request->name),
                'user_id' => Auth::user()->id
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image', 'post');
            if (!empty($dataUploadImage)) {
                $data['image'] = $dataUploadImage['file_path'];
            }
            $post = Post::create($data);
            DB::commit();
            return redirect()->route('posts.index');
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
        $post = Post::find($id);
        if ($post) {
            $post_count = Post::count();
            $policy_count = Policy::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $blog_count = Blog::count();
            $personnel_count = Personnel::count();
            $company = Company::first();
            $category_count = Category::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.post.edit')->with([
                'company' => $company,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'post_count' => $post_count,
                'post' => $post,
                'policy_count' => $policy_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'personnel_count' => $personnel_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('posts.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        try {
            $post = Post::find($id);
            if ($post) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'description' => $request->description,
                    'content' => $request->content,
                    'name_link' => convert_name($request->name),
                    'user_id' => Auth::user()->id
                ];
                $dataUploadImage = $this->storageTraitUpload($request, 'image', 'post');
                if (!empty($dataUploadImage)) {
                    $data['image'] = $dataUploadImage['file_path'];
                }
                $post = $post->update($data);
                DB::commit();
                return redirect()->route('posts.index');
            } else {
                return redirect()->route('posts.index');
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
            $post = Post::find($id);
            if ($post) {
                DB::beginTransaction();
                $post->delete();
                DB::commit();
                return redirect()->route('posts.index');
            } else {
                return redirect()->route('posts.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
