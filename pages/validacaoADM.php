<?php
if (isset($_SESSION['dados']['logado'])) {
  if (!($_SESSION['dados']['userEmail'] === "admin@admin.com")) {

    echo "<script>
        
        window.onload = ()=>{
            Swal.fire({
                title: 'Erro',
                text: 'Você precisa estar logado como Administrador para acessar à estes recursos!',
                icon: 'error',
                confirmButtonText: 'Logar como Administrador',
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = '../index.php';
                } else if (result.isDenied) {
                    window.location.href = '../index.php';
                }
              })
            }
          </script>";
  }
}
?>