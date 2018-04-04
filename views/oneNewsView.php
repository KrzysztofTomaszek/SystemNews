<!DOCTYPE html>
<html>
	<head>
    	<title>Ćwierknik</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">        
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
        </style>
    </head>
    <body>
    <body class="w3-light-grey">
		<div><?php echo $data['header']; ?></div>
		<div><?php echo $data['menu']; ?></div>
        <center>
		<div class="w3-row" style="max-width:75vw">
            <?php echo $data['news']; ?></div>
        <div class="w3-row" style="max-width:75vw">
            <?php echo $data['rating']; ?></div>
        </center>    
        <div><?php echo $data['addComment']; ?></div>
        <div><?php echo $data['comments']; ?></div>
		<div><?php echo $data['footer']; ?></div>
	</body>
</html>