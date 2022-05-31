<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /mwatchman6/phprouter');
}
function checklogin()
{
	include_once '../../blurg.inc';
	include_once 'inc/passwordfuncs.inc.php';
	# VALIDATE THIS YOU MORON!!
	$email = $_POST['username'];
	$userpassword = $_POST['loginpass'];
	
	$db1 = new mysqli('localhost', 'mwatchman6', $password, 'STUmwatchman6');
	if($db1->connect_errno > 0)
	{
		die('Unable to connect to database [' . $db1->connect_error . ']');
	}
	
	$query1 = $db1->prepare("select hashpw,status from grcustomers where email = ?");
	$query1->bind_param('s',$email);

	$query1->execute();
	$query1->store_result();
	$userexists = $query1->num_rows;
	if ($userexists == 1 )
	{
		$query1->bind_result($hashedpw,$status);
		$row = $query1->fetch();
		$query1->free_result();
		if (password_verify($userpassword, $hashedpw))
		{
			echo "You have logged in successfully";
			// echo "Set session variables here including the $status";
			$_SESSION["loggedin"] = true;
			$_SESSION["level"] = $status;
		}
		else
		{
			echo "No soup for you!";
		}
	}
	else
	{
		echo "user not found";
	}
	
	echo "<br />";
	echo '<a href = "https://nbtl.mesacc.edu/mwatchman6/phprouter">CLICK HERE TO RETURN TO HOME PAGE</a>';

}
checklogin();
?>