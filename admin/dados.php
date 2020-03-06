<?php include("includes/topo.php"); ?>

<div class="alert alert-success" id="sucesso_user" style="display:none">
  <strong>Sucesso!</strong> Informações salvas/alteradas com sucesso.
</div>   

<?php

$x=0;
$db = new DB();    



		
if(isset($_GET['action']) && $_GET['action']==1){

   $sel = $db->select("UPDATE config SET  telefone='$telefone', whats='$whats', email='$email', ende='$ende', youtube='$youtube', face='$face', insta='$insta', linkedin='$linkedin', num1='$num1', num2='$num2', num3='$num3', num4='$num4'  ");

   
	
	echo '<script>$("#sucesso_user").show();</script>';
			
	
}



$sel = $db->select("SELECT * FROM config LIMIT 1");
$ln = $db->expand($sel);
?>

<div class="panel panel-primary">

	<div class="panel-heading">
		<h4 class="panel-title"><h4>Texto sobre o Colégio</h4></h4>
	</div>
				

<form method="post" action="?action=1" enctype="multipart/form-data">
<div class="row">

	<div class="col-md-12">&nbsp;</div>
	
    <div class="col-md-12">

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Telefone Fixo <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="telefone" required="required" value="<?php echo $ln['telefone']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">Whats <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="whats" required="required" value="<?php echo $ln['whats']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-4">
           <div class="form-group">
                <label for="exampleInputEmail1">E-mail <span style="color: red;"> **</span></label>
                <input type="email" class="form-control" name="email" required="required" value="<?php echo $ln['email']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-12">
           <div class="form-group">
                <label for="exampleInputEmail1">Endereço completo <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="ende" required="required" value="<?php echo $ln['ende']; ?>"/>
  
           </div>
        </div>


        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Youtube:</label>
                <input type="text" class="form-control" name="youtube" required="required" value="<?php echo $ln['youtube']; ?>"/>
  
           </div>
        </div>


        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Facebook: <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="face" required="required" value="<?php echo $ln['face']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Instagram <span style="color: red;"> **</span></label>
                <input type="text" class="form-control" name="insta" required="required" value="<?php echo $ln['insta']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-6">
           <div class="form-group">
                <label for="exampleInputEmail1">Linkedin</label>
                <input type="text" class="form-control" name="linkedin" required="required" value="<?php echo $ln['linkedin']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-3">
           <div class="form-group">
                <label for="exampleInputEmail1">Anos de Esperiência</label>
                <input type="text" class="form-control" name="num1" required="required" value="<?php echo $ln['num1']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-3">
           <div class="form-group">
                <label for="exampleInputEmail1">Professores</label>
                <input type="text" class="form-control" name="num2" required="required" value="<?php echo $ln['num2']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-3">
           <div class="form-group">
                <label for="exampleInputEmail1">Alunos</label>
                <input type="text" class="form-control" name="num3" required="required" value="<?php echo $ln['num3']; ?>"/>
  
           </div>
        </div>

        <div class="col-md-3">
           <div class="form-group">
                <label for="exampleInputEmail1">Satisfação</label>
                <input type="text" class="form-control" name="num4" required="required" value="<?php echo $ln['num4']; ?>"/>
  
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