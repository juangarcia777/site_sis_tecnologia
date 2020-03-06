<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   

<?php

$x=0;
$db = new DB();    
    

//FAZ A INSERÇAO NO BANCO DE DADOS
if(isset($_GET['action']) && $_GET['action']==1){
  
    $nomeArquivo = trim(strtolower(uniqid().'_'.$_FILES["img"]["name"]));
    $tamanhoArquivo = $_FILES["img"]["size"];
    $nomeTemporario = $_FILES["img"]["tmp_name"];
    $nomeTipo = $_FILES["img"]["type"];
  
    $arq_new = '../images/eventos/'.$nomeArquivo;
    move_uploaded_file($nomeTemporario, ($arq_new));
      
    $sel = $db->select("INSERT INTO img_eventos (img, evento) VALUES ('$nomeArquivo', '$id')");
    echo '<script>$("#sucesso_user").show();</script>';
      

//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS 
} else if(isset($_GET['action']) && $_GET['action']==2){
  
  $x=1;
  
  $sel2 = $db->select("SELECT * FROM img_eventos WHERE id='$id' LIMIT 1");
  $ln2 = $db->expand($sel2);
  
//FAZ A exclusao NO BANCO DE DADOS    
} else if(isset($_GET['action']) && $_GET['action']==3){
  
  $sel = $db->select("DELETE FROM img_eventos WHERE id='$id_foto' LIMIT 1");
  echo '<script>$("#sucesso_user").show();</script>';
  
  
//FAZ A ALTERAÇAO NO BANCO DE DADOS   
} else if(isset($_GET['action']) && $_GET['action']==4){
  
    
    $nomeArquivo = trim(strtolower($_FILES["img"]["name"]));
    $tamanhoArquivo = $_FILES["img"]["size"];
    $nomeTemporario = $_FILES["img"]["tmp_name"];
    $nomeTipo = $_FILES["img"]["type"];
  
    if(!empty($nomeArquivo)){
      $arq_new = '../assets/projetos/'.$nomeArquivo;
      move_uploaded_file($nomeTemporario, ($arq_new));
      $sel = $db->select("UPDATE funcionarios SET nome='$nome', funcao='$funcao', face='$face', twitter = '$twitter' , link='$link' , img='$nomeArquivo' WHERE id='$id' LIMIT 1");  
    } else {
      $sel = $db->select("UPDATE funcionarios SET nome='$nome', funcao='$funcao', face='$face', twitter = '$twitter' , link='$link' WHERE id='$id' LIMIT 1");  
    }
    
      
    echo '<script>$("#sucesso_user").show();</script>';
      
  
}

  $sel2 = $db->select("SELECT * FROM blog WHERE id='$id' LIMIT 1");
  $ln2 = $db->expand($sel2);

?>



<div class="panel panel-primary">

  <div class="panel-heading">
    <h4 class="panel-title"><h4>Cadastro de Imagens do Evento: <?php echo $ln2['titulo']; ?></h4></h4>
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
    
      	
        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Imagem do evento <small> (770x550)</small><span style="color: red;"> **</span> </label>
                <input type="file" class="form-control" name="img" <?php if($x==0){ echo 'required="required"';} ?> />
                <input type="hidden" name="id" value="<?php echo $id; ?>" >
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
						<h4 class="panel-title">Fotos Cadastradas:</h4>
					</div>
								
				
				<ul class="list-group">
									
					<?php
						$arq = $db->select("SELECT * FROM img_eventos WHERE evento='$id' ORDER BY id DESC");
							if($db->rows($arq)){
								while($jj = $db->expand($arq)){
								
										echo'
											
											<li class="list-group-item">
												<img src="../images/eventos/'.$jj['img'].'" width="200" height="140"/>&nbsp;<a href="?action=3&id_foto='.$jj['id'].'&id='.$id.'">[EXCLUIR]</a>			
											</li>
										';
						
							
							}
							
							
							echo '<li class="list-group-item">
										<a href="eventos.php"><button type="button" class="btn btn-warning">VOLTAR</button></a>
									</li>';
								
						} else {
								
							echo '
							<li class="list-group-item">NENHUMA FOTO ENCONTRADA.</li>';
							
									
						}
					
					?>
					
				
				</ul>     
											
					  
				</div>   
</div> 



                     


<?php include("includes/rodape.php"); ?>