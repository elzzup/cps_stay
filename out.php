<?php

ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once('generate_csv.php');

$univ_id = @$_GET['univ_id'];
$user_id = @$_GET['user_id'];
$year    = @$_GET['y'];
if (!$univ_id || !$user_id || !$year) {
    header("location: ./?e");
    exit();
}

$place = '8011107B0' . ':' . '801';
$tmp_dir = './tmp/';

// hoge_2014
$dir_name = "demand_{$univ_id}_{$year}";
// ./tmp/hoge_2014
$tmp_zip_dir = $tmp_dir . $dir_name . "/";
@mkdir($tmp_zip_dir);

// zip module
$zip = new ZipArchive();
$zipname = $dir_name . '.zip';
$zip_path = $tmp_zip_dir . $zipname;
$filenames = array();
if (!file_exists($zip_path)) {

    if ($zip->open($zip_path, ZipArchive::CREATE) !==TRUE) {
        die('cannot open zipobj');
    }
    $filenames = array();
    $start = 1;
    if ($year == date('Y')) {
        $start = date('m');
    }
    foreach (range($start, 12) as $month) {
        $csv = generate_csv($univ_id, $user_id, $year, $month, $place);
        //    $filename = mb_convert_encoding("{$dir_name}/{$year}年{$month}月残留申請_{$user_id}.CSV", 'SJIS', 'UTF-8');
        $filename = "{$dir_name}/demand_{$year}_{$month}_{$user_id}.CSV";
        $tmpfilename = $tmp_zip_dir . $month . '.CSV';
        $filenames[] = $tmpfilename;
        file_put_contents($tmpfilename, $csv);
        $zip->addFile($tmpfilename, $filename);
        //    $zip->addFile($tmpfilename);
        //    unlink($tmpfilename);
    }

    $zip->close();
    //foreach ($filenames as $f) {
    //    unlink($f);
    //}
}

header('Pragma: public');
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $zipname);
readfile($zip_path);

//@rmdir($tmp_zip_dir);
