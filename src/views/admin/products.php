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
    include_once '../../../assets/html/sidebar_admin.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><strong> PRODUTOS </strong></h1>
        </div>

        <div id="button-modal-add">
            <button type="button" class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Cadastrar <i class="bi bi-plus-circle-fill"></i>
            </button>

            <div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">CADASTRAR PRODUTO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../../controllers/ProductsController.php" method="POST">
                            <input type="hidden" name="add" value="true">
                            <input type="hidden" name="id">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 form-floating mb-3">
                                        <select name="category" id="category" class="form-select" required>
                                            <option value="">Selecione</option>
                                            <option value="B. alcoólica">Bebida alcoólica</option>
                                            <option value="B. não alcoólica">Bebida não alcoólica</option>
                                            <option value="Porções">Porções</option>
                                        </select>
                                        <label for="category">
                                            <strong> Categoria </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-floating mb-3">
                                        <input type="text" name="product" id="product" class="form-control" placeholder="Produto" required>
                                        <label for="product">
                                            <strong> Produto </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-floating mb-3">
                                        <input type="number" step="any" name="value" id="value" class="form-control" placeholder="Valor em R$" required>
                                        <label for="value">
                                            <strong> Valor de venda </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-floating mb-3">
                                        <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Produto" required>
                                        <label for="supplier">
                                            <strong> Fornecedor </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-floating mb-3">
                                        <input type="number" step="any" name="supplier-value" id="supplier-value" class="form-control" placeholder="Valor em R$" required>
                                        <label for="supplier-value">
                                            <strong> Valor de compra </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-4 form-floating mb-3">
                                        <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Valor em R$" required>
                                        <label for="quantity">
                                            <strong> Quantidade de unidades </strong>
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
                                            <th scope="col">Categoria</th>
                                            <th scope="col">Produto</th>
                                            <th scope="col">Valor (R$)</th>
                                            <th scope="col">Quantidade (Unidades)</th>
                                            <th scope="col">Fonecedor</th>
                                            <th scope="col">Valor de fornecedor (R$)</th>
                                            <th scope="col">Data da últ. reposição</th>
                                            <th scope="col"></th>
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
                                                <td><?= $products['fornecedor'] ?></td>
                                                <td>R$ <?= $products['valor_fornecedor'] ?></td>
                                                <td><?= date('d/m/Y', strtotime($products['data'])) ?></td>
                                                <td>
                                                    <a role="button" data-bs-toggle="modal" data-bs-target="#EditProducts_<?= $products['id'] ?>">
                                                        <i class="bi bi-pencil-square mr-1" style="color:#343a40;" title="Editar Produto"></i>
                                                    </a>

                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="EditProducts_<?= $products['id'] ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title">EDITAR PRODUTO</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="../../controllers/ProductsController.php" method="POST">
                                                                    <input type="hidden" name="edit" value="true">
                                                                    <input type="hidden" name="id" value="<?= $products['id'] ?>">
                                                                    <div class="col-md-12 form-floating mb-3 mt-3">
                                                                        <select name="category" id="category" class="form-select" required>
                                                                            <option value="B. alcoólica" <?php if ($products['categoria'] == 'B. alcoólica') { ?> selected <?php } ?>>Bebida alcoólica</option>
                                                                            <option value="B. não alcoólica" <?php if ($products['categoria'] == 'B. não alcoólica') { ?> selected <?php } ?>>Bebida não alcoólica</option>
                                                                            <option value="Porções" <?php if ($products['categoria'] == 'Porções') { ?> selected <?php } ?>>Porções</option>
                                                                        </select>
                                                                        <label for="category">
                                                                            <strong> Categoria </strong>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12 form-floating mb-3">
                                                                        <input value="<?= $products['produto'] ?>" type="text" name="product" id="products" class="form-control" placeholder="Produto" required>
                                                                        <label for="products">
                                                                            <strong> Produto </strong>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12 form-floating mb-3">
                                                                        <input value="<?= $products['valor_produto'] ?>" step="any" type="number" name="value" id="value" class="form-control" placeholder="Valor(R$)" required>
                                                                        <label for="value">
                                                                            <strong> Valor(R$) </strong>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12 form-floating mb-3">
                                                                        <input value="<?= $products['quantidade'] ?>" type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantidade" required>
                                                                        <label for="quantity">
                                                                            <strong> Quantidade </strong>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12 form-floating mb-3">
                                                                        <input value="<?= $products['fornecedor'] ?>" type="text" name="supplier" id="supplier" class="form-control" placeholder="Quantidade" required>
                                                                        <label for="supplier">
                                                                            <strong> Fornecedor </strong>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-12 form-floating mb-3">
                                                                        <input value="<?= $products['valor_fornecedor'] ?>" step="any" type="number" name="supplier-value" id="supplier-value" class="form-control" placeholder="Valor(R$)" required>
                                                                        <label for="supplier-value">
                                                                            <strong> Valor de Fornecedor(R$) </strong>
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
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a role="button" data-bs-toggle="modal" data-bs-target="#DeleteProducts_<?= $products['id'] ?>">
                                                        <i class="bi bi-trash3"></i>
                                                    </a>

                                                    <!-- Modal Delete -->
                                                    <div class="modal fade" id="DeleteProducts_<?= $products['id'] ?>">
                                                        <div class="modal-dialog ">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <strong style="font-size: 24px;"> DESEJA EXCLUIR O PRODUTO "<?= $products['produto'] ?>"? </strong>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="../../controllers/ProductsController.php" method="POST">
                                                                        <input type="hidden" name="delete" value="true">
                                                                        <input type="hidden" name="id" value="<?= $products['id'] ?>">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Não">
                                                                            <i class="bi bi-x-square"></i>
                                                                        </button>
                                                                        <button type="submit" class="btn btn-success" title="Sim">
                                                                            <i class="bi bi-check-square"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
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

<!-- ======= Scripts ======= -->
<?php
include_once '../../../assets/html/scripts.html';
?>

<!-- ======= Alerts ======= -->
<?php
if (isset($_SESSION['register_products_success'])) {
?>
    <script>
        swalRegisterSuccess();
    </script>
<?php
    unset($_SESSION['register_products_success']);
}
?>

<?php
if (isset($_SESSION['register_products_fail'])) {
?>
    <script>
        swalRegisterfailed();
    </script>
<?php
    unset($_SESSION['register_products_fail']);
}
?>


<?php
if (isset($_SESSION['edit_products_success'])) {
?>
    <script>
        swalEditSuccess();
    </script>
<?php
    unset($_SESSION['edit_products_success']);
}
?>

<?php
if (isset($_SESSION['edit_products_fail'])) {
?>
    <script>
        swalEditFailed();
    </script>
<?php
    unset($_SESSION['edit_products_fail']);
}
?>

<?php
if (isset($_SESSION['delete_products_success'])) {
?>
    <script>
        swalDeleteSuccess();
    </script>
<?php
    unset($_SESSION['delete_products_success']);
}
?>

<?php
if (isset($_SESSION['delete_products_fail'])) {
?>
    <script>
        swalDeleteFailed();
    </script>
<?php
    unset($_SESSION['delete_products_fail']);
}
?>

</html>