<?php
include('../conecta.php');
$busca = "SELECT * FROM matricula";
$resultado = mysqli_query($connectionDb, $busca);

if (mysqli_num_rows($resultado) > 0) {
    $alunos = array();

    while ($row = $resultado->fetch_assoc()) {
        $dataOriginal = $row['datahora'];
        $dataObjeto = new DateTime($dataOriginal);
        $data = $dataObjeto->format('d/m/Y - H:i');

        $aluno_id = $row['aluno_id'];
        $disciplina_id = $row['disciplina_id'];

        $nomeAluno = 'Não Encontrado';
        $buscaAluno = mysqli_query($connectionDb, "SELECT nome FROM aluno where id = '$aluno_id'");
        if (mysqli_num_rows($buscaAluno) > 0) {
            $rowAluno = $buscaAluno->fetch_assoc();
            $nomeAluno = $rowAluno['nome'];
        }

        $nomeDisciplina = 'Não Encontrada';
        $buscadisciplina = mysqli_query($connectionDb, "SELECT nome FROM disciplina WHERE id = '$disciplina_id'");
        if (mysqli_num_rows($buscadisciplina) > 0) {
            $rowDisciplina = $buscadisciplina->fetch_assoc();
            $nomeDisciplina = $rowDisciplina['nome'];
        }

        // Verifica se o aluno já está no array
        if (!isset($alunos[$nomeAluno])) {
            // Se não estiver, adiciona o aluno ao array com um array vazio de disciplinas
            $alunos[$nomeAluno] = array('disciplinas' => array());
        }

        // Adiciona a disciplina ao array de disciplinas do aluno
        $alunos[$nomeAluno]['disciplinas'][] = $nomeDisciplina;
    }

    $val = '';
    foreach ($alunos as $nomeAluno => $dadosAluno) {
        $val .= "<tr>
            <td class='text-center'>
                <div class='d-flex px-2 py-1'>
                    <div>
                        <img src='\aplicacao\assets\img\perfil.png' class='avatar avatar-sm me-3' alt='user1'>
                    </div>
                    <div class='d-flex flex-column justify-content-center'>
                        <h6 class='mb-0 text-sm'>$nomeAluno</h6>
                        <p class='text-xs text-secondary mb-0'>$email</p>
                    </div>
                </div>
            </td>
            <td class='text-center'>
                <p class='text-xs font-weight-bold mb-0'>$data</p>
                <p class='text-xs text-secondary mb-0'>$ano</p>
            </td>
            <td class='align-middle text-center text-sm'>";

        if (isset($dadosAluno['disciplinas'])) {
            $disciplinas = $dadosAluno['disciplinas'];
            $numDisciplinas = count($disciplinas);
            $tableClass = $numDisciplinas <= 3 ? 'table table-sm table-striped mx-auto' : 'table table-sm table-bordered table-striped mx-auto';
            $val .= "<table class='$tableClass'>";
            $count = 0;

            foreach ($disciplinas as $disciplina) {
                if ($count % 3 === 0 && $count !== 0) {
                    $val .= "</tr><tr>";
                }

                $val .= "<td class='text-center'>$disciplina</td>";
                $count++;
            }

            $val .= "</tr></table>";
        } else {
            $val .= "<p class='text-xs font-weight-bold mb-0'>Nenhuma disciplina matriculada</p>";
        }

        $val .= "</td>
            <td class='align-middle text-center'>
                <a href='#' data-toggle='tooltip' data-original-title='Edit user' class='btn if-bg btn-sm'>Editar</a>
            </td>
            <td class='align-middle text-center'>
                <a href='javascript:;' class='btn btn-danger btn-sm' data-toggle='tooltip' data-original-title='Delet user'>Deletar</a>
            </td>
        </tr>";
    }
} else {
    $val = "<p class='text-xs font-weight-bold mb-0'>Dados não encontrados!</p>";
}

echo $val;
?>