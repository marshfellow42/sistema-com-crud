<?php

$email = $_POST['email'];
$senha = $_POST['senha'];

$filePath = '../json/usuarios.json';

if (file_exists($filePath)) {
    $json = file_get_contents($filePath);
    $json_data = json_decode($json, true);

    foreach ($json_data as $user) {
        if ($user['email'] === $email) {
            if (password_verify($senha, $user['senha'])) {

                session_start();

                $data['id'] = $user['id'];
                $data['email'] = $user['email'];
                $data['access'] = date("d/m/Y H:i:s");

                $_SESSION['user_data'] = $data;
                
                header("Location: ../admin.php");
                exit();
            } else {
                header("location: ../index.php?msg=access_error");
                exit();
            }
        }
    }
    header("location: ../index.php?msg=access_error");
} else {
    header("location: ../index.php?msg=no_users");
}
?>
