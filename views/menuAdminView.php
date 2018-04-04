<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php?cc=Main&cf=strona">Strona Główna</a></li>
      <li><a href="index.php?cc=newsController&cf=getNews">Dodaj News</a></li>
      <li><a href="index.php?cc=Admin&cf=userList">Zablokuj użytkownika</a></li>
      <li><a href="index.php?cc=usersController&cf=wyloguj">Wyloguj</a></li> 
      <li><a href="">Zalogowany jako: <?php echo $_SESSION['userLogin']; ?></a></li>
  </ul>
  </div>
</nav>