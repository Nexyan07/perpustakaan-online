<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\FinesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\KatalogsController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\BookGenresController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReservationsController;

Route::get('/', [BooksController::class, 'highestRating']);

Route::get('/katalogs', [KatalogsController::class, 'index'])->name('katalogs.index');
Route::get('/load-more-books', [KatalogsController::class, 'loadMoreBooks']); // Load More AJAX

Route::get('/katalogs/{slug}', [KatalogController::class, 'index'])->name('katalog.index')->middleware('auth');
Route::post('/katalog/{id}', [KatalogController::class, 'store'])->name('reservation');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/', [LoginController::class, 'logout'])->name('logout');
Route::get('validate-old-password', [LoginController::class, 'validateOldPasswordPage'])->name('validate.old.password');
Route::post('validate-old-password', [LoginController::class, 'validateOldPassword'])->name('validate.password');
Route::get('change-password', [LoginController::class, 'changePasswordPage']);
Route::post('change-password', [LoginController::class, 'changePassword'])->name('change.password');
Route::put('/edit-profile', [LoginController::class, 'destroyFoto'])->name('destroyFoto');
Route::put('/edit-profile/{id}', [LoginController::class, 'updateProfile'])->name('update.profile');

Route::get('/registration', function () {
    return view('auth/registration');
})->middleware('guest');
Route::post('/registration', [RegistrationController::class, 'store'])->name('register');

Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
Route::get('/edit-profile', [ProfileController::class, 'show'])->middleware('auth');

Route::get('/reservation', function () {
    return view('reservation');
})->middleware('auth');

Route::get('/admin', [DashboardController::class, 'index']);

Route::get('/table-users', [UsersController::class, 'index'])->name('user.index')->middleware('admin');
Route::post('/table-users', [UsersController::class, 'store'])->name('user.store');
Route::put('/table-users/{id}', [UsersController::class, 'update'])->name('user.update');
Route::delete('/table-users/{id}', [UsersController::class, 'destroy'])->name('user.destroy');

Route::get('/table-books', [BooksController::class, 'index'])->name('book.index')->middleware('admin');
Route::post('/table-books', [BooksController::class, 'store'])->name('book.store');
Route::put('/table-books/{id}', [BooksController::class, 'update'])->name('book.update');
Route::delete('/table-books/{id}', [BooksController::class, 'destroy'])->name('book.destroy');

Route::get('/table-book-genres', [BookGenresController::class, 'index'])->name('book-genre.index')->middleware('admin');
Route::post('/table-book-genres', [BookGenresController::class, 'store'])->name('book-genre.store');
Route::put('/table-book-genres/{id}', [BookGenresController::class, 'update'])->name('book-genre.update');
Route::delete('/table-book-genres/{id}', [BookGenresController::class, 'destroy'])->name('book-genre.destroy');

Route::get('table-genres', [GenresController::class, 'index'])->name('genre.index')->middleware('admin');
Route::post('table-genres', [GenresController::class, 'store'])->name('genre.store');
Route::put('table-genres/{id}', [GenresController::class, 'update'])->name('genre.update');
Route::delete('table-genres/{id}', [GenresController::class, 'destroy'])->name('genre.destroy');

Route::get('peminjaman', [PeminjamController::class, 'peminjamanUser'])->middleware('auth');
Route::get('peminjaman/{slug}', [PeminjamController::class, 'show'])->middleware('auth');
Route::get('table-peminjam', [PeminjamController::class, 'index'])->name('peminjam.index')->middleware('admin');
Route::post('table-peminjam', [PeminjamController::class, 'store'])->name('peminjam.store');
Route::put('table-peminjam/{id}', [PeminjamController::class, 'update'])->name('peminjam.update');
Route::delete('table-peminjam/{id}', [PeminjamController::class, 'destroy'])->name('peminjam.destroy');
Route::post('peminjaman-clear/{id}', [PeminjamController::class, 'peminjamanClear'])->name('peminjaman.clear');

Route::get('denda', [FinesController::class, 'dendaUser'])->middleware('auth');
Route::get('table-fines', [FinesController::class, 'index'])->name('fine.index')->middleware('admin');
Route::post('table-fines', [FinesController::class, 'refresh'])->name('fine.refresh');
Route::post('table-fines', [FinesController::class, 'store'])->name('fine.store');
Route::put('table-fines/{id}', [FinesController::class, 'update'])->name('fine.update');
Route::delete('table-fines/{id}', [FinesController::class, 'destroy'])->name('fine.destroy');
Route::post('fine-clear/{id}', [FinesController::class, 'fineClear'])->name('fine.clear');

Route::get('/reservations', [ReservationsController::class, 'userReservation'])->middleware('auth');
Route::get('/reservation/{slug}', [ReservationsController::class, 'show'])->name('reservation.show')->middleware('auth');
Route::delete('/reservation/{id}', [ReservationsController::class, 'destroy'])->name('userReservation.destroy');
Route::get('table-reservations', [ReservationsController::class, 'index'])->name('reservation.index')->middleware('admin');
Route::post('table-reservations', [ReservationsController::class, 'store'])->name('reservation.store');
Route::put('table-reservations/{id}', [ReservationsController::class, 'update'])->name('reservation.update');
Route::delete('table-reservations/{id}', [ReservationsController::class, 'destroy'])->name('reservation.destroy');
Route::post('reservation-clear/{id}', [ReservationsController::class, 'reservationClear'])->name('reservation.clear');

Route::post('rating/{book_id}', [RatingsController::class, 'store'])->name('rating');
Route::get('table-ratings', [RatingsController::class, 'index'])->name('rating.index')->middleware('admin');
Route::post('table-ratings', [RatingsController::class, 'store'])->name('rating.store');
Route::put('table-ratings/{id}', [RatingsController::class, 'update'])->name('rating.update');
Route::delete('table-ratings/{id}', [RatingsController::class, 'destroy'])->name('rating.destroy');