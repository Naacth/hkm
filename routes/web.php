<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KabinetController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\DivisiMemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoucherController;

// Public Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'publicPage']);
Route::get('/kabinet', [KabinetController::class, 'publicPage']);
Route::get('/divisi', [DivisiController::class, 'publicPage']);
Route::get('/event', [EventController::class, 'publicPage'])->name('event');
Route::get('/produk', [ProdukController::class, 'publicPage'])->name('produk');
Route::get('/galeri', [GaleriController::class, 'publicPage']);
Route::get('/kontak', [KontakController::class, 'publicPage']);
Route::get('/divisi/{divisi}', [DivisiController::class, 'showDetail'])->name('divisi.detail');

// User Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Order Routes
    Route::get('/orders/create/{produk}', [OrderController::class, 'showOrderForm'])->name('orders.create');
    Route::post('/orders/{produk}', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/success/{order}', [OrderController::class, 'success'])->name('orders.success');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    
    // Event Registration Routes
    Route::get('/event-registrations/create/{event}', [EventRegistrationController::class, 'showRegistrationForm'])->name('event-registrations.create');
    Route::post('/event-registrations/{event}', [EventRegistrationController::class, 'register'])->name('event-registrations.register');
    Route::get('/event-registrations/success/{registration}', [EventRegistrationController::class, 'success'])->name('event-registrations.success');
    Route::get('/event-registrations/history', [EventRegistrationController::class, 'history'])->name('event-registrations.history');
    Route::get('/event-registrations/{registration}', [EventRegistrationController::class, 'show'])->name('event-registrations.show');
    Route::post('/event-registrations/{registration}/cancel', [EventRegistrationController::class, 'cancel'])->name('event-registrations.cancel');
});

// Admin Authentication Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

// Protected Admin Routes
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/profile', [AdminAuthController::class, 'profile'])->name('admin.profile');
    Route::post('/profile', [AdminAuthController::class, 'updateProfile'])->name('admin.profile.update');
    
    Route::get('/dashboard', function () {
        // Recent data
        $recentEvents = App\Models\Event::with('registrations')->latest()->take(5)->get();
        $recentDivisis = App\Models\Divisi::latest()->take(3)->get();
        $recentOrders = App\Models\Order::with('produk')->latest()->take(5)->get();
        
        // Statistics
        $totalEvents = App\Models\Event::count();
        $totalRegistrations = App\Models\EventRegistration::count();
        $totalOrders = App\Models\Order::count();
        
        // Revenue calculations
        $orderRevenue = App\Models\Order::whereNotIn('status', ['cancelled'])->sum(DB::raw('COALESCE(final_price, total_price)'));
        $eventRevenue = App\Models\EventRegistration::where('payment_status', 'paid')->sum(DB::raw('COALESCE(final_price, 0)'));
        $totalRevenue = $orderRevenue + $eventRevenue;
        
        // Cancelled revenue
        $cancelledOrders = App\Models\Order::where('status','cancelled')->sum(DB::raw('COALESCE(final_price, total_price)'));
        $cancelledEvents = App\Models\EventRegistration::where('payment_status','failed')->orWhere('status','cancelled')->sum(DB::raw('COALESCE(final_price, 0)'));
        $cancelledRevenue = $cancelledOrders + $cancelledEvents;
        
        return view('admin-dashboard-new', compact(
            'recentEvents', 'recentDivisis', 'recentOrders',
            'totalEvents', 'totalRegistrations', 'totalOrders',
            'orderRevenue', 'eventRevenue', 'totalRevenue',
            'cancelledRevenue'
        ));
    })->name('admin-dashboard');
    
    // Admin Resources
    Route::resource('events', EventController::class);
    // Batch Certificate Generation
    Route::post('/events/{event}/batch-certificates', [EventController::class, 'batchGenerateCertificates'])->name('admin.events.batch-certificates');
    Route::get('/events/download-batch/{filename}', [EventController::class, 'downloadBatchCertificates'])->name('admin.events.download-batch');
    Route::resource('abouts', AboutController::class);
    Route::resource('galeris', GaleriController::class);
    Route::resource('produks', ProdukController::class);
    Route::resource('kontaks', KontakController::class);
    Route::resource('kabinets', KabinetController::class);
    Route::resource('divisis', DivisiController::class);
    Route::resource('divisi-members', DivisiMemberController::class);
    
    // Admin Order Management
    Route::get('/orders', [OrderController::class, 'adminIndex'])->name('admin.orders.index');
    Route::get('/orders/export', [OrderController::class, 'exportOrders'])->name('admin.orders.export-orders');
    Route::get('/orders/{order}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::post('/orders/{order}/status', [OrderController::class, 'adminUpdateStatus'])->name('admin.orders.update-status');
    
    // Admin Event Registration Management
    Route::get('/event-registrations', [EventRegistrationController::class, 'adminIndex'])->name('admin.event-registrations.index');
    Route::get('/event-registrations/export', [EventRegistrationController::class, 'exportAllRegistrations'])->name('admin.event-registrations.export-all-registrations');
    Route::get('/event-registrations/{registration}', [EventRegistrationController::class, 'adminShow'])->name('admin.event-registrations.show');
    Route::post('/event-registrations/{registration}/status', [EventRegistrationController::class, 'adminUpdateStatus'])->name('admin.event-registrations.update-status');

    // Admin Event Participants Management
    Route::get('/events/{event}/participants', [EventRegistrationController::class, 'adminEventParticipants'])->name('admin.events.participants');
    Route::get('/events/{event}/participants/export', [EventRegistrationController::class, 'exportParticipants'])->name('admin.event-registrations.export-participants');
    Route::post('/event-registrations/{registration}/upload-certificate', [EventRegistrationController::class, 'uploadCertificate'])->name('admin.event-registrations.upload-certificate');
    
    // Admin Order Export
    // Admin Vouchers
    Route::post('/produks/{produk}/vouchers', [VoucherController::class, 'storeForProduk'])->name('admin.produks.vouchers.store');
    Route::post('/events/{event}/vouchers', [VoucherController::class, 'storeForEvent'])->name('admin.events.vouchers.store');
    Route::delete('/vouchers/{voucher}', [VoucherController::class, 'destroy'])->name('admin.vouchers.destroy');
    
    // Admin Payment Management
    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('admin.payments.index');
    Route::post('/payments/event/{registration}/approve', [App\Http\Controllers\Admin\PaymentController::class, 'approveEventPayment'])->name('admin.payments.event.approve');
    Route::post('/payments/product/{order}/approve', [App\Http\Controllers\Admin\PaymentController::class, 'approveProductPayment'])->name('admin.payments.product.approve');
    Route::post('/payments/{type}/{id}/reject', [App\Http\Controllers\Admin\PaymentController::class, 'rejectPayment'])->name('admin.payments.reject');
    
    // Super Admin Routes
    Route::get('/super-admin', [AdminAuthController::class, 'superAdminDashboard'])->name('admin.super-admin.dashboard');
    Route::post('/super-admin/admins', [AdminAuthController::class, 'createAdmin'])->name('admin.super-admin.create');
    Route::post('/super-admin/admins/{admin}', [AdminAuthController::class, 'updateAdmin'])->name('admin.super-admin.update');
    Route::delete('/super-admin/admins/{admin}', [AdminAuthController::class, 'deleteAdmin'])->name('admin.super-admin.delete');
    
});

