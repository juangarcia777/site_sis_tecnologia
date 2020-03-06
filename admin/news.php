<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   


<?php

$x=0;
$db = new DB();    
		

if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM news WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
}


$db = new DB();    
$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
$registros = 20;		
$contagem = $db->select("SELECT id FROM news GROUP BY email");
$total = $db->rows($contagem);
$numPaginas = ceil($total/$registros);
$inicio = ($registros*$pagina)-$registros;

?>



<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Pessoas Cadastradas no site <small style="color:#FFF">(clique sobre o email para mais detalhes)</small> <span style="float:right">TOTAL: <?php echo $total;?></span></h4></h4>
	</div>
				

<ul class="list-group">
					
	<?php
		$x=0;
		
		

		$sel = $db->select("SELECT * FROM news GROUP BY email ORDER BY id DESC LIMIT $inicio,$registros");
		if($db->rows($sel)){
			$x=1;	
			while($yy = $db->expand($sel)){
								
				echo'
					
					<li class="list-group-item">
						<a href="#pro'.$x.'"  data-toggle="collapse" style="text-transform:uppercase">'.$yy['email'].' </a>				
						<a href="?id='.$yy['id'].'&action=3" style="float:right;"><i class="fa fa-trash"></i></a>
						
						
						<div id="pro'.$x.'" class="collapse panel-collapse">
							<br>
							<p><strong>E-mail:</strong> '.$yy['email'].'</p>			
						</div>
						
					</li>
				';
				$x++;	
			}
									
			
		} else {
			
			echo'
					
					<li class="list-group-item">
						<a  data-toggle="collapse" style="text-transform:uppercase">NENHUM REGISTRO ENCONTRADO</a>				
						
						
					</li>
				';
			
		}
	
	?>
	

</ul>                           
      
</div>

<center>
<?php
	  	if($x>0){
			echo '<nav aria-label="Page navigation">
					  <ul class="pagination pagination" style="border:0;">';
			for($i = 1; $i < $numPaginas + 1; $i++) {
				
				if($pagina==$i){
					echo '<li class="page-item active"><a class="page-link" href="news.php?pagina='.$i.'">'.$i.'</a></li>';
				} else {
					echo '<li class="page-item"><a class="page-link" href="news.php?pagina='.$i.'">'.$i.'</a></li>';	
				}
				
        		
    		}	
			echo '</ul>
				</nav>';
		}
?> 
</center>

     
                     


<?php include("includes/rodape.php"); ?>