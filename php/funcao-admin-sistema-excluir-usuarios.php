<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Passo 1: Capturar o e-mail do POST
    if (!isset($_POST['email']) || empty($_POST['email'])) {
        echo "E-mail não fornecido.";
        exit;
    }

    $emailParaExcluir = $_POST['email'];
    $caminhoDoArquivo = '../json/usuarios.json'; // Substitua pelo caminho correto do seu arquivo

    // Passo 2: Ler o conteúdo do arquivo JSON
    if (!file_exists($caminhoDoArquivo)) {
        echo "Arquivo não encontrado.";
        exit;
    }

    $json = file_get_contents($caminhoDoArquivo);

    // Passo 3: Decodificar o JSON para um array PHP
    $usuarios = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Erro ao decodificar o JSON.";
        exit;
    }

    // Passo 4: Iterar sobre o array e remover o usuário com o e-mail especificado
    $usuariosFiltrados = array_filter($usuarios, function($usuario) use ($emailParaExcluir) {
        return $usuario['email'] !== $emailParaExcluir;
    });

    // Passo 5: Re-codificar o array modificado para JSON
    $jsonAtualizado = json_encode(array_values($usuariosFiltrados), JSON_PRETTY_PRINT);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Erro ao codificar o JSON.";
        exit;
    }

    // Passo 6: Salvar o JSON atualizado de volta no arquivo
    if (file_put_contents($caminhoDoArquivo, $jsonAtualizado) === false) {
        echo "Erro ao salvar o arquivo.";
        exit;
    }

    header("Location: ../admin.php?msg=user_deleted");
} else {
    echo "Método de solicitação inválido. Use POST.";
}
?>
