<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('/gioi-thieu', [
    'as' => 'companies.index',
    'uses' => 'CompanyController@index'
]);

Route::get('/chinh-sach-{id}-{name_link}', [
    'as' => 'policies.show',
    'uses' => 'PolicyController@show'
]);

Route::prefix('mon-an')->group(function () {
    Route::get('/', [
        'as' => 'dishs.index',
        'uses' => 'DishController@index'
    ]);
    Route::get('/{id}-{name_link}', [
        'as' => 'dishs.show',
        'uses' => 'DishController@show'
    ]);
});

Route::prefix('tin-tuc')->group(function () {
    Route::get('/', [
        'as' => 'posts.index',
        'uses' => 'PostController@index'
    ]);
    Route::get('/{id}-{name_link}', [
        'as' => 'posts.show',
        'uses' => 'PostController@show'
    ]);
});

Route::prefix('lien-he')->group(function () {
    Route::get('/', [
        'as' => 'contacts.index',
        'uses' => 'ContactController@index'
    ]);
    Route::post('/store', [
        'as' => 'contacts.store',
        'uses' => 'ContactController@store'
    ]);
});

Route::prefix('dat-ban')->group(function () {
    Route::get('/', [
        'as' => 'sets.index',
        'uses' => 'SetController@index'
    ]);
    Route::post('/store', [
        'as' => 'sets.store',
        'uses' => 'SetController@store'
    ]);
});

Route::get('/dang-nhap', [
    'as' => 'fe.login',
    'uses' => 'CustomerController@login'
]);

Route::post('/dang-nhap-post', [
    'as' => 'fe.post.login',
    'uses' => 'CustomerController@authenticate'
]);

Route::get('/dang-ky', [
    'as' => 'fe.register',
    'uses' => 'CustomerController@register'
]);

Route::post('/dang-ky-post', [
    'as' => 'fe.post.register',
    'uses' => 'CustomerController@store'
]);

Route::post('/dang-xuat-post', [
    'as' => 'fe.post.logout',
    'uses' => 'CustomerController@logout'
]);

