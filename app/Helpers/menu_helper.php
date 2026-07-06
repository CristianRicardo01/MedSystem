<?php

function activeMenu($route)
{
    $segment1 = service('uri')->getSegment(1);
    $segment2 = service('uri')->getSegment(2);

    if ($segment1 == $route || $segment2 == $route) {

        return 'active';
    }

    return '';
}
if (!function_exists('activeCollapse')) {

    function activeCollapse(string $segment): string
    {
        return strpos(uri_string(), $segment) === 0 ? 'show' : '';
    }
}

if (!function_exists('activeExpanded')) {

    function activeExpanded(string $segment): string
    {
        return strpos(uri_string(), $segment) === 0 ? 'true' : 'false';
    }
}
