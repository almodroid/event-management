<?php

use App\Http\Controllers\OrganizerAuthController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\OrganizerAttendanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


Route::post('/admin/mark-attendance', [AdminController::class, 'markAttendance']);


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
    Route::get('/admin/attendance-scanner', QRScanner::class)->name('admin.attendance-scanner');
    Route::post('/admin/scan-organizer', [QRScanner::class, 'scanQrCode'])->name('admin.scan-organizer');

});

Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('set-locale');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسارات تسجيل الدخول والخروج للمنظمين
Route::get('/organizer/login', [OrganizerAuthController::class, 'showLoginForm'])->name('organizer.login');
Route::post('/organizer/login', [OrganizerAuthController::class, 'login']);
Route::post('/organizer/logout', [OrganizerAuthController::class, 'logout'])->name('organizer.logout');

// مسارات للمنظمين بعد تسجيل الدخول
Route::middleware(['auth:organizer'])->group(function () {
    Route::get('/organizer/dashboard', [OrganizerController::class, 'dashboard'])->name('organizer.dashboard');
    Route::get('/organizer/scanner', [OrganizerController::class, 'showScanner'])->name('organizer.scanner');
    Route::post('/organizer/scan-ticket', [OrganizerController::class, 'scanTicket'])->name('organizer.scanTicket');
    Route::get('/organizer/tickets', [OrganizerController::class, 'showTickets'])->name('organizer.tickets');
    Route::post('/organizer/tickets', [OrganizerController::class, 'addTicket'])->name('organizer.addTicket');
});


Route::get('/about', [EventController::class, 'about'])->name('about');
Route::get('/privacy', [EventController::class, 'privacy'])->name('privacy');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/tickets/buy/{event}', [TicketController::class, 'buy'])->name('tickets.buy');
Route::post('/tickets/process/{event}', [TicketController::class, 'process'])->name('tickets.process');


Route::post('/verify-ticket', [TicketController::class, 'verify']);
Route::post('/get-organizer-by-qr-code', [OrganizerController::class, 'getOrganizerByQrCode']);
Route::post('/attendance/scan-qr-code', [AttendanceController::class, 'scanQrCode'])->name('attendance.scanQrCode');


require __DIR__.'/auth.php';
