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
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Mesas</li>
                    <li class="breadcrumb-item">Produtos</li>

                </ol>
            </nav>
            <div class="back">
                <button type="button" class="btn btn-outline-success btn-sm rounded-pill"><i class="ri-arrow-go-back-fill"></i></button>
            </div>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <diV>
                            <section>
                                <div class="products">
                                    <table class="table table-bordered border-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Produtos</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Coca-Cola</td>
                                                <td>2</td>
                                                <td>R$ 30,00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Brahma 330ml</td>
                                                <td>5</td>
                                                <td>R$ 25,00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Porção | Espetinho de Carne</td>
                                                <td>8</td>
                                                <td>R$ 56,00</td>
                                            </tr>
                                    </table>

                                </div>

                            </section>

                        </diV>


                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
    include_once '../../../assets/html/footer.html';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

<?php
include_once '../../../assets/html/scripts.html';
?>

</html>