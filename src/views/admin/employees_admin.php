<!DOCTYPE html>
<html lang="en">

<!-- ======= Head ======= -->
<?php
include_once '../../../assets/html/head.html';
?>

<body>

    <!-- ======= Header ======= -->
    <?php
    include_once '../../../assets/html/header.html';
    ?><!-- End Header -->
    
    <!-- ======= Sidebar ======= -->
    <?php
    include_once '../../../assets/html/sidebar_admin.html';
    ?>
            </li><!-- End Dashboard Nav -->
        </ul>

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="bords.php">
                    <i class="bi bi-layers"></i>
                    <span>Mesas</span>
                </a>
            </li><!-- End Dashboard Nav -->
        </ul>
        

    </aside><!-- End Sidebar-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Funcionários</a></li>
                    
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
                                            <h5 class="card-title">Yoda</h5>

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
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; <a href="https://wa.me/94992927891">João P.</a> & <a href="https://wa.me/94992303058">
                        Pedro.H </a> & <a href="https://wa.me/94991066477">Eduardo D.</a> 2023</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

<!-- Vendor JS Files -->
<script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../../assets/vendor/quill/quill.min.js"></script>
<script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../../assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>