<?php header("Content-Type: text/html; charset=iso-8859-1");?>
<?php include("../../class/class.db.php"); ?>
<?php include("../../class/class.seguranca.php"); ?>

<?php
$db = new DB();

	$pesq_linha = $db->select("SELECT * FROM categorias_catalogos2 WHERE id_linha_principal='$id' ORDER BY titulo");
	if($db->rows($pesq_linha)){
		
		echo '<option value="0">Escolha a subcategoria</option>';
		while($line = $db->expand($pesq_linha)){
		
			echo '<option value="'.$line['titulo'].'">'.$line['titulo'].'</option>';
			
		}
	} else {
		
		echo '<option value="0">Nenhuma subcategoria encontrada.</option>';
		
	}

?>
    