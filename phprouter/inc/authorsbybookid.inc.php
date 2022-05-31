<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /mwatchman6/phprouter');
}
?>
<head>
	<style type = "text/css">
		table, td, th {
			border: 1px solid black;
			border-collapse: collapse;
		}
		
		td, th {
			padding: 5px;
		}
		
		a {
			text-decoration: none;
		}
		tr:hover {
			background-color: #ffff88;
		}
	</style>
</head>
<?php
function getauthorsbybookid(string $authoridsearch)
{
	include '../../blurg.inc';
	
	$db1 = new mysqli('localhost', 'mwatchman6', $password, 'STUmwatchman6');

	if($db1->connect_errno > 0)
	{
		die('Unable to connect to database [' . $db1->connect_error . ']');
	}

	$query1 = $db1->prepare('CALL getauthorsbybookid(?)');
	$query1->bind_param('s',$authoridsearch);

	$query1->execute();
	$query1->store_result();
	$query1->bind_result($author_id, $lastname, $firstname, $authorder);
		
# Table loop with results
	$results = '<table><tr><th>Author(s)</th></tr>';
	while($query1->fetch()){
		$results .= "<tr><td>$lastname, $firstname</td></tr>";
	}
	
	$results .= "</table>";
	
	$query1->free_result();
	$db1->close();
	return $results;
	
	
	
}

# getauthursbybookid();
?>