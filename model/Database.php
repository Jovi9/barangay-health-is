<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location: ../');
    exit();
}

class Database
{  
    private $host = "";
    private $user = "";
    private $password = "";
    private $dbname = "";
    // private $port = 3306;
    // private $socket = "";
    public $con = "";

    function __construct()
    {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->dbname)
            or die('Could not connect to the database server' . mysqli_connect_error());
    }
}
