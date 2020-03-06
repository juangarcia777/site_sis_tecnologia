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
	
		$arq_new = '../images/teacher/'.$nomeArquivo;
		move_uploaded_file($nomeTemporario, ($arq_new));

		
		$sel = $db->select("INSERT INTO professores (img, nome, materia, whats, face, insta, link, email ) VALUES ('$nomeArquivo', '$nome', '$materia', '$whats', '$face', '$insta', '$link', '$email'  )");
		echo '<script>$("#sucesso_user").show();</script>';
			

//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS	
} else if(isset($_GET['action']) && $_GET['action']==2){
	
	$x=1;
	
	$sel = $db->select("SELECT * FROM professores WHERE id='$id' LIMIT 1");
	$ln = $db->expand($sel);
	
	$img = $ln['img'];
	$nome = $ln['nome'];
	$materia = $ln['materia'];
	$whats = $ln['whats'];
	$face = $ln['face'];
	$insta = $ln['insta'];
	$link = $ln['link'];
	$email = $ln['email'];
	
	
//FAZ A exclusao NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM professores WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
	
//FAZ A ALTERAÇAO NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==4){
	

		require('class/class.upload.php');
		$Images = new UploadArquivoSis();
	
		//PASSA OS PARAMETROS - PASTA DE UPLOAD, NOME DO CAMPO INPUT, LARGURA/ALTURA MÁXIMA PARA FOTOS
		$arquivo = $Images->Upload('../images/teacher','img',1024);

		if(!empty($arquivo)){
			$sel = $db->select("UPDATE professores SET img='$arquivo' WHERE id='$id' LIMIT 1");	
			echo '<script>$("#sucesso_user").show();</script>';
		}
			
			$sel = $db->select("UPDATE professores SET nome='$nome', materia='$materia', whats='$whats', face='$face', insta='$insta', link='$insta', email='$email'  WHERE id='$id' LIMIT 1");	
			
		echo '<script>$("#sucesso_user").show();</script>';
			
}
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cadastro de Professores</h4></h4>
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
                <label for="exampleInputEmail1">Nome <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="nome" required="required" value="<?php if($x==1){ echo $nome;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Matéria <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="materia" required="required" value="<?php if($x==1){ echo $materia;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Whats</label>
                <input type="text" class="form-control" name="whats" value="<?php if($x==1){ echo $whats;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Facebook</label>
                 <input type="text" class="form-control" name="face" value="<?php if($x==1){ echo $face;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Instagram</label>
                 <input type="text" class="form-control" name="insta" value="<?php if($x==1){ echo $insta;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Linkedin</label>
                 <input type="text" class="form-control" name="link" value="<?php if($x==1){ echo $link;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">E-mail <span style="color: red;"> **</span></label>
                 <input type="text" class="form-control" name="email" value="<?php if($x==1){ echo $email;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Imagem <small> (682x1024)</small>  <span style="color: red;"> **</span></label>
                <input type="file" class="form-control" name="img" <?php if($x!=1){ echo 'required="required"';} ?> />
  
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
		<h4 class="panel-title"><h4>Professores Cadastrados</h4></h4>
	</div>
				

<ul class="list-group">
					
	<?php
		$hoje=date("Y-m-d");
		$db = new DB();    
		$sel = $db->select("SELECT * FROM professores ORDER BY id DESC");
		if($db->rows($sel)){
			$x=1;	
			while($yy = $db->expand($sel)){
								
				echo'
					
					<li class="list-group-item">
						<a  data-toggle="collapse" style="text-transform:uppercase">'.$yy['nome'].' - '.$yy['materia'].'</a>				
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