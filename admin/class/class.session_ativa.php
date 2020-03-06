<?php
ob_start();		
	  
	   @session_start();	
	   if(!isset($_SESSION['user_sisconnection_adm_site'])){
		   header("Location: index.php");								   
		   
	   } else {
		   
		  $id_usuario_logado = $_SESSION['user_sisconnection_adm_site'];		  
		  	
		$db = new DB();			
		   $sel = $db->select("SELECT * FROM config WHERE id='$id_usuario_logado' LIMIT 1");
		   $line = $db->expand($sel);
		   
		   
		   $nome_usuario = $line['user'];
		   $email_usuario = '';
		
		  
	   }
	   
	   
	   

	   
?>