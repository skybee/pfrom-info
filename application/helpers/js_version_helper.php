<?php


function js_version($fname){
    
    if(!preg_match("#^\.\S+#i", $fname)){
        $fname = '.'.$fname;
    }
    
    if( !is_file($fname) ){
        return '1';
    }
    
    $updTime = filemtime($fname);
    
    return date("Ymd-Hi", $updTime);
}
