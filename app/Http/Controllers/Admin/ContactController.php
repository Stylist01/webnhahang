<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Company;
use App\Model\Table;
use App\Model\Position;
use App\Model\Dish;
use App\Model\Policy;
use App\Model\Blog;
use App\Model\Bill;
use App\Model\Contact;
use App\Model\Contactbill;
use App\Model\Contactdetail;
use App\Model\Post;
use App\Model\Personnel;
use App\Model\Set;
use App\Model\Setbill;
use App\Model\Recipe;
use App\Model\Ingredient;
use App\Traits\StorageImageTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response as HttpResponse;
use PDF;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::first();
        $contacts = Contact::all();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.contact.index')->with([
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'company' => $company,
            'contacts' => $contacts,
            'dish_count' => $dish_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'table_count' => $table_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
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
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.contact.add')->with([
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'company' => $company,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'category_count' => $category_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'message' => $request->message,
                'activated' => 1
            ];
            $contact = Contact::create($data);
            DB::commit();
            return redirect()->route('contacts.index');
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
        $contact = Contact::find($id);
        if ($contact) {
            $company = Company::first();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.contact.edit')->with([
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'company' => $company,
                'contact' => $contact,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'recipe_count' => $recipe_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'category_count' => $category_count
            ]);
        } else {
            return redirect()->route('contacts.index');
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
            $contact = Contact::find($id);
            if ($contact) {
                DB::beginTransaction();
                $data = [
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'message' => $request->message,
                    'activated' => 1
                ];
                $contact = $contact->update($data);
                DB::commit();
                return redirect()->route('contacts.index');
            } else {
                return redirect()->route('contacts.index');
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
            $contact = Contact::find($id);
            if ($contact) {
                DB::beginTransaction();
                $contact = $contact->delete();
                DB::commit();
                return redirect()->route('contacts.index');
            } else {
                return redirect()->route('contacts.index');
            }
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function contactbill($id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'contact_id' => $id,
                'user_id' => Auth::user()->id
            ];
            $contactbill_id = Contactbill::create($data)->id;
            DB::commit();
            $company = Company::first();
            $contacts = Contact::all();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.contact.contactbill')->with([
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'company' => $company,
                'contacts' => $contacts,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'recipe_count' => $recipe_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'contactdetails' => Contactdetail::all(),
                'dishs' => Dish::all(),
                'personnels' => Personnel::query()->where('position_id', 4)->get(),
                'contactbill_id' => $contactbill_id,
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function contactdetail(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            $data = [
                'contactbill_id' => $request->contactbill_id,
                'dish_id' => $request->dish_id,
                'quantily' => $request->quantily
            ];
            $contactdetail = Contactdetail::create($data);
            DB::commit();
            $company = Company::first();
            $contacts = Contact::all();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.contact.contactbill')->with([
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'company' => $company,
                'contacts' => $contacts,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'recipe_count' => $recipe_count,
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'contactdetails' => Contactdetail::all(),
                'dishs' => Dish::all(),
                'personnels' => Personnel::query()->where('position_id', 4)->get(),
                'contactbill_id' => $data['contactbill_id'],
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function contactpersonnel(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            $data = [
                'personnel_id' => $request->personnel_id
            ];
            $contact = Contactbill::find($request->id)->update($data);
            DB::commit();
            $company = Company::first();
            $contacts = Contact::all();
            $contact_count = Contact::where('activated', 0)->count();
            $contactbill_count = Contactbill::count();
            $dish_count = Dish::count();
            $category_count = Category::count();
            $table_count = Table::where('status', 0)->count();
            $personnel_count = Personnel::count();
            $policy_count = Policy::count();
            $post_count = Post::count();
            $bill_count_payment = Bill::where('payment', 0)->count();
            $bill_count_activated = Bill::where('activated', 0)->count();
            $recipe_count = Recipe::count();
            $blog_count = Blog::count();
            $position_count = Position::count();
            $ingredient_count = Ingredient::count();
            return view('admin.contact.contactbill')->with([
                'contact_count' => $contact_count,
                'contactbill_count' => $contactbill_count,
                'company' => $company,
                'contacts' => $contacts,
                'dish_count' => $dish_count,
                'table_count' => $table_count,
                'recipe_count' => $recipe_count,
                'set_count_activated' => Set::where('activated', 0)->count(),
                'set_count_status' => Set::where('status', 0)->count(),
                'setbill_count_payment' => Setbill::where('payment', 0)->count(),
                'bill_count_payment' => $bill_count_payment,
                'bill_count_activated' => $bill_count_activated,
                'post_count' => $post_count,
                'blog_count' => $blog_count,
                'policy_count' => $policy_count,
                'personnel_count' => $personnel_count,
                'position_count' => $position_count,
                'ingredient_count' => $ingredient_count,
                'contactdetails' => Contactdetail::all(),
                'dishs' => Dish::all(),
                'personnels' => Personnel::query()->where('position_id', 4)->get(),
                'contactbill_id' => $request->id,
                'category_count' => $category_count
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function print($id)
    {
        $dt = Carbon::now()->toDateTimeString();
        $datetime = $dt;
        $dt = str_replace("-", "", $dt);
        $dt = str_replace(":", "", $dt);
        $dt = str_replace(" ", "_", $dt);
        $data =
            [
                'contactbill' => Contactbill::find($id),
                'contactdetails' => Contactdetail::all(),
                'contactbills' => Contactbill::all(),
                'dishs' => Dish::all(),
                'personnels' => Personnel::all(),
                'company' => Company::first(),
                'dt' => $dt,
                'datetime' => $datetime,
            ];
        $pdf = PDF::loadView('admin/contact/print', $data);
        return $pdf->stream('pdf.pdf');
    }

    public function activated($id, $check)
    {
        try {
            DB::beginTransaction();
            if ($check == 0) {
                $check = 1;
            } else {
                $check = 0;
            }
            $data = [
                'activated' => $check,
            ];
            $contact = Contact::find($id)->update($data);
            DB::commit();
            return redirect()->route('contacts.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' ---Line: ' . $exception->getLine());
            return HttpResponse::HTTP_NOT_FOUND;
        }
    }

    public function bill()
    {
        $company = Company::first();
        $contactbills = Contactbill::all();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.contactbill.bill')->with([
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'company' => $company,
            'contactbills' => $contactbills,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'blog_count' => $blog_count,
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'contactdetails' => Contactdetail::all(),
            'dishs' => Dish::all(),
            'personnels' => Personnel::all(),
            'category_count' => $category_count
        ]);
    }

    public function detail($id)
    {
        $company = Company::first();
        $contacts = Contact::all();
        $contact_count = Contact::where('activated', 0)->count();
        $contactbill_count = Contactbill::count();
        $dish_count = Dish::count();
        $category_count = Category::count();
        $table_count = Table::where('status', 0)->count();
        $personnel_count = Personnel::count();
        $policy_count = Policy::count();
        $post_count = Post::count();
        $bill_count_payment = Bill::where('payment', 0)->count();
        $bill_count_activated = Bill::where('activated', 0)->count();
        $recipe_count = Recipe::count();
        $blog_count = Blog::count();
        $position_count = Position::count();
        $ingredient_count = Ingredient::count();
        return view('admin.contactbill.detail')->with([
            'contact_count' => $contact_count,
            'contactbill_count' => $contactbill_count,
            'company' => $company,
            'contacts' => $contacts,
            'dish_count' => $dish_count,
            'table_count' => $table_count,
            'recipe_count' => $recipe_count,
            'bill_count_payment' => $bill_count_payment,
            'bill_count_activated' => $bill_count_activated,
            'post_count' => $post_count,
            'blog_count' => $blog_count,
            'set_count_activated' => Set::where('activated', 0)->count(),
            'set_count_status' => Set::where('status', 0)->count(),
            'setbill_count_payment' => Setbill::where('payment', 0)->count(),
            'policy_count' => $policy_count,
            'personnel_count' => $personnel_count,
            'position_count' => $position_count,
            'ingredient_count' => $ingredient_count,
            'contactdetails' => Contactdetail::all(),
            'contactbill' => Contactbill::find($id),
            'dishs' => Dish::all(),
            'personnels' => Personnel::all(),
            'category_count' => $category_count
        ]);
    }
}
