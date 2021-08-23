<?php
//Definindo os Paramentros da Base de Dados

define("DB_HOST", "51.38.121.199");
define("DB_USER", "lifelife_balango");
define("DB_PASS", "Balango@dev1");
define("DB_NAME", "lifelife_sgpi");

define("ROOT_PATH", "/lifelife_sgpi/");
define("ROOT_URL", "https://51.38.121.199/lifelife_sgpi/");


?>


<?php
            if(isset($_POST['nome_utilizador'])){
                $nome_utilizador = $_POST['identificadornome_utilizador_utilizador_login'];
                $senha_utilizador = $_POST['senha_utilizador'];
                if (!empty($nome_utilizador) && !empty($senha_utilizador)){
                    $u->conectar();
                    if ($u->msgErro==""){
                    if($u->login($nome_utilizador,$senha_utilizador)){
                        header("location:views/home/home.php");
                    }else{
                        ?>
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