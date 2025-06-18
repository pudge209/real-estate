<?php

use App\Models\Office;
use App\Mail\RequestEstate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RealController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublishedController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\VirtualTourController;
use App\Http\Controllers\VirtualTourRequestController;
use App\Http\Controllers\WishlistController;
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('admin/dashboard', function () {
    return view('admin/dashboard');
})->middleware(['auth', 'verified','admin'])->name('admin.dashboard');


Route::get('client/dashboard', function () {
    return view('client/dashboard');
})->middleware(['auth', 'verified','client'])->name('client.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','user'])->name('dashboard');



Route::get('vendor/dashboard', function () {
    return view('vendor/dashboard');
})->middleware(['auth', 'verified','vendor'])->name('vendor.dashboard');


Route::middleware('auth')->group(function () {
    Route::get("/dashboard/published", [PublishedController::class, 'publish'])->name('published');
    Route::get("/real/card", [PublishedController::class, 'publish'])->name('real.card');
    Route::patch('/real/{real}/pay', [RealController::class, 'handlePay'])->name('real.handlePay');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // /---------------------------------------------------------------------------/

});

// Other routes

Route::resource('real', RealController::class);
Route::get('/real/publish', [RealController::class, 'publish'])->name('real.publish');
Route::get('/', [PublishedController::class, 'display'])->name('');
Route::get('/vendor/dashboard', [PublishedController::class, 'displayDashboard'])->name('vendor.dashboard');
Route::get('/admin/dashboard', [PublishedController::class, 'displayDashboard'])->name('admin.dashboard');
Route::get('/client/dashboard', [PublishedController::class, 'displayDashboard'])->name('client.dashboard');
Route::get('/lang',[LangController::class , 'setLang'])->name('lang');
Route::get('/dashboard', [PublishedController::class, 'displayDashboard'])->name('dashboard');
Route::get('/search', [PublishedController::class, 'search'])->name('search');
require __DIR__.'/auth.php';


Route::get('/admin/real/show/{real}', [ManageUserController::class, 'realShow'])->name('admin.realShow');
Route::get('/admin', [ManageUserController::class, 'index'])->name('admin.index');
Route::get('/admin/{id}', [ManageUserController::class, 'show'])->name('admin.show');
Route::get('/admin/{id}/edit', [ManageUserController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [ManageUserController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [ManageUserController::class, 'delete'])->name('admin.delete');
Route::get('/admin/reals/{id}', [ManageUserController::class, 'real'])->name('admin.real');
// Route::get('/admin/reals/{id}/edit', [ManageUserController::class, 'edit'])->
Route::patch('/admin/{real}/pay', [ManageUserController::class, 'handlePay'])->name('admin.handlePay');
// Route::get("/email",function(){

//     return new RequestEstate();
// });

Route::get('/estate-delete/{estateId}', [ClientController::class, 'deleteEstate'])->name('estate.delete');
Route::post('/email/{estateId}', [MailController::class, 'sendEstateNotification'])->name('email');
Route::get('estate/reject/{estateId}', [MailController::class, 'rejectEstateRequest'])->name('estate.reject');
require __DIR__.'/auth.php';
Route::resource('office', OfficeController::class);
Route::get('mo/{officeId}', [OfficeController::class, 'mo'])->name('office.mo');
Route::get('list', [OfficeController::class, 'list'])->name('office.list');




Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');


Route::get('D:\real\New folder (13)\jr_project\resources\views\admin\offices.blade.php', [OfficeController::class, 'officeStats'])->name('admin.offices');
Route::get('/admin/offices/{id}/view-houses', [OfficeController::class, 'viewHouses'])->name('admin.offices.viewHouses');
Route::delete('/admin/offices/{id}', [OfficeController::class, 'destroy'])->name('admin.offices.destroy');
// Display houses for a specific office
Route::get('/admin/offices/{office}/houses', [OfficeController::class, 'showHouses'])->name('admin.offices.viewHouses');

// Delete a house from a specific office
Route::delete('/admin/offices/{office}/houses/{house}', [OfficeController::class, 'destroyHouse'])->name('admin.offices.destroyHouse');

// Routes for ratings
// Route::resource('ratings', RatingController::class)->only([
//     'store', 'update', 'destroy'
// ]);
// // Reviews routes
// Route::resource('reviews', ReviewController::class)->only([
//     'store', 'update', 'destroy'
// ]);

// routes/web.php

// Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
// Route::post('/ratings/update/{id}', [RatingController::class, 'update'])->name('ratings.update');
// Route::post('/ratings/delete/{id}', [RatingController::class, 'destroy'])->name('ratings.destroy');
// // Review Routes
// Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
// Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
// Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');


// Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
// Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
// Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
// Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
// Route::delete('/ratings/{id}', [RatingController::class, 'destroy'])->name('ratings.destroy');


// web.php

// Routes for Ratings

// Rating Routes
Route::post('/real-estate/{id}/ratings', [RatingController::class, 'store'])->name('real-estate.ratings.store');
Route::delete('/real-estate/{id}/ratings', [RatingController::class, 'destroy'])->name('real-estate.ratings.destroy');
// Route::get('/real-estate/{id}', [RatingController::class, 'show'])->name('real-estate.show');

// Reviews Routes
Route::post('/real-estate/{id}/reviews', [ReviewController::class, 'store'])->name('real-estate.reviews.store');
Route::put('/real-estate/{id}/reviews/{reviewId}', [ReviewController::class, 'update'])->name('real-estate.reviews.update');
Route::delete('/real-estate/{id}/reviews/{reviewId}', [ReviewController::class, 'destroy'])->name('real-estate.reviews.destroy');


Route::post('/request-virtual-tour/{estateId}', [VirtualTourRequestController::class, 'requestVirtualTour'])->name('request-virtual-tour');

Route::get('/virtual-tour/accept/{estateId}/{userId}', [VirtualTourRequestController::class, 'accept']);
Route::get('/virtual-tour/reject/{estateId}/{userId}', [VirtualTourRequestController::class, 'reject']);


Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::get('/help', [HelpController::class, 'index'])->name('help');


// Route::get('/conversations/create/{user_id}', [ChatController::class, 'create'])->name('conversations.create');
// // Route::post('/conversations/store', [ChatController::class, 'store'])->name('conversations.store');
// Route::get('/conversations', [ChatController::class, 'index'])->name('conversations.index');
// Route::get('/conversations/{id}', [ChatController::class, 'show'])->name('conversations.show');
// // Route::post('/conversations/{id}/message', [ChatController::class, 'store'])->name('conversations.message.store');
// Route::post('/conversations/{id}/message', [ChatController::class, 'store'])->name('conversations.message.store');
Route::get('/conversations/create/{user_id}', [ChatController::class, 'create'])->name('conversations.create');
Route::post('/conversations/store', [ChatController::class, 'store'])->name('conversations.store');
Route::get('/conversations', [ChatController::class, 'index'])->name('conversations.index');
Route::get('/conversations/{id}', [ChatController::class, 'show'])->name('conversations.show');
Route::post('/conversations/{id}/message', [ChatController::class, 'store'])->name('conversations.message.store');


Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/{real}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove/{real}', [WishlistController::class, 'remove'])->name('wishlist.remove');
