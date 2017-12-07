<?php 
session_start();
include_once("includes/login_reg.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/custom.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>


 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Página Inicial</title>
 <!-- scripts aqui -->
</head>

<body>
<!-- CONTAINER PRINCIPAL -->
<div class="container">

<!-- ALERTAS BOOTSTRAP -->
<?php 
  $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 

  if (strpos($url, 'conexao=erro') !== false) {    
    echo '<div class="alert alert-success alert-danger text-center" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Erro ao conectar!</strong> Houve um erro ao se conectar no banco de dados.
            <p>Verifique o arquivo em includes/conexao_bd.php
          </div>';
  }

  if (strpos($url, 'login=sucesso') !== false) {    
    echo '<div class="alert alert-success alert-dismissable text-center" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Você entrou com sucesso!</strong> Bem Vindo <strong>'.$_SESSION['login_task'].'</strong>
          </div>';
  }
  if (strpos($url, 'login=erro') !== false) {     
    echo '<div class="alert alert-danger alert-dismissable text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Houve um erro ao efetuar login!</strong> Faça um cadastro ou verifique seu Email e Senha e tente novamente.
          </div>';
  } 

  if (strpos($url, 'loginreg=erro') !== false) {     
    echo '<div class="alert alert-danger alert-dismissable text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Houve um erro ao cadastrar! Usuário já existe</strong> Verifique seu Email e Senha e tente novamente.
          </div>';
  }  

  if (strpos($url, 'loginreg=sucesso') !== false) {    
    echo '<div class="alert alert-success alert-dismissable text-center" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Você se cadastrou com sucesso!</strong> Tente efetuar o login agora.
          </div>';
  }

  if (strpos($url, 'taskdelete=sucesso') !== false) {    
    echo '<div class="alert alert-warning alert-dismissable text-center" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Task</strong> deletada com sucesso!
          </div>';
  }

  if (strpos($url, 'task=erroext') !== false) {    
       echo '<div class="alert alert-dismissable alert-danger text-center" id="alert">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Erro! </strong> Houve um erro ao alterar ao cadastrar o Produto, verifique se o formato da imagem esta correto!.<br>
              <strong>Selecione uma imagem no formato: *.jpg; *.jpeg; *.gif; *.png</strong>
            </div>';
  }

  if (strpos($url, 'task=erro') !== false) {    
     echo '<div class="alert alert-success alert-danger text-center" id="alert">
            <strong>Erro! </strong> Houve um erro ao cadastrar o Produto, verifique se os dados estão corretos.
          </div>';
  }

  if (strpos($url, 'task=sucesso') !== false) {    
      echo '<div class="alert alert-success alert-dismissable text-center" id="alert">
              <strong>Registrado! </strong> Task foi registrada !
            </div>';
  }
  if (strpos($url, 'task=alterado') !== false) {    
      echo '<div class="alert alert-success alert-warning text-center" id="alert">
            <strong>Alterado! </strong> O Produto foi Alterado !
          </div>';
  } 

?>


<!-- NAVBAR -->
<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse rounded mr-0 mt-1 pb-auto pt-auto">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#/home">Página Inicial</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <?php 
      if (!isset($_SESSION['login_task'])) {
        echo 
        '<li class="nav-item active">
            <a class="nav-link" data-toggle="modal" data-target="#loginpopUpWindow" href="">Entrar</a>
          </li>';
      }

      else {
        echo '
        <li class="nav-item">
          <a class="nav-link">Você está logado como: <strong> '.$_SESSION["login_task"].'</strong></a>
        </li>        
        <li class="active li-navbar" href="">
          <form method="POST" action="">
            <button id="btn_sair" class="btn btn-danger mt-1 mb-1 btn-sair" name="btn_sair" type="submit">Sair</button>
          </form>
        </li>';         
      }
      ?>        
    </ul>
  </div>
</nav>

  <div class="jumbotron">
    <h1 class="text-center">CRUD - Tasks</h1><br>
    <p>Aplicação Web para cadastro de um <strong>CRUD </strong>de Tasks.</p>
    <p>Permite <strong>Cadastrar, Alterar, Consultar e Excluir</strong> dados de uma Task.</p>
    <p>É possivel efetuar um <strong>Cadastro</strong> e <strong>Login</strong> e também inserir uma imagem</p>
  </div>

<?php 
if (isset($_SESSION['login_task'])) {
?>
<hr class="divider">

<!-- TASKS VIEW CONTAINER -->
<div class="container">
  <div class="input-group">
    <button class="btn btn-success" data-toggle="modal" data-target="#addtaskPopupwindow"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Adicionar nova <strong>TASK</strong></button>
    <span class="input-group-addon ml-5"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="form-control col-sm-6 float-right" placeholder="Pesquisar por nome" maxlength="30">
    <button class="btn btn-primary">Pesquisar</button>
  </div>
</div>

<?php 
  include_once("includes/conexao_bd.php");
  $sql = "SELECT * FROM tasks";
  $result = mysqli_query($dbconnection, $sql);
  $row = mysqli_fetch_array($result);

  if (empty($row)) { //Se não existir tasks registradas
?>
  <div class="container style=""">
    <h2 class="text-center mt-4">Não há nenhuma task registrada!</h2><br>
    <p class="text-center"><strong>Insira uma nova Task clicando no botão acima!</strong></p>
  </div>
  <?php 
  } 
  else {    
  ?>
  <!-- TABELA DE TASKS -->
  <div class="container">
  <table class="table table-striped table-hover mt-2"> 
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Imagem</th>
        <th>Opções: <i class="text-muted small">(alterar/excluir)</i> </th>
      </tr>
    </thead>
    <tbody>

    <?php do { 
    ?>
      <tr>
        <td><?php echo $row['codigo_task'] ?></td>
        <td><?php echo $row['nome_task'] ?></td>
        <td><?php echo $row['desc_task'] ?></td>
        <td><img src=<?php echo $row['arq_task'] ?> width="80" height="80" class="rounded-circle"></td>
        <td>          
          <button class="btn btn-primary updateTask" data-toggle="modal" data-target="#altertaskPopupwindow"
            data-idtask='<?php echo $row['codigo_task'] ?>'
            data-nometask='<?php echo $row['nome_task'] ?>'
            data-desctask='<?php echo $row['desc_task'] ?>'
            data-imagem='<?php echo $row['arq_task'] ?>'>
            <span class="fa fa-pencil"></span>
          </button>

          <form method="POST" action="includes/delete_task.php">
            <input type="hidden" name="codigo" value=<?php echo $row['codigo_task'] ?>>
            <button class="btn btn-danger mt-1" type="submit"><span class="fa fa-times"></span></button>
          </form>
            
          
        </td>
      </tr>
    <?php } while ($row = mysqli_fetch_array($result)); ?>

    </tbody>
  </table>    
  </div>
<?php 

  } 
?>


<?php 
}
?>
<hr class="divider">

<!-- FOOTER -->
<footer class="footer stick-footer">  
  <span class="text-muted"><i>Erik Aleixo:</i> </span>    
  <a class="btn btn-link" href="https:\\www.github.com/erik684/php-login-consulta">https://github.com/erik684/</a>
</footer> 

<!-- FIM CONTAINER PRINCIPAL -->
</div>




<!-- CADASTRAR TASK MODAL -->
<div class="modal fade bd-modal-md" role="dialog" id="addtaskPopupwindow">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- modal-header -->
      <div class="modal-header">
        <legend>Insira os dados abaixo:</legend>
        <button type="button" class="close" data-dismiss="modal">&times;</button>     
      </div>

      <div class="modal-body">
        <!-- CADASTRAR TASK FORM -->
        <form class="form-horizontal" method="POST" id="form" action="includes/insert_task.php" enctype="multipart/form-data">

        <!-- NOME INPUT-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nomeTask_input">*Nome: </label>  
          <div class="col-md-8">
            <input id="nomeTask_input" name="nomeTask_input" type="text" placeholder="Digite um nome para a sua task! " class="form-control input-md" required="" maxlength="15">       
            <small class="form-text text-muted">Ex.: Reunião as 13:35 na sala 03</small>
          </div>  
        </div>      

        <!-- DESCRIÇÃO INPUT-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="desc_input">Descrição: </label>
          <div class="col-md-8">
            <textarea id="desc_input" name="desc_input" type="textarea" placeholder="Digite uma descrição para sua task! " class="form-control input-md" required="" maxlength="45" row="4" style="resize: none;width:250px"></textarea>        
          </div>
        </div>
        <!-- FILE INPUT -->
        <div class="form-group">
          <label class="col-md-6 control-label" for="imagem">Selecione uma imagem no formato: *.jpg; *.jpeg; *.gif; *.png </label>
          <div class="col-md-6">
            <input id="imagem" name="imagem" type="file" placeholder="Digite um nome para a sua task!" class="form-control-file file">       
          </div>          
        </div>
        <!-- BOTÃO FORM FORM-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="btn_taskreg"></label>
          <div class="col-md-4">                    
            <button id="btn_taskreg" name="btn_taskreg" class="btn btn-primary mb-1" type="submit">Adicionar</button>
          </div>
        </div> 
        </fieldset>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- ALTERAR TASK MODAL -->
<div class="modal fade bd-modal-md" role="dialog" id="altertaskPopupwindow">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- modal-header -->
      <div class="modal-header">
        <legend>Alterar os dados abaixo:</legend>
        <button type="button" class="close" data-dismiss="modal">&times;</button>     
      </div>

      <div class="modal-body">
        <!-- CADASTRAR TASK FORM -->
        <form class="form-horizontal" method="POST" id="form" action="includes/alter_task.php" enctype="multipart/form-data">

        <!-- ID INPUT SHOW DISABLED -->
         <div class="form-group">
          <label class="col-md-4 control-label" for="idtask">Id: </label>  
          <div class="col-md-2">
            <input id="idtask" name="idtask" type="number" class="form-control input-md" readonly>       
          </div>  
        </div>  

        <!-- NOME INPUT-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="nomeTask_alt">*Nome: </label>  
          <div class="col-md-8">
            <input id="nomeTask_alt" name="nomeTask_alt" type="text" placeholder="Digite um nome para a sua task! " class="form-control input-md" required="" maxlength="15">       
            <small class="form-text text-muted">Ex.: Reunião as 13:35 na sala 03</small>
          </div>  
        </div>      

        <!-- DESCRIÇÃO INPUT-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="descTask_alt">Descrição: </label>
          <div class="col-md-8">
            <textarea id="descTask_alt" name="descTask_alt" type="textarea" placeholder="Digite uma descrição para sua task! " class="form-control input-md" maxlength="45" row="4" style="resize: none;width:250px"></textarea>        
          </div>
        </div>

        <!-- IMAGEM SHOWT-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="descTask_alt">Imagem atual: </label>
          <div class="col-md-8">
            <img name="imagem_alt" id="imagem_alt" width="150" height="150" class="rounded"></td>
        </div>

        <!-- FILE INPUT -->
        <div class="form-group">
          <label class="col-md-6 control-label" for="imagem">Selecione uma imagem no formato: *.jpg; *.jpeg; *.gif; *.png </label>
          <div class="col-md-6">
            <input id="imagem" name="imagem" type="file" placeholder="Digite um nome para a sua task!" class="form-control-file file">       
          </div>          
        </div>

        <!-- BOTÃO FORM FORM-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="btn_taskreg"></label>
          <div class="col-md-4">                    
            <button id="btn_taskreg" name="btn_taskreg" class="btn btn-warning mb-1" type="submit">Alterar</button>
          </div>
        </div> 
        </fieldset>

        </form>
      </div>
    </div>
  </div>
</div>
</div>

<!-- LOGIN MODAL -->
<div class="modal fade bd-modal-sm" role="dialog" id="loginpopUpWindow">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- modal-header -->
    <div class="modal-header">
      <legend>Login:</legend>
      <button type="button" class="close" data-dismiss="modal">&times;</button>     
    </div>

    <div class="modal-body">
      <!-- FORM LOGIN -->
      <form class="form-horizontal" method="POST" id="form" action="">

      <!-- USER INPUT-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="email_input">Email: </label>  
        <div class="col-md-7">
        <input id="email_input" name="email_input" type="text" placeholder="Digite o email" class="form-control input-md" required="" maxlength="30">       
        <small class="form-text text-muted">Ex.: pedro354@email.com</small>
        </div>

      </div>

      <!-- PASSWORD INPUT-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="pwd_input">Senha: </label>
        <div class="col-md-7">
          <input id="pwd_input" name="pwd_input" type="password" placeholder="Digite a senha" class="form-control input-md" required="" maxlength="16">         
        </div>
      </div>

      <!-- BOTÃO FORM FORM-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="btn_form"></label>
        <div class="col-md-4">     
          <button id="btn_login" name="btn_login" class="btn btn-success mb-1" type="submit">Entrar</button>               
          <a class="btn btn-primary" data-toggle="modal" data-target="#regPopupwindow" href="">Cadastrar</a>          
        </div>

      </div>        
      </fieldset>
      </form>
    </div>
  </div>
</div>
</div>

<!-- CADASTRAR LOGIN MODAL -->
<div class="modal fade bd-modal-sm" role="dialog" id="regPopupwindow">
  <div class="modal-dialog">
    <div class="modal-content">

    <!-- modal-header -->
    <div class="modal-header">
      <legend>Insira os dados abaixo:</legend>
      <button type="button" class="close" data-dismiss="modal">&times;</button>     
    </div>

    <div class="modal-body">
      <!-- FORM LOGIN -->
      <form class="form-horizontal" method="POST" id="form" action="">

      <!-- USER INPUT-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="emailReg_input">Email: </label>  
        <div class="col-md-7">
        <input id="emailReg_input" name="emailReg_input" type="text" placeholder="Digite o email" class="form-control input-md" required="" maxlength="30">       
        <small class="form-text text-muted">Ex.: pedro354@email.com</small>
        </div>

      </div>

      <!-- PASSWORD INPUT-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="pwdReg_input">Senha: </label>
        <div class="col-md-7">
          <input id="pwdReg_input" name="pwdReg_input" type="password" placeholder="Digite a senha" class="form-control input-md" required="" maxlength="16">   
          <small class="form-text text-muted">Máximo 16 caracteres</small>      
        </div>
      </div>

      <!-- BOTÃO FORM FORM-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="btn_form"></label>
        <div class="col-md-4">                    
          <button id="btn_register" name="btn_register" class="btn btn-primary mb-1" type="submit">Cadastrar</button>
        </div>
      </div> 
      </form>
    </div>
  </div>
</div>
</div>

<!-- SCRIPT ALTER TASK -->
<script> 
$(document).ready(function(){

 $('button.updateTask').click(function(){

   var idtask = $(this).data('idtask');
   var nometask = $(this).data('nometask');
   var desctask = $(this).data('desctask');
   var imagem = $(this).data('imagem');

   $('#idtask').val(idtask);
   $('#nomeTask_alt').val(nometask);
   $('#descTask_alt').val(desctask);
   $('#imagem_alt').attr("src", imagem);
    });

 });
</script>

</body>

</html>	