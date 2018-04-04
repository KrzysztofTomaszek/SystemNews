<?php session_start();?>
<!DOCTYPE html>
<html lang=pl>
    <head>
        <title>Ćwierknik</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">  
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
        </style>
    </head>
    <body>
        <?php
            error_reporting(0);
            if (!($_SESSION['zalogowany'])) {
                $_SESSION['zalogowany']=FALSE;
                $_SESSION['userID']='';
				$_SESSION['userLogin']='';				
				$_SESSION['userGroup']='';
            }            
        ?>
        <?php           
            if(!($controllerClassName = $_GET['cc']))
            {
                $controllerClassName='Main';    
            }
            if(!($controller_functionName = $_GET['cf']))
            {
                $controller_functionName='strona';   
            }       
            
            require_once ".\controller\\".$controllerClassName.".php";
            $controller = new $controllerClassName();
            $controller->$controller_functionName();
        ?>
    </body>
</html>
