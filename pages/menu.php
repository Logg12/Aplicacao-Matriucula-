<?php
if (isset($_SESSION['dados']['logado'])) {
  //imprime configurações de estilo e importação de icones
  echo '<style>
    .sidenavX{
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: collumn;
    }
    .navbar-vertical .navbar-brand>img, .navbar-vertical .navbar-brand-img {
      max-width: 100% !important;
      max-height: fit-content !important ;
    }
    .faixa{
      background-image: linear-gradient(to left,#32A041,green) !important;
    }
    .if-bg {
      background-color: #5FAD41 !important;
      color: white !important;
  }

  .if-bg:hover,
  .if-bg:focus {
      background-color: #31AD49 !important;
      color: var(--bs-gray-200) !important;
  }
    
  </style>
  <script src="https://kit.fontawesome.com/7d5da11ccc.js" crossorigin="anonymous"></script>
  ';
  ////////////////////////////////////////////////////////
  if (($_SESSION['dados']['tipoUser'] === "administrativo")) {
    //Menu para ADMIN
    echo '
   <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header sidenavX" >
      <a class="navbar-brand m-0" href="https://www.formiga.ifmg.edu.br" target="_blank">
        <img src="\aplicacao\assets\img\logoIF.png" class="navbar-brand-img h-100" alt="main_logo"> <br>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="/aplicacao/pages/admin.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/aplicacao/pages/alunos/index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users text-success text-sm opacity-10"></i> 
            </div>
            <span class="nav-link-text ms-1">Alunos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/aplicacao/pages/disciplinas/index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-book text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Disciplina</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/aplicacao/pages/matriculas-Adm/matriculas.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-address-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Matrículas</span> 
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/aplicacao/pages/usuarios/index.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-user text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Usuários</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-list-ul text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Relatórios</span>
          </a>
        </li>
        <hr class="horizontal dark my-sm-2">
        <li class="nav-item">
          <a class="nav-link " href="#">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-1 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-square-xmark text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Excluir Tudo</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="\aplicacao\assets\img\illustrations\icon-documentation.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Quer ficar por dentro?</h6>
                    <p class="text-xs font-weight-bold mb-0">Acesse o nosso último edital!</p>
                </div>
            </div>
        </div>
        <a href="https://docs.google.com/document/d/1Qc44qdVxZR1rtyE94VR1zGwMK6hrEp0kKwe5Vi3Tj3Y/edit" target="_blank"
            class="btn if-bg btn-sm w-100 mb-3">Edital 2023-03</a>
    </div>
   </aside>';
    //fim do menu ADMIN
  } else if (($_SESSION['dados']['tipoUser'] === "público")) {
    //Menu PUBLICO
    echo '<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header sidenavX" >
      <a class="navbar-brand m-0" href="https://www.formiga.ifmg.edu.br" target="_blank">
        <img src="/aplicacao/assets/img/logoIF.png" class="navbar-brand-img h-100" alt="main_logo">
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="/aplicacao/pages/dashboard.php" id="dashboard_opt">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/aplicacao/pages/matriculas-user/matricula.php" id="efetuar_matricula_opt">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Efetuar Matrícula</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#" id="relatorios_opt">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list-ul text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Relatórios</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Opções de conta</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/aplicacao/pages/student_profile.php" id="perfil_opt">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Perfil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/aplicacao/index.php">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bold-left text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sair</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-plain shadow-none" id="sidenavCard">
            <img class="w-50 mx-auto" src="/aplicacao/assets/img/illustrations/icon-documentation.svg"
                alt="sidebar_illustration">
            <div class="card-body text-center p-3 w-100 pt-0">
                <div class="docs-info">
                    <h6 class="mb-0">Quer ficar por dentro?</h6>
                    <p class="text-xs font-weight-bold mb-0">Acesse o nosso último edital!</p>
                </div>
            </div>
        </div>
        <a href="https://docs.google.com/document/d/1Qc44qdVxZR1rtyE94VR1zGwMK6hrEp0kKwe5Vi3Tj3Y/edit" target="_blank"
            class="btn if-bg btn-sm w-100 mb-3">Edital 2023-03</a>
    </div>
</aside>';
    //fim do menu PUBLICO
  }
}

?>