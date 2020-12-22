
<?php

function getMinMax($textFile, $word1, $word2)
{
    $words = preg_split('([\x0a\s])', file_get_contents($textFile));
    $min = PHP_INT_MAX;
    $max = 0;
    $size = sizeof($words);


    foreach ($words as $key => $word) {
        if ($word == $word1) {
            for($i = $key; $i < $size; $i++) {
                if($words[$i] == $word2 && ($i - $key) < $min) { $min = ($i - $key); break;}
            }
            for($i = $size - 1; $i > $key; $i--) {
                if($words[$i] == $word2 && ($i - $key) > $max) { $max = ($i - $key); break;}
            }
        } elseif ($word == $word2) {
            for($i = $key; $i < $size; $i++) {
                if($words[$i] == $word1 && ($i - $key) < $min) { $min = ($i - $key); break;}
            }
            for($i = $size - 1; $i > $key; $i--) {
                if($words[$i] == $word1 && ($i - $key) > $max) { $max = ($i - $key); break;}
            }
        }
    }

    return ['min' => $min - 1, 'max' => $max - 1];
}

var_dump(getMinMax('text.txt', 'на', 'the'));
?>
