<?php
include('../conecta.php');

$busca = "SELECT * FROM aluno";
$resultado = mysqli_query($connectionDb, $busca);

// $_SESSION["alunosData"] = array();

if (mysqli_num_rows($resultado) > 0) {
    $val = '';
    while ($row = $resultado->fetch_assoc()) {
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $endereco = $row['endereco'];
        $nasc = $row['data_nascimento'];
        //die(var_dump($nasc));
        $partes = explode('-', $nasc, 3);
        $data = $partes[2] . "/" . $partes[1];
        $ano = $partes[0];

        $queryE = "SELECT email FROM usuario WHERE nome = '$nome'";
        $resE = mysqli_query($connectionDb, $queryE);
        $rowE = $resE->fetch_assoc();

        $email = $rowE['email'];


        $val .= "<td>
        <div class='d-flex px-2 py-1'>
            <div>
                <img src='\aplicacao\assets\img\perfil-aluno.png'
                    class='avatar avatar-sm me-3' alt='user1'>
            </div>
            <div class='d-flex flex-column justify-content-center'>
                <h6 class='mb-0 text-sm'>$nome</h6>
                <p class='text-xs text-secondary mb-0'>$email</p>
            </div>
        </div>
    </td>
    <td>
    <p class='text-xs font-weight-bold mb-0'>$data</p>
    <p class='text-xs text-secondary mb-0'>$ano</p>
        
    </td>
    <td class='align-middle text-center text-sm'>
    <p class='text-xs font-weight-bold mb-0'>$cpf</p>
    </td>
    <td class='align-middle text-center'>
    <p class='text-xs font-weight-bold mb-0'>$endereco</p>
    </td>


    <td class='align-middle'>
        <a href='edit.php?nome=" . urlencode($nome) . " &email=" . urlencode($email) . " &cpf=" . urlencode($cpf) . " &endereco=" . urlencode($endereco) . "'  data-toggle='tooltip' data-original-title='Edit user'  class='text-secondary font-weight-bold text-xs btn if-bg text-white'>
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

//var_dump($_SESSION["alunosData"]);
?>