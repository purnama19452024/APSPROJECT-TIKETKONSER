<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\BackupController as AdminBackupController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CalculatorController as AdminCalculatorController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\ConcertController as AdminConcertController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WithdrawalController as AdminWithdrawalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatImageController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AnnouncementController as UserAnnouncementController;
use App\Http\Controllers\User\ChatController as UserChatController;
use App\Http\Controllers\User\FeedbackController as UserFeedbackController;
use App\Http\Controllers\User\WithdrawalController as UserWithdrawalController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/concerts', [ConcertController::class, 'index'])->name('concerts.index');
Route::get('/concerts/{concert}', [ConcertController::class, 'show'])->name('concerts.show');
Route::get('/api/concerts/upcoming', [ConcertController::class, 'upcoming'])->name('api.concerts.upcoming');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');
    Route::get('/concerts/{concert}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/concerts/{concert}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{booking}/proof', [BookingController::class, 'uploadProof'])->name('bookings.proof');
    Route::post('/notifications/read', [NotificationController::class, 'markAllAsRead'])->name('notifications.read');

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile');
    Route::put('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::post('/user/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('user.profile.avatar');

    Route::get('/user/feedback', [UserFeedbackController::class, 'create'])->name('user.feedback');
    Route::post('/user/feedback', [UserFeedbackController::class, 'store'])->name('user.feedback.store');

    Route::get('/user/chat', [UserChatController::class, 'index'])->name('user.chat');
    Route::post('/user/chat', [UserChatController::class, 'store'])->name('user.chat.store');

    Route::get('/user/announcements', [UserAnnouncementController::class, 'index'])->name('user.announcements');

    Route::get('/user/withdrawals', [UserWithdrawalController::class, 'index'])->name('user.withdrawals.index');
    Route::get('/user/withdrawals/create', [UserWithdrawalController::class, 'create'])->name('user.withdrawals.create');
    Route::post('/user/withdrawals', [UserWithdrawalController::class, 'store'])->name('user.withdrawals.store');

    Route::delete('/chats/{chat}/image', [ChatImageController::class, 'destroy'])->name('chats.image.delete');
});

Route::middleware(['auth', 'role:admin,supervisor'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('calculator', [AdminCalculatorController::class, 'index'])->name('calculator');
    Route::resource('concerts', AdminConcertController::class);
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::patch('bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('bookings/{booking}/cancel', [AdminBookingController::class, 'cancel'])->name('bookings.cancel');

    Route::get('announcements', [AdminAnnouncementController::class, 'index'])->name('announcements.index');

    Route::get('feedbacks', [AdminFeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('feedbacks/{feedback}', [AdminFeedbackController::class, 'show'])->name('feedbacks.show');

    Route::get('chats', [AdminChatController::class, 'index'])->name('chats.index');
    Route::get('chats/{user}', [AdminChatController::class, 'show'])->name('chats.show');
    Route::post('chats/{user}/reply', [AdminChatController::class, 'reply'])->name('chats.reply');

    Route::get('backup', [AdminBackupController::class, 'index'])->name('backup.index');
    Route::get('backup/download/{filename}', [AdminBackupController::class, 'download'])->name('backup.download');

    Route::get('withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('withdrawals/{withdrawal}', [AdminWithdrawalController::class, 'show'])->name('withdrawals.show');

    Route::get('invoices', [AdminInvoiceController::class, 'index'])->name('invoices.index');
    Route::get('invoices/create', [AdminInvoiceController::class, 'create'])->name('invoices.create')->middleware('role:admin');
    Route::post('invoices', [AdminInvoiceController::class, 'store'])->name('invoices.store')->middleware('role:admin');
    Route::get('invoices/{invoice}', [AdminInvoiceController::class, 'show'])->name('invoices.show');
    Route::get('invoices/{invoice}/pdf', [AdminInvoiceController::class, 'exportPdf'])->name('invoices.pdf');
    Route::get('invoices/{invoice}/word', [AdminInvoiceController::class, 'exportWord'])->name('invoices.word');

    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [AdminUserController::class, 'show'])->name('users.show');

    Route::middleware('role:admin')->group(function () {
        Route::get('users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::post('users/{user}/top-up', [AdminUserController::class, 'topUp'])->name('users.top-up');

        Route::get('announcements/create', [AdminAnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('announcements', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('announcements/{announcement}/edit', [AdminAnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('announcements/{announcement}', [AdminAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('announcements/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');

        Route::delete('feedbacks/{feedback}', [AdminFeedbackController::class, 'destroy'])->name('feedbacks.destroy');

        Route::patch('withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::post('withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');

        Route::post('invoices/{invoice}/signature', [AdminInvoiceController::class, 'uploadSignature'])->name('invoices.signature');

        Route::post('backup/create', [AdminBackupController::class, 'create'])->name('backup.create');
        Route::post('backup/restore', [AdminBackupController::class, 'restore'])->name('backup.restore');
        Route::delete('backup/{filename}', [AdminBackupController::class, 'destroy'])->name('backup.destroy');
    });
});

require __DIR__.'/auth.php';
