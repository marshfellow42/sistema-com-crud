<?php

    session_start();

    if (isset($_SESSION['user_data']) == false) {
        header("location: index.php?msg=access_denied ");
    } else {
        $user = $_SESSION['user_data'];
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">   
    <title> Cadastro de Clientes </title>
</head>
<body>
    
    <?php include_once 'menu.php'; ?>

    <div class="px-md-3">
        <hr>
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item"><a href="admin.php"> Menu de Clientes </a></li>
                    <li class="list-group-item active" aria-current="true"> Cadastro de Clientes </li>
                </ul>
            </div>
            <div class="col-md-10">
                <div class="card text-center">
                    <div class="card-header">
                      Cadastro de Clientes
                    </div>
                    <form action="php/funcao-admin-sistema-criar-conta.php" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="fa fa-address-card"></i> Email
                                        </label>
                                        <input required name="email" type="email" class="form-control">                       
                                    </div>
                
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="fa fa-globe"></i></i> Senha
                                        </label>
                                        <input required name="senha" type="text" class="form-control">                        
                                    </div>
                                </div>

                                <hr>

                                <div class="mb-3">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-success"> Adicionar Usuário </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00');
            $('#telefone').mask('(00) 00000-0000');
            $('#whatsapp').mask('(00) 00000-0000');
        });
    </script>
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
            footer: '<a href="cadastro_usuarios.php" class="btn btn-primary"> OK! </a>'
        });
    </script>
<?php endif; ?>