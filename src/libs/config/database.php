<?php
function database() : mysqli{
    $database = new mysqli(HOST, USER, PASSWORD, DB);
    if(!$database){
        echo 'no se pudo conectar';
        exit;
    }
    return $database;
}//
