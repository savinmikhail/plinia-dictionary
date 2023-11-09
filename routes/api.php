<?php

use App\Http\Controllers\PronounciationController;
use App\Http\Controllers\VocabularyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('vocabulary')->group(function () {
    Route::get("hasword/{email?}", [VocabularyController::class, "hasWord"]);
    Route::get("getvocab/{email?}", [VocabularyController::class, "getVocabulary"]);
    Route::post("getnext/{email?}", [VocabularyController::class, "getNext"]);
    // Route::get("initvocab/{email?}", [VocabularyController::class, "InitializeVocabulary"]);
    Route::post("addvocab/{email?}", [VocabularyController::class, "addVocabulary"]);
    Route::post("changevocab/{email?}", [VocabularyController::class, "changeVocabulary"]);
});

Route::prefix('pronounciation')->group(function () {
    Route::post("get-pronounciation/{email?}", [PronounciationController::class, "getPronounciationsByWord"]);
    Route::post("get_median/{email?}", [PronounciationController::class, "getMedian"]);
    Route::post("store/{email?}", [PronounciationController::class, "store"]);
    Route::get("all", [PronounciationController::class, "getAll"]);
    Route::delete("delete", [PronounciationController::class, "delete"]);
});
