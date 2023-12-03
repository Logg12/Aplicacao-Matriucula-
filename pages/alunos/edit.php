<?php
include('../conecta.php');
include('../validacaoLogged.php');

//$nomeUsuarioAtual = $_SESSION['alunosData']['nome'];
$nomeCompleto = $_GET['nome'];
$partes = explode(' ', $nomeCompleto, 2);

$nome = $partes[0];
$sobrenome = $partes[1];
$email = $_GET['email'];
$cpf = $_GET['cpf'];
$endereco = $_GET['endereco'];


/////////////////// alteracao dados
if (isset($_POST['emailChange']) || isset($_POST['cpfChange']) || isset($_POST['sobrenomeChange']) || isset($_POST['nomeChange']) || isset($_POST['enderecoChange'])) {

    $emailChange = $_POST['emailChange'];
    $cpfChange = $_POST['cpfChange'];
    $sobrenomeChange = $_POST['sobrenomeChange'];
    $nomeChange = $_POST['nomeChange'];
    $enderecoChange = $_POST['enderecoChange'];
    $nomeUsuarioAtual = $_SESSION['dados']['userLogado'];


    $atualizarUsuario = "UPDATE usuario SET email = '$emailChange'
                         , nome = '$nomeChange $sobrenomeChange'  WHERE nome = '$nome'";
    $atualizarAluno = "UPDATE aluno SET nome = '$nomeChange $sobrenomeChange' 
                       , cpf = '$cpfChange' 
                       , endereco = '$enderecoChange'
                        WHERE nome = '$nome'";

    $queryAtualizacaoU = $connectionDb->query($atualizarUsuario);
    $queryAtualizacaoA = $connectionDb->query($atualizarAluno);

    if ($queryAtualizacaoA && $queryAtualizacaoU) {

        $status = "<span class = text-success>Modificações Atualizadas!</span>";
        echo "<style>
            .status{
                display: inline !important;
                  }
            </style>";
    } else {
        $status = "<span class = text-danger>Erro Na Modificação de Dados!</span>";
        echo "<style>
            .status{
                display: inline !important;
                  }
            </style>";
    }
}

/////////////////////// Alteração Senha

if (isset($_POST['passNew']) && isset($_POST['passOld']) && isset($_POST['passOld2'])) {
    $senhaNova = sha1($_POST['passNew']);
    $senhaAntiga = sha1($_POST['passOld']);
    $senhaAntiga2 = sha1($_POST['passOld2']);
    $senhaAtual = $_SESSION['dados']['senha'];

    if ($senhaAntiga === $senhaAntiga2) {
        if ($senhaAntiga === $senhaAtual) {

            $alterarSenha = "UPDATE usuario SET password = '$senhaNova' WHERE email = '$email'";

            if (mysqli_query($connectionDb, $alterarSenha)) {
                $status2 = "<span class = text-success>Senha Atualizada!</span>";
                echo "<style>
                                .status2{
                                    display: inline !important;
                                    }
                              </style>";
            } else {
                $status2 = "<span class = text-danger>Erro Na Atualização da Senha!</span>";
                echo "<style>
                                .status2{
                                    display: inline !important;
                                    }
                              </style>";
            }
        } else {
            $status2 = "<span class = text-danger>Antiga Senha Incorreta!</span>";
            echo "<style>
                        .status2{
                            display: inline !important;
                            }
                      </style>";
        }
    } else {
        $status2 = "<span class = text-danger>Senhas incoerentes!</span>";
        echo "<style>
                        .status2{
                            display: inline !important;
                            }
                      </style>";


    }
}

//////////////////////////// Editar Telefones

//$buscaTel = "Select aluno.nome,telefone.numero From aluno left Join telefone on telefone.aluno_id = aluno.id;"


