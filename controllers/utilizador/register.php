<?php
require_once "../../models/main.php";
$u = new Usuario;

if (isset($_POST['adicionar'])){
$nome_utilizador = $_POST['nome_utilizador'];
$email_utilizador = $_POST['email_utilizador'];
$id_cargo = $_POST['cargo'];
$perfil_utilizador = $_POST['perfil_utilizador'];
$senha_utilizador = $_POST['senha_utilizador'];

// verificar se campos estao limpos
    if (!empty($nome_utilizador) && !empty($email_utilizador) && !empty($id_cargo) && !empty($perfil_utilizador) && !empty($senha_utilizador)){
    $u->conectar();
    $u->adicionar_usuario($nome_utilizador,$email_utilizador,$id_cargo,$perfil_utilizador,$senha_utilizador);
//    echo "O seu registro foi feito com Sucesso";
        echo '<script type="text/javascript">';
        echo 'alert("O seu registro foi feito com Sucesso");';
        echo 'window.location.href = "../../login.php";';
        echo '</script>';
    }else{
        echo "Preencha todos campos";
    }
}

?>
