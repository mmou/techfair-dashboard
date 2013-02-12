<?php

header("Content-type: text/json");

$time = time() * 1000;

//replace these with your db info
mysql_connect("host", "user", "password") or die(mysql_error());
mysql_select_db("techfair+dayof") or die(mysql_error());

//get total count
$resultCount = mysql_query("SELECT COUNT(*) FROM registration2013") or die(mysql_error());
$count = intval(mysql_result($resultCount, 0));

//get timestamp of last entry added
$resultLastTime = mysql_query("SELECT * FROM registration2013 ORDER BY id DESC LIMIT 1") or die(mysql_error());
$lastTime = mysql_fetch_array($resultLastTime);

//get timestamp of first entry added
$resultFirstTime = mysql_query("SELECT * FROM registration2013") or die(mysql_error());
$firstTime = mysql_fetch_array($resultFirstTime);

//calculate average registration rate between first and last registration
$timeDiff = strtotime($lastTime['timestamp']) - strtotime($firstTime['timestamp']);
$rate = $count / $timeDiff *  3600;

$point = array($time, $count, $rate);
echo json_encode($point);

?>