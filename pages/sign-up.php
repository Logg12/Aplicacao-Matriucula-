<?php
include('conecta.php');
$status = "<span style= display: inline !important >Faça o seu Registro!</span>"; //Mensagem de status padrão

if (isset($_POST['email'])) {
    $user = $_POST['nome'];
    $email = $_POST['email'];
    $password = sha1($_POST['senha']);
    $cpf = $_POST['CPF'];
    $endereco = $_POST['endereco'];
    $dataNasc = $_POST['dateBirth'];
    $tel = $_POST['telefone'];
    $zap = $_POST['whatsapp'];

    //consulta sql para verificação de email igual
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($connectionDb, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        //echo 'Email ja cadastrado'; //debug
        $status = "Erro! Email ja cadastrado."; //definir status de erro

        echo ' <style>
            .status{
                    display: inline !important;
                    }
                </style>';
    } else { //Se não tem email duplicado e se todos os campos estiverem preenchidos
        ///////////////////////////////////////////////////////////
        //Registro do aluno se o cpf for válido

        $regex = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/"; //Regex para formatação padrão de cpf

        // Valida o CPF usando o regex no filter_var
        if (filter_var($cpf, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $regex)))) {
            $sqlA = "INSERT INTO aluno (nome,data_nascimento,cpf,endereco)
                VALUES ('$user','$dataNasc','$cpf','$endereco')";

            $resultado = mysqli_query($connectionDb, $sqlA);
        } else {
            $status = "Erro! CPF Inválido";
            echo ' <style>
            .status{ 
                display: inline !important;
                }
          </style>'; //mensagem de erro de cpf
        }


        //definir hora de criação de acordo com hórario de SP
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $dataAtual = new DateTime('now', $timezone);
        $formatado = $dataAtual->format('Y/m/d H:i:s');
        $id = 0;
        //busca pelo id da tabela aluno pelo nome
        $sqlID = "SELECT id FROM aluno WHERE nome = '$user'";
        $resultado = mysqli_query($connectionDb, $sqlID);

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            // Define o valor da variável com o "id"
            $id = $row['id'];

            $sqlU = "INSERT INTO usuario (aluno_id,nome, email, password, datahora_criacao, datahora_atualizacao, ultimo_acesso)
                  VALUES ($id,'$user', '$email', '$password',NOW(), NOW(), null)";

            $resultado = mysqli_query($connectionDb, $sqlU);

            if (isset($zap)) {
                $sqlTel = "INSERT INTO telefone (aluno_id,numero, whatsapp)
              VALUES ($id,'$tel',true)";

                $resultado = mysqli_query($connectionDb, $sqlTel);
            } else {
                $sqlTel = "INSERT INTO telefone (aluno_id,numero, whatsapp)
              VALUES ($id,'$tel',false)";

                $resultado = mysqli_query($connectionDb, $sqlTel);
            }

            $status = '<span style="color: #2dce89;">Sucesso! Registro Criado.</span>';
            echo '<style>
        .status{
          color: #2dce89; !important;
          display: inline !important;
        }</style>';
        } else {

            $status = "Erro! Nenhum resultado.";

            echo ' <style>
                  .status{
                    display: inline !important;
                      }
                </style>';
        }

    }

    $connectionDb->close();
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
        Registro de Usuário
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
    .sombra {
        text-shadow: 3px 3px 18px rgba(0, 0, 0, 1);
    }

    .status {
        color: var(--bs-danger) !important;
        display: none;
    }

    .card-body {
        border: 1px solid #00000026 !important;
        border-radius: 15px !important;
        box-shadow: 0px 3px 6px -2px rgba(0, 0, 0, 0.46);
        -webkit-box-shadow: 0px 3px 6px -2px rgba(0, 0, 0, 0.46);
        -moz-box-shadow: 0px 3px 6px -2px rgba(0, 0, 0, 0.46);
    }

    .card-fix {
        padding: 0.3%;
    }

    #telCamp {
        width: 80% !important;

    }

    .telArea {
        display: flex;
        height: 50px !important;
        justify-content: center;
        align-items: center;
        margin: 0 !important;
    }

    #whatsapp {
        border: 1px solid #d2d6da !important;
        border-radius: 0.5rem;
        width: 80%;
        height: 80%;
        margin: 0 auto;
    }

    #zapzap {
        width: 20%;
    }

    input[type="checkbox"][id^="whatsapp"] {
        display: none;
    }

    label {
        border: 1px solid #fff;
        padding: 10px;
        display: block;
        position: relative;
        margin: 10px;
        cursor: pointer;
    }

    label:before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid grey;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
    }

    label img {
        position: relative;
        height: 30px;
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
    }

    :checked+label {
        border-color: #ddd;
    }

    :checked+label:before {
        content: "✓";
        background-color: grey;
        transform: scale(1);
    }

    :checked+label img {
        transform: scale(0.9);
        /* box-shadow: 0 0 5px #333; */
        z-index: -1;
    }
    </style>
