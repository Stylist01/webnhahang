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
use App\Model\Post;
use App\Model\Recipe;
use App\Model\Personnel;
use App\Model\Contact;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Contactbill;
use App\Model\Blog;
use App\Model\Bill;
use App\Model\Policy;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\PolicyRequest;


class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Policy::all();
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $post_count = Post::count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $recipe_count = Recipe::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.policy.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'policies' => $policies,
            'post_count' => $post_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'personnel_count' => $personnel_count,
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
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $dish_count = Dish::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.policy.add')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'blog_count' => $blog_count,
            'personnel_count' => $personnel_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'post_count' => $post_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PolicyRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'content' => $request->content,
                'name_link' => convert_name($request->name),
                'user_id' => Auth::user()->id
            ];
            $policy = Policy::create($data);
            DB::commit();
            return redirect()->route('policies.index');
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
        $policy = Policy::find($id);
        if ($policy) {
            $policy_count = Policy::count();
            $blog_count = Blog::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $company = Company::first();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $dish_count = Dish::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.policy.edit')->with([
                'company' => $company,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'personnel_count' => $personnel_count,
                'post_count' => $post_count,
                'policy' => $policy,
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
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('policies.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PolicyRequest $request, $id)
    {
        try {
            $policy = Policy::find($id);
            if ($policy) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'content' => $request->content,
                    'name_link' => convert_name($request->name),
                    'user_id' => Auth::user()->id
                ];
                $policy = $policy->update($data);
                DB::commit();
                return redirect()->route('policies.index');
            } else {
                return redirect()->route('policies.index');
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
            $policy = Policy::find($id);
            if ($policy) {
                $policy = $policy->delete();
                DB::commit();
                return redirect()->route('policies.index');
            } else {
                return redirect()->route('policies.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
