<?php
session_start();
include('../conecta.php');
include('../validacaoLogged.php');

$usuarioLog = $_SESSION['dados']['userLogado'];
$emailUserLog = $_SESSION['dados']['userEmail'];

$buscaDataAluno = "SELECT * FROM aluno WHERE nome= '$usuarioLog'";
$buscaDataUsuario = "SELECT * FROM usuario WHERE nome= '$usuarioLog'";
$resultAluno = $connectionDb->query($buscaDataAluno);
$resultUsuario = $connectionDb->query($buscaDataUsuario);

if (mysqli_num_rows($resultAluno) > 0) {
    while ($row = mysqli_fetch_assoc($resultAluno)) {
        $cpf = $row['cpf'];
        $endereco = $row['endereco'];
    }
}
if (mysqli_num_rows($resultUsuario) > 0) {
    while ($row2 = mysqli_fetch_assoc($resultUsuario)) {
        $email = $row2['email'];
        $nomeCompleto = $row2['nome'];
        $partes = explode(' ', $nomeCompleto, 2);
        $nome = $partes[0];
        $sobrenome = $partes[1];

    }
}

if (isset($_POST['nome'])) {
    $nomeMat = $_POST['nome'];
    $sobrenomeMat = $_POST['sobrenome'];
    $nomeCompleto = "$nome $sobrenome";
    $cpfMat = $_POST['cpf'];
    $emailMat = $_POST['email'];
    $senhaMat = sha1($_POST['senha']);
    $disciplinas_selecionadas = $_POST['disciplinas'];
    $idAluno = $_SESSION['dados']['aluno_id'];

    $busca2 = "SELECT * FROM aluno where cpf='$cpfMat'";
    $resultado2 = $connectionDb->query($busca2);
    $busca3 = "SELECT * FROM usuario where email='$emailMat'";
    $resultado3 = $connectionDb->query($busca3);

    if (mysqli_num_rows($resultado3) > 0) {

        foreach ($disciplinas_selecionadas as $disciplinas) {
            $sql_matricula = "INSERT INTO matricula (aluno_id, disciplina_id,datahora) VALUES ('$idAluno', '$disciplinas',NOW())";
            $connectionDb->query($sql_matricula);
        }
        $status = "<span style='color: #2dce89;'>Matrícula realizada com sucesso!</span>";

        echo "<style>
        .status{
            color: #2dce89; !important;
            display: inline !important;
        }</style>";

    } else {
        $status = "Erro ao matricular Aluno: " . $connectionDb->error;

        echo ' <style>
                .status{
                display: inline !important;
                }
            </style>';
    }

}
/////////////////////////////////////////////////////////




?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.ico">
    <title>
        Página de Matrícula
    </title>
    <!--     Fonts and icons     -->
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
    <link rel="shortcut icon" href="IFfavicon.ico" type="image/x-icon">
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

        .status {
            color: var(--bs-danger) !important;
            display: none;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100 faixa"></div>
    <!--Menu com opçoes ADM e Publico -->
    <?php include('../menu.php') ?>
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

        <div class="container-fluid py-3">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex ">
                            <h6>Matriculas</h6>
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center w-20">

                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="Busque a Matricula">
                                </div>

                            </div>
                            <a href="edit.php">
                                <button class="btn if-bg btn-sm  mt-4 btn_mais" name="novoRegistro">
                                    <i class="fa fa-plus" style="color: white;"></i>
                                </button>
                            </a>

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Alunos</th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                Data de Criação da Matricula </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Disciplinas Matriculadas
                                            </th>
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
        </div>

        </div>
        <footer class="footer pt-1">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center p-2">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="col-12 mx-auto text-center mt-1">
                            <p class="mb-0 text-secondary">
                                Copyright ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> feito por Enzo Rodrigues Pieroni.
                            </p>
                            <a class="text-if" href="https://www.formiga.ifmg.edu.br/" target="_blank">IFMG</a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </main>
    <script>
        function clamp(value, min, max) {
            if (value > max) return max;
            if (value < min) return min;
            return value;
        }

        function mascara_cpf(i) {
            var v = i.value;
            v = v.replace(/\D/g, "");
            v = v.replace(/^(\d{3})(\d)/, "$1.$2");
            v = v.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3");
            v = v.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d)/, "$1.$2.$3-$4");
            i.value = v.substring(0, clamp(v.length, 0, 14));
        }
    </script>
</body>

</html>