<?php

use App\Http\Controllers\Api\MiscApiController;
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

// Api route for get all content tools 
Route::get('get/tools', [MiscApiController::class, 'getTools']);
Route::post('content/favourite', [MiscApiController::class, 'makeContentFavourite']);
Route::post('get/team-members', [MiscApiController::class, 'getTeammembers']);
