<?php

$filePath = '../json/usuarios.json';

if (file_exists($filePath)) {
    $json = file_get_contents($filePath);
    $data = json_decode($json, true);
} else {
    $data = array();
}

$options = [
    'memory_cost' => 9*1024, // memory_cost = m (in KiB)
    'time_cost' => 4, // time_cost = t
    'threads' => 1 // threads = p
];

$usuarioEmail = $_POST["email"];
$usuarioSenha = password_hash($_POST["senha"], PASSWORD_ARGON2ID, $options);

$usuarioExistenteIndex = null;
foreach ($data as $index => $usuario) {
    if ($usuario["email"] == $usuarioEmail) {
        $usuarioExistenteIndex = $index;
        break;
    }
}

if ($usuarioExistenteIndex !== null) {
    // Atualizar o usuário existente
    $data[$usuarioExistenteIndex]["senha"] = $usuarioSenha;
} else {
    header("location: ../editar_usuarios.php?msg=user_not_found");
    exit();
}

$jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents($filePath, $jsonData);

header("Location: ../admin.php?msg=password_changed");
exit();
?>
