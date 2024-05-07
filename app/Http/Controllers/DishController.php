<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Company;
use App\Model\Dish;
use App\Model\Category;
use App\Model\Policy;
use App\Model\Blog;
use Illuminate\Support\Facades\DB;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dish_category = DB::table('dishes')
            ->leftJoin('categories', 'dishes.category_id', '=', 'categories.id')
            ->select('categories.name as category_name' ,DB::raw('COUNT(*) as value'))
            ->groupBy('category_id','categories.name')
            ->get();
        return view('dish.index')->with([
            'dishs' => Dish::all(),
            'categories' => Category::all(),
            'company' => Company::first(),
            'policies' => Policy::all(),
            'blogs' => Blog::all(),
            'dish_category' => $dish_category
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
    public function show($id, $name_link)
    {
        $dish = Dish::find($id);
        return view('dish.show')->with([
            'dishs' => Dish::query()->where('id', '<>', $id)->where('category_id', $dish->category_id)->get(),
            'dish' => $dish,
            'categories' => Category::all(),
            'company' => Company::first(),
            'policies' => Policy::all()
        ]);
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
