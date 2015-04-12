<?php
header("Content-type: text/html; charset=utf-8");
require_once('./modules/functions.php');
table_cal($_GET['y'], $_GET['m']);
