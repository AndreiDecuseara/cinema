<?php

use Illuminate\Support\Facades\Route;
// CRUD ROUTES
use App\Http\Livewire\Crud\Movies;
use App\Http\Livewire\Crud\Cinemas;
use App\Http\Livewire\Crud\Tickets;
use App\Http\Livewire\Crud\Halls;
use App\Http\Livewire\Crud\Seats;
use App\Http\Livewire\Crud\Customers;
use App\Http\Livewire\Home;
use App\Models\Ticket;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/movies', Movies\Index::class)->name('movies');
Route::get('/cinemas', Cinemas\Index::class)->name('cinemas');
Route::get('/tickets', Tickets\Index::class)->name('tickets');
Route::get('/halls', Halls\Index::class)->name('halls');
Route::get('/seats', Seats\Index::class)->name('seats');
Route::get('/customers', Customers\Index::class)->name('customers');
