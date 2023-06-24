<!DOCTYPE html>
<html lang="en">
<?php
session_start();

require_once '../../../config/ConnectionDB.php';

$get_products_query = "SELECT * FROM produtos";
$get_products_response = $mysqli->query($get_products_query);
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
    include_once '../../../assets/html/sidebar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><strong> PRODUTOS </strong></h1>
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
                                            <th scope="col">Categoria</th>
                                            <th scope="col">Produto</th>
                                            <th scope="col">Valor</th>
                                            <th scope="col">Quantidade (unidades)</th>
                                            <th scope="col">Data de cadastro</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        <?php
                                        while ($products = $get_products_response->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?= $products['categoria'] ?></td>
                                                <td><?= $products['produto'] ?></td>
                                                <td>R$ <?= $products['valor_produto'] ?></td>
                                                <td><?= $products['quantidade'] ?></td>
                                                <td><?= date('d/m/Y', strtotime($products['data'])) ?></td>
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

</html>