</head>

<body class="">

    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('../assets/img/_78d22663-0ab2-4721-904b-275711dcc80d.jpg '); background-position: center; background-size: 90%;">

            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5 sombra">Bem Vindo!</h1>
                        <h5 class="text-lead text-white sombra">Faça o registro da sua conta para usar os nossos
                            recursos!</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center card-fix">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">



                        <div class="card-body ">
                            <form role="form" method="POST">

                                <div class="mb-3"
                                    style="display: flex; justify-content: center; align-items: center; flex-direction:column;">
                                    <img src="../assets/img/Logo IFMG.png" style="width:30%" alt="">
                                    <h4 style="color: #32A041; font-weight: bold;">Formulário de Registro</h4>
                                </div>
                                <div class="mb-3">
                                    <p class="status">
                                        <?php echo $status ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Nome Completo"
                                        aria-label="Name" name="nome" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email"
                                        name="email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Senha"
                                        aria-label="Password" name="senha" minlength="6" required>
                                </div>

                                <div class="mb-3 telArea">
                                    <input type="text" class="form-control" placeholder="Telefone" aria-label="telefone"
                                        name="telefone" maxlength="16" id="telCamp">

                                    <div id="zapzap">
                                        <input type="checkbox" placeholder="whatsapp" aria-label="whatsapp"
                                            name="whatsapp" id="whatsapp">
                                        <label for="whatsapp">
                                            <img src="../assets/img/whatsapp (1).png" alt="">
                                        </label>

                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="dateBirth">Data de Nascimento :</label>
                                    <input type="date" class="form-control" name="dateBirth" id="data" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" maxlength="14" autocomplete="off" class="form-control"
                                        id="cpfArea" placeholder="CPF: 123.456.789-10" name="CPF" required>
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Endereço: Rua Almeida"
                                        name="endereco" required>
                                </div>

                                <div class="text-center">
                                    <input type="submit" class="btn bg-success w-100 my-4 mb-2 text-white"
                                        value="Fazer Cadasto">
                                </div>
                                <p class="text-sm mt-3 mb-0">Já tem uma conta criada? <a href="../index.php"
                                        class="text-dark font-weight-bolder">Faça Login</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <script>
    ////////////////////////////////
    //validação e formatação do campo de nascimento
    var dataAtual = new Date();

    var dataMin = new Date(dataAtual);
    dataMin.setFullYear(dataAtual.getFullYear() - 20);

    var dataMax = new Date(dataAtual);
    dataMax.setFullYear(dataAtual.getFullYear() - 13);

    var minData = dataMin.toISOString().split('T')[0];
    var maxData = dataMax.toISOString().split('T')[0];

    document.getElementById('data').setAttribute('min', minData);
    document.getElementById('data').setAttribute('max', maxData);

    //////////////////////////////////////////////////////////////
    //validação e formatação cpf

    const cpfCamp = document.querySelector('#cpfArea');

    cpfCamp.addEventListener('keypress', () => {

        let sizeofCPF = cpfCamp.value.length;

        if (sizeofCPF === 3 || sizeofCPF === 7) {
            cpfCamp.value += '.';
        } else if (sizeofCPF == 11) {
            cpfCamp.value += '-';
        }
    })
    cpfCamp.addEventListener('input', () => {
        let cpfValue = cpfCamp.value;
        let cpf = cpfCamp.length;
        let formatar = cpfValue.replace(/[^0-9.\-]/, '');
        cpfCamp.value = formatar;
    })
    ////////////////////////////////////////////////////////////
    //formatação num tel

    const telCamp = document.querySelector('#telCamp');
    telCamp.addEventListener('keypress', () => {
        let sizeOfTel = telCamp.value.length;
        if (sizeOfTel === 2) {
            telCamp.value = '(' + telCamp.value + ') ';
        } else if (sizeOfTel === 6) {
            telCamp.value += ' ';
        } else if (sizeOfTel === 11) {
            telCamp.value += '-'
        }
    })
    </script>
</body>

</html>