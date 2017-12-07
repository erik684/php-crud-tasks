<?php 
include_once("conexao_bd.php");

$nome_task = $_POST['nomeTask_input'];
$desc = $_POST['desc_input'];

// verifica se foi enviado um imagem
if (isset( $_FILES[ 'imagem' ][ 'name' ] ) && $_FILES[ 'imagem' ][ 'error' ] == 0 ) {
 
    $imagem_tmp = $_FILES[ 'imagem' ][ 'tmp_name' ];
    $nome = $_FILES[ 'imagem' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION ); 
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {

        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid ( time () ) .'.'.$extensao;

        // Concatena a pasta com o nome
        $destino = '../img/' . $novoNome;
 
        // tenta mover o imagem para o destino
        if (@move_uploaded_file ($imagem_tmp, $destino)) {
            $destino = substr($destino, 1);

            $sql = "INSERT INTO tasks (nome_task, desc_task, arq_task) 
                    VALUES ('$nome_task', '$desc', '$destino')";

            if (!mysqli_query($dbconnection, $sql)) {
               echo 'erro insercao no banco: '.mysqli_error($dbconnection);
            } else {
                header("Location: ../index.php?task=sucesso");                
            }
        }
        else
           echo 'Erro ao salvar o imagem. Aparentemente você não tem permissão de escrita.<br />';
        	// header("Location: ../index.php?produto=erro");
    }
    else
        header("Location: ../index.php?task=erroext");
        
}
else {
    header("Location: ../index.php?task=erro");
    
    }



?>