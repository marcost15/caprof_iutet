<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_bufeteeb = "localhost";
$database_bufeteeb = "bufeteeb";
$username_bufeteeb = "bufeteeb";
$password_bufeteeb = "tesis";
$bufeteeb = mysql_pconnect($hostname_bufeteeb, $username_bufeteeb, $password_bufeteeb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>