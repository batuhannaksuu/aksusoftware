<?php

require __DIR__ . '/vendor/autoload.php';
use \AksuSoftware\Core\{App,Route};
$app = new \AksuSoftware\Core\App();

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

Route::get('/','Home@index')->name('home');
Route::get('/user/{id}','User@detail')->name('user');

Route::url('user',['id' => 3]);

//Route::get('/user/{id}','User@detail');
//
//Route::post('/updateuser',function (){
//    return 'update user';
//});

Route::dispatch();
