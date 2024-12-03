<?php
$file = file_get_contents('input.txt');
function multiplyNumbersInMul($input)
{
    // Match all occurrences of mul(x, y) with numbers only
    // preg_match_all('/mul\((\d+),(\d+)\)/', $input, $matches);

    $doPattern = '/do\(\)/';
    $dontPattern = '/don\'t\(\)/';
    // Inital state
    $enabled = true;


    preg_match_all('/do\(\)|don\'t\(\)|mul\((\d+),(\d+)\)/', $input, $matches);

    $results = [];
    foreach ($matches[0] as $match) {
        if (preg_match($doPattern, $match)) {
            $enabled = true;
        } elseif (preg_match($dontPattern, $match)) {
            $enabled = false;
        } elseif ($enabled) {
            $numbers = explode(',', str_replace(['mul(', ')'], '', $match));
            $results[] = $numbers[0] * $numbers[1];
        }
    }
    print_r(array_sum($results));
    return array_sum($results);
}

$numbers = multiplyNumbersInMul($file);
