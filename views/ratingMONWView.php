<h3>Twoja Ocena:</h3>
<style type="text/css">label.heart:hover { transform: rotate(5deg) scale(1.5); }</style>
<form action="index.php?cc=newsController&cf=ratingNews&idNews=<?php echo $_GET['idNews']?>&stronaWejscia=<?php echo $_GET['stronaWejscia']?>" method="POST">        
    <input class="heart heart-5" id="heart-5" type="radio" name="heart" value="5" />
    <label class="heart heart-5" for="heart-5"></label>
    <input class="heart heart-4" id="heart-4" type="radio" name="heart" value="4" />
    <label class="heart heart-4" for="heart-4"></label>
    <input class="heart heart-3" id="heart-3" type="radio" name="heart" value="3" />
    <label class="heart heart-3" for="heart-3"></label>
    <input class="heart heart-2" id="heart-2" type="radio" name="heart" value="2" />
    <label class="heart heart-2" for="heart-2"></label>
    <input class="heart heart-1" id="heart-1" type="radio" name="heart" value="1" />
    <label class="heart heart-1" for="heart-1"></label>
    <br><br><br>
    <input class="submit" id="submitH" type="submit"/>
    <label class="submit" for="submitH"></label>
</form>