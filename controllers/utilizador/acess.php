<?php
require_once "../../models/main.php";
$u = new Usuario;

if(isset($_POST['email_utilizador'])){
    $email_utilizador = $_POST['email_utilizador'];
    $senha_utilizador = $_POST['senha_utilizador'];
    if (!empty($email_utilizador) && !empty($senha_utilizador)){
        $u->conectar();
        if ($u->msgErro==""){
            if($u->login($email_utilizador,$senha_utilizador)){
//                header("location:../users.php");
            }else{
                ?>
                <style>
                    div.msg-erro{
                        width: 200px;
                        margin: 20px auto;
                        padding: 10px;
                        background-color: #ff0066;
                        text-align: center;
                    }
                </style>
                <div class="msg-erro">
                    Email e/ou Senha invalidos!
                </div>
                <?php
            }
        }else{
            ?>

            <div class="msg-erro">
                <?php echo "Erro: ".$u->msgErro; ?>
            </div>
            <?php
        }
    }else{
        ?>
        <div class="msg-erro">
            Preencha todos so Campos
        </div>
        <?php
    }
}
?>