<!DOCTYPE html>
<html lang="en">

<?php
include_once '../../../assets/html/head.html';
?>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">

                                        <h5 class="card-title text-center pb-0 fs-4">
                                            <img src="../../../assets/img/favicon.png" /><br>
                                            Painel Administrador
                                        </h5>
                                        <p class="text-center small">Informe seu <b>nome de usuário</b> e <b>senha</b>.</p>
                                    </div>

                                    <form class="row g-3 needs-validation" action="../../controllers/AccessAdminController.php" method="POST" novalidate>
                                        <input type="hidden" name="access_admin" value="true">
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Nome de usuário</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                                <input type="text" name="admin_user" class="form-control" required>
                                                <div class="invalid-feedback">Campo Obrigatório</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Senha</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                <input type="password" name="admin_password" class="form-control" required>
                                                <div class="invalid-feedback">Campo Obrigatório</div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Acessar</button>
                                            <a class="btn btn-secondary w-100 mt-2" href="./tables.php" type="button" >Voltar</a>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?php
    include_once '../../../assets/html/scripts.html';
    ?>

</body>

</html>