<?php
session_start();
include('conecta.php');

$id = $_SESSION['dados']['aluno_id'];
$buscaTel = "SELECT * FROM telefone WHERE aluno_id = $id";
$busca = mysqli_query($connectionDb, $buscaTel);

//die(var_dump(mysqli_num_rows($busca)));
if (mysqli_num_rows($busca) > 0) {
    $res = '';
    //die(var_dump($busca));

    while ($row = $busca->fetch_assoc()) {
        $number = $row['numero'];
        $whatsapp = $row['whatsapp'];

        $res .= "<div class='row'>
        <div class='col-md-4'>
            <div class='form-group'>
                <label for='example-text-input' class='form-control-label'>Telefone
                    1</label>
                <input class='form-control tels' id='numtel1' type='number_format'
                    oninput='mascara_telefone(this)' value='$number' name ='tels[]'
                    required>
            </div>
        </div> 
        

    <div class='col-sm-1 d-flex justify-content-center align-items-center'>

    <div class='form-check form-check-inline pt-3'>";
        if ($whatsapp === '1') {
            $res .= "<input class='form-check-input' type='checkbox' class='zapCheckbox'
        id='checkboxZap'  name='zapCheck[]' checked>";
        } else {
            $res .= "<input class='form-check-input' type='checkbox' class='zapCheckbox'
        id='checkboxZap' name='zapCheck[]'>";
        }
        $res .= "<label class='form-check-label'
        for='checkboxZap'><b>Whatsapp</b></label>
</div>

    </div>

    <div class='col-md-3 ms-auto my-2'>

        <button class='btn bg-warning btn-sm mt-4 ms-5'>
            <i class='fa fa-trash' style='color: white; width: 1rem;'></i>
        </button>
    </div>
</div>";
    }
} else {
    $res = "<div class='row no-tel-cad'>
    <div class='col-md-4'>
        <div class='form-group'>
            <p class=text-danger><i class='fa-solid fa-triangle-exclamation' style='color: #f5365c;'></i> <b> Nenhum Telefone Cadastrado! (Adicione um novo)</b></p>
        </div>
    </div>
    </div>";
}
echo $res;

?>