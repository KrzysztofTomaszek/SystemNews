<?php       
    require_once './controller/Controller.php';
    require_once './controller/newsController.php';
    require_once './controller/usersController.php';
    require_once './models/newsModel.php';

	class Main extends Controller
	{
		public $newsModel;

		public function __construct()
		{
			parent::__construct();	
			$this->newsModel= new newsModel("localhost","root","","newssystem");
		}		

		public function strona($strona=1,$data=NULL)
		{
			if(isset($this->parametry['page']))
			{				
				$strona=$this->parametry['page'];
			}
			$data['header']=$this->loadView('headerView','',true);
			if($_SESSION['userGroup']=='Administrator')
			{				
				$data['menu']=$this->loadView('menuAdminView',$data,true);
			}
			elseif($_SESSION['userGroup']=='Czytelnik')
			{				
				$data['menu']=$this->loadView('menuUserView',$data,true);
			}	
			else
			{
				$data['menu']=$this->loadView('menuView',$data,true);
			}
			$dane=$this->newsModel->page($strona);
			$data['content']='';
			for($i=0;$i<=(count($dane)-1);$i++)
			{
				$zaw=substr($dane[$i]['tresc'],0,50);
				$dane[$i]['zaw']=$zaw.'........';
				$dane[$i]['strona']=$strona;
				$data['content']=$data['content'].$this->loadView('newsPageView',$dane[$i],true);
			}
			$contrN= new newsController;
			$dane=$contrN->sprStron($strona);				
			$data['pagin']=$this->loadView('newsPaginView',$dane,true);
			$data['footer']=$this->loadView('footerView',$dane,true);
			$data['strona']=$strona;
			$this->loadView('mainView',$data);			
		}

		public function badPass($data=NULL)
		{
			$data['header']=$this->loadView('headerView',$data,true);
			if($_SESSION['userGroup']=='Administrator')
			{				
				$data['menu']=$this->loadView('menuAdminView',$data,true);
			}
			elseif($_SESSION['userGroup']=='Czytelnik')
			{				
				$data['menu']=$this->loadView('menuUserView',$data,true);
			}	
			else
			{
				$data['menu']=$this->loadView('menuView',$data,true);
			}			
			$data['footer']=$this->loadView('footerView',$data,true);
			$this->loadView('infoView',$data);			
		}

		public function oneNews($data=NULL)
		{
			$newsID=$this->parametry['idNews'];
			$userID=$_SESSION['userID'];
			$data['header']=$this->loadView('headerView',$data,true);
			$model = new newsModel('localhost', 'root','','newssystem');

			$dane=$this->newsModel->oneNews($newsID);
			$zaw=$dane['tresc'];
    		$dane['tresc']=wordwrap($zaw, 50, "\n", false);
    		$dane['adminButton']='';

    		$contrN= new newsController;			
			$dane['SO']=$this->loadView('ratingSOView',$contrN->wysOceny($this->newsModel->sredniaOcena($newsID)),true);

			$dane['MO']='';
			$data['addComment']='';
			$dane['singleComment']='';	
			$daneWew=$this->newsModel->commentsList($newsID);
			$Coment=count($daneWew);
			
			if($_SESSION['userGroup']=='Administrator')
			{			
				$data['menu']=$this->loadView('menuAdminView',$data,true);

				$dane['adminButton']=$this->loadView('editNewsButtonView','',true);
				if($this->newsModel->ocenaNewsa($userID,$newsID)) 
				{
					$dane['MO']=$this->loadView('ratingMOWView',$contrN->wysOceny($this->newsModel->ocenaNewsa($userID,$newsID)),true);	
				}
				else
				{
					$dane['MO']=$this->loadView('ratingMONWView','',true);	
				}	

				$data['addComment']=$this->loadView('addCommentView','',true);

				for($i=0;$i<$Coment;$i++)
				{ 
					
					if ($model->czyCommentBan($daneWew[$i]['komentarzeID'])) 
					{
						$daneWew[$i]['adminButton']=$this->loadView('unbanCommentView',$daneWew[$i],true);
					}
					else
					{
						$daneWew[$i]['adminButton']=$this->loadView('banCommentView',$daneWew[$i],true);						
					}
				}
			}
			elseif($_SESSION['userGroup']=='Czytelnik')
			{				
				$data['menu']=$this->loadView('menuUserView',$data,true);

				if($this->newsModel->ocenaNewsa($userID,$newsID)) 
				{
					$dane['MO']=$this->loadView('ratingMOWView',$contrN->wysOceny($this->newsModel->ocenaNewsa($userID,$newsID)),true);	
				}
				else
				{
					$dane['MO']=$this->loadView('ratingMONWView','',true);	
				}	

				$data['addComment']=$this->loadView('addCommentView','',true);

				for($i=0;$i<$Coment;$i++)
				{ 
					$daneWew[$i]['adminButton']='';
				}
			}	
			else
			{
				$data['menu']=$this->loadView('menuView',$data,true);

				for($i=0;$i<$Coment;$i++)
				{ 
					$daneWew[$i]['adminButton']='';
				}
			}

			$data['news']=$this->loadView('onlyNewsView',$dane,true);
			$dane['ile']=$this->newsModel->iloscOcen($newsID);
			$data['rating']=$this->loadView('ratingNewsView',$dane,true);
			
						
					
			for($i=0;$i<$Coment;$i++)
			{ 
				if ($model->czyCommentBan($daneWew[$i]['komentarzeID'])) 
				{
					$daneWew[$i]['komentarz']='<h3>Komentarz został zbanowany.</h3>';
				}
				$dane['singleComment']=$dane['singleComment'].$this->loadView('singleCommentView',$daneWew[$i],true);
			}
			
			$data['comments']=$this->loadView('commentsView',$dane,true);
			
			$data['footer']=$this->loadView('footerView',$data,true);
			$this->loadView('oneNewsView',$data);				
		}
	}
?>