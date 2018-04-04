<div class="container">
  <h2>Rejestracja</h2>
  <form action="index.php?cc=usersController&cf=addUser" method="POST">
    <div class="form-group">
      <label for="login">Login:</label>
      <input type="text" class="form-control" id="login" placeholder="Wpisz login" name="login" required minlength="3">
    </div>
    <div class="form-group">
      <label for="password">Hasło:</label>
      <input type="password" class="form-control" id="password" placeholder="Wpisz hasło" name="password" required minlength="3">
    </div>    
    <button type="submit" class="btn btn-default">Zarejestruj</button>
  </form>
</div>