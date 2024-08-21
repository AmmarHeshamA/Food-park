<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CheckoutController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\FrontEnd\ChatController;
use App\Http\Controllers\Frontend\CustomPageController;
use App\Http\Controllers\FrontEnd\DashboardController;
use App\Http\Controllers\FrontEnd\FrontController;
use App\Http\Controllers\FrontEnd\ProfileController as FrontEndProfileController;
use App\Http\Controllers\FrontEnd\WishlistController;
// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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

// Show Home Page
Route::get('/', [FrontController::class, 'index'])->name('home');



Route::group(['middleware' => 'guest'], function () {
    Route::get('admin/login', [AdminAuthController::class, 'index'])
        ->name('admin.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [FrontEndProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [FrontEndProfileController::class, 'updatePasswordProfile'])->name('profile.update.password');
    Route::post('/profile/avatar', [FrontEndProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('address', [DashboardController::class, 'createAddress'])->name('address.store');
    Route::put('address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
    Route::delete('address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');

    // Chat Routes
    Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
    Route::get('chat/get-conversation/{senderId}', [ChatController::class, 'getConversation'])->name('chat.get-conversation');
});

// Product page Route
Route::get('/products', [FrontController::class, 'products'])->name('product.index');

// Show Product Details Pages
Route::get('/product/{slug}', [FrontController::class, 'showProduct'])->name('product.show');

// Load Product Model
Route::get('load-product-model/{productId}', [FrontController::class, 'loadProductModal'])
    ->name('load-product-modal');

Route::post('product-review', [FrontController::class, 'productReviewStore'])->name('product-review.store');

// Add to cart Route
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('get-cart-products', [CartController::class, 'getCartProduct'])->name('get-cart-products');
Route::get('cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');

// Wishlist Route
Route::get('wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');

// Cart Page Route
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
Route::get('cart-destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');

// Coupon Routes
Route::post('/apply-coupon', [FrontController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('/destroy-coupon', [FrontController::class, 'destroyCoupon'])->name('destroy-coupon');

// chef page
Route::get('/chef', [FrontController::class, 'chef'])->name('chef');

// Testimonial page
Route::get('/testimonials', [FrontController::class, 'testimonial'])->name('testimonial');

// About Routes
Route::get('/about', [FrontController::class, 'about'])->name('about');

// Contact Routes
Route::get('/contact', [FrontController::class, 'contact'])->name('contact.index');
Route::post('/contact', [FrontController::class, 'sendContactMessage'])->name('contact.send-message');

// Reservation Routes
Route::post('/reservation', [FrontController::class, 'reservation'])->name('reservation.store');

// Privacy Policy Routes
Route::get('/privacy-policy', [FrontController::class, 'privacyPolicy'])->name('privacy-policy.index');

// Trams and Conditions Routes
Route::get('/trams-and-conditions', [FrontController::class, 'tramsAndConditions'])->name('trams-and-conditions');

// Newsletter Routes
Route::post('/subscribe-newsletter', [FrontController::class, 'subscribeNewsletter'])->name('subscribe-newsletter');

// Custom Page Routes
Route::get('/page/{slug}', CustomPageController::class);

// Blogs Routes
Route::get('/blogs', [FrontController::class, 'blog'])->name('blogs');
Route::get('/blogs/{slug}', [FrontController::class, 'blogDetails'])->name('blogs.details');
Route::post('/blogs/comment/{blog_id}', [FrontController::class, 'blogCommentStore'])->name('blogs.comment.store');

Route::group(['middleware' => 'auth'], function () {
    // CheckOut Routes
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/{id}/delivery-cal', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-cal');
    Route::post('checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');

    // Payment Routes
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');

    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment-cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

    //PayPal Routes
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    // Stripe Routes
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');

    // Razorpay Routes
    Route::get('razorpay-redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay-redirect');
    Route::post('razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');
});


require __DIR__ . '/auth.php';
