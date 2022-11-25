<?php

spl_autoload_register (function ($class) {
//   $path = getcwd() . '\\';
// //   echo $path;
// //    echo $class . '<br>';
//     $class = str_replace ("\\", DIRECTORY_SEPARATOR, $class) . '.php';
// //    echo $class . '<br>';
//     if (!is_file ($path . $class)) {
//         die("Class $class not found with path:$path");
//     }
//     require ($path . $class);

    $class =  str_replace('\\', '/', $class);


    $some =  $class .".php";

    if (!is_file($some)){
        die($some." not found");  }

    require_once $some;



});