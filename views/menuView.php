<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?cc=Main&cf=strona">Główna</a></li> 
     <li><a href="index.php?cc=usersController&cf=addFormUser">Rejestracja</a></li>  
    <li>
    <div class="collapse navbar-collapse">      
      <form class="navbar-form navbar-right" action="index.php?cc=usersController&cf=login" method="POST">
	        <div class="input-group">
	            <span class="input-group-addon">
	            	<i class="glyphicon glyphicon-user"></i>
	            </span>
	            <input type="text"  placeholder="Wpisz login" name="login">           
	        </div>
	        <div class="input-group">
	            <span class="input-group-addon">
	            	<i class="glyphicon glyphicon-lock"></i>
	            </span>
	            <input type="password"  id="password" placeholder="Wpisz hasło" name="password">
	        </div>
	            <button type="submit" class="btn btn-primary">Zaloguj</button>
        </form>     
    </div>
  	</li>
  </ul>
  </div>
</nav>