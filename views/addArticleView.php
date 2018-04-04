<div class="container">
  <h2>Dodawanie Newsa</h2>
  <form action="index.php?cc=newsController&cf=addNews" method="POST">
	<div class="form-group">
      <label for="tytul">Tytuł:</label>
      <input type="text" class="form-control" id="tytul" placeholder="Wpisz tytuł" name="tytul" required minlength="3">
    </div>
    <div class="form-group">
      <label for="tresc">Treść:</label>
      <textarea rows="10" cols="40" name="tresc" class="form-control" id="tresc" placeholder="Wpisz tutaj zawartosc newsa." required></textarea>
    </div>
    <div class="form-group">
      <label for="autor">Autor:</label>
      <select name="autor">
        <?php 
          echo $data;
        ?>
      </select>
    </div>
	<div class="form-group">
      <label for="data">Data:</label>
      <input type="date" class="form-control" id="data" name="data" required>
    </div>   
	<button type="submit" class="btn btn-default">Dodaj</button>
</div>	