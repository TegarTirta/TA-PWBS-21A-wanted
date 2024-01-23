<?php

use App\Http\Controllers\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/mahasiswa/get',[Mahasiswa::class,'getController']);
// buat route untuk pencarian
Route::get('/mahasiswa/search/{keyword}',[Mahasiswa::class,'searchController']);
// buat route detail
Route::get('/mahasiswa/detail/{id}',[Mahasiswa::class,'detailController']);
// buat route menghapus
Route::delete('/mahasiswa/delete/{id}',[Mahasiswa::class,'deleteController']);
// buat route untuk simpan data
Route::post('/mahasiswa/save',[Mahasiswa::class,'saveController']);
// buat route untuk simpan data
Route::put('/mahasiswa/update/{id}',[Mahasiswa::class,'updateController']);
