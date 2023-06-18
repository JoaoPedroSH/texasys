<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once '../../../config/ConnectionDB.php';
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

        <div class="col-md-12">
            <div class="pagetitle">
                <h1><strong> BALCÃO </strong></h1>
            </div>

            <div class="card" style="display:inline-flex">
                <div class="card-header"></div>
                <div class="card-body">
                    <form action="../../controllers/SalesCounterController.php" method="POST">
                        

                        <div class="d-flex align-items-center">
                            <div>
                                <button type="button" id="button-add-product-sales-counter" data-bs-toggle="modal" data-bs-target="#addProductSalesCounter" class="btn btn-warning btn-md" title="Adicionar produtos">
                                    <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
                                </button>
                            </div>
                            <div class="ps-3">
                                <button type="button" id="button-view-product-sales-counter" data-bs-toggle="modal" data-bs-target="#viewProductSalesCounter" class="btn btn-warning btn-md" title="Visualizar produtos">
                                    <i class="ri-eye-fill" style="font-size: 20px;"></i>
                                </button>
                            </div>
                            <div class="input-group ps-3 input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" id="value-totality" class="form-control" disabled>
                            </div>
                            <div class="ps-3">
                                <input type="hidden" name="finish-sales-counter" value="true">
                                <button type="button" id="button-finish-sales-counter" data-bs-toggle="modal" data-bs-target="#finishSalesCounter" class="btn btn-success btn-md" title="Finalizar compra">
                                    <i class="bi bi-check-circle-fill" style="font-size: 20px;"></i>
                                </button>
                            </div>

                            <div class="modal fade" id="finishSalesCounter">
                                <div class="modal-dialog ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong style="font-size: 24px;"> DESEJA REALMENTE FINALIZAR ESTA COMPRA? </strong>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" id="finish-counter-no" data-bs-dismiss="modal" title="Não">
                                                <i class="bi bi-x-square"></i>
                                            </button>
                                            <button type="submit" id="finish-counter-yes" class="btn btn-success" title="Sim">
                                                <i class="bi bi-check-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="radio-client" name="radio-stacked-sales-counter" value="client" checked>
                                    <label class="custom-control-label" for="radio-client">Cliente</label>
                                </div>
                            </div>
                            <div class="ps-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="radio-employees" name="radio-stacked-sales-counter" value="employees">
                                    <label class="custom-control-label" for="radio-employees">Funcionário</label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-1">
                            <?php
                            $get_employees_query = "SELECT * FROM funcionarios";
                            $get_employees_response = $mysqli->query($get_employees_query);
                            while ($employees = $get_employees_response->fetch_assoc()) {
                            ?>
                                <select class="custom-select" name="employees-counter" id="select-employees-counter" style="display:none;">
                                    <option selected disabled value="">Selecionar funcionário</option>
                                    <option value="<?= $employees['id'] ?>"><?= $employees['nome'] ?></option>
                                </select>
                            <?php } ?>
                        </div>
                    </form>

                    <div class="modal fade" id="addProductSalesCounter">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ADICIONAR PRODUTOS AO BALCÃO <strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../../controllers/SalesCounterController.php" method="POST">
                                    <input type="hidden" name="add-product-sales-counter" value="true">
                                    <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px;">
                                        <div class="col-md-9">
                                            <div id="dataTable_filter" class="dataTables_filter">
                                                <input type="search" id="search" class="form-control form-control-md" placeholder="Pesquise o produto aqui" aria-controls="dataTable">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger" id="cancel-add-product-sales-counter" data-bs-dismiss="modal" title="Cancelar">
                                                <i class="bi bi-x-square"></i>
                                            </button>
                                            <button type="submit" class="btn btn-success" id="save-add-product-sales-counter" title="Adicionar">
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
                                            $get_products_query = "SELECT * FROM produtos";
                                            $get_products_response = $mysqli->query($get_products_query);
                                            while ($products = $get_products_response->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-control form-switch" style="align-items: center; border:0px">
                                                            <input style="margin-left: 1%;" class="form-check-input check-produto" type="checkbox" id="produto_<?= $products['id'] ?>" name="produto_<?= $products['id'] ?>" value="<?= $products['id'] ?>">
                                                            <label style="margin-left: 15%;" class="form-check-label" for="produto_<?= $products['id'] ?>"> <?= $products['produto'] ?> </label>
                                                        </div>
                                                    </td>
                                                    <td class="col-md-3">
                                                        <div>
                                                            <input class="form-control input-quantidade" type="number" name="quantidade_<?= $products['id'] ?>" id="quantidade_<?= $products['id'] ?>" min="1" value="1" style="display:none;" disabled>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="viewProductSalesCounter">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"> PRODUTOS ADICIONADOS AO BALCÃO</strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <input type="hidden" name="view-products-of-sales-counter" value="true">
                                <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px; margin-right: 5px;">
                                    <div class="col-md-12">
                                        <div id="dataTable_filter" class="dataTables_filter">
                                            <input type="search" id="search" class="form-control form-control-md" placeholder="Pesquise aqui" aria-controls="dataTable">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered" style="margin-top: 15px;">
                                    <thead>
                                        <tr class="table-secondary">
                                            <th scope="col" style="text-align:center">Produto</th>
                                            <th scope="col" style="text-align:center">Quantidade</th>
                                            <th scope="col" style="text-align:center">Valor</th>
                                            <th scope="col" style="text-align:center"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="dataTable">
                                        <?php
                                        $get_products_table_query = "SELECT * FROM produtos_adicionados_balcao";
                                        $get_products_table_response = $mysqli->query($get_products_table_query);

                                        while ($products_added = $get_products_table_response->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                        <?php
                                                        $code_produto = $products_added['id_produto'];
                                                        $get_products_unic_query = "SELECT * FROM produtos WHERE id = $code_produto";
                                                        $get_products_unic_response = $mysqli->query($get_products_unic_query);
                                                        $products_unic = $get_products_unic_response->fetch_assoc();
                                                        ?>
                                                        <label> <?= $products_unic['produto'] ?> </label>

                                                    </div>
                                                </td>
                                                <td class="col-md-3">
                                                    <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                        <label> <?= $products_added['quantidade'] ?> </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                        <label> R$<?= $products_added['valor'] ?> </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                        <form action="../../controllers/SalesCounterController.php" method="POST">
                                                            <input type="hidden" name="delete-product-added-sales-counter" value="true">
                                                            <input type="hidden" name="cod-product-added" value="<?= $products_added['id'] ?>">
                                                            <input type="hidden" name="id-product" value="<?= $products_added['id_produto'] ?>">
                                                            <input type="hidden" name="quant-product" value="<?= $products_added['quantidade'] ?>">
                                                            <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-trash" style="color:red; cursor:pointer;"></i></button>
                                                        </form>
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

            <div class="col-md-12">
                <hr style="margin-bottom:35px; border: 1px solid;">
            </div>

            <div class="col-md-12">

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
                                                    <?php
                                                    $get_tables_quant_query = "SELECT * FROM mesas_quantidade";
                                                    $get_tables_quant_response = $mysqli->query($get_tables_quant_query);
                                                    $tables_quant = $get_tables_quant_response->fetch_assoc();
                                                    $i = 1;
                                                    while ($i <= $tables_quant['quantidade']) {
                                                    ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php $i++;
                                                    } ?>
                                                </select>

                                                <label for="cod-table">
                                                    <strong> Nº da Mesa </strong>
                                                </label>
                                            </div>
                                            <div class="col-md-8 form-floating mb-3">
                                                <?php
                                                $get_employees_query = "SELECT * FROM funcionarios";
                                                $get_employees_response = $mysqli->query($get_employees_query);
                                                while ($employees = $get_employees_response->fetch_assoc()) {
                                                ?>
                                                    <select class="form-select" name="employee" id="employee" required>
                                                        <option value="">Selecione</option>
                                                        <option value="<?= $employees['id'] ?>"><?= $employees['nome'] ?></option>
                                                    </select>
                                                <?php } ?>
                                                <label for="employee">
                                                    <strong> Funcionário </strong>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="cancel-add-table" data-bs-dismiss="modal" title="Cancelar">
                                            <i class="bi bi-x-square"></i>
                                        </button>
                                        <button type="submit" id="save-add-table" class="btn btn-success" title="Cadastrar">
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
                                $get_table_query = "SELECT * FROM mesas_adicionadas";
                                $get_table_response = $mysqli->query($get_table_query);
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
                                                                <?php
                                                                $id_mesa_value = $tables['cod_mesa'];
                                                                $product_sum_table_query = "SELECT SUM(valor) as total FROM produtos_adicionados_mesas WHERE id_mesa = $id_mesa_value AND status = 'aberto'";
                                                                $product_sum_table_result = $mysqli->query($product_sum_table_query);
                                                                while ($sum_tables = $product_sum_table_result->fetch_assoc()) {
                                                                    if ($sum_tables['total'] > 0) {
                                                                        $sum_tables_value = $sum_tables['total']; 
                                                                    } else {
                                                                        $sum_tables_value = '0'; 
                                                                    }
                                                                ?>
                                                                    <h6> R$ <?= $sum_tables_value ?></h6>
                                                                <?php } ?>
                                                                <span class="text-success small pt-1 fw-bold"></span>
                                                                <span class="text-muted small pt-2 ps-1">
                                                                    <?php
                                                                    $id_employees = $tables['funcionario'];
                                                                    $get_table_employees_query = "SELECT * FROM funcionarios WHERE id = $id_employees";
                                                                    $get_table_employees_response = $mysqli->query($get_table_employees_query);
                                                                    while ($nome_employees = $get_table_employees_response->fetch_assoc()) {
                                                                    ?>
                                                                        <strong style="color:#2eca6a;"> <?= $nome_employees['nome'] ?> </strong>
                                                                    <?php } ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2" style="margin-top: 3px;">
                                                        <div>
                                                            <button type="button" id="button-add-product" data-bs-toggle="modal" data-bs-target="#addProductsTables_<?= $tables['cod_mesa'] ?>" class="btn btn-outline-secondary btn-sm rounded-pill" title="Adicionar produto">
                                                                <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
                                                            </button>

                                                            <div class="modal fade" id="addProductsTables_<?= $tables['cod_mesa'] ?>" tabindex="-1" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">ADICIONAR PRODUTOS Á MESA <strong><?= $tables['cod_mesa'] ?></strong></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="../../controllers/TablesController.php" method="POST" id="formAddProductsTables">
                                                                            <input type="hidden" name="add-products-of-tables" value="true">
                                                                            <input type="hidden" name="id-tables" value="<?= $tables['cod_mesa'] ?>">
                                                                            <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px;">
                                                                                <div class="col-md-9">
                                                                                    <div id="dataTable_filter" class="dataTables_filter">
                                                                                        <input type="search" id="search" class="form-control form-control-md" placeholder="Pesquise o produto aqui" aria-controls="dataTable">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <button type="button" class="btn btn-danger" id="cancel-add-product-table" data-bs-dismiss="modal" title="Cancelar">
                                                                                        <i class="bi bi-x-square"></i>
                                                                                    </button>
                                                                                    <button type="submit" class="btn btn-success" id="save-add-product-table" title="Adicionar">
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
                                                                                    $get_products_query = "SELECT * FROM produtos";
                                                                                    $get_products_response = $mysqli->query($get_products_query);
                                                                                    while ($products = $get_products_response->fetch_assoc()) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-check form-control form-switch" style="align-items: center; border:0px">
                                                                                                    <input style="margin-left: 1%;" class="form-check-input check-produto" type="checkbox" id="produto_<?= $products['id'] ?>" name="produto_<?= $products['id'] ?>" value="<?= $products['id'] ?>">
                                                                                                    <label style="margin-left: 15%;" class="form-check-label" for="produto_<?= $products['id'] ?>"> <?= $products['produto'] ?> </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="col-md-3">
                                                                                                <div>
                                                                                                    <input class="form-control input-quantidade" type="number" name="quantidade_<?= $products['id'] ?>" id="quantidade_<?= $products['id'] ?>" min="1" value="1" style="display:none;" disabled>
                                                                                                </div>
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

                                                        <div style="margin-top: 3px;">
                                                            <button type="button" id="view-consumption" data-bs-toggle="modal" data-bs-target="#viewProductsTables_<?= $tables['cod_mesa'] ?>" class="btn btn-outline-secondary btn-sm rounded-pill" title="Visualizar consumo">
                                                                <i class="ri-eye-fill" style="font-size: 20px;"></i>
                                                            </button>

                                                            <div class="modal fade" id="viewProductsTables_<?= $tables['cod_mesa'] ?>" tabindex="-1" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"> PRODUTOS ADICIONADOS Á MESA <strong><?= $tables['cod_mesa'] ?></strong></h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="../../controllers/TablesController.php" method="POST" id="formAddProductsTables">
                                                                            <input type="hidden" name="view-products-of-tables" value="true">
                                                                            <input type="hidden" name="id-tables" value="<?= $tables['cod_mesa'] ?>">
                                                                            <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px; margin-right: 5px;">
                                                                                <div class="col-md-12">
                                                                                    <div id="dataTable_filter" class="dataTables_filter">
                                                                                        <input type="search" id="search" class="form-control form-control-md" placeholder="Pesquise aqui" aria-controls="dataTable">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <table class="table table-bordered" style="margin-top: 15px;">
                                                                                <thead>
                                                                                    <tr class="table-secondary">
                                                                                        <th scope="col" style="text-align:center">Produto</th>
                                                                                        <th scope="col" style="text-align:center">Quantidade</th>
                                                                                        <th scope="col" style="text-align:center">Valor</th>
                                                                                        <th scope="col" style="text-align:center"></th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody id="dataTable">
                                                                                    <?php
                                                                                    $code_mesa = $tables['cod_mesa'];
                                                                                    $get_products_table_query = "SELECT * FROM produtos_adicionados_mesas WHERE id_mesa = $code_mesa";
                                                                                    $get_products_table_response = $mysqli->query($get_products_table_query);

                                                                                    while ($products_added = $get_products_table_response->fetch_assoc()) {
                                                                                    ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                                                                    <?php
                                                                                                    $code_produto = $products_added['id_produto'];
                                                                                                    $get_products_unic_query = "SELECT * FROM produtos WHERE id = $code_produto";
                                                                                                    $get_products_unic_response = $mysqli->query($get_products_unic_query);
                                                                                                    $products_unic = $get_products_unic_response->fetch_assoc();
                                                                                                    ?>
                                                                                                    <label> <?= $products_unic['produto'] ?> </label>

                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="col-md-3">
                                                                                                <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                                                                    <label> <?= $products_added['quantidade'] ?> </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                                                                    <label> R$<?= $products_added['valor'] ?> </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="form-control" style="align-items:center; border:0px; text-align:center">
                                                                                                    <form action="../../controllers/TablesController.php" method="POST">
                                                                                                        <input type="hidden" name="delete-product-added" value="true">
                                                                                                        <input type="hidden" name="cod-product-added" value="<?= $products_added['id'] ?>">
                                                                                                        <input type="hidden" name="id-product" value="<?= $products_added['id_produto'] ?>">
                                                                                                        <input type="hidden" name="quant-product" value="<?= $products_added['quantidade'] ?>">
                                                                                                        <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-trash" style="color:red; cursor:pointer;"></i></button>
                                                                                                    </form>
                                                                                                </div>
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

                                                        <div style="margin-top: 3px;">
                                                            <button type="button" id="print-bill" class="btn btn-outline-secondary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#printBillTables_<?= $tables['cod_mesa'] ?>" title="Imprimir conta">
                                                                <i class="bi bi-printer-fill" style="font-size: 20px;"></i>
                                                            </button>

                                                            <div class="modal fade" id="printBillTables_<?= $tables['cod_mesa'] ?>" tabindex="-1" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h2 class="modal-title" style="text-align: center;"> DESEJA <strong> IMPRIMIR </strong> E <strong> FECHAR </strong> A CONTA DA MESA <strong><?= $tables['cod_mesa'] ?></strong> ? </h2>
                                                                            <form action="../../controllers/PrintBillController.php" method="POST">
                                                                                <input type="hidden" name="print" value="true">
                                                                                <input type="hidden" name="id-tables-print" value="<?= $tables['cod_mesa'] ?>">
                                                                                <hr>
                                                                                <div class="col-md-12">
                                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                                                        Não <i class="bi bi-x-square"></i>
                                                                                    </button>
                                                                                    <button type="submit" class="btn btn-success">
                                                                                        Sim <i class="bi bi-check-square"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="margin-top: 3px;">
                                                            <button type="button" class="btn btn-success btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#finishTables_<?= $tables['cod_mesa'] ?>" title="Finalizar mesa">
                                                                <i class="bi bi-check-circle-fill" style="font-size: 20px;"></i>
                                                            </button>

                                                            <div class="modal fade" id="finishTables_<?= $tables['cod_mesa'] ?>">
                                                                <div class="modal-dialog ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <strong style="font-size: 24px;"> DESEJA FINALIZAR A MESA <?= $tables['cod_mesa'] ?>? </strong>
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <form action="../../controllers/TablesController.php" method="POST">
                                                                                <input type="hidden" name="finish-tables" value="true">
                                                                                <input type="hidden" name="id-table-finish" value="<?= $tables['cod_mesa'] ?>">

                                                                                <button type="button" class="btn btn-danger" id="finish-counter-no" data-bs-dismiss="modal" title="Não">
                                                                                    <i class="bi bi-x-square"></i>
                                                                                </button>
                                                                                <button type="submit" id="finish-counter-yes" class="btn btn-success" title="Sim">
                                                                                    <i class="bi bi-check-square"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" style="align-items: center;">
                            <span style="margin-bottom: 10px;">Quantidade de mesas</span>
                            <form action="../../controllers/TablesController.php" method="POST">
                                <div class="row" style="justify-content: start;">
                                    <input type="hidden" name="put_quant_tables" value="true">
                                    <div class="col-sm-1">
                                        <?php
                                        $get_tables_quant_form_query = "SELECT * FROM mesas_quantidade";
                                        $get_tables_quant_form_response = $mysqli->query($get_tables_quant_form_query);
                                        $tables_quant_form = $get_tables_quant_form_response->fetch_assoc();
                                        ?>
                                        <input class="form-control" type="number" name="quantity-tables" min="1" value="<?= $tables_quant_form['quantidade'] ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-secondary" id="quant-tables" title="Atualizar quantidade">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</body>

<script>
    $(document).ready(function() {
        $("input[name='radio-stacked-sales-counter']").change(function() {
            var selecionado = $("input[name='radio-stacked-sales-counter']:checked").val();
            if (selecionado === "employees") {
                $("#select-employees-counter").show();
                $('#select-employees-counter').prop('required', true);
            } else {
                $("#select-employees-counter").hide();
                $('#select-employees-counter').prop('required', false);
            }
        });
    });
</script>

<script>
    const checkboxes = document.querySelectorAll('.check-produto');
    checkboxes.forEach(checkbox => {
        const quantidadeInput = checkbox.parentElement.parentElement.nextElementSibling.querySelector('.input-quantidade');
        checkbox.addEventListener('change', () => {
            quantidadeInput.disabled = !checkbox.checked;
            quantidadeInput.style.display = checkbox.checked ? 'block' : 'none';
        });
    });
    const modal = document.getElementById('addProductsTables');
    modal.addEventListener('hidden.bs.modal', () => {
        location.reload();
    });
</script>

<!-- ======= Scripts ======= -->
<?php
include_once '../../../assets/html/scripts.html';
?>

<script>
    function valueSalesCounter() {
        fetch('../../controllers/SalesCounterController.php')
            .then(response => response.json())
            .then(data => {
                let valor = data.valor_total;
                document.getElementById("value-totality").value = valor;
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
            });
    }
    valueSalesCounter();
</script>

<!-- ======= Alerts ======= -->
<?php
if (isset($_SESSION['product_sales_counter_added_success'])) {
?>
    <script>
        valueSalesCounter();
        swalProductAddTableSuccess();
    </script>
<?php
    unset($_SESSION['product_sales_counter_added_success']);
}
?>
<?php
if (isset($_SESSION['product_sales_counter_added_fail'])) {
?>
    <script>
        swalProductAddTableFailed();
    </script>
<?php
    unset($_SESSION['product_sales_counter_added_fail']);
}
?>

<?php
if (isset($_SESSION['removed_product_sales_counter_success'])) {
?>
    <script>
        valueSalesCounter();
        swalProductRemovedTableSuccess();
    </script>
<?php
    unset($_SESSION['removed_product_sales_counter_success']);
}
?>
<?php
if (isset($_SESSION['removed_product_sales_counter_fail'])) {
?>
    <script>
        swalProductRemovedTableFailed();
    </script>
<?php
    unset($_SESSION['removed_product_sales_counter_fail']);
}
?>



<?php
if (isset($_SESSION['num_table_added_success'])) {
?>
    <script>
        swalAddQuantTableSuccess();
    </script>
<?php
    unset($_SESSION['num_table_added_success']);
}
?>

<?php
if (isset($_SESSION['num_table_added_fail'])) {
?>
    <script>
        swalAddQuantTableFailed();
    </script>
<?php
    unset($_SESSION['num_table_added_fail']);
}
?>

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

<?php
if (isset($_SESSION['product_table_added_success'])) {
?>
    <script>
        swalProductAddTableSuccess();
    </script>
<?php
    unset($_SESSION['product_table_added_success']);
}
?>

<?php
if (isset($_SESSION['product_table_added_fail'])) {
?>
    <script>
        swalProductAddTableFailed();
    </script>
<?php
    unset($_SESSION['product_table_added_fail']);
}
?>

<?php
if (isset($_SESSION['removed_product_success'])) {
?>
    <script>
        swalProductRemovedTableSuccess();
    </script>
<?php
    unset($_SESSION['removed_product_success']);
}
?>

<?php
if (isset($_SESSION['removed_product_fail'])) {
?>
    <script>
        swalProductRemovedTableFailed();
    </script>
<?php
    unset($_SESSION['removed_product_fail']);
}
?>

<?php
if (isset($_SESSION['finish_sales_counter_success'])) {
?>
    <script>
        swalFinishSalesCounterSuccess();
    </script>
<?php
    unset($_SESSION['finish_sales_counter_success']);
}
?>

<?php
if (isset($_SESSION['finish_sales_counter_fail'])) {
?>
    <script>
        swalFinishSalesCounterFail();
    </script>
<?php
    unset($_SESSION['finish_sales_counter_fail']);
}
?>

<?php
if (isset($_SESSION['finish_sales_tables_success'])) {
?>
    <script>
        swalFinishSalesTablesSuccess();
    </script>
<?php
    unset($_SESSION['finish_sales_tables_success']);
}
?>

<?php
if (isset($_SESSION['finish_sales_tables_fail'])) {
?>
    <script>
        swalFinishSalesTablesFail();
    </script>
<?php
    unset($_SESSION['finish_sales_tables_fail']);
}
?>



</html>