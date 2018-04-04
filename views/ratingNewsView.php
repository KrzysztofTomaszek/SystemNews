<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style type="text/css">
    div.hearts {
      width: 330px;
      display: inline-block;
    }

    input.heart { display: none; }  

    label.heart {
      float: right;
      padding: 15px;
      font-size: 36px;
      color: #444;
      transition: all .2s;
    }

    input.heart:checked ~ label.heart:before {
      content: '\f08a';
      color: rgb(255, 0, 0);
      transition: all .25s;
    }

    input.heart-5:checked ~ label.heart:before {
      color: rgb(255, 51, 204);
      text-shadow: 0 0 20px rgb(255, 153, 255);
    }

    input.heart-1:checked ~ label.heart:before { color: rgb(153, 0, 0); }


    label.heart:before {
      content: '\f08a';
      font-family: FontAwesome;
    }



    input.submit { display: none; }

    label.submit{
      padding: 3px;
      font-size: 30px;
      color: #093;
      transition: all .2s;
    }

    label.submit:before {
      content: '\f1d8';
      font-family: FontAwesome;
    }
    
    label.submit:hover { transform: rotate(5deg) scale(1.5); }

    

    input.heartSr { display: none; }

    label.heartSr {
      float: right;
      padding: 15px;
      font-size: 36px;
      color: #444;
      transition: all .2s;
    }

    input.heartSr:checked ~ label.heartSr:before {
      content: '\f08a';
      color: rgb(255, 0, 0);
      transition: all .25s;
    }

    input.heartSr-5:checked ~ label.heartSr:before {
      color: rgb(255, 51, 204);
      text-shadow: 0 0 20px rgb(255, 153, 255);
    }

    input.heartSr-1:checked ~ label.heartSr:before { color: rgb(153, 0, 0); }

    label.heartSr:before {
      content: '\f08a';
      font-family: FontAwesome;
    }
</style>
<center>        
<div class="w3-card-4 w3-margin w3-white">
  <div class="w3-container">
      <div class ="hearts">
        <?php echo $data['SO']; ?>
        <h2>Ilość oceniajcych: <b><?php echo $data['ile'][0]; ?></b></h2>
      </div>
      <hr>
      <div class ="hearts">
        <?php echo $data['MO']; ?>
      </div>
  </div>
</div>
</center>