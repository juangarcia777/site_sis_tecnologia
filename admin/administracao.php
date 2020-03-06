<?php include("includes/topo.php"); ?>


<div class="col-md-8">

  <div class="jumbotron">
    <h1>Olá, <?php echo $nome_usuario; ?></h1> 
    <p>Utilize a área administrativa para alterar/excluir ou cadastrar conteúdos.</p> 
  </div>
  
  <div class="alert alert-info">
  	<strong>Lembre-se: </strong>O site segue um padrão de SEO para rankeamento no Google e em buscadores. Antes de qualquer alteração converse com seu suporte.
  </div>
  
  <div class="alert alert-warning">
  	<strong>Atenção: </strong>As imagens devem ser tratadas e ajustadas para os tamanhos e formatos corretos antes de serem envidas ao site.
  </div>
    
  <div class="alert alert-danger">
  	<strong>Cuidado: </strong>Nunca dispare mailings através de sua conta de e-mail. Você poderá ser bloqueado ou classificado como SPAM.
  </div>
  
</div>

<form method="post" action="ajax/envia_contato.php" id="formAjuda">
<div class="col-md-4">

	<div class="panel panel-primary" >

        <div class="panel-heading">
            <h4 class="panel-title"><h4>Precisando de ajuda?</h4>
            <small>ENVIE-NOS SUA MENSAGEM<BR />A EQUIPE DE SUPORTE EM BREVE RESPONDERÁ!</small>
            </h4>
        </div>
    
		
        <div class="row">
		
            <div class="col-md-12">&nbsp;</div>
            
            <div class="col-md-12">
            
            	<div class="col-md-12">
                   <div class="form-group">
                        <label for="exampleInputEmail1">Seu nome</label>
                        <input type="text" class="form-control" value="<?php echo $nome_usuario ?>" name="nome_ajuda" id="nome_ajuda" required="required" />
                   </div>
                </div> 
            
                <div class="col-md-12">
                   <div class="form-group">
                        <label for="exampleInputEmail1">Assunto</label>
                        <input type="text" class="form-control" placeholder="Erro, Mudança, Ajuste" name="assunto_ajuda" id="assunto_ajuda" required="required" />
                   </div>
                </div>   
                
                
                <div class="col-md-12">
                   <div class="form-group">
                        <label for="exampleInputEmail1">Mensagem</label>
                        <textarea class="form-control" placeholder="Descreva o que precisa" name="mensagem_ajuda" id="mensagem_ajuda" required="required" style="height:150px"></textarea>
                   </div>
                </div> 
                
                                
                <hr>
                
                <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="btnenvio">ENVIAR</button>
                </div>   
                
                <div class="col-md-12">&nbsp;</div>
                 
           </div>
        
        </div> 
            
    
    
    </div>		 
         		
</div>      
</form>  


          
       

<?php include("includes/rodape.php"); ?>