<?php

$pressReviewHosts   = ['pressreview24.com','unionpress24.lh'];
$pressFromHosts     = ['pressfrom.info','express-info.lh'];

header('Content-Type: text/plain; charset=utf-8');

if( in_array($_SERVER['HTTP_HOST'],$pressReviewHosts) ){
    echo file_get_contents('robots_pressreview24.txt');
}
elseif( in_array($_SERVER['HTTP_HOST'],$pressFromHosts) ){
    echo file_get_contents('robots_pressfrom.txt');
}
else{
    echo file_get_contents('robots.txt');
}

