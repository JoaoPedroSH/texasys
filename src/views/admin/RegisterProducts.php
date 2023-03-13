<!DOCTYPE html>
<html lang="en">

<?php
include_once '../../../assets/html/head.html';
?>

<body>

    <!-- ======= Header ======= -->
    <?php
    include_once '../../../assets/html/header.html';
    ?>

    <!-- ======= Sidebar ======= -->
    <?php
    include_once '../../../assets/html/sidebar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Cadastrar Produtos</h1>
            <hr>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card-body">

                            <!-- No Labels Form -->
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <select id="inputState" class="form-select">
                                        <option selected="">Categoria</option>
                                        <option value="alcoólica">Bebida alcoólica</option>
                                        <option value="não alcoólica">Bebida não alcoólica</option>
                                        <option value="Porções">Porções</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="product" class="form-control" placeholder="Produto">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="value" class="form-control" placeholder="Valor em R$">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="supplier" class="form-control" placeholder="Fornecedor">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="supplier-value" class="form-control" placeholder="Valor do Fornecedor">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                                </div>
                            </form><!-- End No Labels Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



</body>

<?php
include_once '../../../assets/html/scripts.html';
?>

<!-- ======= Footer ======= -->
<?php
include_once '../../../assets/html/footer.html';
?>

</html>