
function loga(){
		
	   $("#erro").hide();
	   $("#sucesso").hide();
	   usuario = $("#usuario").val();	      	   	   	   
	   senha = $("#senha").val();
	   
	   
	   if(usuario==''){
			$("#usuario").css('background-color','#FCF8E3');
			$("#usuario").focus();
			return;   
	   }
	   
	   if(senha==''){
			$("#senha").css('background-color','#FCF8E3');
			$("#senha").focus();
			return;   
	   }
	   
	   $("#btn").html('VERIFICANDO...');
	   
	   $.post("ajax/login.php",{usuario:usuario, senha:senha},function(resposta){	

	   	
			if(resposta==1){
				window.location.href = 'administracao.php';						
			} else {
				$("#erro").show();
				$("#btn").html('ACESSAR');					
			}
		});
			
			
			
	

}


function logout(){
		
		window.location.href = 'index.php?logout=1';			
		
}