// User Certificate Routes (outside admin middleware)
Route::middleware('auth')->group(function () {
    Route::get('/certificates', [EventController::class, 'certificates'])->name('certificates.index');
    // Certificate Download - accessible by authenticated users
    Route::get('/events/certificate/{registration}', [EventController::class, 'downloadCertificate'])->name('events.certificate.download');
    // Template Download - original PDF template
    Route::get('/events/template/{registration}', [EventController::class, 'downloadTemplate'])->name('events.certificate.template');
    // Custom Certificate Page
    Route::get('/certificates/custom/{registration}', function($registrationId) {
        $registration = \App\Models\EventRegistration::with(['event', 'user'])->findOrFail($registrationId);
        if (auth()->id() !== $registration->user_id) {
            abort(403);
        }
        return view('certificates.custom', compact('registration'));
    })->name('certificates.custom');
    // Name Only Certificate - custom positioning
    Route::get('/events/name-only/{registration}', [EventController::class, 'generateNameOnly'])->name('events.certificate.name-only');
    // Auto-positioned Certificate - optimal positioning
    Route::get('/events/auto-certificate/{registration}', [EventController::class, 'generateAutoPositioned'])->name('events.certificate.auto');
    // Preview Custom Certificate
    Route::get('/events/preview-certificate/{registration}', [EventController::class, 'previewCustomCertificate'])->name('events.certificate.preview');
    // WhatsApp Group Access - only for paid participants
    Route::get('/events/whatsapp/{registration}', [EventController::class, 'joinWhatsAppGroup'])->name('events.whatsapp.join');
    // Test Certificate Generation
    Route::get('/events/test-certificate/{registration}', [EventController::class, 'testCertificate'])->name('events.certificate.test');
});

// Legacy routes for backward compatibility
Route::get('/admin', function () {
    return redirect('/admin/login');
})->name('admin-dashboard-old');

Route::get('/dashboard', function () {
    return view('user-dashboard');
});
