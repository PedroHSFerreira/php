<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['criarPerguntaMultiplaEscolha'])) {
        // Processar criação de pergunta de múltipla escolha
        $pergunta = $_POST['pergunta'];
        $respostas = [
            $_POST['opcao_a'],
            $_POST['opcao_b'],
            $_POST['opcao_c'],
            $_POST['opcao_d']
        ];
        $respostaCorreta = $_POST['resposta_correta'];

        criarPerguntaMultiplaEscolha($pergunta, $respostas, $respostaCorreta);
    } elseif (isset($_POST['criarPerguntaTexto'])) {
        // Processar criação de pergunta em texto
        $pergunta = $_POST['pergunta'];
        $resposta = $_POST['resposta'];

        criarPerguntaTexto($pergunta, $resposta);
    } elseif (isset($_POST['alterarPerguntaMultiplaEscolha'])) {
        // Processar alteração de pergunta de múltipla escolha
        $idPergunta = $_POST['id_pergunta'];
        $pergunta = $_POST['pergunta'];
        $respostas = [
            $_POST['opcao_a'],
            $_POST['opcao_b'],
            $_POST['opcao_c'],
            $_POST['opcao_d']
        ];
        $respostaCorreta = $_POST['resposta_correta'];

        alterarPerguntaMultiplaEscolha($idPergunta, $pergunta, $respostas, $respostaCorreta);
    } elseif (isset($_POST['alterarPerguntaTexto'])) {
        // Processar alteração de pergunta em texto
        $idPergunta = $_POST['id_pergunta'];
        $pergunta = $_POST['pergunta'];
        $resposta = $_POST['resposta'];

        alterarPerguntaTexto($idPergunta, $pergunta, $resposta);
    } elseif (isset($_POST['excluirPergunta'])) {
        // Processar exclusão de pergunta
        $idPergunta = $_POST['id_pergunta'];

        excluirPergunta($idPergunta);
    }
}

// Função para criar Perguntas e Respostas de múltipla escolha
function criarPerguntaMultiplaEscolha($pergunta, $respostas)
{
    $arquivo = fopen("perguntas.txt", "a") or die("Não foi possível abrir o arquivo!");
    $idPergunta = uniqid();
    $texto = "ID: " . $idPergunta . "\\nPergunta: " . $pergunta . "\\nRespostas: ";
    foreach($respostas as $resposta){
    $texto .= $resposta . ";";
    }
    $texto .= "\\n\\n";
    fwrite($arquivo, $texto);
    fclose($arquivo);
    
    return true;
}
    
    // Função para criar Perguntas e Respostas de texto
    function criarPerguntaTexto($pergunta, $resposta){
    $arquivo = fopen("perguntas.txt", "a") or die("Não foi possível abrir o arquivo!");
    $idPergunta = uniqid();
    $texto = "ID: " . $idPergunta . "\\nPergunta: " . $pergunta . "\\nResposta: " . $resposta . "\\n\\n";
    fwrite($arquivo, $texto);
    fclose($arquivo);
    
    return true;
    }
    
    // Função para alterar Perguntas e suas respostas de múltipla escolha
    function alterarPerguntaMultiplaEscolha($idPergunta, $pergunta, $respostas){
    $arquivo = fopen("perguntas.txt", "r") or die("Não foi possível abrir o arquivo!");
    $texto = "";
    while(!feof($arquivo)){
    $linha = fgets($arquivo);
    if(strpos($linha, "ID: ".$idPergunta) !== false){
    $texto .= "ID: " . $idPergunta . "\\nPergunta: " . $pergunta . "\\nRespostas: ";
    foreach($respostas as $resposta){
    $texto .= $resposta . ";";
    }
    $texto .= "\\n\\n";
    }else{
    $texto .= $linha;
    }
    }
    fclose($arquivo);
    
    $arquivo = fopen("perguntas.txt", "w") or die("Não foi possível abrir o arquivo!");
    fwrite($arquivo, $texto);
    fclose($arquivo);
    
    return true;
    }
    
    // Função para alterar Perguntas com respostas de texto
    function alterarPerguntaTexto($idPergunta, $pergunta, $resposta){
    $arquivo = fopen("perguntas.txt", "r") or die("Não foi possível abrir o arquivo!");
    $texto = "";
    while(!feof($arquivo)){
    $linha = fgets($arquivo);
    if(strpos($linha, "ID: ".$idPergunta) !== false){
    $texto .= "ID: " . $idPergunta . "\\nPergunta: " . $pergunta . "\\nResposta: " . $resposta . "\\n\\n";
    }else{
    $texto .= $linha;
    }
    }
    fclose($arquivo);
    
    $arquivo = fopen("perguntas.txt", "w") or die("Não foi possível abrir o arquivo!");
    fwrite($arquivo, $texto);
    fclose($arquivo);
    
    return true;
    }
    
    // Função para listar Perguntas e Respostas
    function listarPerguntasERespostas(){
    $arquivo = fopen("perguntas.txt", "r") or die("Não foi possível abrir o arquivo!");
    $texto = "";
    while(!feof($arquivo)){
    $linha = fgets($arquivo);
    $texto .= $linha;
    }
    fclose($arquivo);
    
    return $texto;
    }
    
    // Função para listar uma Pergunta
    function listarPergunta($idPergunta){
    $arquivo = fopen("perguntas.txt", "r") or die("Não foi possível abrir o arquivo!");
    $texto = "";
    while(!feof($arquivo)){
    $linha = fgets($arquivo);
    if(strpos($linha, "ID: ".$idPergunta) !== false){
    $texto .= $linha;
    break;
    }
    }
    fclose($arquivo);
    
    return $texto;
    }
    
    // Função para excluir Pergunta e respostas
     function excluirPerguntaERespostas($idPergunta){
    $arquivo = fopen("perguntas.txt", "r") or die("Não foi possível abrir o arquivo!");
    $texto = "";
    while(!feof($arquivo)){
    $linha = fgets($arquivo);
    if(strpos($linha, "ID: ".$idPergunta) === false){
    $texto .= $linha;
    }else{
    while(!feof($arquivo)){
    $linha = fgets($arquivo);
    if($linha === "\\n"){
    break;
    }
    }
    }
    }
    fclose($arquivo);
    
    $arquivo = fopen("perguntas.txt", "w") or die("Não foi possível abrir o arquivo!");
    fwrite($arquivo, $texto);
    fclose($arquivo);
    
    return true;
    }
    
?>    