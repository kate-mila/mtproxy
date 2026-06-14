<?php
$config=require 'config.php'; $proxies=[];
foreach($config['sources'] as $url){$html=@file_get_contents($url); if(!$html) continue;
preg_match_all('/tg:\/\/proxy\?server=([^&]+)&port=([0-9]+)&secret=([a-zA-Z0-9]+)/',$html,$matches,PREG_SET_ORDER);
foreach($matches as $m){$proxies[]=['server'=>$m[1],'port'=>$m[2],'secret'=>$m[3]];}}
$proxies=array_unique($proxies,SORT_REGULAR);
file_put_contents($config['cache_file'],json_encode($proxies,JSON_PRETTY_PRINT));
echo "Updated ".count($proxies)." proxies";
