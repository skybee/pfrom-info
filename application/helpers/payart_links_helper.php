<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getRndPaylink($showProcent=30){
    
    mt_srand( abs( crc32($_SERVER['REQUEST_URI']) ) );
        
        $rndInt = mt_rand(0,100000);
        if($rndInt/1000 > $showProcent){ return false; }

        $sitemapXml = file_get_contents('./sitemap/sitemap_pay.xml');

        $xml    = simplexml_load_string($sitemapXml);
        $urlsAr = (array) $xml;
        $urlsAr = $urlsAr['url'];


        $rndUrlObj  = $urlsAr[mt_rand(0,count($urlsAr)-1)];
        $rndUrl     = $rndUrlObj->loc;
    mt_srand();
    
    return $rndUrl;
}
