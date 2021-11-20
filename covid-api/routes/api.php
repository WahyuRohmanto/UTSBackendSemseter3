<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatiensController;
use App\Models\Patiens;

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

// Route::apiResource("patiens", PatiensController::class);

Route::get("/patiens", [PatiensController::class, "index"]);

Route::get("/patiens/{id}", [PatiensController::class, "show"]);

Route::post("/patiens", [PatiensController::class, "store"]);

Route::put("/patiens/{id}" , [PatiensController::class, "update"]);

Route::delete("/patiens/{id}", [PatiensController::class, "destroy"]);

Route::get("/patiens/search/{name}", [PatiensController::class, "search"]);

Route::get("/patiens/status/positive", [PatiensController::class, "positive"]);

Route::get("/patiens/status/recovered", [PatiensController::class, "recover"]);

Route::get("/patiens/status/dead", [PatiensController::class, "dead"]);


