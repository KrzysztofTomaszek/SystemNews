<center>        
<div class="w3-card-4 w3-margin w3-white">
    <!--<img src="" width="640px" height="480px" alt="" style="width:100%;">-->
    <div class="w3-container">
        <h3><b><?php print_r($data['tytul']);?></b></h3>
        <h5><span class="w3-opacity"><?php print_r($data['data']);?></span></h5>
        <h5><span class="w3-opacity">Autor: <?php print_r($data['autor']);?></span></h5>
    </div>
    <div class="w3-container">        
        <div class="w3-row">
                    <p><?php echo $data['tresc'];?><br></p>
                    <a href="index.php?cc=Main&cf=strona&page=<?php echo $_GET['stronaWejscia']; ?>"><button class="btn btn-primary">Wróć</button></a>
                    <?php echo $data['adminButton'];?>
        </div>
    </div>
    <br><br>
</div>
</center>