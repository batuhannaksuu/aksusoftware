<?php

require __DIR__ . '/vendor/autoload.php';
use \AksuSoftware\Core\{App,Route};
$app = new \AksuSoftware\Core\App();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

Route::get('/','Home@index')->name('home');
Route::get('/user/{id1}/{id2}','User@detail')->name('user');

Route::prefix('/admin')->group(function (){
    Route::get('/?',function (){
       return 'admin home page';
    });
    Route::get('/users',function (){
       return 'admin user page';
    });
});



Route::dispatch();
