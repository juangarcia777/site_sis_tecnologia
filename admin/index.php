<?php
ob_start();
@session_start();
if(isset($_GET['logout'])){
	@session_start();			
	@session_destroy();
} else if(isset($_SESSION['user_sisconnection_adm'])){
	header("Location: administracao.php");		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ÁREA ADMINISTRATIVA | SIS</title>

<link rel="stylesheet" href="css/bootstrap.css" >
<link rel="stylesheet" href="css/login.css" >
<link rel="shortcut icon" href="../assets/favicon.ico">

<script src='jquery/jquery.min.js'></script>
<script src='jquery/funcoes.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>




<div class="container">

		<div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">&nbsp;</div>

      <form class="form-signin">
        <br /><br /><br /><br />
       <center> <img src="../images/logo/sis_logo_fundo_azul.png" class="img-responsive"  />
       </center><br />
        

        <input type="email" id="usuario" class="form-control" placeholder="Usuário" required autofocus>
        <input type="password" id="senha" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="btn" onclick="javascript:loga();">ACESSAR</button>
      </form>

</div> <!-- /container -->


	<div class="col-md-3"></div>
    <div class="col-md-6">
    	<div class="alert alert-danger" id="erro" style="display:none"><strong>Erro:</strong> Usu&aacute;rio ou senha inv&aacute;lidos. Tente novamente.</div>
        <?php
			if(isset($_GET['logout'])){			
				echo '<div class="alert alert-success" id="sucesso" ><strong>OK:</strong> Logout efetuado com sucesso!</div>';		
			}
		?>
        
    </div>
    <div class="col-md-3"></div>
    
    


<nav role="navigation" class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid">
         <div class="col-md-12 text-right" style="margin-top:12px">
    		Desenvolvido por: <a href="http://www.sisconnection.com.br/">SisConnection</a>
       </div>
       
    </div>
</nav>


<script>
$(document).ready(function(){   // incial o jquery
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
		loga();	
    }
});
	
});
</script>  

</body>
</html>