Route::middleware('customer')->group(function () {
    Route::get('/gio-hang', [
        'as' => 'fe.cart',
        'uses' => 'CartController@index'
    ]);
    Route::post('/addCart', [
        'as' => 'addCart',
        'uses' => 'CartController@addCart'
    ]);
    Route::post('/deleteOneCart', [
        'as' => 'deleteOneCart',
        'uses' => 'CartController@deleteOneCart'
    ]);
    Route::post('/deleteAllCart', [
        'as' => 'deleteAllCart',
        'uses' => 'CartController@deleteAllCart'
    ]);
    Route::get('/thanh-toan/{order_id}', [
        'as' => 'fe.payment',
        'uses' => 'OrderController@payment'
    ]);
    Route::get('/don-hang', [
        'as' => 'fe.order',
        'uses' => 'OrderController@index'
    ]);
    Route::post('/getOrderDetail', [
        'as' => 'getOrderDetail',
        'uses' => 'OrderController@getOrderDetail'
    ]);
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [
        'as' => 'homes.index',
        'uses' => 'Admin\HomeController@index'
    ]);

    Route::prefix('categories')->group(function () {
        Route::get('/index', [
            'as' => 'categories.index',
            'uses' => 'Admin\CategoryController@index'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'Admin\CategoryController@create'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'Admin\CategoryController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'Admin\CategoryController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'Admin\CategoryController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'categories.destroy',
            'uses' => 'Admin\CategoryController@destroy'
        ]);
    });

    Route::prefix('companies')->group(function () {
        Route::get('/index', [
            'as' => 'companies.index',
            'uses' => 'Admin\CompanyController@index'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'companies.edit',
            'uses' => 'Admin\CompanyController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'companies.update',
            'uses' => 'Admin\CompanyController@update'
        ]);
    });

    Route::prefix('tables')->group(function () {
        Route::get('/index', [
            'as' => 'tables.index',
            'uses' => 'Admin\TableController@index'
        ]);
        Route::get('/create', [
            'as' => 'tables.create',
            'uses' => 'Admin\TableController@create'
        ]);
        Route::post('/store', [
            'as' => 'tables.store',
            'uses' => 'Admin\TableController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'tables.edit',
            'uses' => 'Admin\TableController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'tables.update',
            'uses' => 'Admin\TableController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'tables.destroy',
            'uses' => 'Admin\TableController@destroy'
        ]);
    });

    Route::prefix('dishs')->group(function () {
        Route::get('/index', [
            'as' => 'dishs.index',
            'uses' => 'Admin\DishController@index'
        ]);
        Route::get('/create', [
            'as' => 'dishs.create',
            'uses' => 'Admin\DishController@create'
        ]);
        Route::post('/store', [
            'as' => 'dishs.store',
            'uses' => 'Admin\DishController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'dishs.edit',
            'uses' => 'Admin\DishController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'dishs.update',
            'uses' => 'Admin\DishController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'dishs.destroy',
            'uses' => 'Admin\DishController@destroy'
        ]);
    });

    Route::prefix('ingredients')->group(function () {
        Route::get('/index', [
            'as' => 'ingredients.index',
            'uses' => 'Admin\IngredientController@index'
        ]);
        Route::get('/create', [
            'as' => 'ingredients.create',
            'uses' => 'Admin\IngredientController@create'
        ]);
        Route::post('/store', [
            'as' => 'ingredients.store',
            'uses' => 'Admin\IngredientController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'ingredients.edit',
            'uses' => 'Admin\IngredientController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'ingredients.update',
            'uses' => 'Admin\IngredientController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'ingredients.destroy',
            'uses' => 'Admin\IngredientController@destroy'
        ]);
    });

    Route::prefix('recipes')->group(function () {
        Route::get('/index', [
            'as' => 'recipes.index',
            'uses' => 'Admin\RecipeController@index'
        ]);
        Route::get('/create', [
            'as' => 'recipes.create',
            'uses' => 'Admin\RecipeController@create'
        ]);
        Route::post('/store', [
            'as' => 'recipes.store',
            'uses' => 'Admin\RecipeController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'recipes.edit',
            'uses' => 'Admin\RecipeController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'recipes.update',
            'uses' => 'Admin\RecipeController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'recipes.destroy',
            'uses' => 'Admin\RecipeController@destroy'
        ]);
    });

    Route::prefix('positions')->group(function () {
        Route::get('/index', [
            'as' => 'positions.index',
            'uses' => 'Admin\PositionController@index'
        ]);
        Route::get('/create', [
            'as' => 'positions.create',
            'uses' => 'Admin\PositionController@create'
        ])->middleware('can:positions.create');
        Route::post('/store', [
            'as' => 'positions.store',
            'uses' => 'Admin\PositionController@store'
        ])->middleware('can:positions.store');
        Route::get('/edit/{id}', [
            'as' => 'positions.edit',
            'uses' => 'Admin\PositionController@edit'
        ])->middleware('can:positions.edit');
        Route::post('/update/{id}', [
            'as' => 'positions.update',
            'uses' => 'Admin\PositionController@update'
        ])->middleware('can:positions.update');
        Route::get('/destroy/{id}', [
            'as' => 'positions.destroy',
            'uses' => 'Admin\PositionController@destroy'
        ])->middleware('can:positions.destroy');
    });

    Route::prefix('blogs')->group(function () {
        Route::get('/index', [
            'as' => 'blogs.index',
            'uses' => 'Admin\BlogController@index'
        ]);
        Route::get('/create', [
            'as' => 'blogs.create',
            'uses' => 'Admin\BlogController@create'
        ]);
        Route::post('/store', [
            'as' => 'blogs.store',
            'uses' => 'Admin\BlogController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'blogs.edit',
            'uses' => 'Admin\BlogController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'blogs.update',
            'uses' => 'Admin\BlogController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'blogs.destroy',
            'uses' => 'Admin\BlogController@destroy'
        ]);
    });

    Route::prefix('policies')->group(function () {
        Route::get('/index', [
            'as' => 'policies.index',
            'uses' => 'Admin\PolicyController@index'
        ]);
        Route::get('/create', [
            'as' => 'policies.create',
            'uses' => 'Admin\PolicyController@create'
        ]);
        Route::post('/store', [
            'as' => 'policies.store',
            'uses' => 'Admin\PolicyController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'policies.edit',
            'uses' => 'Admin\PolicyController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'policies.update',
            'uses' => 'Admin\PolicyController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'policies.destroy',
            'uses' => 'Admin\PolicyController@destroy'
        ]);
    });

    Route::prefix('posts')->group(function () {
        Route::get('/index', [
            'as' => 'posts.index',
            'uses' => 'Admin\PostController@index'
        ]);
        Route::get('/create', [
            'as' => 'posts.create',
            'uses' => 'Admin\PostController@create'
        ]);
        Route::post('/store', [
            'as' => 'posts.store',
            'uses' => 'Admin\PostController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'posts.edit',
            'uses' => 'Admin\PostController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'posts.update',
            'uses' => 'Admin\PostController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'posts.destroy',
            'uses' => 'Admin\PostController@destroy'
        ]);
    });

    Route::prefix('personnels')->group(function () {
        Route::get('/index', [
            'as' => 'personnels.index',
            'uses' => 'Admin\PersonnelController@index'
        ]);
        Route::post('/showDistrict', [
            'as' => 'personnels.showDistrict',
            'uses' => 'Admin\PersonnelController@showDistrict'
        ]);
        Route::post('/showCommune', [
            'as' => 'personnels.showCommune',
            'uses' => 'Admin\PersonnelController@showCommune'
        ]);
        Route::get('/create', [
            'as' => 'personnels.create',
            'uses' => 'Admin\PersonnelController@create'
        ])->middleware('can:personnels.create');
        Route::post('/store', [
            'as' => 'personnels.store',
            'uses' => 'Admin\PersonnelController@store'
        ])->middleware('can:personnels.store');
        Route::get('/edit/{id}', [
            'as' => 'personnels.edit',
            'uses' => 'Admin\PersonnelController@edit'
        ])->middleware('can:personnels.edit');
        Route::post('/update/{id}', [
            'as' => 'personnels.update',
            'uses' => 'Admin\PersonnelController@update'
        ])->middleware('can:personnels.update');
        Route::get('/destroy/{id}', [
            'as' => 'personnels.destroy',
            'uses' => 'Admin\PersonnelController@destroy'
        ])->middleware('can:personnels.destroy');

        Route::get('/accountCreate/{id}', [
            'as' => 'personnels.accountCreate',
            'uses' => 'Admin\PersonnelController@accountCreate'
        ])->middleware('can:personnels.accountCreate');
        Route::post('/accountStore/{id}', [
            'as' => 'personnels.accountStore',
            'uses' => 'Admin\PersonnelController@accountStore'
        ])->middleware('can:personnels.accountStore');
        Route::get('/accountDestroy/{id}', [
            'as' => 'personnels.accountDestroy',
            'uses' => 'Admin\PersonnelController@accountDestroy'
        ])->middleware('can:personnels.accountDestroy');

        Route::get('/timekeeping/{id}', [
            'as' => 'personnels.timekeeping',
            'uses' => 'Admin\PersonnelController@timekeeping'
        ]);
        Route::get('/checkin/{id}', [
            'as' => 'personnels.checkin',
            'uses' => 'Admin\PersonnelController@checkin'
        ])->middleware('can:personnels.checkin');
        Route::get('/checkout/{id}/{personnel_id}', [
            'as' => 'personnels.checkout',
            'uses' => 'Admin\PersonnelController@checkout'
        ])->middleware('can:personnels.checkout');
    });

    Route::prefix('bills')->group(function () {
        Route::get('/index', [
            'as' => 'bills.index',
            'uses' => 'Admin\BillController@index'
        ]);
        Route::get('/create', [
            'as' => 'bills.create',
            'uses' => 'Admin\BillController@create'
        ]);
        Route::get('/store', [
            'as' => 'bills.store',
            'uses' => 'Admin\BillController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'bills.edit',
            'uses' => 'Admin\BillController@edit'
        ]);
        Route::get('/update', [
            'as' => 'bills.update',
            'uses' => 'Admin\BillController@update'
        ]);
        Route::get('/show/{id}', [
            'as' => 'bills.show',
            'uses' => 'Admin\BillController@show'
        ]);
        Route::get('/activated/{id}/{check}', [
            'as' => 'bills.activated',
            'uses' => 'Admin\BillController@activated'
        ]);
        Route::get('/payment/{id}/{check}/{table_id}', [
            'as' => 'bills.payment',
            'uses' => 'Admin\BillController@payment'
        ]);
        Route::get('/print/{id}', [
            'as' => 'bills.print',
            'uses' => 'Admin\BillController@print'
        ]);
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/index', [
            'as' => 'contacts.index',
            'uses' => 'Admin\ContactController@index'
        ]);
        Route::get('/create', [
            'as' => 'contacts.create',
            'uses' => 'Admin\ContactController@create'
        ]);
        Route::post('/store', [
            'as' => 'contacts.store',
            'uses' => 'Admin\ContactController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'contacts.edit',
            'uses' => 'Admin\ContactController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'contacts.update',
            'uses' => 'Admin\ContactController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'contacts.destroy',
            'uses' => 'Admin\ContactController@destroy'
        ]);
        Route::get('/contactbill/{id}', [
            'as' => 'contacts.contactbill',
            'uses' => 'Admin\ContactController@contactbill'
        ]);
        Route::post('/contactdetail', [
            'as' => 'contacts.contactdetail',
            'uses' => 'Admin\ContactController@contactdetail'
        ]);
        Route::post('/contactpersonnel', [
            'as' => 'contacts.contactpersonnel',
            'uses' => 'Admin\ContactController@contactpersonnel'
        ]);
        Route::get('/print/{id}', [
            'as' => 'contacts.print',
            'uses' => 'Admin\ContactController@print'
        ]);
        Route::get('/activated/{id}/{check}', [
            'as' => 'contacts.activated',
            'uses' => 'Admin\ContactController@activated'
        ]);
    });

    Route::prefix('contactbills')->group(function () {
        Route::get('/bill', [
            'as' => 'contacts.bill',
            'uses' => 'Admin\ContactController@bill'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'contacts.detail',
            'uses' => 'Admin\ContactController@detail'
        ]);
    });

    Route::prefix('order')->group(function () {
        Route::get('/index', [
            'as' => 'order.index',
            'uses' => 'Admin\OrderController@index'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'order.detail',
            'uses' => 'Admin\OrderController@detail'
        ]);
        Route::post('/update/{id}', [
            'as' => 'order.update',
            'uses' => 'Admin\OrderController@update'
        ]);
    });

    Route::prefix('sets')->group(function () {
        Route::get('/index', [
            'as' => 'sets.index',
            'uses' => 'Admin\SetController@index'
        ]);
        Route::get('/create', [
            'as' => 'sets.create',
            'uses' => 'Admin\SetController@create'
        ]);
        Route::post('/store', [
            'as' => 'sets.store',
            'uses' => 'Admin\SetController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sets.edit',
            'uses' => 'Admin\SetController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'sets.update',
            'uses' => 'Admin\SetController@update'
        ]);
        Route::get('/destroy/{id}', [
            'as' => 'sets.destroy',
            'uses' => 'Admin\SetController@destroy'
        ]);
        Route::get('/setbill/{id}', [
            'as' => 'sets.setbill',
            'uses' => 'Admin\SetController@setbill'
        ]);
        Route::post('/setdetail', [
            'as' => 'sets.setdetail',
            'uses' => 'Admin\SetController@setdetail'
        ]);
        Route::get('/print/{id}', [
            'as' => 'sets.print',
            'uses' => 'Admin\SetController@print'
        ]);
        Route::get('/activated/{id}/{check}', [
            'as' => 'sets.activated',
            'uses' => 'Admin\SetController@activated'
        ]);
        Route::get('/table/{id}', [
            'as' => 'sets.table',
            'uses' => 'Admin\SetController@table'
        ]);
        Route::post('/status', [
            'as' => 'sets.status',
            'uses' => 'Admin\SetController@status'
        ]);
    });

    Route::prefix('setbills')->group(function () {
        Route::get('/bill', [
            'as' => 'sets.bill',
            'uses' => 'Admin\SetController@bill'
        ]);
        Route::get('/detail/{id}', [
            'as' => 'sets.detail',
            'uses' => 'Admin\SetController@detail'
        ]);
        Route::get('/payment/{id}/{check}', [
            'as' => 'sets.payment',
            'uses' => 'Admin\SetController@payment'
        ]);
    });
});
