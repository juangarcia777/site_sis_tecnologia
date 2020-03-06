<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   


<?php

$x=0;
$db = new DB();    
		

//FAZ A INSERÇAO NO BANCO DE DADOS
if(isset($_GET['action']) && $_GET['action']==1){
	
		
		$sel = $db->select("INSERT INTO prof_cursos (curso, professor) VALUES ('$curso_cad', '$professor_cad')");
		echo '<script>$("#sucesso_user").show();</script>';
			

//FAZ A PESQUISA PARA ALTERAÇAO NO BANCO DE DADOS	
} else if(isset($_GET['action']) && $_GET['action']==2){
	
	$x=1;
	
	$sel = $db->select("SELECT * FROM prof_cursos WHERE id='$id' LIMIT 1");
	$ln = $db->expand($sel);
	
	$curso_cad = $ln['curso'];
	$professor_cad = $ln['professor'];
	
	
//FAZ A exclusao NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==3){
	
	$sel = $db->select("DELETE FROM prof_cursos WHERE id='$id' LIMIT 1");
	echo '<script>$("#sucesso_user").show();</script>';
	
	
//FAZ A ALTERAÇAO NO BANCO DE DADOS		
} else if(isset($_GET['action']) && $_GET['action']==4){
	
			
			$sel = $db->select("UPDATE prof_cursos SET curso='$curso_cad', professor='$professor_cad' WHERE id='$id' LIMIT 1");	
			
		echo '<script>$("#sucesso_user").show();</script>';
			
}
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Cadastro de Professor/Ensino</h4></h4>
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
    

         <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Professor <span style="color: red;"> **</span></label>
                <select class="form-control" name="professor_cad" required="required">

                  <?php

                  if($x==1){

                    
                    $sel6 = $db->select("SELECT * FROM professores WHERE id = '$professor_cad' LIMIT 1");

                    $ff = $db->expand($sel6);
                   
                      echo '<option selected value="'.$ff['id'].'">'.$ff['nome'].'</option>';

                    }

    
                      $sel2 = $db->select("SELECT * FROM professores ORDER BY id DESC");

                      if($db->rows($sel2)){
                        
                        while($zz = $db->expand($sel2)){
                            	 
                               echo '<option value="'.$zz['id'].'">'.$zz['nome'].'</option>';
                          }
                        }

                  ?>

                </select>					
                </select>
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Curso/Ensino <span style="color: red;"> **</span></label>
                <select class="form-control" name="curso_cad" required="required">
                  
                  <?php

                  if($x==1){

                    $db = new DB(); 

                    $sel7 = $db->select("SELECT * FROM cursos WHERE id = '$curso_cad' LIMIT 1");

                    $hh = $db->expand($sel7);
                   
                      echo '<option selected value="'.$hh['id'].'">'.$hh['titulo'].'</option>';

                  }

                      $db = new DB();    
                      $sel3 = $db->select("SELECT * FROM cursos ORDER BY id DESC");

                      if($db->rows($sel3)){
                        
                        while($aa = $db->expand($sel3)){
                               
                               echo '<option value="'.$aa['id'].'">'.$aa['titulo'].'</option>';
                          }
                        }

                  ?>

                </select>         
                </select>
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
		<h4 class="panel-title"><h4>Professores/Ensino Cadastrados</h4></h4>
	</div>
				

<ul class="list-group">
					
	<?php
		$hoje=date("Y-m-d");
		$db = new DB();    
		$sel = $db->select("SELECT * FROM prof_cursos ORDER BY id DESC");
		if($db->rows($sel)){
			$x=1;	
			while($yy = $db->expand($sel)){

        $professor = $yy['professor'] ;
        $curso = $yy['curso'] ;

         $sel4 = $db->select("SELECT * FROM professores WHERE id = '$professor' ORDER BY id DESC");

         $cc = $db->expand($sel4);

         $sel5 = $db->select("SELECT * FROM cursos WHERE id = '$curso' ORDER BY id DESC");

         $dd = $db->expand($sel5);


								
				echo'
					
					<li class="list-group-item">
						<a  data-toggle="collapse" style="text-transform:uppercase">'.$cc['nome'].' - '.$dd['titulo'].'</a>				
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