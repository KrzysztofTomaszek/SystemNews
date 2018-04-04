<div class="col-sm-8">
    <div class="panel panel-white post panel-shadow">
        <div class="post-heading">
            <div class="pull-left meta">
                <div class="title h5">
                    <a href="#"><b><?php echo $data['login']; ?></b></a>
                </div>
                <h6 class="text-muted time"><?php echo $data['data']; ?></h6>
            </div>
        </div> 
        <div class="post-description"> 
            <p><?php echo $data['komentarz']; ?></p>
            <br>
            <div class="stats">
            	<?php echo $data['adminButton']; ?>
            </div>
        </div>
    </div>
</div>
	  