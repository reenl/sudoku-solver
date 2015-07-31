<?php

define('INPUT', '.,.,2,.,.,7,4,.,.,.,.,.,4,9,.,.,.,.,9,.,.,3,2,.,.,.,8,4,.,.,7,.,.,6,2,.,.,5,9,.,.,.,3,7,.,.,7,6,.,.,3,.,.,5,8,.,.,.,6,9,.,.,1,.,.,.,.,3,4,.,.,.,.,.,4,2,.,.,9,.,.');

require 'test-fw.php';

ob_start();
require 'solver.php';
$solution = ob_get_contents();
ob_end_clean();

it('solves the puzzle', $solution == '3,8,2,1,5,7,4,9,6,6,1,5,4,9,8,2,3,7,9,4,7,3,2,6,1,5,8,4,3,8,7,1,5,6,2,9,1,5,9,6,8,2,3,7,4,2,7,6,9,4,3,8,1,5,8,2,3,5,6,9,7,4,1,7,9,1,8,3,4,5,6,2,5,6,4,2,7,1,9,8,3'.PHP_EOL);

it('receives 81 numbers', COUNT == 81);
it('detects 9 as board size', SIZE == 9);
it('detects 3 as block size', SQUARE == 3);

it('resolves the first row', row(0) == range(0, 8));
it('resolves the last row', row(80) == range(72, 80));

it('resolves the first column', col(0) == range(0, 80, 9));
it('resolves the last column', col(80) == range(8, 80, 9));
done();
