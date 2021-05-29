<?php

use AksuSoftware\Core\Route;

/**
 * @param string $name
 * @param array $params
 * @return string
 */

function route(string $name,array $params = []){
    return Route::url($name,$params);
}