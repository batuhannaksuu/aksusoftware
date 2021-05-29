<?php

require __DIR__ . '/vendor/autoload.php';
use \AksuSoftware\Core\{App,Route};
$app = new \AksuSoftware\Core\App();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

Route::get('/','Home@index');

Route::get('/user/{id}','User@detail');

Route::post('/updateuser',function (){
    return 'update user';
});

Route::dispatch();

//Route::get('/','Home@index');
//Route::get('users/:id','User@detail')->name('user');
//
//Route::prefix('/admin')->group(function (){
//    Route::get('/','Home@index');
//    Route::get('/users','User@index');
//});