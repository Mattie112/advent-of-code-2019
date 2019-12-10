<?php
/** https://adventofcode.com/2019/day/10 */

$map = [];

if ($file = fopen(__DIR__ . "/day10-input.txt", "rb")) {
    while (!feof($file)) {
        $line = trim(fgets($file));
        if ($line === "") {
            continue;
        }
        $map[] = str_split($line);
    }
}

$most_astroids = 0;
$best_loc_x = 0;
$best_loc_y = 0;
foreach ($map as $row_id => $row) {
    foreach ($row as $cell_id => $cell) {
        if ($cell === ".") {
            continue;
        }
        $seen = [];
        foreach ($map as $yy => $rowY) {
            foreach ($rowY as $xx => $cellX) {
                if ($map[$yy][$xx] === "#" && ($yy !== $row_id || $xx !== $cell_id)) {
                    $degrees = rad2deg(atan2($yy - $row_id, $xx - $cell_id));
                    $seen[] = $degrees;
                }
            }
        }
        $count = count(array_unique($seen));
        if ($count > $most_astroids) {
            $most_astroids = $count;
            $best_loc_x = $cell_id;
            $best_loc_y = $row_id;
        }
    }
}
echo "Part 1: " . $best_loc_x . "," . $best_loc_y . " (" . $most_astroids . " astroids)";
