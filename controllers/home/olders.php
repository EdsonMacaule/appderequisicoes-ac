<?php
session_start();
require_once "../../models/main.php";
$u = new Usuario;


if (isset($_POST['submeter_form'])) {
    $descicao_pedido = $_POST['pedido'];
    $id_utilizador = $_POST['utilizador'];
    $id_departamento = $_POST['dep'];
    $id_estado = $_POST['estado'];
    $id_prioridade = $_POST['prioridade'];
//    echo "Chegamos aqui";
//
    $dados=$u->request($descicao_pedido, $id_utilizador, $id_departamento, $id_estado, $id_prioridade);
//
//    var_dump($dados);
//    if (!empty($descicao_pedido) && !empty($id_utilizador) && !empty($id_departamento) && !empty($id_estado) && !empty($id_prioridade)) {
//
//        $dados=$u->request($descicao_pedido, $id_utilizador, $id_departamento, $id_estado, $id_prioridade);
//
////        echo '<script type="text/javascript">';
////             echo 'alert("preencha todos campos!");';
//////             echo 'window.location.href = "../../views/home/home.php";';
////             echo '</script>';
//    }
}



?>