<?php

function getMinMax($textFile, $word1, $word2)
{
    $words = explode(' ', preg_replace('([\x0a,;.?!])', '', file_get_contents($textFile)));
    $pos1 = array_search($word1, $words);
    $pos2 = array_search($word2, $words);
    $min = PHP_INT_MAX;
    $max = 0;

    foreach ($words as $key => $word) {
        if ($word == $word1) {
            $pos1 = $key;
            $gap = abs($pos1 - $pos2);
            if ($pos2 >= 0) {
                if ($min > $gap) $min = $gap;
                elseif ($max < $gap) $max = $gap;
            }
        } elseif ($word == $word2) {
            $pos2 = $key;
            $gap = abs($pos2 - $pos1);
            if ($pos1 >= 0) {
                if ($min > $gap) $min = $gap;
                elseif ($max < $gap) $max = $gap;
            }
        }
    }

    return ['min' => $min - 1, 'max' => $max - 1];
}

var_dump(getMinMax('text.txt', 'на', 'the'));
?>