if (isset($_POST['tel']) && is_array($_POST['tel']) && count($_POST['tel']) > 0) {
    $deleteTels = "DELETE FROM telefone WHERE aluno_id = $id";
    mysqli_query($connectionDb, $deleteTels);

    foreach ($telefones as $telefone) {
        $insertAllTels = "INSERT INTO telefone (aluno_id, numero) VALUES ($id, '$telefone')";
        mysqli_query($connectionDb, $insertAllTels);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.ico">
    <title>
        Meu Perfil
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .status {
            display: none;
        }

        .status2 {
            display: none;
        }

        .edit-bg-color {
            background-color: #4EA5D9;
            color: white;
        }

        .profile-card {
            background-color: #FDFDFD;
            box-shadow: 0px -1px 9px 4px rgba(0, 0, 0, 0.19);
        }

        .text-primary {
            color: #66d432 !important;
        }

        .text-gradient.text-primary {
            background-image: linear-gradient(310deg, #66d432 0%, #27712d 100%);
        }

        .if-bg {
            background-color: #5FAD41;
            color: white;
        }

        .if-bg:hover,
        .if-bg:focus {
            background-color: #31AD49;
            color: var(--bs-gray-200);
        }

        .color-mask {
            background-color: #27712d;
        }

        .edit-bg-color {
            background-color: #4EA5D9;
            color: white;
        }

        .edit-bg-color:hover,
        .edit-bg-color:focus {
            background-color: #2c8faf;
            color: white;
        }

        .form-check-input:checked[type="checkbox"] {
            background-image: linear-gradient(#31AD49, #31AD49);
        }


        .form-switch .form-check-input:checked {
            border-color: #66d432;
            background-color: #27712d;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #66d432;
            outline: 0;
            box-shadow: 0 3px 9px rgba(50, 50, 9, 0), 3px 4px 8px rgba(94, 114, 228, 0.1);
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100" id="bd">

    <div class="min-height-300 bg-primary position-absolute w-100 faixa"></div>

    <?php
    include('../menu.php');
    ?>

    <div class="main-content position-relative max-height-vh-100 h-100">

        <div class="p-4 pb-2 d-flex justify-content-end">
            <button id="menu-btn" class="btn if-bg-gradient-secondary d-block d-xl-none" onclick="trocar()"
                type="button">
                <i class="fa fa-list" style="color: white;"></i>
            </button>
        </div>

        <script>
            function trocar() {
                const body = document.querySelector("#bd");
                body.classList.toggle("g-sidenav-pinned");
                body.classList.toggle("g-sidenav-show");
                const btn_icon = document.querySelector("#menu-btn>i");
                btn_icon.classList.toggle("fa-list");
                btn_icon.classList.toggle("fa-close");
            }
        </script>

        <div class="card shadow-lg mx-4 card-profile-top profile-card">
            <div class="card-body p-3 flex-nowrap">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="../../assets/img/perfil.png" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">

                                <?php

                                echo ucwords("$nome $sobrenome") ?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                Tipo de perfil : Público
                            </p>
                        </div>
                    </div>

                    <div class="col-auto my-auto mx-auto flex-fill d-flex justify-content-end">
                        <div class="h-100 p-3">
                            <h5 class="mb-1" style="visibility: hidden;">
                                a
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                Ultimo acesso:
                                <?php
                                $emailLog = $_SESSION['dados']['userEmail'];
                                $buscaAcess = "SELECT ultimo_acesso FROM usuario WHERE email = '$emailLog'";
                                $searh = mysqli_query($connectionDb, $buscaAcess);

                                if (($searh->num_rows) > 0) {
                                    $linha = $searh->fetch_assoc();

                                    $ultimo_acesso = $linha['ultimo_acesso'];

                                    $formatar = new DateTime($ultimo_acesso);
                                    $formatada = date_format($formatar, 'd/m/Y H:i');
                                    echo "<b class=text-success>$formatada</b>";
                                }

                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-fluid">
                        <form method="post">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0">Editar perfil</p>
                                        <div class="ms-auto">
                                            <button class="btn edit-bg-color btn-sm me-2 reset-camps-2"
                                                onclick="ResetCamps1()">
                                                <i class="fa fa-undo"></i></button>
                                            <input type="submit" class="btn if-bg btn-sm ms-auto"" value = 'Salvar Alterações'>
                                        </div>

                                    </div>
                                </div>
                                <div class=" card-body">
                                            <p class="text-uppercase text-sm">Informações Principais</p>
                                            <p class="status">
                                                <?php echo $status ?>
                                            </p>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label">CPF</label>
                                                        <input class="form-control" type="number_format"
                                                            name="cpfChange" oninput="mascara_cpf(this)"
                                                            value="<?php echo $cpf; ?>" id="cpfInput" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label">Endereço de
                                                            Email</label>
                                                        <input class="form-control" name="emailChange" type="email"
                                                            value="<?php echo $email; ?>" id="emailInput" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label">Nome</label>
                                                        <input class="form-control" name="nomeChange" type="text"
                                                            value="<?php echo ucwords($nome); ?>" id="nomeInput"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label">Sobrenome</label>
                                                        <input class="form-control" name="sobrenomeChange" type="text"
                                                            value="<?php echo $sobrenome ?>" id="sobrenomeInput"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input"
                                                            class="form-control-label">Endereço</label>
                                                        <input class="form-control" type="text" name="enderecoChange"
                                                            value="<?php echo $endereco; ?>" id="enderecoInput"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-fluid">
                    <form method="post">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="text-uppercase text-sm">Ateração de senha</p>
                                    <div class="ms-auto">
                                        <button class="btn edit-bg-color btn-sm me-2 reset-camps-2"
                                            onclick="ResetCamps1()">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                        <input type="submit" class="btn if-bg btn-sm ms-auto"" value = 'Salvar Alterações'>
                                    </div>
                                </div>
                            </div>
                            <div class=" card-body ">

                                        <p class=" status2 mb-4">
                                        <?php echo $status2 ?>
                                        </p>
                                        <div class="row mx-auto d-flex justify-content-center">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Senha
                                                        Nova</label>
                                                    <input class="form-control passNew" type="text" name="passNew"
                                                        maxlength="6" placeholder="******" required
                                                        onblur="repetirSenha()">
                                                </div>
                                                <div class="form-group text-center">
                                                    <input type="password" name="passOld"
                                                        placeholder="Digite a senha antiga!"
                                                        class="form-control passOld" onblur="repetirSenha2()"
                                                        maxlength="6" required disabled>
                                                    <input type="password" name="passOld2"
                                                        placeholder="Repita a senha antiga!"
                                                        class="form-control mt-2 passOld2" maxlength="6" required
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
        </div>

        <div class=" container-fluid py-4">
            <div class="row">
                <div class="col-fluid">
                    <form method="post">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Editar telefones</p>

                                    <div class="ms-auto">
                                        <button class="btn edit-bg-color btn-sm me-2 reset-camps-1"
                                            onclick="ResetCamps2()"><i class="fa fa-undo"></i></button>
                                        <input class="btn if-bg btn-sm ms-auto" type="submit" value="Salvar Alterações">
                                    </div>
                                </div>
                                <p class=" status3 mb-4">
                                    <?php echo $status3 ?>
                                </p>

                            </div>
                            <div class="card-body card-tels">

                                <?php //A fazer?>

                                <button class="btn if-bg btn-sm ms-auto mt-4 btn_mais" onclick="criarTelArea()">
                                    <i class="fa fa-plus" style="color: white;"></i>
                                </button>


                            </div>

                        </div>
                    </form>
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
                                <a class="text-primary" href="https://www.formiga.ifmg.edu.br/">IFMG</a>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>
        </div>

        <div class="p-3"> </div>

    </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script src='./menu/menu_options.js'> </script>
    <script>
        perfil_opt.classList.toggle('active');
    </script>

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

        function mascara_telefone(i) {
            i.setCustomValidity("");
            var value = i.value;

            // Verificar se o valor já está formatado
            if (/^\(\d{2}\) \d \d{4}-\d{4}$/.test(value)) {
                return;
            }

            // Remover todos os caracteres não numéricos
            value = value.replace(/\D/g, '');

            // Adicionar parênteses e espaços
            value = value.replace(/(\d{2})(\d)/, "($1) $2");

            // Adicionar espaço entre o dígito 9 e o próximo dígito
            value = value.replace(/(\d)(\d{4})/, "$1 $2");

            // Adicionar hífen entre os últimos quatro dígitos
            value = value.replace(/(\d{4})(\d)/, "$1-$2");

            // Limitar o comprimento do valor
            i.value = value.substring(0, clamp(value.length, 0, 16));
        }


        function ResetCamps1() {
            let email = document.getElementById('emailInput');
            let nome = document.getElementById('nomeInput');
            let sobrenome = document.getElementById('sobrenomeInput');
            let cpf = document.getElementById('cpfInput');
            let endereco = document.getElementById('enderecoInput');
            email.value = "";
            nome.value = "";
            sobrenome.value = "";
            cpf.value = "";
            endereco.value = "";
        }



        function criarTelArea() {


            var rowDiv = document.createElement('div');
            rowDiv.className = 'row';

            var colDiv1 = document.createElement('div');
            colDiv1.className = 'col-md-4';

            var formGroup1 = document.createElement('div');
            formGroup1.className = 'form-group';

            var label1 = document.createElement('label');
            label1.setAttribute('for', 'example-text-input');
            label1.className = 'form-control-label';
            label1.textContent = 'Telefone Novo!';

            var inputTel1 = document.createElement('input');
            inputTel1.className = 'form-control tels';
            inputTel1.id = 'numtel1';
            inputTel1.type = 'number_format';
            inputTel1.setAttribute('oninput', 'mascara_telefone(this)');
            inputTel1.placeholder = '(37) 11111-1111';
            inputTel1.required = true;

            formGroup1.appendChild(label1);
            formGroup1.appendChild(inputTel1);
            colDiv1.appendChild(formGroup1);

            var colDiv2 = document.createElement("div");
            colDiv2.classList.add("col-sm-1", "d-flex", "justify-content-center", "align-items-center");

            var divFormRadio = document.createElement("div");
            divFormRadio.classList.add("form-check", "form-check-info", "text-start", "d-flex",
                "justify-content-center",
                "align-items-center");

            var inputRadio = document.createElement("input");
            inputRadio.classList.add("form-check-input");
            inputRadio.setAttribute("type", "checkbox");
            inputRadio.setAttribute("value", "");

            divFormRadio.appendChild(inputRadio);

            colDiv2.appendChild(divFormRadio);

            var colDiv3 = document.createElement('div');
            colDiv3.className = 'col-md-3 ms-auto my-2';

            var trashButton = document.createElement('button');
            trashButton.className = 'btn bg-warning btn-sm mt-4 ms-5';

            var trashIcon = document.createElement('i');
            trashIcon.className = 'fa fa-trash';
            trashIcon.style.color = 'white';
            trashIcon.style.width = '1rem';

            trashButton.appendChild(trashIcon);
            colDiv3.appendChild(trashButton);

            rowDiv.appendChild(colDiv1);
            rowDiv.appendChild(colDiv2);
            rowDiv.appendChild(colDiv3);

            var cardTelsDiv = document.querySelector('.card-tels');
            var btn = document.querySelector('.btn_mais');

            var hr = document.createElement('hr');
            hr.className = 'horizontal dark mt-0';

            cardTelsDiv.insertBefore(rowDiv, btn);
            cardTelsDiv.insertBefore(hr, rowDiv);

        }


        function repetirSenha() {
            var senhaOld = document.querySelector('.passOld');
            var senhanew = document.querySelector('.passNew');
            if (senhanew.value.trim() !== '') {
                senhaOld.removeAttribute('disabled');
            }
        }

        function repetirSenha2() {
            var senhaOld = document.querySelector('.passOld');
            var senhaOld2 = document.querySelector('.passOld2');
            if (senhaOld.value.trim() !== '') {
                senhaOld2.removeAttribute('disabled');
            }
        }
    </script>

    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>