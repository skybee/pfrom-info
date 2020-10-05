<?php

/* 
 * Удаление старых файлов из Upload
 * (по последней дате доступа к файлу)
 */

echo "<pre>";

//$uploadCat = './upload/images/real/2020/06/04';

$uploadCat = './upload/images';
define('CNT_MONTH', 9); //возраст файла для удаления в месяцах (по последней дате доступа к файлу)


function readCat($dirPath){
    if(!is_dir($dirPath)){ 
        echo "is not dir: '{$dirPath}' <br />";
        return false;
    }
    
    $dirFileList = scandir($dirPath);
    
    if($dirFileList == false){
        echo "dir is empty: '{$dirPath}' <br />";
        return false;
    }
    
echo "<br /><br /><b>Scan Dir: ".$dirPath."</b><br /><br />";    
    
    foreach ($dirFileList as $dirFileName){
        // пропуск верхних категорий
        if($dirFileName == '.' || $dirFileName == '..'){
            continue;
        }
        
        // создание списка файлов и каталогов
        $readPath = $dirPath.'/'.$dirFileName;
        
        if(is_dir($readPath)){
            $dirFileNameAr['dir'][] = $readPath;
        }
        elseif(is_file($readPath)){
            $dirFileNameAr['file'][] = $readPath;
        }
        
    }
    
    // Удаление старых файлов
    delFiles($dirFileNameAr['file']);
    
    // переход вниз в случайный каталог
    if(isset($dirFileNameAr['dir'][0]) && !empty($dirFileNameAr['dir'][0])){
        shuffle($dirFileNameAr['dir']);
        readCat($dirFileNameAr['dir'][0]);
    }

//echo "<br />---<br />dirFileList: <br />";    
//print_r($dirFileList);
//
//echo "<br />---<br />dirFileNameAr: <br />";
//print_r($dirFileNameAr);    
//echo "<br /><br /><br />";    

    return $dirFileNameAr;
}


function delFiles($filePathAr){
    
//    echo "<br />---<br />Files to dels: <br />";
//    print_r($filePathAr);
    
    $delTimeInt = strtotime('- '.CNT_MONTH.' month');
    
    if(!is_array($filePathAr) || count($filePathAr)<1){
        echo "<br /><span style='color:blue'><b>Not files in cat for del</b></span> <br />";
        return false;
    }
    
    $i=1;
    
    foreach ($filePathAr as $filePath){
        echo "[{$i}]\t<b>file:</b> <u>".$filePath."</u> <br />";
        $i++;
        
        if(!is_file($filePath)){
            echo "&nbsp; <i style='color:red;'>Is not a file Continue...</i> <br />";
            continue;
        }
        
        $fileTime = fileatime($filePath);
        
        echo "&nbsp;<i>FileTime: ".date("Y.m.d",$fileTime)." - {$fileTime} -</i><br />";
        echo "&nbsp;<i>DelTime: ".date("Y.m.d",$delTimeInt)." - {$delTimeInt} -</i><br />";
        
        // Удаление файла
        if($fileTime < $delTimeInt){
            echo "&nbsp;<b style='color:green;'>File will be Del</b>... ";
            if(unlink($filePath)){
                echo "<u style='color:orange'> -- Del OK -- </u>";
            }
            else{
                echo "<u style='color:red'> -- Del Error -- </u>";
            }
            echo "<br />";
        }
        else{
            echo "&nbsp;<b style='color:blue;'>File will not be Del</b> <br />";
        }
        
    }
}


readCat($uploadCat);

echo "</pre>";