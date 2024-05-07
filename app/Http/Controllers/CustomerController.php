<?php

namespace App\Http\Controllers;

use App\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * @var string
     */
    protected $pathView = 'customer.';

    public function login()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('home');
        }
        return view($this->pathView.'login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('home')->with(['success' => 'Đăng nhập thành công']);
        }
        return redirect()->back()->with([
            'error' => 'Tài khoản hoặc mật khẩu không đúng',
        ]);
    }

    public function register()
    {
        if (Auth::guard('customer')->check()) {
            return back()->withInput();
        }
        return view($this->pathView.'register');
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
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => Hash::make($request->input('password')),
            ];
            $customer = Customer::create($data);
            DB::commit();
            $credentials = $request->only([
                'email',
                'password'
            ]);
            if (Auth::guard('customer')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('home')->with(['success' => 'Đăng nhập thành công']);
            }
        } catch (Exception $e) {
            Log::error('[CustomerController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Đăng ký thất bại']);
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

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }
}
