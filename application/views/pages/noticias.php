<!DOCTYPE html>
<html>
<head>
	<title>Cartelera de Noticias</title>
	<?php $this->load->view('templates/head');?>
</head>
<body>
	<?php $this->load->view('templates/nav');?>
	

<div class="container" style="visibility:<?php if(isset($getnoticias)){echo 'visible';}else{echo 'hidden';} ?>;">
  
<div class="col-md-10 col-md-offset-1">
<h1>Ultimas Noticias</h1>
 


  <?php if(isset($getnoticias)): ?>
    <?php foreach($getnoticias as $datos): ?>
      <div class="media">
      <div class="media-left">
      <a href="#">
      <img class="media-object" width="100" height="100" src="<?php echo $datos['im']?>" alt="..."> 
      </a>
      </div>
      <div class="media-body">
      <h4 class="media-heading"><?php echo $datos['titulo']?></h4>
      <p><?php echo $datos['cont']?></p>
      </div>
      </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>		
</div>

</body>
	<?php $this->load->view('templates/scripts');?>

</html> 