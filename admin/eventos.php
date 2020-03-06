<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   


<?php

$x=0;
$db = new DB();    
		

//FAZ A INSERÇAO NO BANCO DE DADOS
if(isset($_GET['action']) && $_GET['action']==1){
	
		$sel = $db->select("INSERT INTO blog (titulo, texto, data, mes) VALUES ('$titulo','$texto', '$data', '$mes')");
		echo '<script>$("#sucesso_user").show();</script>';


//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS	
} else if(isset($_GET['action']) && $_GET['action']==2){
	
	$x=1;
	
	$sel = $db->select("SELECT * FROM blog WHERE id='$id' LIMIT 1");
	$ln = $db->expand($sel);
	
	$titulo = $ln['titulo'];
	$texto = $ln['texto'];
	$data = $ln['data'];
	$mes = $ln['mes'];
		
//FAZ A exclusao NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM blog WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
	
//FAZ A ALTERAÇAO NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==4){
			
			$sel = $db->select("UPDATE blog SET titulo='$titulo', texto='$texto', data='$data', mes='$mes' WHERE id='$id' LIMIT 1");	
			
		echo '<script>$("#sucesso_user").show();</script>';
			
}
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cadastro de Evento</h4></h4>
	</div>
				
<?php
//SE FOR UPDATE
if($x==1){
	echo '<form method="post" action="?action=4" enctype="multipart/form-data">';	
	echo '<input type="hidden" name="id" value="'.$id.'">';
	
// INSERÇAO NORMAL	
} else {
	echo '<form method="post" action="?action=1" enctype="multipart/form-data">';
}
?>
<div class="row">

	<div class="col-md-12">&nbsp;</div>
	
    <div class="col-md-12">
    

    	<div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Título <span style="color: red;"> **</span> </label>
                <input type="text" class="form-control" name="titulo" required="required" value="<?php if($x==1){ echo $titulo;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Mês <small> (Ex: JAN)</small> <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="mes" required="required" value="<?php if($x==1){ echo $mes;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Dia <small></small> <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="data" required="required" value="<?php if($x==1){ echo $data;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Texto<span style="color: red;"> **</span></label>
                <textarea rows="8" class="form-html" name="texto" ><?php if($x==1){ echo $texto;} ?></textarea>
  
           </div>
        </div>

        
        <div class="col-md-12">
        	<button type="submit" class="btn btn-primary">SALVAR</button>
        </div>   
        
        <div class="col-md-12">&nbsp;</div>
           
   </div>

</div>                            
      
</div>    



<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Eventos Cadastrados</h4></h4>
	</div>
				

<ul class="list-group">
					
	<?php
		$hoje=date("Y-m-d");
		$db = new DB();    
		$sel = $db->select("SELECT * FROM blog ORDER BY id DESC");
		if($db->rows($sel)){
			$x=1;	
			while($yy = $db->expand($sel)){
								
				echo'
					
					<li class="list-group-item">
						<a  data-toggle="collapse" style="text-transform:uppercase">'.$yy['titulo'].'</a	>			
						<a href="?id='.$yy['id'].'&action=3" style="float:right;"><i class="fa fa-trash"></i></a>
						<a href="?id='.$yy['id'].'&action=2" style="float:right; margin-right:8px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a href="fotos_eventos.php?id='.$yy['id'].'" style="float:right; margin-right:8px;"><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
						
					</li>
				';
				$x++;	
			}
		}
	
	?>
	

</ul>                           
      
</div> 

<?php require("includes/editor_texto.php"); ?>
<?php include("includes/rodape.php"); ?>