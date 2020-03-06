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
	
	if($_SESSION['language-c4']=='br'){
		return number_format($valor,2,",",".")	;		
	} else {
		return number_format($valor,2,".",",")	;	
	}
	
	
	
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


function limita_texto($texto,$tamanho=200){
	
	$texto = strip_tags($texto);
	$texto = substr($texto,0,$tamanho).'...';	
	return $texto;				
	
}


function envia_email($assunto,$mensagem){
				
	$mail = new PHPMailer;	
	$mail->SMTPDebug =0;                 	
	//$mail->isSMTP();                    
	$mail->CharSet = 'UTF-8';
	$mail->Host = "srv74.prodns.com.br";
	$mail->Username = 'site@lpxtecnologia.com.br';
	$mail->Password = "a1b2c3d4";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->setFrom('site@lpxtecnologia.com.br', 'LPX Tecenologia');
	
	$mail->addAddress('contato@lpxtecnologia.com.br', 'LPX Tecnologia');
	$mail->addAddress('comercial@lpxtecnologia.com.br', 'LPX Tecnologia');
	$mail->addAddress('erico@lpxtecnologia.com.br', 'LPX Tecnologia');

	
	$mail->isHTML(true);                              
	
	$mail->Subject = $assunto;
	$mail->Body    = $mensagem;
	$mail->send();
				
}

function normaliza2($str){
	
	
	$str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = preg_replace('/[,(),;:|!"#$%&=?~^><ªº-]/', '-', $str);
    $str = preg_replace('/[^a-z0-9]/i', '-', $str);
    $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)
	$str = str_replace('<br>','', $str); // ideia do Bacco :)
	$str = strip_tags($str);
	$str = strtolower($str);
		
	$string = $str.'.html';		
		
	
	
	
	return $string; //finaliza, gerando uma saída para a funcao
}

function pega_mes($mes){

	if($mes==01){return 'Jan';}
	if($mes==02){return 'Fev';}
	if($mes==03){return 'Mar';}
	if($mes==04){return 'Abr';}
	if($mes==05){return 'Mai';}
	if($mes==06){return 'Jun';}
	if($mes==07){return 'Jul';}
	if($mes==08){return 'Ago';}
	if($mes==09){return 'Set';}
	if($mes==10){return 'Out';}
	if($mes==11){return 'Nov';}
	if($mes==12){return 'Dez';}
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
	$str = str_replace('<br>','', $str); // ideia do Bacco :)
	$str = strip_tags($str);
	$str = strtolower($str);
		
	$string = $str.'.html';		
		
	
	
	
	echo $string; //finaliza, gerando uma saída para a funcao
}
	
	
	
	function Mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    echo $mask;

}
	
?>