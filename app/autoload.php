<?php
/**
 * PSR-4 autoloader
 */
spl_autoload_register(function ($className){
    $file = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') . DIRECTORY_SEPARATOR .  str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';
    if (is_readable($file)) {
        require $file;
        return true;
    }
    return false;
});