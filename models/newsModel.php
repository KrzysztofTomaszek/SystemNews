<?php
	require_once 'Model.php';

	class newsModel extends Model
	{
	    function __construct($host, $username, $password, $database)
	    {
	        parent::__construct($host,$username,$password,$database);
	    }

	    public function allrecords() 
	    {
	        $result = $this->mysqli->query("select * from news");
	        $data=NULL;
	        while($row=$result->fetch_array())
	        {
	            $data[]=$row;
	        }
	        return $data;
	    }

	    public function oneNews($newsID)
	    {
	        $result = $this->mysqli->query("select * from news where newsID=$newsID and data < CURRENT_TIMESTAMP"); 
	        $data=NULL;
	        while($row=$result->fetch_array())
	        {
	            $data=$row;
	        }
	        return $data;
	    }

	    public function page($nrPage)
	    {
	    	$off=($nrPage*5)-5;
	        $result = $this->mysqli->query("select * from news n WHERE n.data < CURRENT_TIMESTAMP order by n.data desc limit 5 offset ".$off.""); 
	        $data=NULL;
	        while($row=$result->fetch_array())
	        {
	            $data[]=$row;
	        }	        
	        return $data;
	    }

	    public function addNews($dane)
	    {	    	
	    	$query="insert into `news` (`newsID`, `tytul`, `tresc`, `data`, `autor`) VALUES (NULL, '".$dane['tytul']."', '".$dane['tresc']."', '".$dane['data']."', '".$dane['autor']."')";
	    	$this->mysqli->query($query);
	    	return 1;
	    }

	    public function addComment($dane)
	    {
	    	$query="insert into `komentarze` (`komentarzeID`, `komentarz`, `data`, `newsID`, `usersID`, `ban`) VALUES (NULL, '".$dane['tresc']."', '".$dane['data']."', '".$dane['idNews']."', '".$dane['userID']."', '0')";
	    	$this->mysqli->query($query);
	    	return 1;
	    }

	    public function commentsList($newsID)
	    {
	    	$result = $this->mysqli->query("select * from `komentarze` inner join `users` on `komentarze`.`usersID`=`users`.`usersID` where newsID=$newsID order by `komentarze`.`data` DESC");
	        $data=NULL;
	        while($row=$result->fetch_array())
	        {
	            $data[]=$row;
	        }
	        return $data;
	    }

	    public function sredniaOcena($newsID)
	    {
	    	$query="select ROUND(AVG(ocena), 0) as ocena from ocenynews o WHERE o.newsID = '".$newsID."' GROUP BY o.newsID";	    	
	    	
	    	if($result =$this->mysqli->query($query))
	    	{
	    		$data=NULL;
		        while($row=$result->fetch_array())
		        {
		            $data=$row;
		        }	        
		        return $data;
	    	}
	    	return 0;	        
	    }

	    public function iloscOcen($newsID)
	    {
	    	$query="select count(usersID) as ile from ocenynews o WHERE o.newsID = '".$newsID."' GROUP BY o.newsID";	    	
	    	
	    	if($result =$this->mysqli->query($query))
	    	{	    		
	    		$data=NULL;
		        while($row=$result->fetch_array())
		        {
		            $data=$row;
		        }
		        if($data[0]==NULL)
		        {
		        	$data[0]=0;
		        }	    
		        return $data;
	    	}
	    	return 0;	        
	    }

	    public function ocenaNewsa($userID,$newsID)
	    {
	        $query="select ocena from ocenynews o WHERE o.usersID = '".$userID."' and o.newsID = '".$newsID."'";
	    	if($result =$this->mysqli->query($query))
	    	{
	    		$data=NULL;
		        while($row=$result->fetch_array())
		        {
		            $data=$row;
		        }	        
		        return $data;
	    	}
	    	return 0;
	    }

	    public function addRating($userID,$heart,$idNews)
	    {
	    	$query="insert INTO `ocenynews` (`ocenyNewsID`, `newsID`, `usersID`, `ocena`) VALUES (NULL, '".$idNews."', '".$userID."', '".$heart."')";
	    	$this->mysqli->query($query);
	    	return 1;
	    }


	    public function czyCommentBan($komentarzID)
	    {
	    	$query="select * from komentarze where komentarzeID = '".$komentarzID."' and ban = '1'";
	    	$result = NULL;
	        $row = 0;
	        $result = $this->mysqli->query($query);
	        if($result->num_rows===1)
	        {
	            $row=1;
	        }
	        return $row;
	    }

	    public function editNews($dane)
	    {
	    	$query="update `news` SET `tytul` = '".$dane['tytul']."', `tresc` = '".$dane['tresc']."', `data` = '".$dane['data']."', `autor` = '".$dane['autor']."' WHERE `news`.`newsID` = ".$dane['idNews']."";
	    	$this->mysqli->query($query);
	    	return 1;
	    }

	    public function autorzy()
	    {
	    	$result = $this->mysqli->query("select * from `autorzy`");
	        $data=NULL;
	        while($row=$result->fetch_array())
	        {
	            $data[]=$row;
	        }
	        return $data;
	    }
	}
?>