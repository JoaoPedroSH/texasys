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
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class=" col-md-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title">Mesa 01</h5>

                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-cart"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>R$ 0,00</h6>
                                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Vago</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4" style="text-align: center; margin-top: 30px;">

                                            <div>
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="bi bi-bag-plus"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-eye-line"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-file-edit-line"></i></button>
                                            </div>

                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title">Mesa 02</h5>

                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-cart"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>R$ 110,00</h6>
                                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Ocupado</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="text-align: center; margin-top: 30px;">

                                            <div>
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="bi bi-bag-plus"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-eye-line"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-file-edit-line"></i></button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5 class="card-title">Mesa 03</h5>

                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-cart"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>R$ 0,00</h6>
                                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Vago</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="text-align: center; margin-top: 30px;">

                                            <div>
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="bi bi-bag-plus"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-eye-line"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-file-edit-line"></i></button>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

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