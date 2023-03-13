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
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill " data-bs-toggle="modal" data-bs-target="#AddProduct"><i class="bi bi-bag-plus"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-eye-line"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="ri-file-edit-line"></i></button>
                                            </div>

                                        </div>

                                        <!-- Basic Modal -->

                                        <div class="modal fade" id="AddProduct" tabindex="-1"="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Adicionar Produto</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div name="SearchAndFilter" class="row g-3">
                                                                <div class="col-md-12">
                                                                    <div id="dataTable_filter" class="dataTables_filter">

                                                                        <input type="search" list="products" id="search" class="form-control form-control" placeholder="Buscar" aria-controls="dataTable">

                                                                        <datalist id="products">
                                                                            <option value="brahama"></option>
                                                                            <option value="Antarcta"></option>
                                                                            <option value="skol"></option>
                                                                        </datalist>

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input type="range" class="form-control" name="quantidade" placeholder="Quantidade">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="button" class="btn btn-primary">Salvar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Full Screen Modal-->
                                        <!-- End Basic Modal-->

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
                                                    <h6>R$ 111,00</h6>
                                                    <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">Ocupado</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="text-align: center; margin-top: 30px;">

                                            <div>
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><i class="bi bi-bag-plus"></i></button>
                                            </div>
                                            <div style="margin-top: 10px;">
                                                <button type="button" class="btn btn-outline-success btn-sm rounded-pill "><a href="../all/products.php"><i class="ri-eye-line"></i></a></button>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- ======= Footer ======= -->
    <?php
    include_once '../../../assets/html/footer.html';
    ?>

</body>

<?php
include_once '../../../assets/html/scripts.html';
?>

</html>