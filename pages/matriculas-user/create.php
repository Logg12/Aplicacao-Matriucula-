<?php
include('../conecta.php');
$busca = 'SELECT * FROM disciplina;';
$result = mysqli_query($connectionDb, $busca);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {
        $nome = $row['nome'];
        $ch = $row['carga_horaria'];
        $id_disciplina = $row['id'];

        $val .= "<tr>
        <td>$nome</td>
        <td>$ch Horas</td>
        <td>
            <div class='form-check form-check-inline'>
                <input class='form-check-input' type='checkbox'
                    id='checkboxAdd' name='disciplinas[]' value='$id_disciplina'>
                <label class='form-check-label'
                    for='checkboxAdd'>Adicionar</label>
            </div>
        </td>
    </tr>";
    }

} else {
    $val = 'Busca feita com erro!';
}
echo $val;


?>