<?php 
	$dbconnection = mysqli_connect("localhost", "root", "", "tasks_bd"); 
	//endereco_servidor , usuario, senha, nome_banco

	if (!$dbconnection) {
		header("Location: ./index.php?conexao=erro");
	}
?>