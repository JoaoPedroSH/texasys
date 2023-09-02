<!DOCTYPE html>
<html lang="en">
<?php
session_start();

require_once '../../../config/ConnectionDB.php';

$get_products_query = "SELECT * FROM produtos";
$get_products_response = $mysqli->query($get_products_query);

$get_categories_query = "SELECT * FROM categorias";
$get_categories_response = $mysqli->query($get_categories_query);

$get_categories_select_query = "SELECT * FROM categorias";
$get_categories_select_response = $mysqli->query($get_categories_select_query);
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
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">CADASTRAR PRODUTO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../../controllers/ProductsController.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="add" value="true">
                            <input type="hidden" name="id">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="file" name="photo" id="photo" class="form-control" style="display: none;" onchange="previewImage(event)">
                                        <button id="buttonPhoto" for="photo" type="button" class="btn btn-lg btn-outline-secondary" style="width: 100%; font-size: 25px;">
                                            <label for="photo">
                                                <i id="iconCamera" class="bi bi-camera" style="color:black;"></i>
                                            </label>
                                        </button>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <center><img id="preview" src="#" alt="Pré-visualização da imagem" style="display: none; width: 45px;"></center>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <select name="category" id="category" class="form-select" required>
                                            <option selected disabled value="">Selecione</option>
                                            <?php
                                            while ($categorie_select = $get_categories_select_response->fetch_assoc()) {
                                            ?>
                                                <option value="<?= $categorie_select['descricao'] ?>"><?= $categorie_select['descricao'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <label for="category">
                                            <strong> Categoria </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="text" name="product" id="product" class="form-control" placeholder="Produto" required>
                                        <label for="product">
                                            <strong> Produto </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="number" step="any" name="value" id="value" class="form-control" placeholder="Valor em R$" required>
                                        <label for="value">
                                            <strong> Valor de venda </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="text" name="supplier" id="supplier" class="form-control" placeholder="Produto" required>
                                        <label for="supplier">
                                            <strong> Fornecedor </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
                                        <input type="number" step="any" name="supplier-value" id="supplier-value" class="form-control" placeholder="Valor em R$" required>
                                        <label for="supplier-value">
                                            <strong> Valor de fornecedor </strong>
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-floating mb-3">
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
                                    <div class="col-md-7">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#Categories">
                                            Categorias <i class="bi bi-list-nested"></i>
                                        </button>

                                        <div class="modal fade" id="Categories" tabindex="-1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">CATEGORIAS</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <button type="button" class="btn btn-sm btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#addCategories">
                                                                    Cadastrar <i class="bi bi-plus-circle-fill"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <table class="table table-hover table-bordered">
                                                                    <thead>
                                                                        <tr class="table-primary">
                                                                            <div id="dataTable_filter" class="dataTables_filter">
                                                                                <input type="search" id="search" class="form-control form-control-md" placeholder="Buscar" aria-controls="dataTable">
                                                                            </div>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="dataTable_categorie">
                                                                        <?php
                                                                        while ($categories = $get_categories_response->fetch_assoc()) {
                                                                        ?>
                                                                            <tr>
                                                                                <td><?= $categories['descricao'] ?></td>
                                                                                <td>
                                                                                    <form action="../../controllers/ProductsController.php" method="POST">
                                                                                        <input type="hidden" name="delete-categorie" value="true">
                                                                                        <input type="hidden" name="id" value="<?= $categories['id'] ?>">
                                                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                                                            <i class="bi bi-trash3"></i>
                                                                                        </button>
                                                                                    </form>
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
                                        </div>

                                        <div class="modal fade" id="addCategories" tabindex="-1" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">CADASTRAR CATEGORIA</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="../../controllers/ProductsController.php" method="POST">
                                                        <input type="hidden" name="add-categorie" value="true">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col form-floating mb-3">
                                                                    <input type="text" name="categorie" id="categorie" class="form-control" required>
                                                                    <label for="categorie">
                                                                        <strong> Descrição </strong>
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
                                    <div class="col-md-5">
                                        <div id="dataTable_filter" class="dataTables_filter">
                                            <input type="search" id="search_products" class="form-control form-control-md" placeholder="Buscar" aria-controls="dataTable">
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Foto</th>
                                            <th scope="col">Categoria</th>
                                            <th scope="col">Produto</th>
                                            <th scope="col">Valor (R$)</th>
                                            <th scope="col">Quantidade (UN)</th>
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
                                                <td><img src="../<?= $products['caminho_foto'] ?>" style="width: 40px;"></td>
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
                                                                <form action="../../controllers/ProductsController.php" method="POST" enctype="multipart/form-data">
                                                                    <input type="hidden" name="edit" value="true">
                                                                    <input type="hidden" name="id" value="<?= $products['id'] ?>">
                                                                    <div class="row ml-1">
                                                                        <div class="col-md-7 form-floating mb-3 mt-3">
                                                                            <input type="file" name="photo_edit" id="photo_edit_<?= $products['id'] ?>" class="form-control" style="display: none;" onchange="previewImageEdit(event, <?= $products['id'] ?>)">
                                                                            <a id="buttonPhoto_edit" for="photo_edit_<?= $products['id'] ?>" role="button">
                                                                                <label for="photo_edit_<?= $products['id'] ?>">
                                                                                    <i id="iconCamera_edit" class="bi bi-camera" style="color:black; font-size: 40px; cursor: pointer"></i>
                                                                                </label>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-5 form-floating mb-3 mt-3">
                                                                            <center><img id="preview_edit_<?= $products['id'] ?>" src="../../storage/<?= $products['foto'] ?>" style="display: block; width: 45px;"></center>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 form-floating mb-3 mt-3">
                                                                        <select name="category" id="category" class="form-select" required>
                                                                            <?php
                                                                            $get_categories_edit_query = "SELECT * FROM categorias";
                                                                            $get_categories_edit_response = $mysqli->query($get_categories_edit_query);
                                                                            while ($categorie_edit = $get_categories_edit_response->fetch_assoc()) {
                                                                            ?>
                                                                                <option value="<?= $categorie_edit['descricao'] ?>" <?php if ($products['categoria'] == $categorie_edit['descricao']) { ?> selected <?php } ?>><?= $categorie_edit['descricao'] ?></option>
                                                                            <?php } ?>
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

<!-- <script>
    document.getElementById('buttonPhoto_edit').addEventListener('click', function() {
        document.getElementById('iconCamera_edit').click();
    });
</script>

<script>
    document.getElementById('buttonPhoto').addEventListener('click', function() {
        document.getElementById('iconCamera').click();
    });
</script> -->

<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    function previewImageEdit(event, id) {
        var input = event.target;
        var preview = document.getElementById('preview_edit_'+id);

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

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