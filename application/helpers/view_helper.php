<?php

use Jenssegers\Blade\Blade;

if(!function_exists('view')){

    function view($view, $data = []){
        $views = 'application/views';
        $cache = 'application/views/cache';
        $blade = new Blade($views, $cache);
        echo $blade->make($view, $data);
    }

    function alert(){
        $CI=&get_instance();
        $CI->load->library("customfunction");
        return $CI->customfunction->showAlert();
    }

    function getSize($value)
    {
        $CI=&get_instance();
        $CI->load->library("customfunction");
        return $CI->customfunction->getSize($value);
    }
    
}