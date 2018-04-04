<?php       
    require_once './controller/Controller.php';
    require_once './controller/newsController.php';
    require_once './controller/usersController.php';
    require_once './models/newsModel.php';
    require_once './models/adminModel.php';
    require_once './controller/Main.php';

	class Admin extends Controller
	{
		public $newsModel;
		public $mainView;

		public function __construct()
		{
			parent::__construct();

			$this->mainView = new Main();
		}

		public function mainPage($data=NULL)
		{
			$data['header']=$this->loadView('headerView',$data,true);
			$data['menu']=$this->loadView('menuAdminView',$data,true);		
			$data['footer']=$this->loadView('footerView',$data,true);
			$newsModel = new newsModel("localhost","root","","newssystem");
			$dane=$newsModel->page(1);
			$data['content']='';
			if($this->sprawdzaczAdmina())
			{				
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
				$data['strona']=1;				
			}	
			$this->loadView('mainView',$data);		
		}
		
		public function sprawdzaczAdmina()
		{
			if($_SESSION['userGroup']=='Administrator')
			{
				return TRUE;
			}
			else
			{
				$data['content']="
		<div><h1>Błąd Dostępu</h1></div>
		<div>Nie posiadasz uprawnień by dostać się do tego miejsca</div>";
				$this->mainView->badPass($data);
				return FALSE;
			}	
		}

		public function userList() 
	    {	
	    	$main= new Main();
	    	if($this->sprawdzaczAdmina())
			{  	
				$model = new adminModel('localhost', 'root','','newssystem');
		    	$list=$model->userList();

		    	$dane['banListView']='';
		    	$iloscUsr=count($list);
			    for($i=0;$i<$iloscUsr;$i++)
			    {
			    	if(!($list[$i]['ban']))
					{
					    $list[$i]['czyBan']='Nie';
					}
					else
					{
					    $list[$i]['czyBan']='Tak';
					}
					
					if(!($list[$i]['ban']))
					{ 
						$list[$i]['banButton']=$this->loadView('banUserView',$list[$i],true);
					}
					else
					{ 
						$list[$i]['banButton']=$this->loadView('unbanUserView',$list[$i],true); 
					}
			    	$dane['banListView']=$dane['banListView'].$this->loadView('singleUserListView',$list[$i],true);
			    }
				$data['content']=$this->loadView('userListView',$dane,true);
				$main->badPass($data);
			}

	    }

	    public function banUser() 
	    {
	    	if($this->sprawdzaczAdmina())
			{
		    	$userID=$_GET['userID'];
		    	$model = new adminModel('localhost', 'root','','newssystem');
		    	$model->banUser($userID);
		    	$this->userList();
		    }	
	    }

	    public function unbanUser() 
	    {
	    	if($this->sprawdzaczAdmina())
			{
		    	$userID=$_GET['userID'];
		    	$model = new adminModel('localhost', 'root','','newssystem');
		    	$model->unbanUser($userID);
		    	$this->userList();
			}    
	    }

		public function banComm()
		{
			if($this->sprawdzaczAdmina())
			{
				$parameters=$_GET+$_POST+$_SESSION;
		    	$model = new adminModel('localhost', 'root','','newssystem');
		    	if($model->banComm($_GET['komentarzeID']))
		    	{
		    		header("Location: index.php?cc=Main&cf=oneNews&idNews=".$parameters['idNews']."&stronaWejscia=".$parameters['stronaWejscia']."");
		    	}
		    	else
		    	{
		    		$data['content']="<div><h1>Błąd Dodawania</h1></div><div>Komentarz nie został zbanowany.</div>";
					$this->mainView->badPass($data);
		    	}	
		    }	
		}

		public function unbanComm() 
	    {
	    	if($this->sprawdzaczAdmina())
			{
		    	$parameters=$_GET+$_POST+$_SESSION;
		    	$model = new adminModel('localhost', 'root','','newssystem');
		    	if($model->unbanComm($_GET['komentarzeID']))
		    	{
		    		header("Location: index.php?cc=Main&cf=oneNews&idNews=".$parameters['idNews']."&stronaWejscia=".$parameters['stronaWejscia']."");
		    	}
		    	else
		    	{
		    		$data['content']="<div><h1>Błąd Dodawania</h1></div><div>Komentarz nie został odbanowany.</div>";
					$this->mainView->badPass($data);
		    	}
		    }	
	    }
	}
?>