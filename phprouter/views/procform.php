<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /mwatchman6/phprouter');
}
?>
<?php

echo "<h1>Test Get with a router</h1>";
echo "Full Name: " . $_GET['fullname'];

?>
