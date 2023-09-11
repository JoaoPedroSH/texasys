<!DOCTYPE html>
<html lang="en">
<?php

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
            <div class="col-md-12">
                <div class="pagetitle">
                    <h1><strong> CONSUMO DOS FUNCIONÁRIOS </strong></h1>
                </div>

                <div class="card" style="display:inline-flex">
                    <form action="../../controllers/SalesCounterController.php" method="POST">
                        <div class="card-header">
                            <div class="d-flex align-items-center mt-1">
                                <input type="hidden" name="tipo-vendas" value="employees">
                                <select class="custom-select" name="employees-counter" id="select-employees-counter" required>
                                    <option selected disabled value="">Selecionar funcionário</option>
                                    <?php
                                    $get_employees_query = "SELECT * FROM funcionarios";
                                    $get_employees_response = $mysqli->query($get_employees_query);
                                    while ($employees = $get_employees_response->fetch_assoc()) {
                                    ?>
                                        <option value="<?= $employees['id'] ?>"><?= $employees['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <button type="button" id="button-add-product-sales-counter" data-bs-toggle="modal" data-bs-target="#addProductSalesCounter" class="btn btn-outline-secondary btn-md" title="Adicionar produtos">
                                        <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
                                    </button>
                                </div>
                                <div class="ps-3">
                                    <button type="button" id="button-view-product-sales-counter" data-bs-toggle="modal" data-bs-target="#viewProductSalesCounter" class="btn btn-outline-secondary btn-md" title="Visualizar produtos">
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
                                    <button type="button" id="button-finish-sales-counter" data-bs-toggle="modal" data-bs-target="#finishSalesCounter" class="btn btn-secondary btn-md" title="Finalizar compra">
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
                        </div>
                    </form>
                </div>

                <div class="modal fade" id="addProductSalesCounter">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ADICIONAR PRODUTOS AO BALCÃO <strong></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="../../controllers/SalesCounterController.php" method="POST">
                                <input type="hidden" name="add-product-sales-counter" value="true">
                                <input type="hidden" name="tipo-vendas" value="employees">
                                <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px;">
                                    <div class="col-md-9">
                                        <div id="dataTable_filter" class="dataTables_filter">
                                            <input type="search" id="search_balcao" class="form-control form-control-md" placeholder="Pesquise o produto aqui" aria-controls="dataTable">
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
                                            <th scope="col">Foto</th>
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
                                                <td class="col-md-2">
                                                    <div>
                                                        <center><img src="../<?= $products['caminho_foto'] ?>" style="width: 40px;"></center>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-control form-switch" style="align-items: center; border:0px">
                                                        <input style="margin-left: 0%;" class="form-check-input check-produto" type="checkbox" id="produto_<?= $products['id'] ?>" name="produto_<?= $products['id'] ?>" value="<?= $products['id'] ?>">
                                                        <label style="margin-left: 18%;" class="form-check-label" for="produto_<?= $products['id'] ?>"> <?= $products['produto'] ?> </label>
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
                                        <input type="search" id="search_balcao" class="form-control form-control-md" placeholder="Pesquise aqui" aria-controls="dataTable">
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
                                    $get_products_table_query = "SELECT * FROM produtos_adicionados_balcao WHERE status = 'aberto'";
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
                                                        <input type="hidden" name="tipo-vendas" value="employees">
                                                        <input type="hidden" name="cod-product-added" value="<?= $products_added['id'] ?>">
                                                        <input type="hidden" name="id-product" value="<?= $products_added['id_produto'] ?>">
                                                        <input type="hidden" name="quant-product" value="<?= $products_added['quantidade'] ?>">
                                                        <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-trash" style="color:black; cursor:pointer;"></i></button>
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

            <div class="col-md-12">
                <hr style="margin-bottom:25px;margin-top:0px; border: 1px solid;">
            </div>

            <?php
            function checkGender($name)
            {
                $name = strtolower($name);
                $masculineEndings = ['o', 'r', 's'];
                $feminineEndings = ['a', 'e'];
                $lastLetter = substr($name, -1);

                if (in_array($lastLetter, $masculineEndings)) {
                    return 'Masculino';
                } elseif (in_array($lastLetter, $feminineEndings)) {
                    return 'Feminino';
                } else {
                    return 'Indefinido';
                }
            }
            ?>

            <div class="col-md-12">
                <section class="section dashboard">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">

                                <?php
                                $get_funcionario_query = "SELECT * FROM funcionarios";
                                $get_funcionario_response = $mysqli->query($get_funcionario_query);
                                while ($funcionarios = $get_funcionario_response->fetch_assoc()) {
                                    if (checkGender($funcionarios['nome']) == 'Masculino') {
                                        $color_icon = 'revenue-card';
                                        $color_name = '#198754';
                                        $color_function = '#2eca6a';
                                    }
                                    if (checkGender($funcionarios['nome']) == 'Feminino') {
                                        $color_icon = 'customers-card';
                                        $color_name = '#C30808';
                                        $color_function = '#ff0d0d';
                                    }
                                ?>
                                    <div class="col-md-4">
                                        <div class="card info-card <?= $color_icon ?>">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <h5 class="card-title">
                                                            <strong style="color:<?= $color_name ?>;"> <?= $funcionarios['nome'] . ' ' . $funcionarios['sobrenome'] ?> </strong>
                                                        </h5>
                                                        <div class="d-flex align-items-center">
                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                            <div class="ps-3">
                                                                <h6> R$ <?= $funcionarios['debito'] ?></h6>
                                                                <span class="text-success small pt-1 fw-bold"></span>
                                                                <span class="text-muted small pt-2 ps-1">
                                                                    <strong style="color:<?= $color_function ?>"> <?= $funcionarios['funcao'] ?> </strong>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" style="justify-content: end;">
                                                    <div class="col-md-2">
                                                        <button type="button" id="view-consumption" style="background-color: white; border:1px solid <?= $color_name ?>" data-bs-toggle="modal" data-bs-target="#viewProductsEmployees_<?= $funcionarios['id']  ?>" class="btn btn-outline-secondary btn-sm rounded-pill" title="Visualizar consumo">
                                                            <i class="bi bi-file-earmark-text-fill" style="font-size: 20px;color:#102E5D"></i>
                                                        </button>

                                                        <div class="modal fade" id="viewProductsEmployees_<?= $funcionarios['id'] ?>">
                                                            <div class="modal-dialog modal-md">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"> CONSUMO DE " <strong><?= $funcionarios['nome'] . ' ' . $funcionarios['sobrenome'] ?> "</strong></h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="../../controllers/TablesController.php" method="POST" id="formAddProductsTables">
                                                                        <input type="hidden" name="view-products-of-tables" value="true">
                                                                        <input type="hidden" name="id-tables" value="<?= $funcionarios['id'] ?>">
                                                                        <div id="search-filter" class="row" style="margin-top: 15px; margin-left: 5px; margin-right: 5px;">
                                                                            <div class="col-md-12">
                                                                                <div id="dataTable_filter" class="dataTables_filter">
                                                                                    <input type="search" id="search_card_func" class="form-control form-control-md" placeholder="Pesquise aqui" aria-controls="dataTable">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <table class="table table-bordered" style="margin-top: 15px;">
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

                                                                                if ($funcionarios['debito'] != '0') {

                                                                                    $id_func = $funcionarios['id'];

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
            </div>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

</body>

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