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
	
		$arq_new = '../images/livros/'.$nomeArquivo;
		move_uploaded_file($nomeTemporario, ($arq_new));

		if(!empty($pdf)){
			$pdf = trim(strtolower(uniqid().'_'.$_FILES["pdf"]["name"]));
			$pdf = $_FILES["pdf"]["size"];
			$pdf = $_FILES["pdf"]["tmp_name"];
			$nomeTipo2 = $_FILES["pdf"]["type"];
	
			$arq_new = '../arquivos/'.$pdf;
			move_uploaded_file($nomeTemporario2, ($arq_new));
		}

		
		$sel = $db->select("INSERT INTO acervo (img, pdf, titulo, texto, sub_titulo, link, letra, assunto, disciplina ) VALUES ('$nomeArquivo', '$pdf', '$titulo', '$texto', '$sub_titulo', '$link', '$letra', '$assunto', '$disciplina'  )");
		echo '<script>$("#sucesso_user").show();</script>';
			

//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS	
} else if(isset($_GET['action']) && $_GET['action']==2){
	
	$x=1;
	
	$sel = $db->select("SELECT * FROM acervo WHERE id='$id' LIMIT 1");
	$ln = $db->expand($sel);
	
	$img = $ln['img'];
	$titulo = $ln['titulo'];
	$texto = $ln['texto'];
	$sub_titulo = $ln['sub_titulo'];
	$link = $ln['link'];
	$letra = $ln['letra'];
	$assunto = $ln['assunto'];
	$disciplina = $ln['disciplina'];
	$pdf = $ln['pdf'];
	
	
//FAZ A exclusao NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM acervo WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
	
//FAZ A ALTERAÇAO NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==4){
	

		require('class/class.upload.php');
		$Images = new UploadArquivoSis();
	
		//PASSA OS PARAMETROS - PASTA DE UPLOAD, NOME DO CAMPO INPUT, LARGURA/ALTURA MÁXIMA PARA FOTOS
		$arquivo = $Images->Upload('../images/livros','img',1024);

		$pdf = $Images->Upload('../arquivos','pdf',0);

		if(!empty($arquivo)){
			$sel = $db->select("UPDATE acervo SET img='$arquivo' WHERE id='$id' LIMIT 1");	
			echo '<script>$("#sucesso_user").show();</script>';
		}if(!empty($pdf)){
			$sel = $db->select("UPDATE acervo SET pdf='$pdf' WHERE id='$id' LIMIT 1");	
			echo '<script>$("#sucesso_user").show();</script>';
		}
			
			$sel = $db->select("UPDATE acervo SET titulo='$titulo', texto='$texto', sub_titulo='$sub_titulo', link='$link', letra='$letra', assunto='$assunto', disciplina='$disciplina'  WHERE id='$id' LIMIT 1");	
			
		echo '<script>$("#sucesso_user").show();</script>';
			
}
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cadastro de Acervos</h4></h4>
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
                <label for="exampleInputEmail1">Link</label>
                <input type="text" class="form-control" name="link" value="<?php if($x==1){ echo $link;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Letra <span style="color: red;"> **</span></label>
                <select class="form-control" name="letra" required="required">
                	
                	<?php if($x==1){

                    if($ln['letra'] == 'a'){
                      echo '<option selected value="a">A</option>';
                    }if($ln['letra'] == 'b'){
                      echo '<option value="b">B</option>';
                    }if($ln['letra'] == 'c'){
                      echo '<option value="c">C</option>';
                    }if($ln['letra'] == 'd'){
                      echo '<option value="d">D</option>';
                    }if($ln['letra'] == 'e'){
                      echo '<option value="e">E</option>';
                    }if($ln['letra'] == 'f'){
                      echo '<option value="f">F</option>';
                    }if($ln['letra'] == 'g'){
                      echo '<option value="g">G</option>';
                    }if($ln['letra'] == 'h'){
                      echo '<option value="h">H</option>';
                    }if($ln['letra'] == 'i'){
                      echo '<option value="i">I</option>';
                    }if($ln['letra'] == 'j'){
                      echo '<option value="j">J</option>';
                    }if($ln['letra'] == 'k'){
                      echo '<option value="k">K</option>';
                    }if($ln['letra'] == 'l'){
                      echo '<option value="l">L</option>';
                    }if($ln['letra'] == 'm'){
                      echo '<option value="m">M</option>';
                    }if($ln['letra'] == 'n'){
                      echo '<option value="n">N</option>';
                    }if($ln['letra'] == 'o'){
                      echo '<option value="o">O</option>';
                    }if($ln['letra'] == 'p'){
                      echo '<option value="p">P</option>';
                    }if($ln['letra'] == 'q'){
                      echo '<option value="q">Q</option>';
                    }if($ln['letra'] == 'r'){
                      echo '<option value="r">R</option>';
                    }if($ln['letra'] == 's'){
                      echo '<option value="s">S</option>';
                    }if($ln['letra'] == 't'){
                      echo '<option value="t">T</option>';
                    }if($ln['letra'] == 't'){
                      echo '<option value="u">U</option>';
                    }if($ln['letra'] == 'u'){
                      echo '<option value="u">U</option>';
                    }if($ln['letra'] == 'v'){
                      echo '<option value="v">V</option>';
                    }if($ln['letra'] == 'x'){
                      echo '<option value="x">X</option>';
                    }if($ln['letra'] == 'y'){
                      echo '<option value="y">Y</option>';
                    }if($ln['letra'] == 'y'){
                      echo '<option value="z">Z</option>';
                    }

                  } ?>


                  <option>Selecione</option>
                	<option value="a">A</option>
                	<option value="b">B</option>
                	<option value="c">C</option>
                	<option value="d">D</option>
                	<option value="e">E</option>
                	<option value="f">F</option>
                	<option value="g">G</option>
                	<option value="h">H</option>
                	<option value="i">I</option>
                	<option value="j">J</option>
                	<option value="k">K</option>
                	<option value="l">L</option>
                	<option value="m">M</option>
                	<option value="n">N</option>
                	<option value="o">O</option>
                	<option value="p">P</option>
                	<option value="q">Q</option>
                	<option value="r">R</option>
                	<option value="s">S</option>
                	<option value="t">T</option>
                	<option value="u">U</option>
                	<option value="v">V</option>
                	<option value="x">X</option>
                	<option value="y">Y</option>
                	<option value="z">Z</option>
                </select>					
                </select>
           </div>
        </div> 

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Assunto <span style="color: red;"> **</span></label>
                 <input type="text" class="form-control" name="assunto" value="<?php if($x==1){ echo $assunto;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Disciplina <span style="color: red;"> **</span></label>
                 <input type="text" class="form-control" name="disciplina" value="<?php if($x==1){ echo $disciplina;} ?>"/>
  
           </div>
        </div>

         <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Pdf <span style="color: red;"> **</span></label>
                <input type="file" class="form-control" name="pdf" />
  
           </div>
        </div>


        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Sub Título</label>
                <input type="text" class="form-control" name="sub_titulo" required="required" value="<?php if($x==1){ echo $sub_titulo;} ?>"/>
  
           </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Texto <span style="color: red;"> **</span></label>
                <textarea rows="8" class="form-html" name="texto"  ><?php if($x==1){ echo $texto;} ?></textarea>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Imagem <span style="color: red;"> **</span></label>
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
		$sel = $db->select("SELECT * FROM acervo ORDER BY id DESC");
		if($db->rows($sel)){
			$x=1;	
			while($yy = $db->expand($sel)){
								
				echo'
					
					<li class="list-group-item">
						<a  data-toggle="collapse" style="text-transform:uppercase">'.$yy['titulo'].' - '.$yy['disciplina'].'</a>				
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