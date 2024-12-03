<?php
$file = file_get_contents('./input.txt');

$file = preg_replace('/\s+/', '-', $file);
$file = explode("-", $file);
$array1 = [];
$array2 = [];

$counter = 1;
foreach ($file as $key => $value) {
  if ($counter % 2) {
    $array1[] = (int)$value;
  } else {
    $array2[] = (int)$value;
  }
  $counter++;
}

sort($array1);
sort($array2);
array_shift($array1);

$occursArray = array_count_values($array2);
$diffs = [];
$counter = 0;
$score = 0;
foreach ($array1 as $value) {
  $diff = abs((int)$array1[$counter] - (int)$array2[$counter]);
  $diffs[] = $diff;
  $counter++;

  // Part 2
  if (array_key_exists($value, $occursArray)) {
    $occursAmount = $occursArray[$value];
    $score = $score + $occursAmount *  $value;
  }
}

echo $score;
// echo array_sum($diffs);
