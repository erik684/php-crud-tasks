<?php //FUNÇÃO QUE VERIFICA LOGIN

if (isset($_POST['btn_login'])) { //se botão btn_login for pressionado, é efetuado a tentativa de login

	include_once("includes/conexao_bd.php");

	$email = $_POST['email_input'];
	$senha = $_POST['pwd_input'];
		
	$sql = "SELECT * FROM login_task WHERE email = '$email' AND senha = '$senha'";
	$result = mysqli_query($dbconnection, $sql);

	$row = mysqli_fetch_assoc($result);

	if (empty($row)) { //se usuário não existir	no banco
		header('Location: '.$_SERVER['PHP_SELF'].'?&login=erro');
		exit;
	}
	else { // se usuário existir no banco
		header('Location: '.$_SERVER['PHP_SELF'].'?&login=sucesso');
		$_SESSION['login_task'] = $row['email'];
		exit;			
	}
}

if (isset($_POST['btn_register'])) {

	include_once("includes/conexao_bd.php");

	$email = $_POST['emailReg_input'];
	$senha = $_POST['pwdReg_input'];

	$sql = "SELECT * FROM login_task WHERE email = '$email' AND senha = '$senha'";
	$result = mysqli_query($dbconnection, $sql);
	$row = mysqli_fetch_assoc($result);

	if (empty($row)) { //se usuário não existir no banco
		$sql ="INSERT INTO login_task (email, senha) VALUES ('$email', '$senha')";
		$result = mysqli_query($dbconnection, $sql);
		header('Location: '.$_SERVER['PHP_SELF'].'?&loginreg=sucesso');
		exit;
	}
	else { // se usuário existir no banco
		header('Location: '.$_SERVER['PHP_SELF'].'?&loginreg=erro');		
		exit;			
	}	
}

if (isset($_POST['btn_sair'])) { //se botão btn_logout for pressionado, é efetuado a saida do usuario
	session_destroy();
	header('Location: '.$_SERVER['PHP_SELF']);
	exit;
}
?>
