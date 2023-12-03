<?php
include('conecta.php');
include('validacaoLogged.php');

$usuarioLog = $_SESSION['dados']['userLogado'];
$emailUserLog = $_SESSION['dados']['userEmail'];
$id = $_SESSION['dados']['aluno_id'];

$aluno = "SELECT * FROM aluno where id = '$id'";
$resultadoAluno = mysqli_query($connectionDb, $aluno);
if ($resultadoAluno) {
    $row = mysqli_fetch_assoc($resultadoAluno);
    $cpf = $row['cpf'];
    $dataOriginal = $row['datahora'];
    $dataObjeto = new DateTime($dataOriginal);
    $data = $dataObjeto->format('d/m/Y - H:i');
}

$materias = "SELECT * FROM matricula WHERE aluno_id = '$aluno_id'";
$resultMateria = mysqli_query($connectionDb, $materias);


if ($resultMateria) {
    $row2 = mysqli_fetch_assoc($resultMateria);
    $disciplina_id = $row2['disciplina_id'];
}

$disciplina = "SELECT nome FROM disciplina WHERE ="

    ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.9.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <title>
        Página de Usuário
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
                                        <?php echo $usuarioLog ?>
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
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-xl-7 col-sm-6 mb-xl-0 mb-4">
                    <?php
                    $matricula = "SELECT * From matricula where aluno_id = $id";
                    $queryMatricula = mysqli_query($connectionDb, $matricula);
                    if ($queryMatricula) {
                        if (mysqli_num_rows($queryMatricula) > 0) {
                            $var = "<div class='card'>
                                <div class='card-header p-3 pt-2 ps-4 bg-white d-flex justify-content-start flex-column'>
        
                                    <img src='/aplicacao/assets/img/logoIF.png' style='width:25%' alt='Logo IFMG'>
                                    <h1 class='h2 text-if-secondary'>Dashboard - Sistema IFMG</h1>
                                    
                                </div>
                                <div class='card-body p-3'>
                                    <div class='form-group row d-flex justify-content-center align-items-center  '>
                                        <div class='col-sm-11 d-flex justify-content-center align-items-center  '>
                                            <h5 class='me-auto'>
                                                Nome
                                                :
                                                <span class='text-if'>
                                                    $usuarioLog
                                            </h5>
                                            <h5>
                                                Email
                                                :
                                                <span class='text-if'>
                                                    $emailUserLog
                                            </h5>
                                        </div>
                                    </div>
                                    <div class='form-group row d-flex justify-content-center align-items-center  '>
                                        <div class='col-sm-11 d-flex justify-content-center align-items-center '>
                                            <h5 class='me-auto'>
                                                CPF
                                                :
                                                <span class='text-if'>
                                                    $cpf
                                            </h5>
                                            <h6>
                                                Data da Emissão da Matricula
                                                :
                                                <span class='text-if'>
                                                    $data
                                            </h6>
                                        </div>
                                    </div>
        
        
                                    <div class='form-group row  d-flex justify-content-center align-items-center'>
        
                                        <div class='col-sm-11'>
                                            <table class='table  caption-top '>
                                                <caption><b>Disicplinas Matriculadas</b></caption>
                                                <thead class='table-light'>
                                                    <td class='text-center'>Disicplinas</td>
                                                </thead>";
                            $var .= '<tbody>';
                            ob_start();
                            include('materiasMatriculadas.php');
                            $var .= ob_get_clean();
                            $var .= "</tbody>
                                            </table>
                                        </div>
        
        
                                    </div>
        
        
                                </div>
        
                            </div>";
                        } else {
                            $var = "<div class='card'>
                    <div class='card-header p-3 pt-2 ps-4 bg-white d-flex justify-content-start flex-column'>

                        <img src='/aplicacao/assets/img/logoIF.png' style='width:25%' alt='Logo IFMG'>
                        <h1 class='h2 text-if-secondary'>Dashboard - Sistema IFMG</h1>
                        
                </div>
                <div class='card-body p-3'>
                    <div class='form-group row d-flex justify-content-center align-items-center  '>
                    <div class='col-sm-11 text-center'>
    <h4 class='me-auto  text-danger'>
        <b>
            Você ainda não está matriculado <br>
            Faça a matrícula agora!
        </b>
    </h4>
</div>
            </div>

        </div>
        </div>";
                        }

                        echo $var;
                    }
                    ?>

                </div>
            </div>
            <!-- Rodapé Copyright -->

            <!-- Fim do Rodapé -->
        </div>
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="dashboard-base.php" class="nav-link px-2 text-muted">Dashboard-Base</a>
                </li>
                <li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Página de Login</a></li>
                <li class="nav-item"><a href="https://www.formiga.ifmg.edu.br" class="nav-link px-2 text-muted"
                        target="_blank">Página do IFMG Campus Formiga</a></li>

            </ul>
            <p class="text-center text-muted">© Copyright 2023 Feito por Enzo Pieroni. Todos os direitos
                reservados.<br> Desenvolvido com <a href="https://getbootstrap.com" target="_blank"><span
                        style="color: #6f42c1;"><b>Bootstrap</b></span></a> - <a
                    href="https://www.formiga.ifmg.edu.br"><span style="color:#32A041 ;"><b>IFMG</b></span></a></p>
        </footer>
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
                    </a>>
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