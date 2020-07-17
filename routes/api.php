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

// PW変更画面
Route::get('/changepassword', 'Auth\ChangePasswordController@setindex')->name('changepassword.setindex');
// PW変更
Route::post('/changepassword', 'Auth\ChangePasswordController@change')->name('changepassword.change');

// ログイン
Route::post('/login', 'Auth\LoginController@login')->name('login');

// ログアウト
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// ログインユーザー
//Route::get('/user', fn() => Auth::user())->name('user');

// ログインユーザー
Route::get('/user', function () {
    return Auth::user();
})->name('user');

// コラム投稿
Route::post('/columns', 'ColumnController@create')->name('column.create');

// コラム一覧
Route::get('/columns', 'ColumnController@index')->name('column.index');

// コラム詳細
Route::get('/columns/{id}', 'ColumnController@show')->name('column.show');

//コラム更新
Route::put('/columns/{id}', 'ColumnController@update')->name('column.update');

//コラム削除
Route::delete('/columns/{id}', 'ColumnController@delete')->name('column.delete');

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

//チャート表示
Route::post('/chart', 'NoteController@chart')->name('chart');

// トークンリフレッシュ
Route::get('/reflesh-token', function (Illuminate\Http\Request $request) {
    $request->session()->regenerateToken();

    return response()->json();
});



