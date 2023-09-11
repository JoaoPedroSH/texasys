<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once '../../../config/ConnectionDB.php';

$get_employees_query = "SELECT * FROM funcionarios";
$get_employees_response = $mysqli->query($get_employees_query);
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
        margin-bottom: 1.25rem;
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
            <h1><strong> FUNCIONÁRIOS </strong></h1>
        </div>

        <div id="button-modal-add">
            <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Cadastrar <i class="bi bi-plus-circle-fill"></i>
            </button>
            <div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">CADASTRAR FUNCIONÁRIO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../../controllers/EmployeesController.php" method="POST">
                            <input type="hidden" name="add" value="true">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome" required>
                                        <label for="name">
                                            <strong> Nome </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Sobrenome" required>
                                        <label for="lastname">
                                            <strong> Sobrenome </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="text" name="function" id="function" class="form-control" placeholder="Função" required>
                                        <label for="function">
                                            <strong> Função </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="text" name="telefone" id="telefone" class="form-control" placeholder="N° Telefone" required>
                                        <label for="telefone">
                                            <strong> N° Telefone </strong>
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
                                            <th scope="col">Função</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Débito</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        <?php
                                        while ($employees = $get_employees_response->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?= $employees['funcao'] ?></td>
                                                <td><?= $employees['nome'] ?> <?= $employees['sobrenome'] ?></td>
                                                <td><?= $employees['numero'] ?></td>
                                                <td>R$ <?= $employees['debito'] ?></td>
                                                <td>

                                                    <div class="d-inline-block">
                                                        <form id="formDischarge" action="../../controllers/EmployeesController.php" method="POST">
                                                            <input type="hidden" name="discharge_debit" value="true">
                                                            <input type="hidden" name="id_employees_discharge" value="<?= $employees['id'] ?>">

                                                            <a role="button" data-bs-toggle="modal" data-bs-target="#dischargeEmployeesFinish_<?= $employees['id'] ?>">
                                                                <i class="bi bi-file-earmark-check-fill" style="color:#343a40;" title="Quitar débito"></i></a>

                                                            <div class="modal fade" id="dischargeEmployeesFinish_<?= $employees['id'] ?>">
                                                                <div class="modal-dialog ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <strong style="font-size: 1.5rem;"> DESEJA QUITAR ESTE DEBITO DE R$<?= $employees['debito'] ?>? </strong>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Não">
                                                                                <i class="bi bi-x-square"></i>
                                                                            </button>
                                                                            <button type="submit" class="btn btn-success" title="Sim">
                                                                                <i class="bi bi-check-square"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="d-inline-block">
                                                        <a role="button" data-bs-toggle="modal" data-bs-target="#viewProductsEmployees_<?= $employees['id'] ?>">
                                                            <i class="bi bi-file-earmark-text-fill" style="color:#343a40;" title="Vizualizar consumo"></i>
                                                        </a>
                                                    </div>
                                                    <div class="modal fade" id="viewProductsEmployees_<?= $employees['id'] ?>">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"> CONSUMO DE " <strong><?= $employees['nome'] . ' ' . $employees['sobrenome'] ?> "</strong></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="../../controllers/TablesController.php" method="POST" id="formAddProductsTables">
                                                                    <input type="hidden" name="view-products-of-tables" value="true">
                                                                    <input type="hidden" name="id-tables" value="<?= $employees['id'] ?>">
                                                                    <div id="search-filter" class="row" style="margin-top: .9375rem; margin-left: .3125rem; margin-right: .3125rem;">
                                                                        <div class="col-md-12">
                                                                            <div id="dataTable_filter" class="dataTables_filter">
                                                                                <input type="search" id="search_card_func" class="form-control form-control-md" placeholder="Pesquise aqui" aria-controls="dataTable">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <table class="table table-bordered" style="margin-top: .9375rem;">
                                                                        <thead>
                                                                            <tr class="table-secondary">
                                                                                <th scope="col" style="text-align:center">Produto</th>
                                                                                <th scope="col" style="text-align:center">Quantidade</th>
                                                                                <th scope="col" style="text-align:center">Valor</th>
                                                                                <th scope="col" style="text-align:center">Data</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody id="dataTable_card_func">
                                                                            <?php

                                                                            if ($employees['debito'] != '0') {

                                                                                $id_func = $employees['id'];

                                                                                $get_balcao_vendas_query = "SELECT * FROM vendas_balcao_funcionario WHERE id_funcionario = $id_func AND status = 'pendente' ";
                                                                                $get_balcao_vendas_response = $mysqli->query($get_balcao_vendas_query);

                                                                                $resultados_por_id = array();

                                                                                while ($row = $get_balcao_vendas_response->fetch_assoc()) {
                                                                                    $id_funcionario_vendas = $row['id'];

                                                                                    $get_balcao_funcionario_query = "SELECT * FROM produtos_adicionados_balcao WHERE id_vendas_balcao = $id_funcionario_vendas AND tipo_vendas = 'employees' AND status_debito = 'pendente'";
                                                                                    $get_balcao_funcionario_response = $mysqli->query($get_balcao_funcionario_query);

                                                                                    while ($produto = $get_balcao_funcionario_response->fetch_assoc()) {
                                                                                        $resultados_por_id[] = $produto;
                                                                                    }
                                                                                }

                                                                                $resultados_finais = array();

                                                                                foreach ($resultados_por_id as $func) {
                                                                                    $id_produto = $func['id_produto'];
                                                                                    $get_product_query = "SELECT * FROM produtos WHERE id = $id_produto";
                                                                                    $get_product_response = $mysqli->query($get_product_query);

                                                                                    if ($get_product_response) {
                                                                                        $produto = $get_product_response->fetch_assoc();

                                                                                        if ($produto) {
                                                                                            $resultado_final = array(
                                                                                                'produto' => $produto['produto'],
                                                                                                'quantidade' => $func['quantidade'],
                                                                                                'valor' => $func['valor'],
                                                                                                'data_hora' => date('d/m/Y', strtotime($func['data_hora']))
                                                                                            );

                                                                                            $resultados_finais[] = $resultado_final;
                                                                                        }
                                                                                    }
                                                                                }


                                                                                foreach ($resultados_finais as $resultado) {
                                                                            ?>
                                                                                    <tr>
                                                                                        <td style="text-align:center"><?= $resultado['produto'] ?></td>
                                                                                        <td style="text-align:center"><?= $resultado['quantidade'] ?></td>
                                                                                        <td style="text-align:center">R$ <?= $resultado['valor'] ?></td>
                                                                                        <td style="text-align:center"><?= $resultado['data_hora'] ?></td>
                                                                                    </tr>
                                                                            <?php
                                                                                }
                                                                            } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
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

<script>
    function submitFormDischarge() {
        var form = document.getElementById("formDischarge");
        form.submit();
    }
</script>

<!-- ======= Scripts ======= -->
<?php
include_once '../../../assets/html/scripts.html';
?>

<!-- ======= Alerts ======= -->
<?php
if (isset($_SESSION['register_employees_success'])) {
?>
    <script>
        swalEmployeesAddSuccess();
    </script>
<?php
    unset($_SESSION['register_employees_success']);
}
?>

<?php
if (isset($_SESSION['register_employees_fail'])) {
?>
    <script>
        swalEmployeesAddFailed();
    </script>
<?php
    unset($_SESSION['register_employees_fail']);
}
?>

<?php
if (isset($_SESSION['dischange_debit_success'])) {
?>
    <script>
        swalDischangeDebitSuccess();
    </script>
<?php
    unset($_SESSION['dischange_debit_success']);
}
?>

<?php
if (isset($_SESSION['dischange_debit_fail'])) {
?>
    <script>
        swalDischangeDebitFailed();
    </script>
<?php
    unset($_SESSION['dischange_debit_fail']);
}
?>

</html>