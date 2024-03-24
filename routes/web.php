<?php

use App\Models\AboutUs;
use App\Models\PrivacyPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Admin\BlogContoller;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UsersContoller;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\AllProductsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductContoller;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ReturnProductControllers;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Http;
use Srmklive\PayPal\Services\PayPal;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//-------------customer side-----------
// Home
Route::get('/', [FrontEndController::class, 'homePage'])->name('homepage');
Route::post('contact-us', [FrontEndController::class, 'contactUs'])->name('contact.us');

//enquiry
Route::get('enquiry', [FrontEndController::class, 'enquiryPage'])->name('enquiry-page');
Route::post('enquiry-data', [FrontEndController::class, 'enquiryData'])->name('enquiry-data');

//login
Route::get('/customer-login', [CustomerAuthController::class, 'loginPage'])->name('customer-login');
Route::post('/customer-login-data', [CustomerAuthController::class, 'login'])->name('customer-login-data');

// forgot password
Route::view('/customer-forgot-password','customer.customer-forgot-password')->name('customer-forgot-password');
Route::post('/customer-forgot-password-post', [CustomerAuthController::class, 'forget_password'])->name('customer-forgot-password-data');
Route::get('/verify-otp', [CustomerAuthController::class, 'otp_page'])->name('verify-otp');
Route::post('/verify-otp-post', [CustomerAuthController::class, 'verify_otp'])->name('verify-otp-post');


//sign up
Route::get('/customer-signup', [CustomerAuthController::class, 'signup'])->name('customer-signup');
Route::post('/customer-signup-data', [CustomerAuthController::class, 'register'])->name('customer-signup-data');

// verify email
Route::get('/verify-email/{id}', [CustomerAuthController::class, 'verifyEmail'])->name('verify-email');

// Product
Route::get('/product-details/{id}', [FrontEndController::class, 'product'])->name('product');

//All Products
Route::get('/all-products', [AllProductsController::class, 'allProductsPage'])->name('all-products-page');

Route::middleware(['auth.customer'])->group(function () {

    Route::get('/demo', [CustomerAuthController::class, 'demo'])->name('demo');

    //cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart', [CartController::class, 'add_product'])->name('cart.add_product');
    Route::get('/remove-from-cart/{id}', [CartController::class, 'remove_product'])->name('cart.remove_product');
    Route::post('update-quantity', [CartController::class, 'update_quantity'])->name('cart.update-quantity');

    // Order
    Route::get('/My-Orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/track-order/{order_id}/{cart_id?}', [OrderController::class, 'trackOrder'])->name('track-order');

    //return Product
    Route::get('return-products/{id}', [OrderController::class, 'returnOrderPage'])->name('return-products');
    Route::post('/return-product-data', [OrderController::class, 'returnProductData'])->name('return-product-data');

    // Payment
    Route::get('/checkout', [CheckOutController::class, 'checkout'])->name('cart.checkout');
    Route::post('/payment', [CheckOutController::class, 'payment'])->name('cart.payment');
    Route::get('success-transaction', [CheckOutController::class, 'paypal_return'])->name('successTransaction');
    Route::get('cancel-transaction', [CheckOutController::class, 'paypal_cancel'])->name('cancelTransaction');

    Route::get('/test/{id}', function ($id) {

        // user details
        $paypal = new PayPal();
        $paypal->setApiCredentials(config('paypal'));

        $response = $paypal->getAccessToken();
        // $access_token = $response['access_token'];

        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Authorization' => 'Bearer ' . $access_token,
        // ])->post("https://api.paypal.com/v2/scim/Users/{$id}");

        // dd($response);

    });


});

//profile
Route::get('/profile/{id}', [ProfileController::class, 'profilePage'])->name('profile');
Route::post('/profile-data', [ProfileController::class, 'profileData'])->name('profile-data');
Route::post('/reset-password-data', [ProfileController::class, 'resetPasswordData'])->name('reset-password-data');



//NewsLetter
Route::post('/news-letter-data', [FrontEndController::class, 'newsLetterData'])->name('news-letter-data');

//search product
// Route::get('/search', [FrontEndController::class, 'search'])->name('search');

Route::get('/about-us', function () {
    $aboutus = AboutUs::where('id', '=', 1)->first();
    return view('frontend.about-us', compact('aboutus'));
})->name('about-us');
Route::get('/privacy-policy', function () {
    $privacypolicy = PrivacyPolicy::where('id', '=', 1)->first();
    return view('frontend.privacy-policy', compact('privacypolicy'));
})->name('privacy-policy');

//get In touch

Route::get('/getIntouch', [FrontEndController::class, 'getIntouch'])->name('getIntouch');

//logout
Route::get('/customer-logout', [CustomerAuthController::class, 'logout'])->name('customer-logout');






// -------------admin------------------------
//forget password

Route::get('/email-verify-page', [ForgetPasswordController::class, 'emailVerifyPage'])->name('email-verify-page');

Route::post('/email-verify', [ForgetPasswordController::class, 'emailVerify'])->name('email-verify');

