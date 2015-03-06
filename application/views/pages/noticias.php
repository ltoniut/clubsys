<!DOCTYPE html>
<html>
<head>
	<title>Cartelera de Noticias</title>
	<?php $this->load->view('templates/head');?>
</head>
<body>
	<?php $this->load->view('templates/nav');?>
	<h1>Ultimas Noticias</h1>

<div class="container" style="visibility:<?php if(isset($getnoticias)){echo 'visible';}else{echo 'hidden';} ?>;">
  

  <?php

   if(isset($getnoticias)){

foreach ($getnoticias as $datos) {

	
  echo '<div class="media">';
  echo '<div class="media-left">';
  echo  '<a href="#">';
 	echo     '<img class="media-object" width="100" height="100" src="'.$datos['im'].'" alt="...">';
   echo '</a>';
  echo '</div>';
  echo '<div class="media-body">';
  echo '  <h4 class="media-heading">Media heading</h4>';
  echo  '<p>'.$datos['titulo'].'</p>';
  echo '</div>';
echo '</div>';
    
	}

 }

  ?>
</div>		


</body>
	<?php $this->load->view('templates/scripts');?>

</html> 