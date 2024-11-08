<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\SsdController;
use App\Http\Controllers\Admins\AuthController;
use App\Http\Controllers\Admins\UserController;
use App\Http\Controllers\Admins\BrandController;
use App\Http\Controllers\Admins\ColorController;
use App\Http\Controllers\Admins\OrderController;
use App\Http\Controllers\Admins\StaffController;
use App\Http\Controllers\Clients\CartController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\ShopController;
use App\Http\Controllers\Clients\LoginController;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Clients\AccountController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Clients\CheckoutController;
use App\Http\Controllers\Clients\ProductDetailController;
use App\Http\Controllers\Admins\Trashs\UserTrashController;
use App\Http\Controllers\Admins\Trashs\StaffTrashController;
use App\Http\Controllers\Admins\Categories\CategoryController;
use App\Http\Controllers\Admins\FlashSaleController;
use App\Http\Controllers\Admins\PostController;
use App\Http\Controllers\Admins\Trashs\ProductTrashController;
use App\Http\Controllers\Clients\PostDetailController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admins\VoucherController;
use App\Http\Controllers\Clients\RecentlyViewedController;
use App\Http\Controllers\Admins\SlideShowController;
use App\Http\Controllers\Clients\WishlistController;
use App\Models\FlashSale;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// form login admin
Route::get('/admin', [AuthController::class, 'index'])->name('admin.login')->middleware('logged');
Route::post('/admin/store', [AuthController::class, 'store'])->name('admin.store');

// route admin
Route::middleware(['admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/index', [DashboardController::class, 'index'])->name('admin.index');
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::post('/user-trash/trash', [UserTrashController::class, 'trash'])->name('user.trash');
        Route::post('/user-trash/delete', [UserTrashController::class, 'delete'])->name('user.delete');
        Route::post('/user-trash/restore', [UserTrashController::class, 'restore'])->name('user.restore');
        Route::resource('/user-trash', UserTrashController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/brand', BrandController::class);
        Route::resource('/product', ProductController::class);
        Route::post('/product-trash/trash', [ProductTrashController::class, 'trash'])->name('product.trash');
        Route::post('/product-trash/delete', [ProductTrashController::class, 'delete'])->name('product.delete');
        Route::post('/product-trash/restore', [ProductTrashController::class, 'restore'])->name('product.restore');
        Route::resource('/product-trash', ProductTrashController::class);
        Route::resource('/categories', CategoryController::class);
        Route::resource('/post', PostController::class);
        // Route::post('posts/upload', [PostController::class, 'upload'])->name('posts.upload');
        Route::resource('/voucher', VoucherController::class);

        Route::post('/slide-show/apply/{id}', [SlideShowController::class, 'apply'])->name('slide-show.apply');
        Route::resource('/slide-show', SlideShowController::class);
        Route::middleware(['staff'])->group(function () {
            Route::post('/staff-trash/trash', [StaffTrashController::class, 'trash'])->name('staff.trash');
            Route::post('/staff-trash/delete', [StaffTrashController::class, 'delete'])->name('staff.delete');
            Route::post('/staff-trash/restore', [StaffTrashController::class, 'restore'])->name('staff.restore');
            Route::resource('/staff-trash', StaffTrashController::class);
            Route::resource('/staff', StaffController::class);
        });
        //------------------------------ quản lý thuộc tính màu sắc---------------------------------------------------------
        Route::get('/color', [ColorController::class, 'index'])->name('color.index');
        Route::get('/color/create', [ColorController::class, 'create'])->name('color.create');
        Route::post('/color/store', [ColorController::class, 'store'])->name('color.store');
        Route::get('/color/edit/{id}', [ColorController::class, 'edit'])->name('color.edit');
        Route::post('/color/update/{id}', [ColorController::class, 'update'])->name('color.update');
        Route::delete('/color/delete/{id}', [ColorController::class, 'destroy'])->name('color.destroy');
        // ------------------------------quản lý thuộc tính dung lượng-------------------------------------------------------
        Route::get('/ssd', [SsdController::class, 'index'])->name('ssd.index');
        Route::get('/ssd/create', [SsdController::class, 'create'])->name('ssd.create');
        Route::post('/ssd/store', [SsdController::class, 'store'])->name('ssd.store');
        Route::get('/ssd/edit/{id}', [SsdController::class, 'edit'])->name('ssd.edit');
        Route::post('/ssd/update/{id}', [SsdController::class, 'update'])->name('ssd.update');
        Route::delete('/ssd/delete/{id}', [SsdController::class, 'destroy'])->name('ssd.destroy');
        Route::get('/order', [OrderController::class, 'index'])->name('order.index');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
        Route::post('/order/{id}', [OrderController::class, 'update'])->name('order.update');
    });
});

// route client
Route::get('/', [HomeController::class, 'index'])->name('client.index');
Route::get('/login', [LoginController::class, 'login'])->name('client.login');
Route::get('/signup', [LoginController::class, 'signup'])->name('client.signup');
Route::get('/logout', [LoginController::class, 'logout'])->name('client.logout');
Route::post('/store', [LoginController::class, 'store'])->name('client.store');
Route::post('/store-signup', [LoginController::class, 'storeSignup'])->name('client.store.signup');
Route::get('/shop', [ShopController::class, 'shop'])->name('client.shop');
Route::get('/recently-viewed', [RecentlyViewedController::class, 'recentlyViewed'])->name('recently.viewed');
Route::get('/product-detail/{id}', [ProductDetailController::class, 'productDetail'])->name('client.product.detail');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('client.addToCart');
Route::get('/cart', [CartController::class, 'showCart'])->name('client.cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('client.updateCart');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('client.removeFromCart');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('client.checkouts.checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('client.checkouts.process');
Route::get('/checkout/callback', [CheckoutController::class, 'handleVnPayCallback'])->name('client.vnpay.callback');
Route::get('/account', [AccountController::class, 'account'])->name('client.account');
Route::get('/order-detail/{id}', [AccountController::class, 'orderDetail'])->name('client.order.detail');
Route::post('/confirm/{id}', [AccountController::class, 'confirm'])->name('client.confirm');
Route::post('/cancel/{id}', [AccountController::class, 'cancel'])->name('client.cancel');
Route::get('/thanh-cong', [AccountController::class, 'thanhCong'])->name('client.accounts.thanhcong');
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('client.wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('client.wishlist');
Route::get('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('client.wishlist.remove');


// đánh giá
Route::post('/order/{orderId}/product/{orderDetailId}/review', [ReviewController::class, 'store'])->name('client.review.store');
Route::get('product/{productId}/reviews', [ReviewController::class, 'index'])->name('client.review.index');
Route::get('product/{productId}/reviews/show', [ReviewController::class, 'show'])->name('client.review.show');

// blog
Route::get('/blog', [PostDetailController::class, 'index'])->name('client.blog');

Route::get('/blog-detail/{slug}', [PostDetailController::class, 'blogDetail'])->name('client.blog.detail');
Route::post('/blog-detail/{post}/comments', [PostDetailController::class, 'storeComment'])->name('comments.store');

Route::get('/blog-detail/{id}', [PostDetailController::class, 'blogDetail'])->name('client.blog.detail');
Route::post('/blog-detail/{post}/comments', [PostDetailController::class, 'storeComment'])->name('comments.store');
