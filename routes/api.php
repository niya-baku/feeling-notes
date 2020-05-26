<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 会員登録
Route::post('/register', 'Auth\RegisterController@register')->name('register');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザー
Route::get('/user', fn() => Auth::user())->name('user');

// ノート投稿
Route::post('/notes', 'NoteController@create')->name('note.create');

// ノート一覧
Route::get('/notes', 'NoteController@index')->name('note.index');

// ノート詳細
Route::get('/notes/{id}', 'NoteController@show')->name('note.show');

//ノート更新
Route::put('/notes/{id}', 'NoteController@update')->name('note.update');

//ノート削除
Route::delete('/notes/{id}', 'NoteController@delete')->name('note.delete');



