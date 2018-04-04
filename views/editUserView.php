<div class="container">
  <h2>Zmiana danych logowania</h2>
  <form action="index.php?cc=Czytelnik&cf=zmienDane&userID=<?php echo $_SESSION['userID']; ?>&oldLogin=<?php echo $_SESSION['userLogin']; ?>" method="POST">
    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" class="form-control" id="login" placeholder="Wpisz login" name="login" value="<?php echo $_SESSION['userLogin']; ?>">
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" class="form-control" id="password" placeholder="Wpisz hasło" name="password">
    </div>    
    <button type="submit" class="btn btn-default">Zmień</button>
  </form>
</div>