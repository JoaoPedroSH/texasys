<!DOCTYPE html>
<html lang="en">
<?php
session_start();

require_once '../../../config/ConnectionDB.php';

$get_table_query = "SELECT * FROM mesas_adicionadas";
$get_table_response = $mysqli->query($get_table_query);

$get_products_query = "SELECT * FROM produtos";
$get_products_response = $mysqli->query($get_products_query);
?>

<?php
include_once '../../../assets/html/head.html';
?>

<body>

    <!-- ======= Header e Sidebar ======= -->
    <?php
    include_once '../../../assets/html/header.html';
    include_once '../../../assets/html/sidebar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><strong> MESAS </strong></h1>
        </div>

        <div id="button-modal-add">
            <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Adicionar <i class="bi bi-plus-circle-fill"></i>
            </button>
            <div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ADICIONAR MESA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../../controllers/TablesController.php" method="POST">
                            <input type="hidden" name="add" value="true">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 form-floating mb-3">
                                        <select class="form-select" name="cod-table" id="cod-table" required>
                                            <option value="">Selecione</option>
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                        </select>
                                        <label for="cod-table">
                                            <strong> Nº da Mesa </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-8 form-floating mb-3">
                                        <select class="form-select" name="employee" id="employee" required>
                                            <option value="">Selecione</option>
                                            <option value="João Pedro">João Pedro</option>
                                        </select>
                                        <label for="employee">
                                            <strong> Funcionário </strong>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                    <i class="bi bi-x-square"></i>
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-square"></i>
                                </button>
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

                        <?php
                        while ($tables = $get_table_response->fetch_assoc()) {
                        ?>
                            <div class="col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-10">
                                                <h5 class="card-title">
                                                    Mesa
                                                    <strong style="color:#198754;"> <?= $tables['cod_mesa'] ?> </strong>
                                                </h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                        <i class="bi bi-file-earmark-spreadsheet"></i>
                                                    </div>
                                                    <div class="ps-3">
                                                        <h6> R$ 0,00 </h6>
                                                        <span class="text-success small pt-1 fw-bold"></span>
                                                        <span class="text-muted small pt-2 ps-1">
                                                            <strong style="color:#2eca6a;"> <?= $tables['funcionario'] ?> </strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-2" style="margin-top: 30px;">
                                                <div>
                                                    <button type="button" id="button-add-product" data-bs-toggle="modal" data-bs-target="#addProductsTables" class="btn btn-outline-secondary btn-sm rounded-pill" title="Adicionar Produto">
                                                        <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
                                                    </button>

                                                    <div class="modal fade" id="addProductsTables" tabindex="-1" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">ADICIONAR PRODUTOS Á MESA</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="../../controllers/TablesController.php" method="POST">
                                                                    <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px;">
                                                                        <div class="col-md-9">
                                                                            <div id="dataTable_filter" class="dataTables_filter">
                                                                                <input type="search" id="search" class="form-control form-control-md" placeholder="Pesquise o produto aqui" aria-controls="dataTable">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                                <i class="bi bi-x-square"></i>
                                                                            </button>
                                                                            <button type="submit" class="btn btn-success">
                                                                                <i class="bi bi-check-square"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <table class="table table-bordered" style="margin-top: 15px;">
                                                                        <thead>
                                                                            <tr class="table-secondary">
                                                                                <th scope="col">Produto</th>
                                                                                <th scope="col">Quantidade</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody id="dataTable">
                                                                            <?php
                                                                            while ($products = $get_products_response->fetch_assoc()) {
                                                                            ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-check form-switch">
                                                                                            <input class="form-check-input" type="checkbox" id="product-<?= $products['id'] ?>" name="product-<?= $products['id'] ?>" value="<?= $products['produto'] ?>">
                                                                                            <label class="form-check-label" for="product-<?= $products['id'] ?>"> <?= $products['produto'] ?> </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <input class="form-control" type="number" name="quantidade-<?= $products['id'] ?>" id="quantidade-<?= $products['id'] ?>" min="0" value="0">
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 2px;">
                                                    <button type="button" id="view-consumption" class="btn btn-outline-secondary btn-sm rounded-pill" title="Visualizar Consumo">
                                                        <i class="ri-eye-fill" style="font-size: 20px;"></i>
                                                    </button>
                                                </div>
                                                <div style="margin-top: 2px;">
                                                    <button type="button" id="print-bill" class="btn btn-outline-secondary btn-sm rounded-pill" step="1f" title="Imprimir Conta">
                                                        <i class="bi bi-printer-fill" style="font-size: 20px;"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

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
if (isset($_SESSION['table_added_success'])) {
?>
    <script>
        swalAddTableSuccess();
    </script>
<?php
    unset($_SESSION['table_added_success']);
}
?>

<?php
if (isset($_SESSION['table_added_fail'])) {
?>
    <script>
        swalAddTableFailed();
    </script>
<?php
    unset($_SESSION['table_added_fail']);
}
?>

</html>