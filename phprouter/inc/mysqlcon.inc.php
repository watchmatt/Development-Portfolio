<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /mwatchman6/phprouter');
}

class mysql_connect
{
    private $dbh
    public function __construct($dbpasswd,$dbname,$dbuser,$host = "localhost")
    {
        $this->dbh = new mysqli($host,$dbuser,$dbpasswd,$dbname);
        
        if($this->dbh->connect_errno > 0)
        {
            die('Unable to connect to database [' . $this->dhb->connect_error . ']');
        }
    }
    
}


?>