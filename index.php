<?php
session_name('inti');
session_start();
$_SESSION=array();
include('./configs/smarty.php');

$smarty->disp();