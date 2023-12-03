<?php
include('../conecta.php');

$busca = "SELECT * FROM disciplina";
$resultado = mysqli_query($connectionDb, $busca);

if (mysqli_num_rows($resultado) > 0) {
    $val = '';
    while ($row = $resultado->fetch_assoc()) {
        $nome = $row['nome'];
        $carga_Horaria = $row['carga_horaria'];
        $sigla = $row['sigla'];
        $id = $row['id'];

        $query = "SELECT descricao FROM ementa WHERE disciplina_id = '$id'";
        $res = mysqli_query($connectionDb, $query);
        $row2 = $res->fetch_assoc();

        $descricao = $row2['descricao'];

        $val .= "<td>
        <div class='d-flex px-2 py-1'>
            <div>
                <img src='\aplicacao\assets\img\perfil-disciplina.png'
                    class='avatar avatar-sm me-3' alt='user1'>
            </div>
            <div class='d-flex flex-column justify-content-center'>
                <h6 class='mb-0 text-sm'>$nome</h6>
                <p class='text-xs text-secondary mb-0'>Cod: $id</p>
            </div>
        </div>
    </td>
    <td>
    <p class='text-xs font-weight-bold mb-0'>0$carga_Horaria:00</p>
    <p class='text-xs text-secondary mb-0'>Horas</p>
        
    </td>
    <td class='align-middle text-center text-sm'>
    <p class='text-xs font-weight-bold mb-0'>$sigla</p>
    </td>
    <td class='align-middle text-center'>
    <p class='text-xs font-weight-bold mb-0'>$descricao</p>
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