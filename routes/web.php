<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

//common resource routes
// index - show all listings
// show - show single listing
// create - show form to create new listing
// store - save new listing
// edit - show form to edit listing
// update - save edited listing
// destroy - delete listing

//All listings
Route::get('/', ListingController::class . '@index');

//show create listing form
Route::get('/listings/create', ListingController::class . '@create')->middleware('auth');

//save new listing
Route::post('/listings', ListingController::class . '@store')->middleware('auth');

//Show Edit listing
Route::get('/listings/{listing}/edit', ListingController::class . '@edit')->middleware('auth');

//Save edited listing
Route::put('/listings/{listing}', ListingController::class . '@update')->middleware('auth');

//Delete listing
Route::delete('/listings/{listing}', ListingController::class . '@destroy')->middleware('auth');

//manage listings
Route::get('/listings/manage', ListingController::class . '@manage')->middleware('auth');

//Single listing
Route::get('/listings/{listing}', ListingController::class . '@show');

//show register form
Route::get('/register', UserController::class . '@create')->middleware('guest');

//save new user
Route::post('/users', UserController::class . '@store');

//logout
Route::post('/logout', UserController::class . '@logout')->middleware('auth');

//show login form
Route::get('/login', UserController::class . '@login')->name('login')->middleware('guest');

//login
Route::post('users/authenticate', UserController::class . '@authenticate');
