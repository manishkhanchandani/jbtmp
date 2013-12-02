<?php

function pr($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function tstobts($ts)
{
    return $ts * 1000;
}

function btstots($bts)
{
    return $bts / 1000;
}

function guid()
{
    mt_srand((double) microtime() * 10000);
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $guid = substr($charid, 0, 8) . '-' .
            substr($charid, 8, 4) . '-' .
            substr($charid, 12, 4) . '-' .
            substr($charid, 16, 4) . '-' .
            substr($charid, 20, 12);
   return $guid;
}