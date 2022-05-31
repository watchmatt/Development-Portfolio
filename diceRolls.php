<?php
declare(strict_types=1);

$yourpath = dirname($_SERVER['SCRIPT_NAME']). '/';
session_set_cookie_params (0, $yourpath);
session_start();
session_regenerate_id();

if(!isset($_SESSION['rolls'])){
	$_SESSION['rolls'] = array();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Dice Rolls Array</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="dcterms.rightsHolder" content="Name of Copyright Holder" />
<meta name="dcterms.dateCopyrighted" content="2021" />
</head>
<body>

<?php
function rolldice(int $numsides, int $numdice =1): array
{
    $dicerolls = array();
    if ( $numsides == 0 or $numdice == 0 )
    { 
            return $dicerolls;
    }
    elseif ( $numdice == 1 )
    {
		$dicerolls[] = mt_rand(1,$numsides);
		return $dicerolls;
    }
    else
    {
		for ( $i = 1; $i <= $numdice; $i++)
		{
				$dicerolls[] = mt_rand(1,$numsides);
		}
		return $dicerolls;
    }
}
?>

<?php
if (isset($_POST['first_name'])) {
	$_SESSION['name'] = $_POST['first_name'];
}
if (isset($_POST['submit'])) {
	echo "<h3>Nice Roll!</h3>";
	
	$result = rolldice(6,6);
	
	for ($i = 0; $i < count($result); $i++) {
		echo '<img src = "dicefaces/dice0' . $result[$i] . '.png"/>';
	}
	echo "<br /><br />";
	
	echo <<<__FORM__
	<form method = "post" action = "#">
	<strong>Thank You for rolling the dice $_SESSION[name]! Would you like to roll again?</strong>
	<br />
	<br />
	<input type = "submit" name = "submit" value = "Roll Dice Again" />
	<br />
	</form>
__FORM__;

	echo "<br /><hr />";
	echo "<h3>Past Ten Rolls (oldest to newest):</h3>";
	echo "<ol>";
	foreach ($_SESSION['rolls'] as $item){
		echo "<li>";
		foreach ((array) $item as $dicerolls){
			echo '<img src = "dicefaces/dice0' . $dicerolls . '.png"/>';
		}
		echo "<br /><br />";
		echo "</li>";
	}
	echo "</ol>";
	
	$_SESSION['rolls'][] = $result;
	if (count($_SESSION['rolls']) > 10) {
		array_shift($_SESSION['rolls']);
	}
	echo "<br />";
} else {
	echo <<<__FORM__
	<form method = "post" action = "#">
	<label for = "fname">Enter your first name:</label>
	<input type = "text" id = "fname" name = "first_name" />
	<br />
	<input type = "submit" name = "submit" value = "Roll Dice" />
	<br />
	</form>
__FORM__;
}
?>

	<div id="validator">
		<a href="http://validator.w3.org/nu/?doc=https://nbtl.mesacc.edu/mwatchman6/diceRolls.php" target = "_blank">
		HTML 5 Validation</a>

		<a href="https://jigsaw.w3.org/css-validator/validator?uri=https://nbtl.mesacc.edu/mwatchman6/diceRolls.php" target = "_blank">
		CSS 3 Validator
		</a>

		<a href="http://wave.webaim.org/report#/https://nbtl.mesacc.edu/mwatchman6/diceRolls.php" target = "_blank">
		Wave Accessibility Test</a>
	</div>
</body>
</html>