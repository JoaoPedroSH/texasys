<!DOCTYPE html>
<html lang="en">

<?php
include_once '../../../assets/html/head.html';

session_start();
?>

<body>

    <!-- ======= Header ======= -->
    <?php
    include_once '../../../assets/html/header.html';
    ?>

    <!-- ======= Sidebar ======= -->
    <?php
    include_once '../../../assets/html/sidebar_admin.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Cadastrar Produtos</h1>
            <hr>
        </div>

        <section class="section dashboard">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">
                        <div class="card-body">
                            <form action="../../controllers/ProductsController.php" method="POST" class="row g-3">
                                <input type="hidden" name="register">   
                                <div class="col-md-6">
                                    <select name="category" class="form-select" required>
                                        <option selected="">Categoria</option>
                                        <option value="alcoólica">Bebida alcoólica</option>
                                        <option value="não alcoólica">Bebida não alcoólica</option>
                                        <option value="Porções">Porções</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="product" class="form-control" placeholder="Produto" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="value" class="form-control" placeholder="Valor em R$" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="supplier" class="form-control" placeholder="Fornecedor" required>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="supplier-value" class="form-control" placeholder="Valor do Fornecedor" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



</body>

<?php
include_once '../../../assets/html/scripts.html';
?>

<!-- ======= Footer ======= -->
<?php
include_once '../../../assets/html/footer.html';
?>

<?php 
 if(isset($_SESSION['register_products_success'])) {
?>
    <script>
        swalRegisterSuccess();
    </script>
<?php
    unset($_SESSION['register_products_success']);
 }
?>

<?php 
 if(isset($_SESSION['register_products_fail'])) {
?>
    <script>
        swalRegisterfailed();
    </script>
<?php
    unset($_SESSION['register_products_fail']);
 }
?>

</html>