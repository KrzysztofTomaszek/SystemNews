<?php	
	require_once './controller/Controller.php';
	require_once './controller/Main.php';            
    require_once './controller/usersController.php';
	class newsController extends Controller
	{
		public $mainView;

		public function __construct()
		{
			$this->mainView = new Main();
			parent::__construct();
		}

	    public function sprStron($strona)
	    {
	    	$dane['lewa']=1;
	    	$dane['prawa']=1;
	    	$model = new newsModel('localhost', 'root','','newssystem');
	    	if ($strona!=1) 
	    	{
	    		if(!$model->page($strona-1))
	        	{
	        		$dane['lewa']=0;
	        	}	
	    	}
	    	else
	    	{
	    		$dane['lewa']=0;
	    	}
	        if(!$model->page($strona+1))
	        {
	        	$dane['prawa']=0;
	        }
	        $dane['strona']=$strona;

	        if($dane['lewa'])
			{
				$dane['lewa']=$this->loadView('leftPaginView',$dane,true);
			}
			else
			{
				$dane['lewa']='';
			}
			if($dane['prawa'])
			{
				$dane['prawa']=$this->loadView('rightPaginView',$dane,true);
			}
			else
			{
				$dane['prawa']='';
			}

	        return $dane;
	    }

	    public function getNews()
	    {
	    	$data['header']='';
	    	$data['header']=$this->loadView('headerView','',true);
			$data['menu']=$this->loadView('menuView','',true);			
			$data['footer']=$this->loadView('footerView','',true);

			if($_SESSION['userGroup']=='Administrator')
			{	
				$model = new newsModel('localhost', 'root','','newssystem');
				$dane = $model->autorzy();
				$autorzy='';
				for($i=0; $i<count($dane); $i++)
				{
					$autorzy=$autorzy.'<option value="'.$dane[$i]['autor'].'">'.$dane[$i]['autor'].'</option>';
				}
				$data['content']=$this->loadView('addArticleView',$autorzy,true);
			}	
			else
			{
				$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';
			}
			$this->mainView->badPass($data);
	    }
	    
	    public function addNews()
	    {
	    	$model = new newsModel('localhost', 'root','','newssystem');
	    	$dane=$_POST;
	    	if($_SESSION['userGroup']=='Administrator')
			{
		    	if($model->addNews($dane))
		    	{
		    		$data['content']="<div><h1>News Dodany</h1></div>";
		    	}
		    	else
		    	{
		    		$data['content']="<div><h1>Błąd Dodawania</h1></div><div>News nie został dodany.</div>";
		    	}
		    }	
			else
			{
				$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';
			}
			$this->mainView->badPass($data);		
	    }

	    public function addComment()
	    {
	    	$model = new newsModel('localhost', 'root','','newssystem');
	    	$parameters=$_GET+$_POST+$_SESSION;
            $parameters=array_splice($parameters,2);

            if($_SESSION['userGroup']=='Administrator' || $_SESSION['userGroup']=='Czytelnik')
			{
		    	if($model->addComment($parameters))
		    	{
		    		header("Location: index.php?cc=Main&cf=oneNews&idNews=".$parameters['idNews']."&stronaWejscia=".$parameters['stronaWejscia']."");
		    	}
		    	else
		    	{
		    		$data['content']="<div><h1>Błąd Dodawania</h1></div><div>Komentarz nie został dodany.</div>";
		    	}
		    }	
			else
			{
				$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';
			}
			$this->mainView->badPass($data);			
	    }

	    public function wysOceny($dane)
	    {
	    	$ocena=$dane['ocena'];
	    	$data['hSR5']='';
	    	$data['hSR4']='';
	    	$data['hSR3']='';
	    	$data['hSR2']='';
	    	$data['hSR1']='';
	    	switch ($ocena) 
	    	{
	    		case 1:
	    			$data['hSR1']='checked';
	    			break;
	    		case 2:
	    			$data['hSR2']='checked';
	    			break;
	    		case 3:
	    			$data['hSR3']='checked';
	    			break;
	    		case 4:
	    			$data['hSR4']='checked';
	    			break;
	    		case 5:
	    			$data['hSR5']='checked';
	    			break;
	    	}
	    	return $data;
	    }

	    public function ratingNews()
	    {
	    	$parameters=$_GET+$_POST+$_SESSION;
            $parameters=array_splice($parameters,2);

            $model = new newsModel('localhost', 'root','','newssystem');

            if($_SESSION['userGroup']=='Administrator' || $_SESSION['userGroup']=='Czytelnik')
			{
	            if($model->addRating($parameters['userID'],$parameters['heart'],$parameters['idNews']))
		    	{
		    		header("Location: index.php?cc=Main&cf=oneNews&idNews=".$parameters['idNews']."&stronaWejscia=".$parameters['stronaWejscia']."");
		    	}
		    	else
		    	{
		    		$data['content']="<div><h1>Błąd Dodawania</h1></div><div>Ocena nie została dodana.</div>";
		    	}
		    }		        
		    else
			{
				$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';
			}
			$this->mainView->badPass($data);		  
	    }

	    public function getEditNews()
	    {
	    	$data['header']='';
	    	$data['header']=$this->loadView('headerView',$data,true);
			$data['menu']=$this->loadView('menuView',$data,true);			
			$data['footer']=$this->loadView('footerView',$data,true);

			if($_SESSION['userGroup']=='Administrator')
			{	
				$model = new newsModel('localhost', 'root','','newssystem');
				$dane = $model->autorzy();
				$autorzy='';
				for($i=0; $i<count($dane); $i++)
				{
					$autorzy=$autorzy.'<option value="'.$dane[$i]['autor'].'">'.$dane[$i]['autor'].'</option>';
				}
								
		    	$dane = $model->oneNews($_GET['idNews']);
		    	$dane['autorzy'] = $autorzy;
				$data['content']=$this->loadView('editArticleView',$dane,true);
			}	
			else
			{
				$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';
			}
			$this->mainView->badPass($data);	
	    }

	    public function editNews()
	    {
	    	$data['header']='';
	    	$data['header']=$this->loadView('headerView',$data,true);
			$data['menu']=$this->loadView('menuView',$data,true);			
			$data['footer']=$this->loadView('footerView',$data,true);

	    	$model = new newsModel('localhost', 'root','','newssystem');
	    	$dane=$_GET+$_POST+$_SESSION;
	    	$dane=array_splice($dane,2);	    	

	    	if($_SESSION['userGroup']=='Administrator')
			{	
				if($model->editNews($dane))
		    	{
		    		header("Location: index.php?cc=Main&cf=oneNews&idNews=".$dane['idNews']."&stronaWejscia=".$dane['stronaWejscia']."");
		    	}
		    	else
		    	{
		    		$data['content']="<div><h1>Błąd Dodawania</h1></div><div>News nie został zedytowany.</div>";
		    	}
			}	
			else
			{
				$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';			
			}
			$this->mainView->badPass($data);
	    }
	}
?>