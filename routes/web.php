<?php
use App\Models\Invoices;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\Invoices_ReportController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\Customers_ReportController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource('invoices', InvoicesController::class);
Route::get('edit_invoice/{id}', [InvoicesController::class, 'edit']);
Route::get('Status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');
Route::post('Status_Update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');


Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);

Route::resource('InvoiceAttachments' , InvoiceAttachmentsController::class);

Route::resource('Archive', InvoiceArchiveController::class);


Route::get('Print_invoice/{id}' , [InvoicesController::class, 'Print_invoice']);


Route::get('InvoicesDetails/{id}', [InvoiceDetailsController::class, 'show']);

Route::get('View_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class, 'View_file']);
Route::get('download/{invoice_number}/{file_name}', [InvoiceDetailsController::class, 'download_file']);
Route::post('delete_file', [InvoiceDetailsController::class, 'destroy'])->name('delete_file');



// ده الراوت الخاص بانه يجيب المنتجات التابعه لكل قسم فاضافة الفاتورة تبع كود الاجاكس
Route::get('section/{id}', [InvoicesController::class, 'getSectionProducts']);


// حالات الدفع
Route::get('Invoice_Paid' , [InvoicesController::class , 'Invoice_Paid']);
Route::get('Invoice_UnPaid' , [InvoicesController::class , 'Invoice_UnPaid']);
Route::get('Invoice_Partial' , [InvoicesController::class , 'Invoice_Partial']);


// Permissions
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles' , RoleController::class);
    Route::resource('users' , UserController::class);
});



// Reports
Route::get('invoices_report' , [Invoices_ReportController::class, 'index']);
Route::post('Search_invoices' , [Invoices_ReportController::class, 'Search_invoices']);

Route::get('customers_report' , [Customers_ReportController::class, 'index']);
Route::post('Search_customers' , [Customers_ReportController::class, 'Search_customers']);


// Notifications
Route::get('MarkAsRead_all' , [InvoicesController::class , 'MarkAsRead_all'])->name('MarkAsRead_all');
    

Route::get('/{page}' , [AdminController::class, 'index']);
