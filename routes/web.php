<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TraininngController;

Route::prefix('reset')->group(function () {
    // パスワード再設定用のメール送信フォーム
    Route::get('/', [TraininngController::class, 'requestResetPassword'])->name('reset.form');
    // メール送信処理
    Route::post('/send', [TraininngController::class, 'sendResetPasswordMail'])->name('reset.send');
    // メール送信完了
    Route::get('/send/complete', [TraininngController::class, 'sendCompleteResetPasswordMail'])->name('reset.send.complete');
    // パスワード再設定
    Route::get('/password/edit', [TraininngController::class, 'resetPassword'])->name('reset.password.edit');
    // パスワード更新
    Route::post('/password/update', [TraininngController::class, "updatePassword"])->name('reset.password.update');
});

Route::group(["middleware" => ["guest"]], function(){
    Route::get("/registration", [TraininngController::class, "registration"])->name("registration");
    Route::post("/store", [TraininngController::class, "store"])->name("store");
    Route::get("/login", [TraininngController::class, "login"]) -> name("login");
    Route::post("/login", [TraininngController::class, "logincharenge"]) -> name("logincharenge");
});

Route::group(["middleware" => ["auth"]], function(){
    Route::get("/", [TraininngController::class, "index"])->name("main");
    Route::get("/management", [TraininngController::class, "management"])->name("management");
    Route::get("/logout", [TraininngController::class, "destroy"])->name("logout");
    Route::get("/uplode", [TraininngController::class, "uplode"]) -> name("uplode");
    Route::post("/checkUplode", [TraininngController::class, "checkUplode"]) -> name("checkUplode");
    Route::get("/management", [TraininngController::class, "management"])->name("management");
    Route::get("/management/{lesson}", [TraininngController::class, "managementShow"])->name("managementShow");
    Route::get("/managementEdit/{id}", [TraininngController::class, "managementEdit"])->name("managementEdit");
    Route::post("/editMovie", [TraininngController::class, "editMovie"])->name("editMovie");
    Route::get("/deleatMovie/{id}", [TraininngController::class, "deleatMovie"])->name("deleatMovie");
    Route::get("/showMovie/{id}", [TraininngController::class, "showMovie"])->name("showMovie");
    Route::post("/addComment", [TraininngController::class, "addComment"])->name("addComment");
    Route::get("/addfavorite/{id}", [TraininngController::class, "addfavorite"])->name("addfavorite");
    Route::get("/dellfavorite/{id}", [TraininngController::class, "dellfavorite"])->name("dellfavorite");
    Route::get("/category/{id}", [TraininngController::class, "category"])->name("category");
    Route::get("/search", [TraininngController::class, "search"])->name("search");
    Route::post("/search", [TraininngController::class, "searchCharenge"])->name("searchCharenge");
    Route::get("/mainlist", [TraininngController::class, "mainlist"])->name("mainlist");
    Route::get("/categorylist", [TraininngController::class, "categorylist"])->name("categorylist");
    Route::get("/favoritelist", [TraininngController::class, "favoritelist"])->name("favoritelist");
    Route::get("/profile/{id}", [TraininngController::class, "profile"])->name("profile");
    Route::get("/profile/update/{id}", [TraininngController::class, "profileUpdate"])->name("profileUpdate");
    Route::post("/profile/up", [TraininngController::class, "profileup"])->name("profileup");
});

