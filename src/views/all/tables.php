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
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8 form-floating mb-3">
                                    <select class="form-select" id="employee" required>
                                        <option selected="">Selecione</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label for="employee">
                                        <strong> Funcionário </strong>
                                    </label>
                                </div>
                                <div class="col-md-4 form-floating mb-3">
                                    <select class="form-select" id="table-number" required>
                                        <option selected="">Selecione</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <label for="table-number">
                                        <strong> Nº da Mesa </strong>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-square"></i>
                            </button>
                            <button type="button" class="btn btn-success">
                                <i class="bi bi-check-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class=" col-md-3">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-10">
                                            <h5 class="card-title">
                                                Mesa
                                                <strong style="color:#198754;"> 01 </strong>
                                            </h5>
                                            <div class="d-flex align-items-center">
                                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="bi bi-file-earmark-spreadsheet"></i>
                                                </div>
                                                <div class="ps-3">
                                                    <h6> R$ 0,00 </h6>
                                                    <span class="text-success small pt-1 fw-bold"></span>
                                                    <span class="text-muted small pt-2 ps-1">
                                                        <strong style="color:#2eca6a;">João Pedro</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2" style="margin-top: 30px;">
                                            <div>
                                                <button type="button" id="button-add-product" class="btn btn-outline-secondary btn-sm rounded-pill" title="Adicionar Produto">
                                                    <i class="bi bi-plus-circle-fill" style="font-size: 20px;"></i>
                                                </button>
                                            </div>
                                            <div style="margin-top: 2px;">
                                                <button type="button" id="view-consumption" class="btn btn-outline-secondary btn-sm rounded-pill" title="Visualizar Consumo">
                                                    <i class="ri-eye-fill" style="font-size: 20px;"></i>
                                                </button>
                                            </div>
                                            <div style="margin-top: 2px;">
                                                <button type="button" id="print-bill" class="btn btn-outline-secondary btn-sm rounded-pill" title="Imprimir Conta">
                                                    <i class="bi bi-printer-fill" style="font-size: 20px;"></i>
                                                </button>
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