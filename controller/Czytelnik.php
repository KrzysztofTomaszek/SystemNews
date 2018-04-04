<?php       
    require_once './controller/Controller.php';
    require_once './controller/newsController.php';
    require_once './controller/usersController.php';
    require_once './models/newsModel.php';
    require_once './controller/Main.php';

	class Czytelnik extends Controller
	{
		public $newsModel;
		public $mainView;

		public function __construct()
		{
			parent::__construct();

			$this->mainView = new Main();	
			$this->newsModel= new newsModel("localhost","root","","newssystem");
		}

		public function mainPage($data=NULL)
		{
			if($this->sprawdzaczCzytelnika())
			{
				$data['header']=$this->loadView('headerView',$data,true);
				$data['menu']=$this->loadView('menuUserView',$data,true);
				$dane=$this->newsModel->page(1);
				$data['content']='';
				for($i=0;$i<(count($dane)-1);$i++)
				{
					$zaw=substr($dane[$i]['tresc'],0,50);
					$dane[$i]['zaw']=$zaw.'........';
					$dane[$i]['strona']=1;
					$data['content']=$data['content'].$this->loadView('newsPageView',$dane[$i],true);
				}
				$contrN= new newsController;
				$dane=$contrN->sprStron(1);
				$data['pagin']=$this->loadView('newsPaginView',$dane,true);
				$data['footer']=$this->loadView('footerView',$data,true);
				$data['strona']=1;
				$this->loadView('mainView',$data);
			}			
		}
		
		public function sprawdzaczCzytelnika()
		{
			if($_SESSION['userGroup']=='Czytelnik')
			{
				return TRUE;
			}
			else
			{
				$data['content']="<div><h1>Błąd Dostępu</h1></div><div>Nie posiadasz uprawnień by dostać się do tego miejsca</div>";
				$this->mainView->badPass($data);
				return FALSE;
			}	
		}

		public function zmienDaneForm()
		{
			if($this->sprawdzaczCzytelnika())
			{		
				$data['header']='';
		    	$data['header']=$this->loadView('headerView',$data,true);
				$data['menu']=$this->loadView('menuView',$data,true);			
				$data['footer']=$this->loadView('footerView',$data,true);

				if($_SESSION['userGroup']=='Czytelnik')
				{	
					$model = new usersModel('localhost', 'root','','newssystem');
					$data['content']=$this->loadView('editUserView',$dane,true);
				}	
				else
				{
					$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';
				}
				$this->mainView->badPass($data);
			}	
		}

		public function zmienDane()
		{
			if($this->sprawdzaczCzytelnika())
			{
				$data['header']='';
		    	$data['header']=$this->loadView('headerView',$data,true);
				$data['menu']=$this->loadView('menuView',$data,true);			
				$data['footer']=$this->loadView('footerView',$data,true);	    	

		    	if($_SESSION['userGroup']=='Czytelnik')
				{	
					$model = new usersModel('localhost', 'root','','newssystem');
			    	$dane=$_GET+$_POST+$_SESSION;
			    	$dane=array_splice($dane,2);	    	
					$login=$dane['login'];
					$password=$dane['password'];
					$userId=$dane['userID'];
					$existNew=$model->userExist($dane['login']);
					$existOld=$model->userExist($dane['oldLogin']);

					if($existNew && ($existNew!=$existOld))
			    	{
			    		$data['content']="<div><h1>Błąd zmiany danych</h1></div>			<div>Użytkownik o takim loginie już istnieje.</div>";
			    	}
			    	else
			    	{
			    		$model->editUser($userId,$login,$password);
			    		session_destroy();
			    		session_start();
			    		$data['menu']=$this->loadView('menuView',$data,true);
			    		$data['content']="<div><h1>Zmiana Danych Dokonana Pomyślnie</h1></div>";
			    	}				
				}	
				else
				{
					$data['content']='<div class="container"><h1>Nie posiadasz odpowiednich uprawnień by uzyskać dostęp do tego miejsca.</h1></div>';			
				}

				$this->mainView->badPass($data);
			}	
		}
	}
?>