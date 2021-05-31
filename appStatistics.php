<?php

mysql_connect("localhost", "88843", "bob123456") or die(mysql_error());
mysql_select_db("88843") or die(mysql_error()); 



$data1=mysql_fetch_assoc( mysql_query("SELECT count(*) as total from to_be_lettered") )['total']; // to_be_lettered
$data2=mysql_fetch_assoc( mysql_query("SELECT count(*) as total from lettered") )['total']; // lettered
$data3= $data1 + $data2; // all_registered_letters

$json = array('to_be_lettered' => $data1, 'lettered' => $data2, 'all_registered_letters' => (string)$data3);


echo json_encode($json) ;


?> 