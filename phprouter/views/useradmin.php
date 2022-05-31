<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /mwatchman6/phprouter');
}
if($_SESSION["loggedin"] != true){
	header('Location: /mwatchman6/phprouter/login');
}
// echo "You are logged in.";
// echo "<br />";

if  ($_SESSION["level"] == admin){
	echo "<h1>Welcome Admin, what is thy bidding today?</h1>";
}
else {
	echo "<h2>WARNING!!!!!</h2>";
	echo "<br />";
	echo "<h3>You are not Admin, return to previous page NOW!!!!</h3>";
}


















?>