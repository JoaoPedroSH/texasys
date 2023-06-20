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

                $agora = time();
                $dia_atual = date('Y-m-d', $agora);
                $hora_atual = date('H:i:s', $agora);
                $timestamp_init = strtotime($dia_atual . ' 09:00:00');
                $timestamp_end = strtotime($dia_atual . ' 01:00:00') + (24 * 60 * 60);

                if ($agora < $timestamp_init && $hora_atual < '06:00:00') {
                    $dia_anterior = date('Y-m-d', strtotime('-1 day', $agora));
                    $date_init = $dia_anterior;
                    $date_end = $dia_atual;
                } else {
                    $data_atual = date('Y-m-d');
                    $data_seguinte = date('Y-m-d', strtotime($data_atual . ' +1 day'));
                    $date_init = $data_atual;
                    $date_end = $data_seguinte;
                }
                ?>
                <h1><strong>ESTATÍSTICAS</strong></h1>
                <strong>(<?= date('d/m/Y', strtotime($date_init)) ?> - 09:00 | <?= date('d/m/Y', strtotime($date_end)) ?> - 01:00)</strong>
            </div>

            <section class="section dashboard">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Vendas</h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-bag-check"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="sales_today"></h6>
                                                <span class="text-muted small pt-2 ps-1">Balcão e Mesas</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card info-card customers-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Receita Total</h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-wallet2"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="revenue"></h6>
                                                </span> <span class="text-muted small pt-2 ps-1">Reais</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card info-card revenue-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Lucro Total</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cash-stack"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="profit"></h6>
                                                <span class="text-muted small pt-2 ps-1">Reais</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <h5 class="card-title">Estatísticas da receita</h5>

                                        <div id="reportsChart"></div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", () => {
                                                fetch('../../services/StatisticsGraphic.php')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        console.log(data);

                                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                                            series: [{
                                                                name: 'Balcão (R$)',
                                                                data: data.sales_grafic_counter[0]
                                                            }, {
                                                                name: 'Mesas (R$)',
                                                                data: data.sales_grafic_tables[0]
                                                            }],
                                                            chart: {
                                                                height: 350,
                                                                type: 'area',
                                                                toolbar: {
                                                                    show: false
                                                                },
                                                            },
                                                            markers: {
                                                                size: 4
                                                            },
                                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                            fill: {
                                                                type: "gradient",
                                                                gradient: {
                                                                    shadeIntensity: 1,
                                                                    opacityFrom: 0.3,
                                                                    opacityTo: 0.4,
                                                                    stops: [0, 90, 100]
                                                                }
                                                            },
                                                            dataLabels: {
                                                                enabled: false
                                                            },
                                                            stroke: {
                                                                curve: 'smooth',
                                                                width: 2
                                                            },
                                                            xaxis: {
                                                                type: 'datetime',
                                                                categories: [
                                                                    data.date_init + "T09:00:00.000Z",
                                                                    data.date_init + "T15:00:00.000Z",
                                                                    data.date_init + "T23:00:00.000Z",
                                                                    data.date_end + "T01:00:00.000Z",
                                                                    data.date_end + "T01:10:00.000Z"
                                                                ],
                                                                labels: {
                                                                    format: 'HH:mm'
                                                                }
                                                            },
                                                            tooltip: {
                                                                x: {
                                                                    format: 'dd/MM/yy HH:mm'
                                                                },
                                                            }
                                                        }).render();
                                                    })
                                                    .catch(error => {
                                                        console.error('Erro na requisição:', error);
                                                    });
                                            });
                                        </script>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    </body>

    <script>
        function valueSalesCounter() {
            fetch('../../services/StatisticsCards.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById("sales_today").innerText = data.vendas;
                    document.getElementById("revenue").innerText = data.receita;
                    document.getElementById("profit").innerText = data.lucro;
                })
                .catch(error => {
                    console.error('Erro na requisição:', error);
                });
        }
        valueSalesCounter();
    </script>

    <?php
    include_once '../../../assets/html/scripts.html';
    ?>

    </html>
<?php
    unset($_SESSION['access_admin_fail']);
}
?>