<?php

$arr = [ 13, 5, 6, 4, 8, 9, 7, 11, 12, 10 ];

$arr1 = array_sort($arr, 'asc');

function quick_sort($arr)
{
    if (count($arr) <= 1) {
        return $arr;
    }

    $pivot = $arr[0];
    
    foreach ($arr as $key => $value) {
        if ($key == 0) {
            continue;
        }

        if ($value < $pivot) {
            $left[] = $value;
        } else {
            $right[] = $value;
        }
    }

    return array_merge(quick_sort($left), [$pivot], quick_sort($right));
}

echo quick_sort($arr);

?>