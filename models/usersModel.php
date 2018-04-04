<?php
	require_once 'Model.php';

	class usersModel extends Model
	{
	    function __construct($host, $username, $password, $database)
	    {
	        parent::__construct($host,$username,$password,$database);
	    }

	    public function login($login,$password)
	    {
	    	$query = "select * from users left join groups on (users.groupsId = groups.groupsId) where login = '".$login."' and password = '".$password."'";
	        $result = NULL;
	        $row = NULL;
	        $result = $this->mysqli->query($query);
	        if($result->num_rows===1)
	        {
	            $row=$result->fetch_array();
	        }
	        return $row;
	    }

	    public function addUser($login,$password)
	    {	    	
	    	$query="insert into `users` (`usersID`, `login`, `password`, `groupsID`, `ban`) values (NULL, '".$login."', '".$password."', '2', '0')";
	    	$this->mysqli->query($query);
	    }

	    public function editUser($userID, $login, $password)
	    {	    	
	    	$query="update `users` SET `login` = '".$login."', `password` = '".$password."' WHERE `users`.`usersID` = ".$userID."";
	    	$this->mysqli->query($query);
	    }

	    public function userExist($login)
	    {
	    	$query="select * from users where login = '".$login."';";
	    	$result = NULL;
	        $row = 0;
	        $result = $this->mysqli->query($query);
	        if($result->num_rows===1)
	        {
	            $row=1;
	        }
	        return $row;
	    }

		public function checkBan($usersID)
	    {
	    	$query="select * from users where usersID = '".$usersID."' and ban = '1'";
	    	$result = NULL;
	        $row = 0;
	        $result = $this->mysqli->query($query);
	        if($result->num_rows===1)
	        {
	            $row=1;
	        }
	        return $row;
	    }

	    public function checkGroup($usersID)
	    {
	    	$query = "select groups.name from users left join groups on (users.groupsId = groups.groupsId) where usersID = '".$usersID."' ";
	        $result = NULL;
	        $row = NULL;
	        $result = $this->mysqli->query($query);
	        if($result->num_rows===1)
	        {
	            $row=$result->fetch_array();
	        }
	        return $row;
	    }
	    
	}
?>