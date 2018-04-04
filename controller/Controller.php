<?php
    class Controller
    {      
        public $parametry;

        public function __construct()
        {
            $parameters=$_GET+$_POST+$_SESSION;
            unset($parameters['cc']);
            unset($parameters['cf']);
            $this->parametry=$parameters;
        }   
        
        public function loadView($viewName, $data, $returnHTML=false)
        {
            if($returnHTML==true) ob_start();
            include ".\\views\\$viewName.php";
            $content=NULL;
            if($returnHTML==true)
            {
                $content=ob_get_contents();
                ob_end_clean();
                return $content;
            }
            return NULL;
        }
    }

?>