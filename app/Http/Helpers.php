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
//highlights the selected navigation li->ul on admin panel
if(! function_exists('activeRoutesUl')){
    function activeRoutesUl(Array $routes, $output = 'menu-is-opening menu-open'){
        foreach($routes as $route){
            if(Route::currentRouteName() == $route) return $output;
        }
    }
}
//highlights the selected navigation li->ul->li on admin panel
if(! function_exists('activeRoutesUlLi')){
    function activeRoutesUlLi(Array $routes, $output = "active"){
        foreach($routes as $route){
            if(Route::currentRouteName() == $route) return $output;
        }
    }
}


?>