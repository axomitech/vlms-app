<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/register_user', [App\Http\Controllers\RegisterVlmsUser::class, 'registerUser'])->name('register_user');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');
Route::get('/diarize', [App\Http\Controllers\LetterController::class, 'index'])->name('diarize');
Route::get('/letters', [App\Http\Controllers\LetterController::class, 'showLetters'])->name('letters');
Route::post('/store_letter', [App\Http\Controllers\LetterController::class, 'store'])->name('store_letter');
Route::get('/action_letters', [App\Http\Controllers\LetterActionController::class, 'index'])->name('action_letters');
Route::get('/letter_lists', [App\Http\Controllers\LetterActionController::class, 'letterIndex'])->name('letter_lists');
Route::get('/actions/{id}/{no}/{letter}/{sender}/{org}', [App\Http\Controllers\LetterActionController::class, 'actions'])->name('actions');
Route::get('/action_lists/{id}/{no}/{letter}/{sender}/{org}', [App\Http\Controllers\LetterActionController::class, 'letterActions'])->name('action_lists');
Route::get('/action_notes', [App\Http\Controllers\LetterActionResponseController::class, 'actionNotes'])->name('action_notes');
Route::post('/store_action', [App\Http\Controllers\LetterActionController::class, 'store'])->name('store_action');
Route::post('/store_note', [App\Http\Controllers\LetterActionResponseController::class, 'store'])->name('store_note');
Route::get("/log", function(){
    Log::channel('i_love_this_logging_thing')->info("Action log debug test", ['log-string' => ['user'=>1], "run"]);
 
    return ["result" => true];
});