Route::get('/send-otp/{id}', [ForgetPasswordController::class, 'sendOtp'])->name('send-otp');

Route::post('/send-otp-data', [ForgetPasswordController::class, 'sendOtpData'])->name('send-otp-data');

Route::get('/resend-otp-data', [ForgetPasswordController::class, 'resendOtpData'])->name('resend-otp-data');

Route::get('/forget-pwd-page/{id}', [ForgetPasswordController::class, 'forgetPwdPage'])->name('forget-pwd-page');

Route::post('/forget-pwd-data', [ForgetPasswordController::class, 'forgetPwdData'])->name('forget-pwd-data');

Route::middleware('auth')->prefix('admin')->group(function () {

    //-----------------------Admin-----------------------------------

    Route::get('/home', [DashboardController::class, 'index'])->name('home');


    //categories
    Route::prefix('category')->group(function () {

        Route::get('', [categoryController::class, 'showCategories'])->name('show-categories');

        Route::get('add', [categoryController::class, 'addPageCategory'])->name('add-page-category');
        Route::post('add', [categoryController::class, 'addCategory'])->name('add-category');

        Route::get('edit/{id}', [categoryController::class, 'editPageCategory'])->name('edit-page-category');
        Route::post('edit', [categoryController::class, 'editCategory'])->name('edit-category');

        Route::get('delete/{id}', [categoryController::class, 'deleteCategory'])->name('delete-category');

        // Route::post('visible-change/{id}', [CategoryController::class, 'visibleChange'])->name('visible-change');

        Route::get('force-delete-category/{id}', [categoryController::class, 'forceDeleteCategory'])->name('force-delete-category');
        Route::get('delete-all-category', [categoryController::class, 'deleteAllCategory'])->name('delete-all-category');

        Route::get('restore-category/{id}', [categoryController::class, 'restoreCategory'])->name('restore-category');
        Route::get('restore-all-category', [categoryController::class, 'restoreAllCategory'])->name('restore-all-category');

    });

    //end categories

    //product
    Route::prefix('product')->group(function () {

        Route::get('', [ProductContoller::class, 'showProducts'])->name('show-products');

        Route::get('add', [ProductContoller::class, 'addPageProducts'])->name('add-page-product');
        Route::post('add', [ProductContoller::class, 'addProducts'])->name('add-product');

        Route::get('edit/{id}', [ProductContoller::class, 'editPageProducts'])->name('edit-page-product');
        Route::post('edit', [ProductContoller::class, 'editProducts'])->name('edit-product');

        Route::get('delete/{id}', [ProductContoller::class, 'deleteProduct'])->name('delete-product');

        Route::get('force-delete-product/{id}', [ProductContoller::class, 'forceDeleterProduct'])->name('force-delete-product');
        Route::get('delete-all-products', [ProductContoller::class, 'deleteAllProduct'])->name('delete-all-product');

        Route::get('restore-product/{id}', [ProductContoller::class, 'restoreProduct'])->name('restore-product');
        Route::get('restore-all-products', [ProductContoller::class, 'restoreAllProduct'])->name('restore-all-product');

        Route::post('visible-change-product/{id}', [ProductContoller::class, 'visibleChangeProduct'])->name('visible-change-product');
        Route::post('latest-change-product/{id}', [ProductContoller::class, 'latestChangeProduct'])->name('latest-change-product');


    });
    //end product

    Route::prefix('brand')->group(function () {

        Route::get('', [BrandController::class, 'showBrands'])->name('brand.show');

        Route::post('add', [BrandController::class, 'addBrand'])->name('brand.add');

        Route::post('edit-data', [BrandController::class, 'editBrand'])->name('brand.edit.data');
        Route::post('edit', [BrandController::class, 'updateBrand'])->name('brand.edit');

        Route::get('delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');

        Route::get('force-delete-brand/{id}', [BrandController::class, 'forceDeleteBrand'])->name('force-delete-brand');
        Route::get('delete-all-brand', [BrandController::class, 'deleteAllBrand'])->name('brand.delete.all');

        Route::get('restore-brand/{id}', [BrandController::class, 'restoreBrand'])->name('brand.restore');
        Route::get('restore-all-brand', [BrandController::class, 'restoreAllBrand'])->name('brand.restore.all');

    });

    Route::prefix('tags')->group(function () {

        Route::get('', [TagController::class, 'index'])->name('tags.index');
        Route::post('create', [TagController::class, 'create'])->name('tags.create');

        Route::post('edit-data', [TagController::class, 'editTag'])->name('tags.edit.data');
        Route::post('edit', [TagController::class, 'edit'])->name('tags.edit');

        Route::get('destroy/{id}', [TagController::class, 'destroy'])->name('tags.delete');

    });

    //users

    Route::prefix('users')->group(function () {

        Route::get('', [UsersContoller::class, 'showUsers'])->name('show-user');

        Route::get('add', [UsersContoller::class, 'addPageUser'])->name('add-page-user');
        Route::post('add', [UsersContoller::class, 'addUser'])->name('add-user');

        Route::get('edit/{id}', [UsersContoller::class, 'editPageUser'])->name('edit-page-user');
        Route::post('edit', [UsersContoller::class, 'editUser'])->name('edit-user');

        Route::get('delete/{id}', [UsersContoller::class, 'deleteUser'])->name('delete-user');

    });

    //end uses


    //customers
    Route::get('customers', [CustomersController::class, 'showCustomers'])->name('show-customers');
    //end customers

    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contactus.show');


    Route::get('enquiry', [EnquiryController::class, 'index'])->name('enquiry.show');
    Route::get('enquiry/destroy/{id}', [EnquiryController::class, 'destroy'])->name('enquiry.delete');

    Route::prefix('Order')->group(function () {

        Route::get('', [AdminOrderController::class, 'showOrders'])->name('order.show');

        Route::get('details/{id}', [AdminOrderController::class, 'OrderDetails'])->name('order.details');


        Route::post('/status-update', [AdminOrderController::class, 'order_status_update'])->name('order.status.update');
        Route::get('/single/{cart_id}', [AdminOrderController::class, 'order_status_single'])->name('order.status.single');

        Route::post('/bunch-status', [AdminOrderController::class, 'order_bunch_status'])->name('order.bunch.status');

    });

    //return Products
    Route::prefix('return-product')->group(function () {

        Route::get('', [ReturnProductControllers::class, 'showReturnProduct'])->name('return-product.show');

        Route::get('delete/{id}', [ReturnProductControllers::class, 'deleteReturnProduct'])->name('delete-return-product');


        Route::get('force-delete-return-product/{id}', [ReturnProductControllers::class, 'forceDeleteReturnProduct'])->name('force-delete-return-product');
        Route::get('delete-all-return-product', [ReturnProductControllers::class, 'deleteAllReturnProduct'])->name('delete-all-return-product');

        Route::get('restore-return-product/{id}', [ReturnProductControllers::class, 'restoreReturnProduct'])->name('restore-return-product');
        Route::get('restore-all-return-product', [ReturnProductControllers::class, 'restoreAllReturnProduct'])->name('restore-all-return-product');
    });

    //NewsLetter admin
    Route::prefix('news-letter')->group(function () {

        Route::get('', [NewsLetterController::class, 'show'])->name('news-letter.show');
    });

    //NewsLetter admin
    Route::prefix('blog')->group(function () {

        Route::get('', [BlogContoller::class, 'show'])->name('blog.show');

        Route::get('add', [BlogContoller::class, 'addPageBlog'])->name('add-page-blog');
        Route::post('add', [BlogContoller::class, 'addBlog'])->name('add-blog');

        Route::get('edit/{id}', [BlogContoller::class, 'editPageBlog'])->name('edit-page-blog');
        Route::post('edit', [BlogContoller::class, 'editBlog'])->name('edit-blog');

        Route::get('delete/{id}', [BlogContoller::class, 'deleteBlog'])->name('delete-blog');

    });

    //Testimonial admin
    Route::prefix('testimonial')->group(function () {

        Route::get('', [TestimonialController::class, 'show'])->name('testimonial.show');

        Route::get('add', [TestimonialController::class, 'addPageTestimonial'])->name('add-page-testimonial');
        Route::post('add', [TestimonialController::class, 'addTestimonial'])->name('add-testimonial');

        Route::get('edit/{id}', [TestimonialController::class, 'editPageTestimonial'])->name('edit-page-testimonial');
        Route::post('edit', [TestimonialController::class, 'editTestimonial'])->name('edit-testimonial');

        Route::get('delete/{id}', [TestimonialController::class, 'deleteTestimonial'])->name('delete-testimonial');

    });


    //gallery admin
    Route::prefix('gallery')->group(function () {

        Route::get('', [GalleryController::class, 'show'])->name('gallery.show');

        Route::get('add', [GalleryController::class, 'addPageGallery'])->name('add-page-gallery');
        Route::post('add', [GalleryController::class, 'addGallery'])->name('add-gallery');

        Route::get('delete/{id}', [GalleryController::class, 'deleteGallery'])->name('delete-gallery');

    });

    //gallery admin
    Route::prefix('banner')->group(function () {

        Route::get('', [BannerController::class, 'show'])->name('banner.show');

        Route::get('add', [BannerController::class, 'addPageBanner'])->name('add-page-banner');
        Route::post('add', [BannerController::class, 'addBanner'])->name('add-banner');

        Route::get('delete/{id}', [BannerController::class, 'deleteBanner'])->name('delete-banner');

    });

    Route::prefix('about-us')->group(function () {

        Route::get('', [AboutUsController::class, 'editPageAboutUs'])->name('about-us.show');
        Route::post('edit', [AboutUsController::class, 'editAboutUs'])->name('about-us-data');

    });

    Route::prefix('privacy-policy')->group(function () {
        Route::get('', [PrivacyPolicyController::class, 'editPagePrivacyPolicy'])->name('privacy-policy.show');
        Route::post('edit', [PrivacyPolicyController::class, 'editPrivacyPolicy'])->name('privacy-policy-data');
    });

});
