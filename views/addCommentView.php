<div class="container"> 
  <form action="index.php?cc=newsController&cf=addComment&idNews=<?php echo $_GET['idNews']?>&stronaWejscia=<?php echo $_GET['stronaWejscia']?>" method="POST">
	<div class="form-group">
    </div>
  	<h4>Dodaj Komentarz</h4>
    <div class="form-group">
      <textarea rows="5" cols="50" name="tresc" class="form-control" id="tresc" placeholder="Wpisz tutaj zawartosc komentarza." required minlength="3"></textarea>
    </div>  	   
	<button type="submit" class="btn btn-default">Dodaj komentarz</button>
	<div class="form-group">
        <input type="input" class="form-control" id="data" name="data" value="<?php echo  date("Y-m-d H:i:s"); ?>" style="visibility: hidden;" requireds>
    </div>
</div>