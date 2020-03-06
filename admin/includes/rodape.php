 </div> 

	</div>
	

</div> 




<script>
$('#formAjuda').on('submit', function(){
	var $form = $(this);
	var $data  = $form.serialize();
	$("#btnenvio").html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true"></i> ENVIANDO...');
	
	
	$.ajax({type: "POST", url:$("#formAjuda").attr('action'), data:$data, success: function(msg){					
		$('#myModal').modal();
		$("#btnenvio").html('ENVIAR');
		$("#assunto_ajuda").val('');
		$("#mensagem_ajuda").val('');
				
	}});
	
	
    return false;
});
</script>	


	


</body>
</html>