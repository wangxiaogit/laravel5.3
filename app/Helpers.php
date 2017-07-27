<?php

if(!function_exists('lang')) {
    /**
     * Trans for getting the language.
     *
     * @param string $text
     * @param  array $parameters
     * @return string
     */
    function lang($text, $parameters = [])
    {
        return trans('blog.'.$text, $parameters);
    }
}

if(!function_exists('isActive')) {

    function isActive ($nav)
    {
        return Route::currentRouteName() == $nav ? 'active' : '';
    }
}