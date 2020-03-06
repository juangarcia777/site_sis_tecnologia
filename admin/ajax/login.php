<?php header("Content-Type: text/html; charset=iso-8859-1");?>
<?php include("../../class/class.db.php"); ?>
<?php include("../class/class.seguranca.php"); ?>


<?php
@session_start();
$db = new DB();    
$sel = $db->select("SELECT id FROM config WHERE user='$usuario' AND senha='$senha' LIMIT 1");
if($db->rows($sel)){
	$line = $db->expand($sel);
	$_SESSION['user_sisconnection_adm_site']=$line['id'];
	echo 1;	
} else {
	echo 0;
}


?>