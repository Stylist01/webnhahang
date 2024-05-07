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
use App\Model\Timekeeping;
use App\Traits\StorageImageTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;

class TimekeepingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $personnel = Personnel::query();
        $timekeepings = Timekeeping::query();
        if ($request) {
            $search = $request->input('search');
            $personnel = $personnel
                ->where('id', $search);
        }
        $personnel = $personnel->get();
        $timekeepings = $timekeepings
            ->where('personnel_id', $personnel->id)
            ->whereMonth('day', Carbon::now()->month());
        $timekeepings = $timekeepings->get();
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
        return view('admin.timekeeping.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
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
            'timekeepings' => $timekeepings,
            'personnels' => Personnel::all(),
            'personnel' => $personnel,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
