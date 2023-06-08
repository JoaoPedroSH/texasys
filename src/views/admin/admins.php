<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once '../../../config/ConnectionDB.php';
?>

<?php
include_once '../../../assets/html/head.html';
?>

<style>
    tr {
        text-align: center;
    }

    #search-filter {
        justify-content: end;
        margin-bottom: 20px;
    }
</style>

<body>

    <!-- ======= Header e Sidebar ======= -->
    <?php
    include_once '../../../assets/html/header.html';
    include_once '../../../assets/html/sidebar_admin.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><strong> ADMINISTRADORES </strong></h1>
        </div>

        <div id="button-modal-add">
            <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Cadastrar <i class="bi bi-plus-circle-fill"></i>
            </button>
            <div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">CADASTRAR ADMINISTRADOR</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../../controllers/AdminsController.php" method="POST">
                            <input type="hidden" name="add" value="true">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 form-floating mb-3">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome" required>
                                        <label for="name">
                                            <strong> Nome </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-12 form-floating mb-3">
                                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Nome de Usuário" required>
                                        <label for="user_name">
                                            <strong> Nome de usuário </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-12 form-floating mb-3">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Senha" required>
                                        <label for="password">
                                            <strong> Senha </strong>
                                        </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            <i class="bi bi-x-square"></i>
                                        </button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-check-square"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div id="search-filter" class="row">
                                    <div class="col-md-5">
                                        <div id="dataTable_filter" class="dataTables_filter">
                                            <input type="search" id="search" class="form-control form-control-md" placeholder="Buscar" aria-controls="dataTable">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Nome</th>
                                            <th scope="col">Nome de usuário</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        <?php
                                        $get_admins_query = "SELECT * FROM admins";
                                        $get_admins_response = $mysqli->query($get_admins_query);
                                        while ($admins = $get_admins_response->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?= $admins['nome'] ?></td>
                                                <td><?= $admins['nome_usuario'] ?></td>
                                                <td></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</body>

<!-- ======= Scripts ======= -->
<?php
include_once '../../../assets/html/scripts.html';
?>

<!-- ======= Alerts ======= -->
<?php
if (isset($_SESSION['register_admins_success'])) {
?>
    <script>
        swalAdminsAddSuccess();
    </script>
<?php
    unset($_SESSION['register_admins_success']);
}
?>

<?php
if (isset($_SESSION['register_admins_fail'])) {
?>
    <script>
        swalAdminsAddFailed();
    </script>
<?php
    unset($_SESSION['register_admins_fail']);
}
?>

</html>