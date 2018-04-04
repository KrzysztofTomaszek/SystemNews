<div class="container">
  <h2>Edytowanie Newsa</h2>
  <form action="index.php?cc=newsController&cf=editNews&stronaWejscia=<?php echo $_GET['stronaWejscia']; ?>&idNews=<?php echo $_GET['idNews']; ?>" method="POST">
	<div class="form-group">
      <label for="tytul">Tytuł:</label>
      <input type="text" class="form-control" id="tytul" placeholder="Wpisz tytuł" value="<?php echo $data['tytul']; ?>" name="tytul">
    </div>
    <div class="form-group">
      <label for="tresc">Treść:</label>
      <textarea rows="10" cols="40" name="tresc" class="form-control" id="tresc" placeholder="Wpisz tutaj zawartosc newsa."><?php echo $data['tresc']; ?></textarea>
    </div>
    <div class="form-group">
      <label for="autor">Autor:</label>
      <select name="autor">
        <?php 
          echo $data['autorzy'];
        ?>
      </select>
    </div>
	<div class="form-group">
      <label for="data">Data:</label>
      <input type="date" class="form-control" id="data" name="data" value="<?php echo $data['data']; ?>">
    </div>   
	<button type="submit" class="btn btn-default">Zmień</button>
</div>	