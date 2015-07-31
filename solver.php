<?php

$numbers = explode(',', trim(defined('INPUT') ? INPUT : fgets(STDIN)));
$backup = null;
define('COUNT', count($numbers));
define('SIZE', sqrt(COUNT));
define('SQUARE', sqrt(SIZE));

function xpos($x, $y)
{
    return $x + $y * SIZE;
}

function getX($pos)
{
    return $pos % SIZE;
}

function getY($pos)
{
    return (int) ($pos / SIZE);
}

function value($x, $y = null)
{
    global $numbers;

    $val = $numbers[$y ? xpos($x, $y) : $x];
    if (is_array($val) || $val === '.') {
        return;
    }

    return $val;
}

function col($pos)
{
    return range(getX($pos), COUNT - 1, SIZE);
}

function row($pos)
{
    $start = getY($pos) * SIZE;

    return range($start, $start + SIZE - 1);
}

function match($pos)
{
    return array_merge(col($pos), row($pos), block($pos));
}

function avail($item)
{
    static $all;
    $all = $all ?: range(1, SIZE);

    return array_diff($all, $item);
}

$solve = function () use (&$numbers, &$backup) {
    $moved = false;
    $solved = true;
    foreach ($numbers as $pos => $item) {
        if ($item == '.') {
            $numbers[$pos] = $item = usedNumbers($pos);
        }

        if (is_array($item)) {
            $options = avail($item);
            if (count($options) == 1) {
                fill($pos, reset($options));
                $moved = true;
                continue;
            }
            $solved = false;
        }
    }

    if ($solved) {
        return true;
    }

    if ($moved) {
        return false;
    }

    foreach (['col', 'row', 'block'] as $t) {
        if (forcedMove($numbers, $backup, $t)) {
            return false;
        }
    }

    $backup = $backup ?: $numbers;

    for ($z = 0; $z <= SIZE; ++$z) {
        foreach ($numbers as $pos => $item) {
            if (!is_array($item)) {
                continue;
            }

            $options = avail($item);
            if (count($options) == $z) {
                fill($pos, $options[array_rand($options)]);

                return false;
            }
        }
    }
};

while (!$solve());

echo implode(',', $numbers).PHP_EOL;

function forcedMove(&$numbers, &$backup, $type)
{
    foreach ($numbers as $pos => $item) {
        if (!is_array($item)) {
            continue;
        }

        $options = [avail($item)];
        $posList = $type($pos);
        foreach ($posList as $pos2) {
            if ($pos2 == $pos) {
                continue;
            }

            if (!is_array($numbers[$pos2])) {
                continue;
            }

            $options[] = avail($numbers[$pos2]);
        }

        if (count($options) < 2) {
            $numbers = $backup;
            $backup = null;

            return true;
        }

        $mustBeHere = call_user_func_array('array_diff', $options);
        if (count($mustBeHere) == 1) {
            fill($pos, reset($mustBeHere));

            return true;
        }
    }

    return false;
}

function fill($pos, $value)
{
    global $numbers;

    $numbers[$pos] = $value;

    foreach (match($pos) as $pos2) {
        is_array($numbers[$pos2]) && $numbers[$pos2][] = $value;
    }
}

function usedNumbers($pos)
{
    $invalid = [];
    foreach (match($pos) as $pos2) {
        $invalid[] = value($pos2);
    }

    return $invalid;
}

function block($pos)
{
    static $blocks = [];

    $y = getY($pos);
    $x = getX($pos);

    $blockX = (int) ($x / SQUARE);
    $blockY = (int) ($y / SQUARE);
    $pos = $blockX + $blockY * SQUARE;
    if (isset($blocks[$pos])) {
        return $blocks[$pos];
    }

    $posList = [];
    $startX = $blockX * SQUARE;
    $maxX = $startX + SQUARE;
    $startY = $blockY * SQUARE;
    $maxY = $startY + SQUARE;

    for ($x = $startX; $x < $maxX; ++$x) {
        for ($y = $startY; $y < $maxY; ++$y) {
            $posList[] = xpos($x, $y);
        }
    }

    return $blocks[$pos] = $posList;
}
