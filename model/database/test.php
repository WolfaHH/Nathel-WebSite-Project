<?php

function P($E)
{
    $P = array();
    $i = 0;
    $max_i = 2**(count($E))-1;

    while ($i <= $max_i){
        $s = array();
        $j = 0;
        $max_j = count($E)-1;
        while ($j <= $max_j){
            if (($i>>$j)&1 == 1){
                array_push($s, $E[$j]);
            }
            $j+=1;
        }

        array_push($P, $s);
        $i+=1;
    }

    return $P;

}

$x = array('a','b','c');
var_dump(P($x));