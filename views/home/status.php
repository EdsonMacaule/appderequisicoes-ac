<?php
session_start();
require_once "../../models/main.php";
$u=new Usuario;


if (isset($_POST['update_form'])){

    $id_pedido=$_POST['pedido_id'];
    $id_prioridade=$_POST['id_prioridade'];
    $id_estado=$_POST['update_estado'];

    $u->request_update($id_estado,$id_prioridade,$id_pedido);

}

?>