<?php

    function debug($var="hello"){
        die(var_dump($var));
    }


    function getUrlFormat($string){
        $string = preg_replace('/[^\w\s]/',"",$string);
        $string = preg_replace('/\s+/',"-",$string);
        $string = strtolower($string);
        return $string;
    }

    function getNameFormat($string){
        $string = str_replace("-"," ",$string);
        $string = ucwords($string);
        return $string;
    }
 ?>
