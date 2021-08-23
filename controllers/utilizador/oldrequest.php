<?php
session_start();
require_once "../../models/main.php";
$u= new Usuario;


$u->conectar();
//$u->userquest($id_utilizador);

?>