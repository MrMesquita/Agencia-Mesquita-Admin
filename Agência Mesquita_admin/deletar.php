<?php
	if(isset($_POST['id_membro'])){
	include('Mysql.php');
	$sql = $pdo->prepare("DELETE FROM `tb_equipe` WHERE id = ?");
	$sql->execute(array($_POST['id_membro']));
	}
?>