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
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.css">  
    <link rel="stylesheet" href="assets/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="assets/css/buttons.bootstrap5.css"> 
    <title> Página de Clientes </title>
</head>
<body>
    
    <?php include_once 'menu.php'; ?>

    <div class="px-md-3">
        <hr>
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true"> Menu de Usuários </li>
                    <li class="list-group-item"><a href="cadastro_usuarios.php"> Cadastro de Usuários </a></li>
                </ul>
            </div>
            <div class="col-md-10">
                <table class="table table-striped nowrap" style="width:100%" id="myTable">
                    <thead>
                        <th> Id </th>    
                        <th> Email </th>
                        <th> Senha </th>
                        <th> Ações </th>
                    </thead>

                    <?php

                    $usuarios = [];

                    $filePath = 'json/usuarios.json';

                    if (file_exists($filePath)) {

                        $json_data = file_get_contents($filePath);

                        $data = json_decode($json_data, true);

                        $usuarios = array_merge($usuarios, $data);

                    }

                    ?>

                    <tbody>
                    
                    <?php foreach ($usuarios as $arr_tot): ?>
                        
                        <tr>
                            <td><?php echo $arr_tot["id"]; ?></td>
                            <td><?php echo $arr_tot["email"]; ?></td>
                            <td><?php echo $arr_tot["senha"]; ?></td>
                            <td>
                                <form action="editar_usuarios.php" method="post" style="display: inline;">
                                    <input type="hidden" name="email" value="<?php echo $arr_tot['email']; ?>">
                                    <button class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                </form>
                                
                                <form action="php/funcao-admin-sistema-excluir-usuarios.php" method="post" style="display: inline;">
                                    <input type="hidden" name="email" value="<?php echo $arr_tot['email']; ?>">
                                    <button class="btn btn-sm btn-danger" title="Excluir">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </form>

                                <button class="btn btn-sm btn-secondary" title="Visualizar" style="display: inline;">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </td>


                        </tr>

                    <?php endforeach; ?>

                    </tbody>
            
                    <tfoot>
                        <th> Id </th>    
                        <th> Email </th>
                        <th> Senha </th>
                        <th> Ações </th>
                    </tfoot>
            
                </table>
            </div>
        </div>
    </div>
 
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.responsive.js"></script>
    <script src="assets/js/responsive.bootstrap5.js"></script>
    <script src="assets/js/dataTables.buttons.js"></script>
    <script src="assets/js/buttons.bootstrap5.js"></script>
    <script src="assets/js/jszip.min.js"></script>
    <script src="assets/js/pdfmake.min.js"></script>
    <script src="assets/js/vfs_fonts.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/buttons.colvis.min.js"></script>
    <script type="text/javascript">
        new DataTable('#myTable', {
            responsive: true,
            layout: {
                topStart: {
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                }
            },
            stateSave: true,
            language: {
                url:"https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php 
    if(isset($_GET['msg'])): 
        switch($_GET['msg']):
            case "user_deleted":
                $icon = "success";
                $title = "Usuário deletado!";
                $text = "Esse usuário foi deletado.";
            break;

            case "password_changed":
                $icon = "success";
                $title = "Senha alterada!";
                $text = "A senha desse usuário foi alterada.";
            break;
        endswitch;
?>    
    <script>
        Swal.fire({
            icon: "<?=$icon;?>",
            title: "<?=$title;?>",
            text: "<?=$text;?>",
            showConfirmButton: false,
            footer: '<a href="admin.php" class="btn btn-primary"> OK! </a>'
        });
    </script>
<?php endif; ?>