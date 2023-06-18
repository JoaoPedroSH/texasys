<!DOCTYPE html>

<?php
session_start();
?>

<?php
if (isset($_SESSION['access_admin_success'])) {
?>


    <html lang="pt">

    <?php
    include_once '../../../assets/html/head_admin.html';
    ?>

    <body>

        <?php
        include_once '../../../assets/html/header.html';
        ?>

        <?php
        include_once '../../../assets/html/sidebar_admin.html';
        ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <?php
                date_default_timezone_set('America/Belem');
                $data_atual = date('d/m/y');
                $data_seguinte = date('d/m/y', strtotime(date('Y-m-d') . ' +1 day'));
                ?>
                <h1><strong>RELATÓRIOS</strong></h1>
            </div>

            <section class="section dashboard">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <select></select>
                                </div>
                                <div class="col-md-3">
                                    <select></select>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn-sm btn-warning rounded-pill">
                                        <strong>Buscar <i class="bi bi-search"></i></strong>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class="table-primary">
                                            <th scope="col">Data e Hora</th>
                                            <th scope="col">Vendas</th>
                                            <th scope="col">Receita</th>
                                            <th scope="col">Lucro</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataTable">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: center;">
                                                <i class="bi bi-printer-fill mr-3" style="color:#343a40; cursor:pointer;" title="Imprimir relatório"></i>
                                                <i class="bi bi-eye-fill" style="color:#343a40; cursor:pointer;" title="Ver detalhes"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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

    </html>
<?php
    unset($_SESSION['access_admin_fail']);
}
?>