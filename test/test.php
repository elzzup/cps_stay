<?php
 
$zip = new ZipArchive();
 
$zipName = 'test.zip';
 
if ($zip->open($zipName, ZipArchive::CREATE) === true) {
    $zip->addFromString('test1.txt', 'test1');
    $zip->addFromString('test2.txt', 'test2');
    $zip->close();
 
    header('Content-Type: application/zip');
    readfile($zipName);
 
    unlink($zipName);
}
