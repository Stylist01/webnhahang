<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Model\Company;
use App\Model\Blog;
use App\Model\Position;
use App\Model\Post;
use App\Model\Bill;
use App\Model\Policy;
use App\Model\Category;
use App\Model\Dish;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Personnel;
use App\Model\Table;
use App\Model\Recipe;
use App\Model\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response as HttpResponse;

class CompanyController extends Controller
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
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $post_count = Post::count();
        $dish_count = Dish::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        $blog_count = Blog::count();
        $recipe_count = Recipe::count();
        return view('admin.company.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'recipe_count' => $recipe_count,
            'policy_count' => $policy_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'personnel_count' => $personnel_count,
            'post_count' => $post_count,
            'position_count' => $position_count,
            'blog_count' => $blog_count,
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
        $company = Company::find($id);
        if ($company) {
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $blog_count = Blog::count();
            $policy_count = Policy::count();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $post_count = Post::count();
            $personnel_count = Personnel::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $dish_count = Dish::count();
            $position_count = Position::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            return view('admin.company.edit')->with([
                'company' => $company,
                'table_count' => $table_count,
                'position_count' => $position_count,
                'recipe_count' => $recipe_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'blog_count' => $blog_count,
                'post_count' => $post_count,
                'dish_count' => $dish_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'ingredient_count' => $ingredient_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('companies.index');
        }
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
        try {
            $company = Company::find($id);
            if ($company) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'description' => $request->description,
                    'content' => $request->content,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'bank' => $request->bank,
                    'account_number' => $request->account_number,
                    'user_id' => Auth::user()->id
                ];
                $dataUploadImage = $this->storageTraitUpload($request, 'image', 'company');
                if (!empty($dataUploadImage)) {
                    $data['image'] = $dataUploadImage['file_path'];
                }
                $dataUploadLogo = $this->storageTraitUpload($request, 'logo', 'company');
                if (!empty($dataUploadLogo)) {
                    $data['logo'] = $dataUploadLogo['file_path'];
                }
                $company = $company->update($data);
                DB::commit();
                return redirect()->route('companies.index');
            } else {
                return redirect()->route('companies.index');
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
        //
    }
}
