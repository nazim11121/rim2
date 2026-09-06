<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\AmenitiesController;
use App\Http\Controllers\Admin\FoodManagementController;
use App\Http\Controllers\Admin\CheckInController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\HouseKeepingController;
use App\Http\Controllers\Admin\LaundryController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\JournalPostController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\StayController;
use App\Http\Controllers\Admin\RateTierController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/packages', [FrontendController::class, 'packageList'])->name('packages');
Route::get('/rooms', [FrontendController::class, 'roomList'])->name('rooms');
Route::get('/services', [FrontendController::class, 'services'])->name('services');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/packages/details/{id}', function () {
    return view('frontend.packages');
})->name('package.details');
Route::get('/terms-and-conditions', [FrontendController::class, 'terms'])->name('terms');
Route::get('/faq', [FrontendController::class, 'faq'])->name('faq');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/journal', [FrontendController::class, 'journal'])->name('journal');
Route::get('/journal/{slug}', [FrontendController::class, 'journalShow'])->name('journal.show');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->name('admin.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/room', RoomController::class);
    Route::resource('/rooms/type', RoomTypeController::class);
    Route::resource('/rooms/amenities', AmenitiesController::class);
    Route::resource('/food-management', FoodManagementController::class);
    Route::get('food-management/dining/list', [FoodManagementController::class, 'diningList'])->name('food-management.dining.list');
    Route::get('food-management/dining/create', [FoodManagementController::class, 'diningCreate'])->name('food-management.dining.create');
    Route::post('food-management/dining/store', [FoodManagementController::class, 'diningStore'])->name('food-management.dining.store');
    Route::get('food-management/dining/{id}/edit', [FoodManagementController::class, 'diningEdit'])->name('food-management.dining.edit');
    Route::match(['PUT','PATCH'],'food-management/dining/{id}', [FoodManagementController::class, 'diningUpdate'])->name('food-management.dining.update');
    Route::delete('food-management/dining/destroy', [FoodManagementController::class, 'diningDestroy'])->name('food-management.dining.destroy');

    Route::resource('/checkIn', CheckInController::class);
    Route::get('/checkIn/page2/create/{id}', [CheckInController::class, 'page2Create'])->name('checkIn.page2.create');
    Route::post('/checkIn/page2/store', [CheckInController::class, 'page2Store'])->name('checkIn.page2.store');
    Route::get('/checkOut/create/{id}', [CheckInController::class, 'checkoutPage'])->name('checkout.create');
    Route::match(['PUT','PATCH'],'/checkOut/update/{id}', [CheckInController::class, 'getCheckoutInfo'])->name('checkout.update');
    Route::get('/checkout/list', [CheckInController::class, 'checkoutList'])->name('checkout.list');
    Route::get('/checkout/view/{id}', [CheckInController::class, 'checkoutView'])->name('checkout.view');
    Route::resource('/house-keeping', HouseKeepingController::class);
    Route::resource('/laundry', LaundryController::class);
    Route::get('/laundry/receive/{id}', [LaundryController::class, 'receive'])->name('laundry.receive');
    Route::get('/laundry/details/{id}', [LaundryController::class, 'details'])->name('laundry.details');
    Route::match(['PUT','PATCH'],'/laundry/receive/update/{id}', [LaundryController::class, 'receiveUpdate'])->name('laundry.receive.update');
    Route::resource('/vendors', VendorController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/frontend/aboutUs', AboutUsController::class);
    Route::resource('/package', PackageController::class);
    Route::get('/package/details/{id}', [PackageController::class, 'create'])->name('package.details');
    Route::resource('/package-category', PackageCategoryController::class);
    Route::resource('/slider', SliderController::class);
    Route::resource('/account/expense', ExpenseController::class);
    Route::get('/report/income', [ReportController::class, 'income'])->name('report.income');
    Route::get('/report/expense', [ReportController::class, 'expense'])->name('report.expense');

    // Online-booking domain (Stay/RateTier/Promo/Reservation/Setting). None of
    // these resource names collide with a public frontend route (see the public
    // routes above: /, about, packages, rooms, services, contact, terms, faq,
    // gallery, journal), so — unlike the admin/-prefixed block below — they
    // follow the OLDER, majority convention here of bare names (/package,
    // /room, etc.) for consistency with most of this app.
    Route::resource('/stays', StayController::class);
    Route::post('/rate-tiers', [RateTierController::class, 'store'])->name('rateTiers.store');
    Route::delete('/rate-tiers/{id}', [RateTierController::class, 'destroy'])->name('rateTiers.destroy');
    Route::resource('/promos', PromoController::class);
    Route::resource('/reservations', ReservationController::class)->only(['index', 'show']);
    Route::post('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Prefixed with admin/ (unlike the older resources above) because these
    // resource names collide with public frontend routes of the same name
    // (/faq, /gallery, /journal are real public pages — see routes above).
    Route::prefix('admin')->group(function () {
        Route::resource('/faq', FaqController::class);
        Route::resource('/gallery', GalleryController::class);
        Route::resource('/journal', JournalPostController::class);
        Route::resource('/enquiries', EnquiryController::class)->only(['index', 'show', 'destroy']);
    });

});

Route::resource('/frontend/menu', MenuController::class);

Route::get('/optimize-clear', function () {
    Artisan::call('optimize:clear');
    return 'Optimization caches cleared!';
});

require __DIR__.'/auth.php';
