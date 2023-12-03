<?php
include('../conecta.php');
include('../validacaoLogged.php');
include('../validacaoADM.php');


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7d5da11ccc.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100 faixa"></div>

    <?php include('../menu.php') ?>

    <main class="main-content position-relative border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                            <?php
                            $pageName = basename($_SERVER['PHP_SELF'], '.php');
                            echo ucwords($pageName);
                            ?>
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        <?php
                        $pageName = basename($_SERVER['PHP_SELF'], '.php');
                        echo ucwords($pageName);
                        ?>
                    </h6>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <!-- barra -->
                    </div>
                    <!-- icone de perfil -->
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none"><b>
                                        ADMIN
                                    </b></span>
                            </a>
                        </li>

                        <!-- icone de config -->
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex ">
                            <h6>Disciplinas</h6>
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center w-20">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="Busque a Disciplina">
                                </div>
                            </div>
                            <button class="btn if-bg btn-sm  mt-4 btn_mais" name="novoRegistro"
                                onclick="criarTelArea()">
                                <i class="fa fa-plus" style="color: white;"></i>
                            </button>

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Nome da Disciplina</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-0">
                                                Carga Horária</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Sigla da Disciplina</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Descrição</th>

                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php include('create.php') ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="py-3 my-4">
                <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                    <li class="nav-item"><a href="dashboard-base.php"
                            class="nav-link px-2 text-muted">Dashboard-Base</a></li>
                    <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Página de Login</a></li>
                    <li class="nav-item"><a href="https://www.formiga.ifmg.edu.br" class="nav-link px-2 text-muted"
                            target="_blank">Página do IFMG Campus Formiga</a></li>

                </ul>
                <p class="text-center text-muted">© Copyright 2023 Feito por Enzo Pieroni. Todos os direitos
                    reservados.<br> Desenvolvido com <a href="https://getbootstrap.com" target="_blank"><span
                            style="color: #6f42c1;"><b>Bootstrap</b></span></a> - <a
                        href="https://www.formiga.ifmg.edu.br"><span style="color:#32A041 ;"><b>IFMG</b></span></a></p>
            </footer>
        </div>
    </main>
    <div class="fixed-plugin">

        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Menu de Configurações</h5>
                    <p>Configurações:</p>
                </div>
                <div class="float-end mt-4">
                    <a class="text-dark p-0 fixed-plugin-close-button cursor-pointer">
                        <i class="fa fa-close"></i>
                    </a>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto body-sidebar">
                <!-- Sidebar Backgrounds -->
                <div class="mt-3">
                    <a href="../index.php">
                        <h6 class="mb-0">Efetuar Logout <i class="fas fa-sign-out-alt" style="color: #d90202;"></i></h6>
                        <p class="text-sm">Sair da conta ou fazer login com outra conta. </p>
                        <?php session_abort(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>



    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <script src="../../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>