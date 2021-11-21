<?php
use Illuminate\Support\Facades\Auth;
//highlights the selected navigation li on admin panel
if(! function_exists('activeRoutesLi')){
    function activeRoutesLi(Array $routes, $output = 'menu-is-opening menu-open'){
        foreach($routes as $route){
            if(Route::currentRouteName() == $route) return $output;
        }
    }
}
//highlights the selected navigation ul on admin panel
if(! function_exists('activeRoutesUl')){
    function activeRoutesUl(Array $routes, $output = 'style=display:block;'){
        foreach($routes as $route){
            if(Route::currentRouteName() == $route) return $output;
        }
    }
}
//highlights the selected navigation ul li on admin panel
if(! function_exists('activeRoutesUlLi')){
    function activeRoutesUlLi(Array $routes, $output = "active"){
        foreach($routes as $route){
            if(Route::currentRouteName() == $route) return $output;
        }
    }
}


?>