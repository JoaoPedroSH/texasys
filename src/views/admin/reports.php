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
                <h1><strong>RELATÓRIOS</strong></h1>
            </div>

            <section class="section dashboard">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-md-3">
                                    <input class="form-control" type="date" id="select-calendario">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" id="select-turno">
                                        <option value="0">Todos os turnos</option>
                                        <option value="1">09:00 - 15:00</option>
                                        <option value="2">15:00 - 23:00</option>
                                        <option value="3">23:00 - 01:00</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" onclick="searchReports()" class="btn btn-sm btn-warning rounded-pill">
                                        <strong>Buscar <i class="bi bi-search"></i></strong>
                                    </button>
                                    <button type="button" id="printReports" class="btn btn-sm btn-success rounded-pill" style="display: none;">
                                        <strong>Imprimir <i class="bi bi-printer"></i></strong>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

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



    <script>
        function searchReports() {
            let data_calendario = document.getElementById("select-calendario").value;
            let hora_turno = document.getElementById("select-turno").value;

            let formData = new FormData();
            formData.append('calendario', data_calendario);
            formData.append('turno', hora_turno);

            fetch('../../services/SearchReports.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status === "true") {
                        document.getElementById("printReports").style.display = "inline-block";
                    } else {
                        document.getElementById("printReports").style.display = "none";
                    }
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        }
    </script>

    </html>
<?php
    unset($_SESSION['access_admin_fail']);
}
?>