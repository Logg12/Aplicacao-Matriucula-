<?php
include('../conecta.php');

$id = $_SESSION['dados']['aluno_id'];
$busca = "SELECT m.disciplina_id, d.nome FROM matricula m JOIN disciplina d ON m.disciplina_id = d.id WHERE m.aluno_id = '$id'";
$resultado = mysqli_query($connectionDb, $busca);

if (mysqli_num_rows($resultado) > 0) {
    $val = '';
    while ($row = $resultado->fetch_assoc()) {
        $nomeDisciplina = $row['nome'];
        $val .= "<tr>
            <td class='text-center'>$nomeDisciplina</td>
        </tr>";
    }
} else {
    $val = "<p class='text-xs font-weight-bold mb-0'>Dados não encontrados!</p>";
}

echo $val;
?>