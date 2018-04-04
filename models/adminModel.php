<?php
	require_once 'Model.php';

	class adminModel extends Model
	{
	    function __construct($host, $username, $password, $database)
	    {
	        parent::__construct($host,$username,$password,$database);
	    }   
		
	    public function userList()
	    {
	    	$result = $this->mysqli->query("select usersID, login, ban from users where groupsID != 1");
	        $data=NULL;
	        while($row=$result->fetch_array())
	        {
	            $data[]=$row;
	        }
	        return $data;
	    }

	    public function banUser($userID)
	    {
	    	$query = "UPDATE `users` SET `ban` = '1' WHERE `users`.`usersID` =".$userID."";
	    	$this->mysqli->query($query);
	    	return 1;
	    }

	    public function unbanUser($userID)
	    {
	    	$query = "UPDATE `users` SET `ban` = '0' WHERE `users`.`usersID` =".$userID."";
	    	$this->mysqli->query($query);
	    	return 1;
	    }

	    public function banComm($komentarzID)
	    {
	    	$query = "UPDATE `komentarze` SET `ban` = '1' WHERE `komentarze`.`komentarzeID` =".$komentarzID."";
	    	$this->mysqli->query($query);
	    	return 1;
	    }

	    public function unbanComm($komentarzID)
	    {
	    	$query = "UPDATE `komentarze` SET `ban` = '0' WHERE `komentarze`.`komentarzeID` =".$komentarzID."";
	    	$this->mysqli->query($query);
	    	return 1;
	    }
	}
?>