<?php

use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',HomeComponent::class);

Route::get('/shop',ShopComponent::class)->name('product.shop');

Route::get('/cart',CartComponent::class)->name('product.cart');

Route::get('/checkout',CheckoutComponent::class);

Route::get('/product/{slug}',DetailsComponent::class)->name('product.details');

Route::get('/product-category/{category_slug}',CategoryComponent::class)->name('product.category');

Route::get('/search',SearchComponent::class)->name('product.search');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');



// ==========For User or Customer================

// Route::middleware(['auth:sanctum','verified'])->group(function (){
//     Route::get('user/deshboard',UserDashboardComponent::class)->name('user.dashborad');
// });

Route::group(['prefix' => 'user','middleware' => ['auth:sanctum','verified']], function(){
    Route::get('/deshboard',UserDashboardComponent::class)->name('user.dashborad');
});

//==========For Admin============

// Route::middleware(['auth:sanctum','verified','authadmin'])->group(function (){
//     Route::get('admin/deshboard',AdminDashboardComponent::class)->name('admin.dashboard');
// });

Route::group(['prefix' => 'admin','middleware' => ['auth:sanctum','verified','authadmin']], function() {
    Route::get('/deshboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/categories',AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/category/add',AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/category/edit/{category_slug}',AdminEditCategoryComponent::class)->name('admin.editcategory');

    Route::get('/products',AdminProductComponent::class)->name('admin.products');
    Route::get('/product/add',AdminAddProductComponent::class)->name('admin.addproduct');
});