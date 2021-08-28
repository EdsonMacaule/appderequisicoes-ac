<?php
require_once "../../models/main.php";
$u = new Usuario;

if(isset($_POST['login_form'])){
    $email_utilizador = $_POST['email_utilizador'];
    $senha_utilizador = $_POST['senha_utilizador'];
//    $u->conectar();
    $u->login($email_utilizador,$senha_utilizador);

}
?>