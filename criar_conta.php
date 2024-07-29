<?php

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
                   <header>Criar Conta</header>

                   <form action="php/funcao-sistema-criar-conta.php" method="POST">
                        
                        <div class="input-field">
                            <input type="email" class="input" name="email" required autocomplete="off">
                            <label for="email">Email</label> 
                        </div>

                        <div class="input-field">
                            <input type="password" class="input" name="senha" required>
                            <label for="text">Senha</label>
                        </div> 
                        
                        <div class="input-field">    
                            <input type="submit" class="submit" value="Criar">
                        </div>

                        <div class="signin">
                            <span>Já tem uma conta? <a href="index.php">Faça Login</a></span>
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
            case "same_email":
                $icon = "error";
                $title = "Erro ao criar!";
                $text = "Esse email já existe no sistema.";
            break;
        endswitch;
?>    
    <script>
        Swal.fire({
            icon: "<?=$icon;?>",
            title: "<?=$title;?>",
            text: "<?=$text;?>",
            showConfirmButton: false,
            footer: '<a href="criar_conta.php" class="btn btn-primary"> OK! </a>'
        });
    </script>
<?php endif; ?>