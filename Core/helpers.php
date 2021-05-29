<?php

/**
 * @param string $name
 * @param array $params
 * @return string
 */

function route(string $name,array $params = []){
    return \AksuSoftware\Core\Route::url($name,$params);
}