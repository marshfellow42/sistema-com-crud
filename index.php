<?php

    $folderPath = 'json';

    if (!is_dir($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    session_start();

    if (isset($_SESSION['user_data'])) {
        header("location: admin.php ");
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">
                <img src="images/white.png" alt="">
                <div class="text">
                    <!-- <p>Join the community of developers <i>- ludiflex</i></p> -->
                </div>
                
            </div>

            <div class="col-md-6 right">
                
                <div class="input-box">
                   <header>Entre já</header>

                   <form action="php/funcao-sistema-login.php" method="post">

                        <div class="input-field">
                            <input type="text" class="input" name="email" required="" autocomplete="off">
                            <label for="email">Email</label> 
                        </div>

                        <div class="input-field">
                            <input type="password" class="input" name="senha" required="">
                            <label for="pass">Senha</label>
                        </div> 

                        <div class="input-field">
                            <input type="submit" class="submit" value="Entrar">
                        </div> 
                        
                        <div class="signin">
                            <span>Não tem uma conta? <a href="criar_conta.php">Crie Já</a></span>
                        </div>

                   </form>
                   
                </div>  
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php 
    if(isset($_GET['msg'])): 
        switch($_GET['msg']):
            case "access_error":
                $icon = "error";
                $title = "Erro ao acessar!";
                $text = "Usuario ou senha incorretos!";
            break;

            case "no_users":
                $icon = "error";
                $title = "Erro ao acessar!";
                $text = "Não existe nenhum usuário.";
            break;

            case "invalid_password":
                $icon = "error";
                $title = "As senhas não conferem!";
                $text = "Preencha as senhas iguais.";
            break;

            case "end_session":
                $icon = "success";
                $title = "Sessão encerrada";
                $text = "Volte sempre!!";
            break;

            case "access_denied":
                $icon = "error";
                $title = "Acesso não permitido!";
                $text = "Verifique os dados de acesso";
            break;
        endswitch;
?>    
    <script>
        Swal.fire({
            icon: "<?=$icon;?>",
            title: "<?=$title;?>",
            text: "<?=$text;?>",
            showConfirmButton: false,
            footer: '<a href="index.php" class="btn btn-primary"> OK! </a>'
        });
    </script>
<?php endif; ?>