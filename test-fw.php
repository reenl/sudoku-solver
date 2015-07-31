<?php

function it($m, $p)
{
    echo($p ? '✔︎' : '✘')." It $m\n";
    if (!$p) {
        $GLOBALS['f'] = 1;
    }
}function done()
{
    if (@$GLOBALS['f']) {
        die(1);
    }
}
