<?php

    $filePath = '../json/usuarios.json';

    if (file_exists($filePath)) {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true);

        $ids = array_column($data, 'id');
        $maxId = $ids ? max($ids) : 0;
    } else {
        $data = array();
        $maxId = 0;
    }

    $options = [
        'memory_cost' => 9*1024, // memory_cost = m (in KiB)
        'time_cost' => 4, // time_cost = t
        'threads' => 1 // threads = p
    ];

    $novoUsuario = array(
        "id" => $maxId + 1,
        "email" => $_POST["email"],
        "senha" => password_hash($_POST["senha"], PASSWORD_ARGON2ID, $options)
    );

    if (in_array($novoUsuario["email"], array_column($data, 'email'))) {
        header("location: ../cadastro_usuarios.php?msg=same_email");
        exit();
    } else {
        $data[] = $novoUsuario;
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        file_put_contents($filePath, $jsonData);
    }
    
    header("Location: ../admin.php");
    exit();
?>