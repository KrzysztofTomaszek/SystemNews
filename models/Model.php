<?php
	class Model
	{
		public $mysqli;
		public $host;
	    public $database;
	    public $username;
	    public $password;

		public function __construct($host,$login,$password,$baseName)
		{
			$this->mysqli=new mysqli($host,$login,$password,$baseName);
		}		
	}
?>