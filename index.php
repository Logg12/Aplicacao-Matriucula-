<?php
include('pages/conecta.php');

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $senha = sha1($_POST['password']);
    $usuario = "";
    define('EMAIL_ADM', 'admin@admin.com');
    define('SENHA_ADM', sha1('Senha@123'));

    $sql = "SELECT * FROM usuario WHERE email = '$email' AND password = '$senha'";
    $resultado = mysqli_query($connectionDb, $sql);
    //
    if (($email === EMAIL_ADM and $senha === SENHA_ADM)) {
        session_start();
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            $usuarioLogado = $row['nome'];
            $_SESSION['dados'] = [
                'logado' => true,
                'userLogado' => $usuarioLogado,
                'userEmail' => $email,
                'tipoUser' => 'administrativo',
                'senha' => $senha
            ];
            header("Location: pages/admin.php");
            exit();

        }
    } else if (mysqli_num_rows($resultado) > 0) {
        session_start();
        $row = $resultado->fetch_assoc();
        $usuarioLogado = $row['nome'];
        $id = $row['aluno_id'];
        $_SESSION['dados'] = [
            'logado' => true,
            'userLogado' => $usuarioLogado,
            'userEmail' => $email,
            'tipoUser' => 'público',
            'senha' => $senha,
            'aluno_id' => $id

        ];
        //Pegar data atual para atualizar o campo  ultimo acesso
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $dataAtual = new DateTime('now', $timezone);
        $formatado = $dataAtual->format('Y/m/d H:i:s');

        $updateAcess = "UPDATE usuario SET ultimo_acesso ='$formatado' WHERE email = '$email'";
        if (mysqli_query($connectionDb, $updateAcess)) {
            header("Location: pages/dashboard.php");
            exit();
        }
    } else {
        echo "
    <script>
     console.log('Acesso Negado');
     var btn = document.getElementbyId('
    </script>";
        $status = 'Email ou senha inválidos';
        echo "<style>
      .status{
        display: inline !important;
      } 
    </style>";
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <title>
        Login Page
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
    .status {
        color: var(--bs-danger) !important;
        font-weight: 400 !important;
        display: none;
    }
    </style>
</head>

<body class="">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->

                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">

                                <div class="card-header pb-0 text-start">
                                    <h2 class="font-weight-bolder text-success">Login</h2>
                                    <p class="mb-0">Entre com seu email e senha para logar!</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="">
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email"
                                                aria-label="Email" name="email">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" aria-label="Password" name="password"
                                                minlength="6">
                                        </div>

                                        <div class="text-center">
                                            <input type="submit" id="login"
                                                class="btn btn-lg btn-primary bg-success btn-lg w-100 mt-4 mb-0"
                                                value="Fazer Login">
                                            <p class="status">
                                                <?php echo $status ?>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Não tem uma conta criada?
                                        <a href="pages/sign-up.php"
                                            class="text-primary text-gradient font-weight-bold">Criar conta</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('assets/img/ifmg\ -\ ia.jpg');
          background-size: cover;">
                                <span class="mask opacity-6"></span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
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
    <script src="assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>


</html>