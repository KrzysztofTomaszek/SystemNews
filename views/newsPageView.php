<center>		
	<div class="w3-card-4 w3-margin w3-white">
		<!--<img src="" width="640px" height="480px" alt="" style="width:100%;">-->
		<div class="w3-container">
			<h3><b><?php echo $data['tytul'];?></b></h3>
			<h5><span class="w3-opacity"><?php echo $data['data']; ?></span></h5>
			<h5><span class="w3-opacity">Autor: <?php echo $data['autor']; ?></span></h5>
		</div>
		<div class="w3-container">
			<p><?php echo $data['zaw'];?><br></p>
			<div class="w3-row">
				<div class="w3-col m8 s12"><p></p>
	        	</div>
	    	</div>
	    </div>
	    <a href="index.php?cc=Main&cf=oneNews&idNews=<?php echo $data['newsID'];?>&stronaWejscia=<?php echo $data['strona']; ?>"><button class="btn btn-primary">Więcej</button></a>
	    <br><br>
	</div>
</center>	