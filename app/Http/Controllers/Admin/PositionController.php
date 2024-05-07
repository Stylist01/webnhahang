<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Dish;
use App\Model\Blog;
use App\Model\Position;
use App\Model\Personnel;
use App\Model\Ingredient;
use App\Model\Recipe;
use App\Model\Bill;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Post;
use App\Model\Policy;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\PositionRequest;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::all();
        $company = Company::first();
        $category_count = Category::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $blog_count = Blog::count();
        $personnel_count = Personnel::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.position.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'blog_count' => $blog_count,
            'positions' => $positions,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'policy_count' => $policy_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'personnel_count' => $personnel_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'post_count' => $post_count,
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
        $policy_count = Policy::count();
        $post_count = Post::count();
        $dish_count = Dish::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $ingredient_count = Ingredient::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $position_count = Position::count();
        return view('admin.position.add')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'post_count' => $post_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'recipe_count' => $recipe_count,
            'personnel_count' => $personnel_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'ingredient_count' => $ingredient_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'position_count' => $position_count,
            'blog_count' => $blog_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'wage' => $request->wage,
                'user_id' => Auth::user()->id
            ];
            $position = Position::create($data);
            DB::commit();
            return redirect()->route('positions.index');
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
        $position = Position::find($id);
        if ($position) {
            $company = Company::first();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $post_count = Post::count();
            $personnel_count = Personnel::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $policy_count = Policy::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $blog_count = Blog::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.position.edit')->with([
                'company' => $company,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'recipe_count' => $recipe_count,
                'personnel_count' => $personnel_count,
                'blog_count' => $blog_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'policy_count' => $policy_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'position' => $position,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('positions.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        try {
            $position = Position::find($id);
            if ($position) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'wage' => $request->wage,
                    'user_id' => Auth::user()->id
                ];
                $position = $position->update($data);
                DB::commit();
                return redirect()->route('positions.index');
            } else {
                return redirect()->route('positions.index');
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
            $position = Position::find($id);
            if ($position) {
                DB::beginTransaction();
                $position = $position->delete();
                DB::commit();
                return redirect()->route('positions.index');
            } else {
                return redirect()->route('positions.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
