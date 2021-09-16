<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\AddtoCart;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategory;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AddProductComponent;
use App\Http\Livewire\AdminAddCategory;
use App\Http\Livewire\AdminSaleComponent;
use App\Http\Livewire\AdminEditProductComponent;
use App\Http\Livewire\WishlistComponent;
use App\Http\Livewire\ThankyouComponent;

use App\Http\Livewire\Admin\AdminHomeSliderComponent;
use App\Http\Livewire\Admin\AdminAddHomeSliderComponent;
use App\Http\Livewire\Admin\AdminEditHomeSliderComponent;
use App\Http\Livewire\Admin\AdminHomeCategoryComponent;

use App\Http\Livewire\Admin\AdminCouponComponent;
use App\Http\Livewire\Admin\AdminAddCouponComponent;
use App\Http\Livewire\Admin\AdminEditCouponComponent;
use App\Http\Livewire\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailComponent;

use App\Http\Livewire\UserOrderComponent;
use App\Http\Livewire\UserOrderDetailComponent;

use App\Http\Livewire\User\UserReviewComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;

use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminSettingComponent;


Route::get('/',HomeComponent::class);
Route::get('/cart',CartComponent::class)->name('product.cart');
Route::get('/shop',ShopComponent::class);
Route::get('/checkout',CheckoutComponent::class)->name('checkout');
Route::get('/detail/{slug}',DetailsComponent::class)->name('product.detail');
Route::get('/product-category/{category_slug}',CategoryComponent::class)->name('product.category');
Route::get('/search',SearchComponent::class)->name('product.search');
Route::get('thankyou/',ThankyouComponent::class)->name('thankyou');
Route::get('/contact-us',ContactComponent::class)->name('contact');


//For USER
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
   
    Route::get('/user/orders',UserOrderComponent::class)->name('user.orders');
    Route::get('/user/order/{order_id}',UserOrderDetailComponent::class)->name('user.detail');
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/review/{order_item_id}',UserReviewComponent::class)->name('user.review');
    Route::get('/user/change-password',UserChangePasswordComponent::class)->name('user.changepassword');
});


//For USR

Route::middleware(['auth:sanctum', 'verified','authadmin'])->group(function(){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('admin/categories',AdminCategoryComponent::class)->name('admin.categories');
    Route::get('admin/add/categories',AdminAddCategory::class)->name('admin.addcategories');
    Route::get('admin/edit/category/{category_slug}',AdminEditCategory::class)->name('admin.editcategory');
    Route::get('/admin/products',AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/products/add',AddProductComponent::class)->name('admin.addproducts');
    Route::get('/admin/products/edit/{slug}',AdminEditProductComponent::class)->name('admin.editproducts');

    Route::get('admin/homeslider/',AdminHomeSliderComponent::class)->name('admin.homeslider');
    Route::get('admin/homeslider/add',AdminAddHomeSliderComponent::class)->name('admin.addhomeslider');
    Route::get('admin/homeslider/edit/{slide_id}',AdminEditHomeSliderComponent::class)->name('admin.edithomeslider');

    Route::get('admin/home-categories',AdminHomeCategoryComponent::class)->name('admin.homecategory');
    Route::get('admin/sale-setting',AdminSaleComponent::class)->name('admin.salesetting');

    Route::get('wishlist',WishlistComponent::class)->name('wishlist');

    Route::get('admin/coupons',AdminCouponComponent::class)->name('admin.coupons');
    Route::get('admin/coupons/add',AdminAddCouponComponent::class)->name('admin.addcoupons');
    Route::get('admin/coupons/edit/{coupon_id}',AdminEditCouponComponent::class)->name('admin.editcoupons');

    Route::get('admin/orders',AdminOrderComponent::class)->name('admin.orders');
    Route::get('admin/order/{order_id}',AdminOrderDetailComponent::class)->name('admin.orderdetail');
    Route::get('admin/contact-us',AdminContactComponent::class)->name('admin.contact');

    Route::get('admin/setting',AdminSettingComponent::class)->name('admin.setting');

    



});