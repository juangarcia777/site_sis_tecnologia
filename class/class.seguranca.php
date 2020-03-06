<?php
ob_start();
@session_start();
session_cache_expire(180000); 
date_default_timezone_set('America/Sao_Paulo');


$db = new DB();
foreach($_POST as $nome_campo => $valor){	
		$valor =$db->escape(addslashes($valor));			
		$comando = "$" . $nome_campo . '="' . $valor . '";';
		eval($comando);		
}

//Recebe as variaveis do GET - PERMITINDO APENAS NUMEROS
	foreach($_GET as $nome_campo => $valor){	
		$comando = "\$" . $nome_campo . "='" . $valor . "';";
		eval($comando);
	}


function valores($valor){
	return number_format($valor,2,",",".")	;	
	
}


function aplica_desconto($val,$desconto){
	$desconto = (($val*$desconto)/100);
	$val = ($val-$desconto);
	return $val;
}

function data_mysql_para_user($y){
	if ($y != ''){
		$data_inverter = explode("-",$y);
		$x = $data_inverter[2].'/'. $data_inverter[1].'/'. $data_inverter[0];
		return $x;
	}else{
		return '';
}
}


function data_user_para_mysql($y){
	if ($y != ''){
		$data_inverter = explode("/",$y);
		$x = $data_inverter[2].'-'. $data_inverter[1].'-'. $data_inverter[0];
		return $x;
	}else{
		return '';
}
}



function envia_email($email,$mensagem){
				
	$mail = new PHPMailer;	
	$mail->SMTPDebug =0;                 	
	$mail->isSMTP();                    
	$mail->Host = 'srv74.prodns.com.br';  
	$mail->SMTPAuth = true;                             
	$mail->Username = 'site@serradefitas.com.br';
	$mail->Password = 'n.z}HiT4qxXR';                      
	$mail->SMTPSecure = 'tls';                         
	$mail->Port = 587;                                 
	
	$mail->setFrom('site@serradefitas.com.br', 'SITE SERRA FITAS');
	$mail->addAddress($email);     
	$mail->addReplyTo('serrafita@serrafita.com.br', 'SERRA FITAS');
	
	$mail->isHTML(true);                              
	
	$mail->Subject = 'CONTATO ENVIADO PELO SITE';
	$mail->Body    = $mensagem;
	
	if(!$mail->send()) {
			//echo 'Mailer Error: ' . $mail->ErrorInfo;
			return 0;
	} else {
			return 1;
	}
				
}

function normaliza($str){
	
	
	$str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = preg_replace('/[,(),;:|!"#$%&=?~^><ªº-]/', '-', $str);
    $str = preg_replace('/[^a-z0-9]/i', '-', $str);
    $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)
	$str = strtolower($str);
		
	$string = $str.'.html';		
		
	
	
	
	return $string; //finaliza, gerando uma saída para a funcao
	}
	
	
	
	function Mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    echo $mask;

}
	
?>