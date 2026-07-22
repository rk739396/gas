<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AdjustbalanceController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FosassignController;
use App\Http\Controllers\DebitpaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CreditchargeController;
use App\Http\Controllers\CompanyAccessRequestController;
use App\Http\Controllers\VirtualBalanceController;

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

// UserController
Route::get('/add-user', [UserController::class, 'index'])->name('add-user');
Route::post('/save-user', [UserController::class, 'create'])->name('save-user');
Route::get('/view-user',[UserController::class, 'view_user'])->name('view-user');
Route::get('/view-profile',[UserController::class, 'view_profile'])->name('view-profile');
Route::get('/view-team',[UserController::class, 'view_team'])->name('view-team');
Route::get('/update-user/{id}',[UserController::class, 'edit']);
Route::put('/update-user/{id}', [UserController::class, 'update']);
Route::get('/delete-user/{id}', [UserController::class, 'destroy']);
Route::post('/update-password', [UserController::class, 'update_password'])->name('update-password');

// loginusercontroller 
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::match(['get', 'post'],'/loginuser',[LoginController::class,'loginuser'])->name('loginuser');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

// CallController 

Route::get('/dashboard',[CallController::class,'index'])->name('dashboard');
Route::get('/sup-dashboard',[CallController::class,'sup_dash'])->name('sup-dashboard');
Route::get('/dist-dashboard',[CallController::class,'dist_dash'])->name('dist-dashboard');
Route::get('/tt-dashboard',[CallController::class,'top_dash'])->name('tt-dashboard');
Route::get('/fos-dashboard',[CallController::class,'fos_dash'])->name('fos-dashboard');
Route::get('/ret-dashboard',[CallController::class,'ret_dash'])->name('ret-dashboard');


// Companycontroller 
Route::get('/add-company', [CompanyController::class, 'index'])->name('add-company');
Route::post('/save-company', [CompanyController::class, 'create'])->name('save-company');
Route::get('/view-company',[CompanyController::class, 'view_company'])->name('view-company');
Route::get('/update-company/{id}',[CompanyController::class, 'edit']);
Route::put('/update-company/{id}', [CompanyController::class, 'update']);
Route::get('/delete-company/{id}', [CompanyController::class, 'destroy']);

// CreditchargeController 
Route::get('/add-charges', [CreditchargeController::class, 'index'])->name('add-charges');
Route::post('/save-charges', [CreditchargeController::class, 'create'])->name('save-charges');
Route::get('/view-charges',[CreditchargeController::class, 'view'])->name('view-charges');


// AdjustbalanceController 
Route::get('/adjust-balance', [AdjustbalanceController::class, 'index'])->name('add-adjust');
Route::post('/save-adjust', [AdjustbalanceController::class, 'create'])->name('save-adjust');
Route::get('/view-adjust',[AdjustbalanceController::class, 'view_adjust'])->name('view-adjust');

// FosassignController 
Route::get('/change-fos', [FosassignController::class, 'index'])->name('change-fos');
Route::post('/fetch-retailers', [FosassignController::class, 'fetchretailer'])->name('fetch-retailers');
Route::post('/save-fos', [FosassignController::class, 'create'])->name('save-fos');
Route::get('/view-fos',[FosassignController::class, 'view_fos'])->name('view-fos');
Route::get('/update-fos/{id}',[FosassignController::class, 'edit']);
Route::put('/update-fos/{id}', [FosassignController::class, 'update']);

// TopupController
Route::get('/add-topup-request', [TopupController::class, 'index'])->name('add-topup-request');
Route::post('/save-topup-request', [TopupController::class, 'create'])->name('save-topup-request');
Route::get('/view-topup-request',[TopupController::class, 'view_topup'])->name('view-topup');
Route::get('/approve-topup-request/{id}',[TopupController::class, 'edit']);
Route::put('/approve-topup-request/{id}', [TopupController::class, 'accept_update']);
Route::get('/topup-payment/{id}',[TopupController::class, 'edit_payment']);
Route::put('/topup-payment/{id}',[TopupController::class, 'payment']);
Route::get('/delete-topup-request/{id}', [TopupController::class, 'destroy']);


