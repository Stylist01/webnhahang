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
use App\Model\Recipe;
use App\Model\Post;
use App\Model\Blog;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Bill;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Policy;
use App\Model\Personnel;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\PersonnelRequest;
use App\Jobs\SendMailJob;
use App\Model\Commune;
use App\Model\District;
use App\Model\Province;
use App\Model\Timekeeping;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PersonnelController extends Controller
{
    use StorageImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnels = Personnel::all();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $policy_count = Policy::count();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $blog_count = Blog::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $company = Company::first();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.personnel.index')->with([
            'company' => $company,
            'table_count' => $table_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'dish_count' => $dish_count,
            'personnels' => $personnels,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'policy_count' => $policy_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'blog_count' => $blog_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'personnel_count' => $personnel_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function showDistrict(Request $request)
    {
        if ($request->ajax()) {
            $districts = District::where('province_id', $request->province_id)->select('id', 'name')->get();

            return response()->json($districts);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function showCommune(Request $request)
    {
        if ($request->ajax()) {
            $communes = Commune::where('district_id', $request->district_id)->select('id', 'name')->get();

            return response()->json($communes);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Position::all();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $company = Company::first();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.personnel.add')->with([
            'company' => $company,
            'positions' => $positions,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'post_count' => $post_count,
            'provinces' => Province::all(),
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'blog_count' => $blog_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'personnel_count' => $personnel_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonnelRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'sex' => $request->sex,
                'age' => $request->age,
                'commune_id' => $request->commune_id,
                'district_id' => $request->district_id,
                'province_id' => $request->province_id,
                'phone' => $request->phone,
                'email' => $request->email,
                'bank' => $request->bank,
                'account_number' => $request->account_number,
                'position_id' => $request->position_id,
                'user_id' => Auth::user()->id
            ];
            $dataUploadImage = $this->storageTraitUpload($request, 'image', 'personnel');
            if (!empty($dataUploadImage)) {
                $data['image'] = $dataUploadImage['file_path'];
            }
            $personnel = Personnel::create($data);
            DB::commit();
            return redirect()->route('personnels.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personnel = Personnel::find($id);
        if ($personnel) {
            $personnel_count = Personnel::count();
            $post_count = Post::count();
            $policy_count = Policy::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $positions = Position::all();
            $blog_count = Blog::count();
            $company = Company::first();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $dish_count = Dish::count();
            $recipe_count = Recipe::count();
            $ingredient_count = Ingredient::count();
            $position_count = Position::count();
            return view('admin.personnel.edit')->with([
                'company' => $company,
                'table_count' => $table_count,
                'dish_count' => $dish_count,
                'personnel' => $personnel,
                'provinces' => Province::all(),
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'positions' => $positions,
                'post_count' => $post_count,
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'policy_count' => $policy_count,
                'blog_count' => $blog_count,
                'recipe_count' => $recipe_count,
                'ingredient_count' => $ingredient_count,
                'position_count' => $position_count,
                'personnel_count' => $personnel_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('personnels.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonnelRequest $request, $id)
    {
        try {
            $personnel = Personnel::find($id);
            if ($personnel) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'sex' => $request->sex,
                    'age' => $request->age,
                    'commune_id' => $request->commune_id,
                    'district_id' => $request->district_id,
                    'province_id' => $request->province_id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'bank' => $request->bank,
                    'account_number' => $request->account_number,
                    'position_id' => $request->position_id,
                    'user_id' => Auth::user()->id
                ];
                $dataUploadImage = $this->storageTraitUpload($request, 'image', 'personnel');
                if (!empty($dataUploadImage)) {
                    $data['image'] = $dataUploadImage['file_path'];
                }
                $personnel = $personnel->update($data);
                DB::commit();
                return redirect()->route('personnels.index');
            } else {
                return redirect()->route('personnels.index');
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
            $personnel = Personnel::find($id);
            if ($personnel) {
                DB::beginTransaction();
                $personnel->delete();
                DB::commit();
                return redirect()->route('personnels.index');
            } else {
                return redirect()->route('personnels.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountCreate($id)
    {
        $positions = Position::all();
        $personnel_count = Personnel::count();
        $post_count = Post::count();
        $policy_count = Policy::count();
        $blog_count = Blog::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $company = Company::first();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $dish_count = Dish::count();
        $recipe_count = Recipe::count();
        $ingredient_count = Ingredient::count();
        $position_count = Position::count();
        return view('admin.personnel.accountAdd')->with([
            'company' => $company,
            'positions' => $positions,
            'table_count' => $table_count,
            'dish_count' => $dish_count,
            'post_count' => $post_count,
            'personnel' => Personnel::find($id),
            'provinces' => Province::all(),
            'roles' => Role::query()->where('id', '<>', 1)->get(),
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'policy_count' => $policy_count,
            'blog_count' => $blog_count,
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'recipe_count' => $recipe_count,
            'ingredient_count' => $ingredient_count,
            'position_count' => $position_count,
            'personnel_count' => $personnel_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function accountStore(Request $request, $id)
    {
        try {
            $personnel = Personnel::find($id);
            DB::beginTransaction();
            $data = [
                'name' => $personnel->name,
                'email' => $personnel->email,
                'role_id' => $request->role_id,
                'password' => Hash::make($request->password)
            ];
            $user = User::create($data);
            $sendMailJob = (new SendMailJob($personnel));
            dispatch($sendMailJob);
            DB::commit();
            return redirect()->route('personnels.index');
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
    public function accountDestroy($id)
    {
        try {
            $personnel = Personnel::find($id);
            $user = User::query()->where('email', $personnel->email)->first();
            if ($user) {
                DB::beginTransaction();
                $user->delete();
                DB::commit();
                return redirect()->route('personnels.index');
            } else {
                return redirect()->route('personnels.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function timekeeping($id)
    {
        $personnel = Personnel::find($id);
        $timekeepings = Timekeeping::query()->where('personnel_id', $id)->get();
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
        return view('admin.personnel.timekeeping')->with([
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
            'personnel' => $personnel,
            'category_count' => $category_count
        ]);
    }

    public function checkin($id)
    {
        try {
            DB::beginTransaction();        
            $data = [
                'personnel_id' => $id,
                'day' => Carbon::now()->toDateString(),
                'begin' => Carbon::now()->toTimeString()
            ];
            $timekeeping = Timekeeping::create($data);
            DB::commit();
            return redirect()->route('personnels.timekeeping', ['id' => $id]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function checkout($id,$personnel_id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'end' => Carbon::now()->toTimeString()
            ];
            $timekeeping = Timekeeping::find($id)->update($data);
            DB::commit();
            return redirect()->route('personnels.timekeeping', ['id' => $personnel_id]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }
}
