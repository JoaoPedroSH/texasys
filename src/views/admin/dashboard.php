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
                <h1>Estatísticas</h1>
            </div>

            <section class="section dashboard">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Vendas <span>| Hoje (9:00h - 1:00h)</span></h5>

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
                                        <h5 class="card-title">Receita |<span id="text_revenue_month"></span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-wallet2"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="revenue_month"></h6>
                                                </span> <span class="text-muted small pt-2 ps-1">Reais</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card info-card revenue-card">

                                    <div class="card-body">
                                        <h5 class="card-title">Lucro | <span id="text_profit_month"></span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cash-stack"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="profit_month"></h6>
                                                <span class="text-muted small pt-2 ps-1">Reais</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <?php
                                        date_default_timezone_set('America/Belem');
                                        $data_atual = date('d/m/y');
                                        $data_seguinte = date('d/m/y', strtotime(date('Y-m-d') . ' +1 day'));
                                        ?>
                                        <h5 class="card-title">Estatísticas da receita <span>(<?= $data_atual ?> - <?= $data_seguinte ?>)</span></h5>

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
                                                                data: data.sales_counter[0],
                                                            }, {
                                                                name: 'Mesas (R$)',
                                                                data: [11, 32, 45, 32, 34, 52, 41]
                                                            }, {
                                                                name: 'Geral (R$)',
                                                                data: [15, 11, 32, 18, 9, 24, 11]
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
                                                                    data.date_init+"T09:00:00.000Z",
                                                                    data.date_init+"T10:00:00.000Z",
                                                                    data.date_init+"T11:00:00.000Z",
                                                                    data.date_init+"T12:00:00.000Z",
                                                                    data.date_init+"T13:00:00.000Z",
                                                                    data.date_init+"T14:00:00.000Z",
                                                                    data.date_init+"T15:00:00.000Z",
                                                                    data.date_init+"T16:00:00.000Z",
                                                                    data.date_init+"T17:00:00.000Z",
                                                                    data.date_init+"T18:00:00.000Z",
                                                                    data.date_init+"T19:00:00.000Z",
                                                                    data.date_init+"T20:00:00.000Z",
                                                                    data.date_init+"T21:00:00.000Z",
                                                                    data.date_init+"T22:00:00.000Z",
                                                                    data.date_init+"T23:00:00.000Z",
                                                                    data.date_end+"T00:00:00.000Z",
                                                                    data.date_end+"T01:00:00.000Z",
                                                                    data.date_end+"T01:30:00.000Z"
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
                    let valor = data.valor_total;
                    document.getElementById("sales_today").value = valor;
                    document.getElementById("revenue_month").value = valor;
                    document.getElementById("profit_month").value = valor;
                    document.getElementById("text_revenue_month").value = valor;
                    document.getElementById("text_profit_month").value = valor;
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