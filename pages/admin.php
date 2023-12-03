<?php
include('conecta.php');
include('validacaoLogged.php');
include('validacaoADM.php');

$usuarioLog = $_SESSION['dados']['userLogado'];


//busca por quantidade de usuarios
$numbU = "SELECT COUNT(*) as total_usuarios FROM usuario";
$numberUORerror = '';
$resultado1 = $connectionDb->query($numbU);
if ($resultado1) {
    $row = $resultado1->fetch_assoc();
    $totalUsuarios = $row['total_usuarios'];
    $numberUORerror = $totalUsuarios;
} else {
    $numberORerror = "Erro na Consulta no BD: " . $connectionDb->error;
}

//busca por quantidade de alunos
$numbA = "SELECT COUNT(*) as total_alunos FROM aluno";
$numberAORerror = '';
$resultado2 = $connectionDb->query($numbA);
if ($resultado2) {
    $row = $resultado2->fetch_assoc();
    $totalAlunos = $row['total_alunos'];
    $numberAORerror = $totalAlunos;
} else {
    $numberAORerror = "Erro na Consulta no BD: " . $connectionDb->error;
}
//busca por quanidade de disciplinas
$numbD = "SELECT COUNT(*) as total_disciplina FROM disciplina";
$numberDORerror = '';
$resultado3 = $connectionDb->query($numbD);
if ($resultado3) {
    $row = $resultado3->fetch_assoc();
    $totalDisciplina = $row['total_disciplina'];
    $numberDORerror = $totalDisciplina;
} else {
    $numberDORerror = "Erro na Consulta no BD: " . $connectionDb->error;
}
//busca por quantidade de matriculas
$numbM = "SELECT COUNT(*) as total_matricula FROM matricula";
$numberMORerror = '';
$resultado4 = $connectionDb->query($numbM);
if ($resultado4) {
    $row = $resultado4->fetch_assoc();
    $totalMatricula = $row['total_matricula'];
    $numberMORerror = $totalMatricula;
} else {
    $numberMORerror = "Erro na Consulta no BD: " . $connectionDb->error;
}

$buscaGrafico = "SELECT YEAR(datahora_criacao) AS ano, MONTH(datahora_criacao) AS mes, COUNT(*) AS quantidade 
                FROM usuario 
                GROUP BY ano, mes 
                ORDER BY ano, mes";

$resultadoBusca = $connectionDb->query($buscaGrafico);

$anosEmeses = [];
$quantidades = [];

if (mysqli_num_rows($resultadoBusca) > 0) {
    while ($row = $resultadoBusca->fetch_assoc()) {

        //Subsituindo os valores da busca por nome dos meses
        switch ($row['mes']) {
            case 1:
                $row['mes'] = 'Jan';
                break;
            case 2:
                $row['mes'] = 'Fev';
                break;
            case 3:
                $row['mes'] = 'Mar';
                break;
            case 4:
                $row['mes'] = 'Abr';
                break;
            case 5:
                $row['mes'] = 'Mai';
                break;
            case 6:
                $row['mes'] = 'Jun';
                break;
            case 7:
                $row['mes'] = 'Jul';
                break;
            case 8:
                $row['mes'] = 'Ago';
                break;
            case 9:
                $row['mes'] = 'Set';
                break;
            case 10:
                $row['mes'] = 'Out';
                break;
            case 11:
                $row['mes'] = 'Nov';
                break;
            case 12:
                $row['mes'] = 'Dez';
                break;
        }
        $mes = $row['mes'];
        $anoMes = $mes . ' de ' . $row['ano'];
        $anosEmeses[] = $anoMes;
        $quantidades[] = $row['quantidade'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <title>
        Página de Admin
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .sidenavX {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-vertical .navbar-brand>img,
        .navbar-vertical .navbar-brand-img {
            max-width: 100%;
            max-height: fit-content !important;
        }

        .faixa {
            background-image: linear-gradient(to left, #32A041, green) !important;

        }

        .body-sidebar {
            border: 1px solid #00000026 !important;
            border-radius: 15px !important;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100 faixa"></div>
    <!--Menu com opçoes ADM e Publico -->
    <?php include('menu.php') ?>
    <!--Fim do Menu -->
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
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
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row mt-4">

                <!--Card Usuario -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" src="../assets/img/perfil.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Número de Usuários :</b>
                                <?php echo $numberUORerror; ?> <br>
                                <small>Número atual de "Usuários" cadastrados no sistema.</small>
                            </p>
                        </div>
                    </div>
                </div>

                <!--Card Aluno -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" src="../assets/img/perfil-aluno.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Número de Alunos :</b>
                                <?php echo $numberAORerror; ?><br>
                                <small>Número atual de "Alunos" cadastrados no sistema.</small>
                            </p>
                        </div>
                    </div>
                </div>

                <!--Card Disciplina -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" src="../assets/img/perfil-disciplina.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Número de Disciplinas :</b>
                                <?php echo $numberDORerror; ?><br>
                                <small>Número atual de "Disciplinas" cadastrados no sistema.</small>
                            </p>
                        </div>
                    </div>
                </div>

                <!--Card Disciplina -->
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card" style="width: 17rem;">
                        <img class="card-img-top" src="../assets/img/perfil-matricula.png" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                                <b>Número de Matrículas :</b>
                                <?php echo $numberMORerror; ?><br>
                                <small>Número atual de "Matrículas" cadastrados no sistema.</small>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <!--Card Grafico -->
            <div class="row mt-4 d-flex justify-content-center align-items-center">
                <div class="col-lg-7 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6>Quantidade de Usuários criados<br> Por mês em cada ano</h6>
                            <p class="text-sm mb-0">
                                <i class="fa-solid text-success fa-address-book"></i>
                                Quantidade de usuarios
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300"
                                    style="display: block; box-sizing: border-box; height: 300px; width: 477.8px;"
                                    width="477"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Rodapé Copyright -->
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
            <!-- Fim do Rodapé -->
        </div>
    </main>

    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
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

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, '#aad576');
        gradientStroke1.addColorStop(0.2, '#a6c48a');
        gradientStroke1.addColorStop(0, '#f0fff1');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: <?php echo json_encode($anosEmeses); ?>,
                datasets: [{
                    label: "Quantidade",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3e8914",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: <?php echo json_encode($quantidades); ?>,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>