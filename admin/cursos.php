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
	
		$arq_new = '../images/index/'.$nomeArquivo;
		move_uploaded_file($nomeTemporario, ($arq_new));

		
		$sel = $db->select("INSERT INTO cursos (img, titulo, periodo, alunos, horario, preco, duracao, cordenador, sub_desc, categoria, autorizacao, descricao, inicio, ensino ) VALUES ('$nomeArquivo', '$titulo', '$periodo', '$alunos', '$horario', '$preco', '$duracao', '$cordenador', '$sub_desc', '$categoria', '$autorizacao', '$descricao', '$inicio', '$ensino' )");
		echo '<script>$("#sucesso_user").show();</script>';
			

//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS	
} else if(isset($_GET['action']) && $_GET['action']==2){
	
	$x=1;
	
	$sel = $db->select("SELECT * FROM cursos WHERE id='$id' LIMIT 1");
	$ln = $db->expand($sel);
	
	$img = $ln['img'];
	$titulo = $ln['titulo'];
	$periodo = $ln['periodo'];
	$alunos = $ln['alunos'];
	$horario = $ln['horario'];
	$preco = $ln['preco'];
	$duracao = $ln['duracao'];
	$cordenador = $ln['cordenador'];
	$sub_desc = $ln['sub_desc'];
	$categoria = $ln['categoria'];
	$autorizacao = $ln['autorizacao'];
	$descricao = $ln['descricao'];
	$ensino = $ln['ensino'];
	
	
//FAZ A exclusao NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM cursos WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
	
//FAZ A ALTERAÇAO NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==4){
	

		require('class/class.upload.php');
		$Images = new UploadArquivoSis();
	
		//PASSA OS PARAMETROS - PASTA DE UPLOAD, NOME DO CAMPO INPUT, LARGURA/ALTURA MÁXIMA PARA FOTOS
		$arquivo = $Images->Upload('../images/index','img',1024);

		if(!empty($arquivo)){
			$sel = $db->select("UPDATE cursos SET img='$arquivo' WHERE id='$id' LIMIT 1");	
			echo '<script>$("#sucesso_user").show();</script>';
		}
			
			$sel = $db->select("UPDATE cursos SET titulo='$titulo', periodo='$periodo', alunos='$alunos', horario='$horario', preco='$preco', duracao='$duracao', cordenador='$cordenador', sub_desc='$sub_desc', categoria='$categoria', autorizacao='$autorizacao', descricao='$descricao', inicio='$inicio', ensino='$ensino'   WHERE id='$id' LIMIT 1");	
			
		echo '<script>$("#sucesso_user").show();</script>';
			
}
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cadastro de Cursos/Educação</h4></h4>
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
                <label for="exampleInputEmail1">Título <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="titulo" required="required" value="<?php if($x==1){ echo $titulo;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Periodo <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="periodo" required="required" value="<?php if($x==1){ echo $periodo;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Alunos</label>
                <input type="text" class="form-control" name="alunos" value="<?php if($x==1){ echo $alunos;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Horario</label>
                 <input type="text" class="form-control" name="horario" value="<?php if($x==1){ echo $horario;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Início</label>
                 <input type="text" class="form-control" name="inicio" value="<?php if($x==1){ echo $inicio;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Preco</label>
                 <input type="text" class="form-control" name="preco" value="<?php if($x==1){ echo $preco;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Duração</label>
                 <input type="text" class="form-control" name="duracao" value="<?php if($x==1){ echo $duracao;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Cordenador</label>
                 <input type="text" class="form-control" name="cordenador" value="<?php if($x==1){ echo $cordenador;} ?>"/>
  
           </div>
        </div>

        

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Categoria</label>
                 <input type="text" class="form-control" name="categoria" value="<?php if($x==1){ echo $categoria;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Autorizacao</label>
                 <input type="text" class="form-control" name="autorizacao" value="<?php if($x==1){ echo $autorizacao;} ?>"/>
  
           </div>
        </div>


         <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Tipo <span style="color: red;"> **</span></label>
                <select class="form-control" name="ensino" required="required">
                	
                	<?php if($x==1){

                    if($ln['inicio'] == 0){
                      echo '<option selected value="0">CURSO</option>';
                    }if($ln['inicio'] == 1){
                      echo '<option selected value="1">ENSINO</option>';
                    }

                  } ?>


                  <option>Selecione</option>
                	<option value="0">CURSO</option>
                	<option value="1">ENSINO</option>
                </select>					
                </select>
           </div>
        </div> 

        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Sub-desc</label>
                 <input type="text" class="form-control" name="sub_desc	" value="<?php if($x==1){ echo $sub_desc;} ?>"/>
  
           </div>
        </div>

         <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Texto <span style="color: red;"> **</span></label>
                <textarea rows="8" class="form-html" name="descricao"  ><?php if($x==1){ echo $descricao;} ?></textarea>
  
           </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Imagem curso <span style="color: red;"> *770x550*</span></label>
                <input type="file" class="form-control" name="img" <?php if($x!=1){ echo 'required="required"';} ?> />
  
           </div>
        </div>
       
        <hr>
        
        <div class="col-md-12">
        <button type="submit" class="btn btn-primary">SALVAR</button>
        </div>   
        
        <div class="col-md-12">&nbsp;</div>
           
   </div>
</form>
</div>                            
      
</div>    


<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cursos Cadastrados</h4></h4>
	</div>
				

<ul class="list-group">
					
	<?php
		$hoje=date("Y-m-d");
		$db = new DB();    
		$sel = $db->select("SELECT * FROM cursos ORDER BY id DESC");
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