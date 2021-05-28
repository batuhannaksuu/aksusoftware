<?php

require __DIR__ . '/vendor/autoload.php';
use \AksuSoftware\Core\{App,Route};
$app = new \AksuSoftware\Core\App();

Route::get('/',function (){
    return 'home page';
});

Route::get('/users',function (){
    return 'user page';
});

//Route::get('/','Home@index');
//Route::get('users/:id','User@detail')->name('user');
//
//Route::prefix('/admin')->group(function (){
//    Route::get('/','Home@index');
//    Route::get('/users','User@index');
//});