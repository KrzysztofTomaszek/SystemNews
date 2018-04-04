<?php	
	require_once './controller/Controller.php';
	require_once './controller/Main.php';     
	require_once './controller/Admin.php';
	require_once './controller/Czytelnik.php';          
    require_once './controller/newsController.php';
    require_once './models/usersModel.php';

	class usersController extends Controller
	{
		public $usersModel;
		public $mainConttroller;
		public $adminController;
		public $czytelnikController;

		public function __construct()
		{
			$this->usersModel = new usersModel("localhost","root","","newssystem");
			$this->mainConttroller = new Main();
			$this->adminController = new Admin();
			$this->czytelnikController = new Czytelnik();
			parent::__construct();
		}

		public function login()
		{
			$data=$_POST;
			$login=$data['login'];
			$password=$data['password'];
			$loginInfo=$this->usersModel->login($login,$password);
			if($loginInfo['usersID'])
			{
				if($this->usersModel->checkBan($loginInfo['usersID']))
				{
					$_SESSION['zalogowany']=FALSE;
					$_SESSION['userID']='';
					$_SESSION['userLogin']='';				
					$_SESSION['userGroup']='';
					$data['content']="<div><h1>Błąd Logowania</h1></div>		<div><h3>Twoje konto zostało zablokowane.</h3></div><div><h4>W celu wyjaśnienia i podania przyczyny prosimy zgłosić się do administracji.</h></div>";
				$this->mainConttroller->badPass($data);

				}
				else
				{
					$_SESSION['zalogowany']=TRUE;
					$_SESSION['userID']=$loginInfo['usersID'];
					$_SESSION['userLogin']=$loginInfo['login'];
					$groupInfo=$this->usersModel->checkGroup($loginInfo['usersID']);
					$_SESSION['userGroup']=$groupInfo['name'];
					if($groupInfo['name']=='Administrator')
					{
						$this->adminController->mainPage();
					}
					elseif($groupInfo['name']=='Czytelnik')
					{
						$this->czytelnikController->mainPage();
					}
					else
					{
						$this->mainConttroller->strona();
					}
					
				}
			}
			else
			{
				$data['content']="<div><h1>Błąd Logowania</h1></div><div>Podano złe hasło lub login</div>";
				$this->mainConttroller->badPass($data);
			}			
		}

		public function wyloguj()
		{			
			session_destroy();
			session_start();
			$_SESSION['zalogowany']=FALSE;
			$_SESSION['userID']='';
			$_SESSION['userLogin']='';				
			$_SESSION['userGroup']='';
			$this->mainConttroller->strona(); 
		}

	    public function addFormUser()
	    {
	    	$data['header']='';
	    	$data['header']=$this->loadView('headerView',$data,true);
			$data['menu']=$this->loadView('menuAdminView',$data,true);			
			$data['footer']=$this->loadView('footerView',$data,true);
			$data['content']=$this->loadView('addUserView',$data,true);
			$this->mainConttroller->badPass($data); 	
	    }	    
	    
	    public function addUser()
	    {
	    	$model = new usersModel('localhost', 'root','','newssystem');
	    	$dane=$_POST;
	    	$exist=$model->userExist($dane['login']);
	    	if($exist)
	    	{
	    		$data['content']="<div><h1>Błąd Rejestracji</h1></div><div>Użytkownik o takim loginie już istnieje.</div>";
				
	    	}
	    	else
	    	{
	    		$model->addUser($dane['login'],$dane['password']);
	    		$data['content']="<div><h1>Rejestracja Dokonana Pomyślnie</h1></div>";
	    	}
	    	$this->mainConttroller->badPass($data);	    	
	    }
	    
	}
?>