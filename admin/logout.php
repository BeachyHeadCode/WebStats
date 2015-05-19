<?php
if(basename(__FILE__) == basename($_SERVER['PHP_SELF'])){exit();}
ERROR_REPORTING(E_ALL);
session_start();
pml_logout('../');
?>