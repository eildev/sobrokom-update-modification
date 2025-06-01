<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubSubcategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\GlobalCouponController;
use App\Http\Controllers\Backend\PopupMessageController;
use App\Http\Controllers\Backend\TagNameController;
use App\Http\Controllers\Backend\HomeBannerController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OfferBannerController;
use App\Http\Controllers\Backend\OrderManageController;
use App\Http\Controllers\Backend\StockManageController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\BlogCommentController;
use App\Http\Controllers\Backend\CompanyDetailsController;
use App\Http\Controllers\Backend\UserTrackerController;
use App\Http\Controllers\Backend\userController;
use App\Http\Controllers\AllMail;
use App\Http\Controllers\Backend\PurchaseDetailsController;
use App\Http\Controllers\Backend\historyController;
use App\Http\Controllers\Backend\MarketingController;
use App\Http\Controllers\Frontend\ReviewRatingController;
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
    return view('frontend.index');
})->name('home');

Route::get('admin/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');
Route::controller(AllMail::class)->group(function () {
    Route::post('/reply/mail', 'replyMail')->name('reply.mail');
});
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //All Routes for Category Start
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/view', 'view')->name('category.view');
        Route::get('/category/edit/{id}', 'edit')->name('category.edit');
        Route::post('/category/update/{id}', 'update')->name('category.update');
        Route::get('/category/delete/{id}', 'delete')->name('category.delete');
        Route::post('/category/status/{id}', 'CategoryStatus')->name('category.status');
    });
    Route::controller(historyController::class)->group(function () {
        Route::get('/current-history/{value}', 'CurrentHistory');
    });
    // Marketing for SMS Marketing Routes
    Route::controller(MarketingController::class)->group(function () {
        Route::get('/sms/page', 'index')->name('sms.page');
        Route::post('/sms/send', 'sendSMS')->name('sms.send');
    });
    Route::controller(userController::class)->group(function () {
        Route::get('/all-user', 'allUser')->name('all.users');
        Route::get('/admin/disable-user/{user_id}', 'DisableUser')->name('admin.disable-user');
        Route::get('/admin/enable-user/{user_id}', 'EnableUser')->name('admin.enable-user');
    });

  Route::controller(ReviewRatingController::class)->group(function () {
    Route::get('/review/rating', 'index')->name('review.manage');
     Route::get('review/Approve/{id}', 'approve')->name('review.approve');
     Route::get('review/delete/{id}', 'delete')->name('review.delete');
  });


    //All Routes for Category End

    //All Routes for Subcategory Start
    Route::controller(SubcategoryController::class)->group(function () {
        Route::get('/subcategory', 'index')->name('subcategory');
        Route::post('/subcategory/store', 'store')->name('subcategory.store');
        Route::get('/subcategory/view', 'view')->name('subcategory.view');
        Route::get('/subcategory/edit/{id}', 'edit')->name('subcategory.edit');
        Route::post('/subcategory/update/{id}', 'update')->name('subcategory.update');
        Route::get('/subcategory/delete/{id}', 'delete')->name('subcategory.delete');
        Route::get('/find/subcategory/{id}', 'findSubcat')->name('subcategory.find');
    });
    //All Routes for Subcategory End

    //All Routes for brand Start
    Route::controller(BrandController::class)->group(function () {
        Route::get('/brand', 'index')->name('brand');
        Route::post('/brand/store', 'store')->name('brand.store');
        Route::get('/brand/view', 'show')->name('brand.view');
        Route::get('/brand/edit/{id}', 'edit')->name('brand.edit');
        Route::post('/brand/update/{id}', 'update')->name('brand.update');
        Route::get('/brand/delete/{id}', 'destroy')->name('brand.delete');
    });
    //All Routes for brand End


    //All Routes for Popup Message Start
    Route::controller(PopupMessageController::class)->group(function () {
        Route::get('/popupMessage', 'index')->name('popupMessage');
        Route::post('/popupMessage/store', 'store')->name('popupMessage.store');
        Route::get('/popupMessage/view', 'view')->name('popupMessage.view');
        Route::get('/popupMessage/edit/{id}', 'edit')->name('popupMessage.edit');
        Route::post('/popupMessage/update/{id}', 'update')->name('popupMessage.update');
        Route::get('/popupMessage/delete/{id}', 'delete')->name('popupMessage.delete');
    });
    //All Routes for Popup Message End


    //All Routes for Tag name Start
    Route::controller(TagNameController::class)->group(function () {
        Route::get('/tagname', 'index')->name('tagname');
        Route::post('/tagname/store', 'store')->name('tagname.store');
        Route::get('/tagname/view', 'view')->name('tagname.view');
        Route::get('/tagname/edit/{id}', 'edit')->name('tagname.edit');
        Route::post('/tagname/update/{id}', 'update')->name('tagname.update');
        Route::get('/tagname/delete/{id}', 'delete')->name('tagname.delete');
    });
    //All Routes for Tag name End


    //All Routes for Home Banner Start
    Route::controller(HomeBannerController::class)->group(function () {
        Route::get('/banner', 'index')->name('banner');
        Route::post('/banner/store', 'store')->name('banner.store');
        Route::get('/banner/view', 'view')->name('banner.view');
        Route::get('/banner/edit/{id}', 'edit')->name('banner.edit');
        Route::post('/banner/update/{id}', 'update')->name('banner.update');
        Route::get('/banner/delete/{id}', 'delete')->name('banner.delete');
        Route::post('/banner/status/{id}', 'bannerStatus')->name('banner.status');
    });
    //All Routes for Home Banner End

    //All Routes for Offer Banner Start
    Route::controller(OfferBannerController::class)->group(function () {
        Route::get('/offerbanner', 'index')->name('offerbanner');
        Route::post('/offerbanner/store', 'store')->name('offerbanner.store');
        Route::get('/offerbanner/view', 'view')->name('offerbanner.view');
        Route::get('/offerbanner/edit/{id}', 'edit')->name('offerbanner.edit');
        Route::post('/offerbanner/update/{id}', 'update')->name('offerbanner.update');
        Route::get('/offerbanner/delete/{id}', 'delete')->name('offerbanner.delete');
        Route::post('/offerbanner/status/{id}', 'statusUpdate')->name('offerbanner.status');
    });
    //All Routes for Offer Banner End

    //All Routes for Product Start
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product');
        Route::post('/product/store', 'store')->name('product.store');
        Route::post('/product/update/{id}', 'update')->name('product.update');
        Route::get('/product/view', 'view')->name('product.view');
        Route::get('/product/view/{id}', 'viewDetails')->name('product.view.details');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::get('/product/delete/{id}', 'delete')->name('product.delete');
        Route::post('/product/status/{id}', 'productStatus')->name('product.status');
        Route::get('/find/variant/{id}', 'findVariant')->name('find.variant');
        // Route::post('/product/variant/store', 'variantStore')->name('variant.store');
        // Route::get('/product/variant/show/{id}', 'variantShow')->name('variant.show');
        // Route::get('/product/variant/edit/{id}', 'editVariant')->name('variant.edit');
        // Route::post('/product/variant/update/{id}', 'updateVariant')->name('variant.update');
        // Route::get('/product/variant/delete/{id}', 'deleteVariant')->name('variant.delete');

    });
    //All Routes for Product End


    //All Routes for Global Coupons Start
    Route::controller(GlobalCouponController::class)->group(function () {
        Route::get('/global-coupon', 'index')->name('global.coupon');
        Route::post('/global-coupon/store', 'store')->name('global.store');
    });
    //All Routes for Global Coupons End

    //All Routes for Order  Start
    Route::controller(OrderManageController::class)->group(function () {
        Route::get('/new-order', 'index')->name('new.order');

        Route::get('/admin-approve-order/{invoiceNumber}', 'adminApprove')->name('admin.approve.order');
        Route::get('/admin-denied-order/{invoiceNumber}', 'adminDenied')->name('admin.denied.order');
        Route::get('/order/denied', 'deniedOrders')->name('order.denied');


        Route::get('/order/confirmed', 'approvedOrders')->name('order.confirmed');

        Route::get('/order/admin-process-order/{invoiceNumber}', 'orderProcessing')->name('admin.process.order');
        Route::get('/order/processed', 'processedOrders')->name('order.processed');

        Route::get('/order/admin-delivery-order/{invoiceNumber}', 'orderDelivering')->name('admin.delivery.order');
        Route::get('/order/delivering', 'deliveringOrders')->name('order.delivering');

        Route::get('/order/admin-completed-order/{invoiceNumber}', 'orderCompleted')->name('admin.completed.order');
        Route::get('/order/completed', 'completedOrders')->name('order.completed');

        Route::get('/order/admin-refunded-order/{invoiceNumber}', 'orderRefunded')->name('admin.refunded.order');
        Route::get('/order/refunding-orders', 'refundOrders')->name('order.refunding');

        Route::get('/order/refunded-orders', 'refundedOrders')->name('order.refunded');

        Route::get('/order/canceled-orders', 'canceledOrders')->name('order.canceled');
        Route::post('/order/send-sms', 'SendSMS')->name('send.sms');


        Route::get('/order/detailed-orders/{order_id}', 'DetailOrders')->name('order.details');
        // Route::post('/order/send-sms', 'SendSMS')->name('send.sms');


        // Route::get('/admin-cancel-order/{invoiceNumber}', 'adminCancel')->name('admin.cancel.order');

    });

    //All Routes for Order End


    //All Routes for Stock Management System
    Route::controller(StockManageController::class)->group(function () {
        Route::get('/stock/view', 'index')->name('stock.view');
    });
    //All Routes for Stock Management End

    //All Routes for Contact us
    Route::controller(ContactUsController::class)->group(function () {
        Route::get('/contact-message/show', 'show')->name('contact-message.show');
        Route::get('/contact-message/delete', 'destroy')->name('contact-message.delete');
    });
    //All Routes for Contact us

    //All Route for Blog Category
    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('/blog/category/view', 'AddBlogCategory')->name('blog.category.view');
        Route::post('/blog/store/category', 'StoreBlogCategory')->name('blog.category.store');
        Route::get('/blog/all/category/view', 'BlogAllCategoryView')->name('blog.all.category.view');
        Route::get('/blog/category/edit/{id}', 'EditBlogCategory')->name('blog.category.edit');
        Route::post('/blog/category/update/{id}', 'UpdateBlogCategory')->name('blog.category.update');
        Route::get('/blog/category/delete/{id}', 'DeleteBlogCategory')->name('blog.category.delete');
    });
    //Blog Post All Route Start
    Route::controller(BlogPostController::class)->group(function () {
        Route::get('/blog/post/add', 'AddBlogPost')->name('blog.post.add.view');
        Route::post('/blog/post/store', 'StoreBlogPost')->name('blog.store');
        Route::get('/blog/post/all/view', 'allBlogPostView')->name('blog.all.post.view');
        Route::get('/blog/post/edit/{id}', 'BlogPostEdit')->name('blog.post.edit');
        Route::post('/blog/post/update/{id}', 'BlogPostupdate')->name('blog.post.update');
        Route::get('/blog/post/delete/{id}', 'BlogPostDelete')->name('blog.post.delete');
        Route::get('/blog/post/inactive/{id}', 'BlogActiveToInactive')->name('blog.post.inactive');
        Route::get('/blog/post/active/{id}', 'BlogInctiveToActive')->name('blog.post.active');
    });
    //Blog Post All Route End

    //All Routes for Sub Subcategory Start
    Route::controller(SubSubcategoryController::class)->group(function () {
        Route::get('/sub-subcategory', 'index')->name('sub.subcategory');
        Route::post('/sub-subcategory/store', 'store')->name('sub.subcategory.store');
        Route::get('/sub-subcategory/view', 'view')->name('sub.subcategory.view');
        Route::get('/sub-subcategory/edit/{id}', 'edit')->name('sub.subcategory.edit');
        Route::post('/sub-subcategory/update/{id}', 'update')->name('sub.subcategory.update');
        Route::get('/sub-subcategory/delete/{id}', 'delete')->name('sub.subcategory.delete');
        Route::get('/find/sub-subcategory/{id}', 'findSubSubcat')->name('sub.subcategory.find');
    });
    //All Routes for Sub Subcategory End

    //Blog Comment All Route Start
    Route::controller(BlogCommentController::class)->group(function () {
        Route::get('/blog/all/pending/comment', 'BlogAllPendingComment')->name('blog.all.pending.comment');
        Route::get('/blog/all/approve/comment', 'BlogAllApproveComment')->name('blog.all.approved.comment');
        Route::get('/blog/pending/comment/approve/{id}', 'BlogCommentPendingToApprove')->name('blog.comment.approve');
        Route::get('/blog/approve/comment/pending/{id}', 'BlogCommentApproveToPending')->name('comment.approve.cancel');
        Route::get('/blog/comment/delete/{id}', 'BlogCommentDelete')->name('comment.delete');
        //Reply Comment route

    });
    //Blog Comment All Route End

    //Company Details All Route Start
    Route::controller(CompanyDetailsController::class)->group(function () {
        Route::get('/company-details', 'index')->name('company-details');
        Route::post('/company-details/add', 'store')->name('company-details.store');
        Route::get('/company-details/view', 'view')->name('company-details.view');
        Route::get('/company-details/edit/{id}', 'edit')->name('company-details.edit');
        Route::post('/company-details/update/{id}', 'update')->name('company-details.update');
        Route::get('/company-details/delete/{id}', 'delete')->name('company-details.delete');
        Route::post('/company-details/status/{id}', 'status')->name('company-details.status');
    });
    //Company Details All Route End

    //Purchase Details All Route Start
    Route::controller(PurchaseDetailsController::class)->group(function () {
        Route::get('/purchase', 'index')->name('purchase');
        Route::post('/purchase/add', 'store')->name('purchase.store');
        Route::get('/purchase/view', 'view')->name('purchase.view');
        Route::get('/purchase/view/details/{id}', 'viewDetails')->name('purchase.view.details');
        Route::get('/purchase/edit/{id}', 'edit')->name('purchase.edit');
        Route::post('/purchase/update/{id}', 'update')->name('purchase.update');
        Route::get('/purchase/delete/{id}', 'delete')->name('purchase.delete');
        // Route::post('/purchase/status/{id}', 'status')->name('purchase.status');
    });
    //Purchase Details All Route End


    //Company Details All Route Start
    Route::controller(CompanyDetailsController::class)->group(function () {
        Route::get('/company-details', 'index')->name('company-details');
        Route::post('/company-details/add', 'store')->name('company-details.store');
        Route::get('/company-details/view', 'view')->name('company-details.view');
        Route::get('/company-details/edit/{id}', 'edit')->name('company-details.edit');
        Route::post('/company-details/update/{id}', 'update')->name('company-details.update');
        Route::get('/company-details/delete/{id}', 'delete')->name('company-details.delete');
        Route::post('/company-details/status/{id}', 'status')->name('company-details.status');
    });
    //Company Details All Route End
});

//All Routes for Global Coupons Start
Route::controller(GlobalCouponController::class)->group(function () {
    Route::get('/apply-coupon/{code}', 'applyCoupon')->name('apply.coupon');
});
//All Routes for Global Coupons End

//User Tracker Details All Route Start
Route::controller(UserTrackerController::class)->group(function () {
    Route::post('/user-tracker/user-count', 'store')->name('user.count');
    Route::get('/user-tracker/show', 'index')->name('user-tracker.show');
    // Route::post('/company-details/add', 'store')->name('company-details.store');
    // Route::get('/company-details/edit/{id}', 'edit')->name('company-details.edit');
    // Route::post('/company-details/update/{id}', 'update')->name('company-details.update');
    // Route::get('/company-details/delete/{id}', 'delete')->name('company-details.delete');
    // Route::post('/company-details/status/{id}', 'status')->name('company-details.status');
});
//User Tracker All Route End

require __DIR__ . '/auth.php';
require __DIR__ . '/frontend.php';
