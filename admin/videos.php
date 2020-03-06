<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   


<?php

$x=0;
$db = new DB();    
		

//FAZ A INSERÇAO NO BANCO DE DADOS
if(isset($_GET['action']) && $_GET['action']==1){
	
		$nomeArquivo = trim(strtolower(uniqid().'_'.$_FILES["imagem"]["name"]));
		$tamanhoArquivo = $_FILES["imagem"]["size"];
		$nomeTemporario = $_FILES["imagem"]["tmp_name"];
		$nomeTipo = $_FILES["imagem"]["type"];
	
		$arq_new = 'img/'.$nomeArquivo;
		move_uploaded_file($nomeTemporario, ($arq_new));

		
		$sel = $db->select("INSERT INTO cad_videos (logo) VALUES ('$nomeArquivo')");
		echo '<script>$("#sucesso_user").show();</script>';
			

//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS	
} else if(isset($_GET['action']) && $_GET['action']==2){
	
	$x=1;
	
	$sel = $db->select("SELECT * FROM cad_videos WHERE id='$id' LIMIT 1");
	$ln = $db->expand($sel);
	
	$logo = $ln['logo'];
	
	
//FAZ A exclusao NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM cad_videos WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
	
//FAZ A ALTERAÇAO NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==4){
	
			$nomeArquivo = trim(strtolower($_FILES["logo"]["name"]));
			$tamanhoArquivo = $_FILES["logo"]["size"];
			$nomeTemporario = $_FILES["logo"]["tmp_name"];
			$nomeTipo = $_FILES["logo"]["type"];

			if(!empty($nomeArquivo)){
	   		$arq_new = 'img/'.$nomeArquivo;
	   		move_uploaded_file($nomeTemporario, ($arq_new));

	   		$sel = $db->select("UPDATE cad_videos SET logo='$nomeArquivo' WHERE id='$id' LIMIT 1");		
		
		}
			
		echo '<script>$("#sucesso_user").show();</script>';
			
}
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cadastro de Vídeos</h4></h4>
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
                <label for="exampleInputEmail1">Video</label>
                <input type="text" class="form-control" name="video" required="required" value="<?php if($x==1){ echo $video;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Título</label>
                <input type="text" class="form-control" name="titulo" required="required" value="<?php if($x==1){ echo $titulo;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Data</label>
                <input type="date" class="form-control" name="data" required="required" value="<?php if($x==1){ echo $data;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Tags</label>
                 <input type="text" class="form-control" name="tags" required="required" value="<?php if($x==1){ echo $tags;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Imagem</label>
                <input type="file" class="form-control" name="imagem" <?php if($x==1){ echo 'required="required"';} ?> />
  
           </div>
        </div>


        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Texto</label>
                <textarea rows="8" class="form-html" name="texto"  required="required"><?php if($x==1){ echo $texto;} ?></textarea>
  
           </div>
        </div>
       
        <hr>
        
        <div class="col-md-12">
        <button type="submit" class="btn btn-primary">SALVAR</button>
        </div>   
        
        <div class="col-md-12">&nbsp;</div>
           
   </div>

</div>                            
      
</div>    


<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Vídeos Cadastrados</h4></h4>
	</div>
				

<ul class="list-group">
					
	<?php
		$hoje=date("Y-m-d");
		$db = new DB();    
		$sel = $db->select("SELECT * FROM cad_videos ORDER BY id DESC");
		if($db->rows($sel)){
			$x=1;	
			while($yy = $db->expand($sel)){
								
				echo'
					
					<li class="list-group-item">
						<a  data-toggle="collapse" style="text-transform:uppercase">'.$yy['titulo'].'</a>				
						<a href="?id='.$yy['id'].'&action=3" style="float:right;"><i class="fa fa-trash"></i></a>
						<a href="?id='.$yy['id'].'&action=2" style="float:right; margin-right:8px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						
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