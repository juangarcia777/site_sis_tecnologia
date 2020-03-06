<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   

<?php

$x=0;
$db = new DB();    



		
if(isset($_GET['action']) && $_GET['action']==1){

    $nomeArquivo = $_FILES["img"]["name"];
    $tamanhoArquivo = $_FILES["img"]["size"];
    $nomeTemporario = $_FILES["img"]["tmp_name"];
    $nomeTipo = $_FILES["img"]["type"];

    if(!empty($nomeArquivo)){
      $arq_new = '../images/index/'.$nomeArquivo;
      move_uploaded_file($nomeTemporario, ($arq_new));

		$sel = $db->select("UPDATE biblioteca SET img='$nomeArquivo', texto='$texto', titulo='$titulo' ");	

	}else {

      $sel = $db->select("UPDATE biblioteca SET  texto='$texto', titulo='$titulo' ");

    }
	
	echo '<script>$("#sucesso_user").show();</script>';
			
	
}



$sel = $db->select("SELECT * FROM biblioteca LIMIT 1");
$ln = $db->expand($sel);
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Texto sobre a biblioteca</h4></h4>
	</div>
				

<form method="post" action="?action=1" enctype="multipart/form-data">
<div class="row">

	<div class="col-md-12">&nbsp;</div>
	
    <div class="col-md-12">
    
    	<div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">titulo <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="titulo" required="required" value="<?php echo $ln['titulo']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Texto <span style="color: red;"> **</span></label>
                <textarea rows="8" class="form-html" name="texto"  required="required"><?php echo $ln['texto']; ?></textarea>
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Imagem <span style="color: red;"> **</span></label>
                <input type="file" class="form-control" name="img" value="<?php echo $ln['img']; ?>" />
           </div>
        </div>
        
      
        <hr>
        
        <div class="col-md-12">
        <button type="submit" class="btn btn-primary">SALVAR</button>
        </div>   
        
        <div class="col-md-12">&nbsp;</div>
           
   </div>

</div>                            
      
 




                     

<?php require("includes/editor_texto.php"); ?>
<?php include("includes/rodape.php"); ?>