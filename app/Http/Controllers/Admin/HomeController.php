<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Company;
use App\Model\Category;
use App\Model\Table;
use App\Model\Blog;
use App\Model\Position;
use App\Model\Bill;
use App\Model\Dish;
use App\Model\Contact;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Contactbill;
use App\Model\Post;
use App\Model\Personnel;
use App\Model\Ingredient;
use App\Model\Recipe;
use App\Model\Policy;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $post_count = Post::count();
        $dish_count = Dish::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $personnel_count = Personnel::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $policy_count = Policy::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();

        $bill_chart = DB::table('bills')
            ->select(DB::raw('date(updated_at) as getYear'), DB::raw('COUNT(*) as value'))
            ->groupBy(DB::raw('date(updated_at)'))
            ->orderBy('updated_at', 'ASC')
            ->get();

        $contactbill_chart = DB::table('contactbills')
            ->select(DB::raw('date(updated_at) as getYear'), DB::raw('COUNT(*) as value'))
            ->groupBy(DB::raw('date(updated_at)'))
            ->orderBy('updated_at', 'ASC')
            ->get();

        $setbill_chart = DB::table('setbills')
            ->select(DB::raw('date(updated_at) as getYear'), DB::raw('COUNT(*) as value'))
            ->groupBy(DB::raw('date(updated_at)'))
            ->orderBy('updated_at', 'ASC')
            ->get();

        $dishbill_chart = DB::table('details')
            ->leftJoin('dishes', 'details.dish_id', '=', 'dishes.id')
            ->select('name', DB::raw("SUM(quantily) as y"))
            ->groupBy('dish_id', 'name')
            ->get();

        $dishcontactbill_chart = DB::table('contactdetails')
            ->leftJoin('dishes', 'contactdetails.dish_id', '=', 'dishes.id')
            ->select('name', DB::raw("SUM(quantily) as y"))
            ->groupBy('dish_id', 'name')
            ->get();

        $dishsetbill_chart = DB::table('setdetails')
            ->leftJoin('dishes', 'setdetails.dish_id', '=', 'dishes.id')
            ->select('name', DB::raw("SUM(quantily) as y"))
            ->groupBy('dish_id', 'name')
            ->get();

        return view('admin.home')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'position_count' => $position_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'contact_count' => $contact_count,
            'bill_count' => Bill::count(),
            'setbill_count' => Setbill::count(),
            'contactbill_count' => $contactbill_count,
            'total_money' => Contactbill::sum('total_money') + Setbill::sum('total_money') + Bill::sum('total_money'),
            'bill_count_activated' => $bill_count_activated,
            'personnel_count' => $personnel_count,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'ingredient_count' => $ingredient_count,
            'setbill_chart' => $setbill_chart,
            'contactbill_chart' => $contactbill_chart,
            'bill_chart' => $bill_chart,
            'dishbill_chart' => $dishbill_chart,
            'dishsetbill_chart' => $dishsetbill_chart,
            'dishcontactbill_chart' => $dishcontactbill_chart,
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
