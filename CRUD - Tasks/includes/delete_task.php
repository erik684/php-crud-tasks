<?php 
include_once("conexao_bd.php");

$codigo = $_POST['codigo'];

$sql = "DELETE FROM tasks WHERE codigo_task = $codigo";

$result = mysqli_query($dbconnection, $sql);
header("Location: ../index.php?taskdelete=sucesso");


?>