// DebitpaymentController
Route::get('/debit-payment', [DebitpaymentController::class, 'index'])->name('debit-payment');
Route::post('/fetch-balance', [DebitpaymentController::class, 'fetchbalance'])->name('fetch-balance');
Route::post('/payment-done', [DebitpaymentController::class, 'debit_payment'])->name('payment-done');
Route::get('/view-pending-payment',[DebitpaymentController::class, 'view_pending'])->name('view-pending-payment');
Route::get('/payment-collect/{id}',[DebitpaymentController::class, 'payment_collect']);
Route::put('/payment-collect/{id}',[DebitpaymentController::class, 'collect_update']);
Route::get('/view-collect-payment',[DebitpaymentController::class, 'view_collect'])->name('view-collect');


// ReportController
Route::any('/filter', [ReportController::class, 'filter'])->name('filter');
Route::any('/refresh', [ReportController::class, 'filter'])->name('refresh');
Route::get('/account-statement', [ReportController::class, 'account_stmt'])->name('account-statement');
Route::get('/topup-report', [ReportController::class, 'topup_report'])->name('topup-report');
Route::get('/topup-credit-report', [ReportController::class, 'topup_credit_report'])->name('topup-credit-report');
Route::get('/income-report', [ReportController::class, 'income_report'])->name('income-report');
Route::get('/companywise-report', [ReportController::class, 'companywise_report'])->name('companywise-report');
Route::get('/total-retailer-topup-report', [ReportController::class, 'total_topup'])->name('total-retailer-topup');
Route::get('/total-fos-cc-report', [ReportController::class, 'total_fos_collect'])->name('total-fos-cc-report');   



// ProductController
Route::get('/product/add-product',[ProductController::class, 'add_product'])->name('add-product');
Route::post('/product/add-product',[ProductController::class, 'create'])->name('save-product');
Route::get('/product/view-product',[ProductController::class, 'index'])->name('view-product');
Route::get('/product/update-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
Route::put('/product/update-product/{id}', [ProductController::class, 'update'])->name('update-product');
Route::get('/product/delete-product/{id}', [ProductController::class, 'destroy'])->name('delete-product');


// OrderController
Route::get('/order/add-order',[OrderController::class, 'add_order'])->name('add-order');
Route::post('/order/save-order',[OrderController::class, 'create'])->name('save-order');
Route::get('/order/view-order',[OrderController::class, 'view'])->name('view-order');

// NoteController

Route::get('/notes/add-notes',[NoteController::class, 'index'])->name('add-notes');
Route::post('/notes/save-notes',[NoteController::class, 'create'])->name('save-notes');


// Company Access Request


// Retailer
Route::get('/request-company-access',
    [CompanyAccessRequestController::class, 'index'])
    ->name('request-company-access');

Route::get(
    '/my-company-access-request',
    [CompanyAccessRequestController::class, 'myRequests']
)->name('my-company-access-request');    

Route::post('/save-company-access-request',
    [CompanyAccessRequestController::class, 'store'])
    ->name('save-company-access-request');

// Topup Team
Route::get('/view-company-access-request',
    [CompanyAccessRequestController::class, 'view'])
    ->name('view-company-access-request');

Route::get('/approve-company-access-request/{id}',
    [CompanyAccessRequestController::class, 'approve'])
    ->name('approve-company-access-request');

Route::get('/reject-company-access-request/{id}',
    [CompanyAccessRequestController::class, 'reject'])
    ->name('reject-company-access-request');
    
// Creating Commision Functionality for Topup Team
Route::get('/add-commission', [TopupController::class, 'commissionIndex'])->name('add-commission');
Route::post('/save-commission', [TopupController::class, 'commissionStore'])->name('save-commission');

Route::get('/view-commission', [TopupController::class, 'view_commision'])->name('view-commission');
Route::get('/consolidate-account-statement', [TopupController::class, 'accountStatement'])->name('consolidate-account-statement');

# Create Virual Ballance for companies

Route::get('/virtual-balance', [VirtualBalanceController::class, 'index'])->name('virtual-balance');
Route::post('/virtual-balance/store', [VirtualBalanceController::class, 'store'])->name('virtual-balance.store');
Route::get('/virtual-balance/delete/{id}', [VirtualBalanceController::class, 'destroy'])->name('virtual-balance.delete');