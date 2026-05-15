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
