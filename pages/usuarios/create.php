<?php
include('../conecta.php');

$busca = "SELECT * FROM usuario";
$resultado = mysqli_query($connectionDb, $busca);

if (mysqli_num_rows($resultado) > 0) {
    $val = '';
    while ($row = $resultado->fetch_assoc()) {
        $nome = $row['nome'];
        $email = $row['email'];

        $dataCriacao = $row['datahora_criacao'];
        $dataObjeto = new DateTime($dataCriacao);
        $data_criacao = $dataObjeto->format('d/m/Y - H:i');

        $dataAtualizacao = $row['datahora_atualizacao'];
        $dataObjeto2 = new DateTime($dataAtualizacao);
        $data_atualizacao = $dataObjeto2->format('d/m/Y - H:i');

        $ultimoAcesso = $row['ultimo_acesso'];
        $dataObjeto3 = new DateTime($ultimoAcesso);
        $ultimo_acesso = $dataObjeto3->format('d/m/Y - H:i');
        $id_user = $row['id'];

        $val .= "<td>
        <div class='d-flex px-2 py-1'>
            <div>
                <img src='\aplicacao\assets\img\perfil.png'
                    class='avatar avatar-sm me-3' alt='user1'>
            </div>
            <div class='d-flex flex-column justify-content-center'>
                <h6 class='mb-0 text-sm'>$nome</h6>
                <p class='text-xs text-secondary mb-0'>Cod: $id_user</p>
            </div>
        </div>
    </td>
    <td>
    <p class='text-xs font-weight-bold mb-0'>$email</p>
    
        
    </td>
    <td class='align-middle text-center text-sm'>
    <p class='text-xs font-weight-bold mb-0'>$data_criacao</p>
    </td>
    <td class='align-middle text-center'>
    <p class='text-xs font-weight-bold mb-0'>$data_atualizacao</p>
    </td>
    <td class='align-middle text-center'>
    <p class='text-xs font-weight-bold mb-0'>$ultimo_acesso</p>
    </td>


    <td class='align-middle'>
        <a href='javascript:;' class='text-secondary font-weight-bold text-xs btn if-bg text-white '
            data-toggle='tooltip' data-original-title='Edit user'>
            Editar
        </a>
    </td>
    <td class='align-middle '>
        <a href='javascript:;' class='text-secondary font-weight-bold text-xs btn bg-danger text-white'
            data-toggle='tooltip' data-original-title='Delet user'>
            Deletar
        </a>
    </td>
</tr>";
    }
} else {
    $val = "<p class='text-xs font-weight-bold mb-0'>Dados não encontrados!</p>";
}
echo $val;
?>