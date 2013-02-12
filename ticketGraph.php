<?php

header("Content-type: text/json");

$time = time() * 1000;

//replace these with your db info
mysql_connect("host", "user", "password") or die(mysql_error());
mysql_select_db( "logportal");

//total submit count
$resultSubmitCount = mysql_query("SELECT COUNT(*) FROM portal_ticket") or die(mysql_error());
$submitCount = intval(mysql_result($resultSubmitCount, 0));

//total answer count
$resultAnswerCount = mysql_query("SELECT COUNT(*) FROM portal_ticket WHERE Date_Completed IS NOT NULL") or die(mysql_error());
$answerCount = intval(mysql_result($resultAnswerCount, 0));

$point =  array($time, $submitTotal, $answerTotal);
echo json_encode($point);

?>


