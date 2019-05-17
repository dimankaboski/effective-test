<?php

$sum = 0;
$count = 0;
$next = 1;
$prev = 0;
while ($count < 64) 
{
	echo $prev, " ";
	$sum = $prev + $next;
	$prev = $next;
	$next = $sum;
	$count = $count + 1;
}

?>